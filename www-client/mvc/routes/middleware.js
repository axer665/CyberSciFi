const User = require("./../models/user");
module.exports = async function (req, res, next) {
    //Do your session checking...
    let authorised = false;

    const sess = req.session;
    let cookie = req.cookies;

    //return res.send("user: " + cookie.userToken);

    if (sess.user && sess.user.login) {
        authorised = true;
        if (cookie.userToken === undefined || cookie.userToken == ""){
            res.cookie('userToken', sess.user.token, { maxAge: 900000, httpOnly: true });
        }
        //return res.send("user session: " + sess.user.login);
    } else if (cookie.userToken !== undefined && cookie.userToken != "") {
        let user = await User.findOne({'token': cookie.userToken})

        if (user && user.login) {
            const rand = () => Math.random(0).toString(36).substr(2);
            const tokenFunc = await function (length) { return (rand()+rand()+rand()+rand()).substr(0,length)};
            const token = await tokenFunc(20);

            //update COOKIE
            res.cookie('userToken', token, { maxAge: 900000, httpOnly: true });

            //update model
            User.findOneAndUpdate(
                { login: user.login },
                { token: token },
                { new: false }
            )

            user = await User.findOne({'_id': user._id})

            //update SESSIONS
            req.session.user = user;

            authorised = true;
        } else {
            //res.cookie('userToken', '');
        }
    } else {
        //res.cookie('userToken', '');
    }

    if (authorised) {
        next();
    }
    else {
        res.redirect("/auth");
    }
};