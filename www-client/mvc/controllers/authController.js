const bcrypt = require("bcrypt");
const User = require("./../models/user");

exports.index = function (req, res) {
    //response.render("../mvc/views/users.ejs", { users: allUsers, count:views });
    res.render('../mvc/views/authentication.ejs', {});
};

exports.confirm = async (req, res) => {
    let login = req.body.login;
    const user = await User.findOne({ login: login });
    const password = await bcrypt.compare(req.body.password, user.password);

    if (user && password) {
        const rand=()=>Math.random(0).toString(36).substr(2);
        const tokenFunc=(length)=>(rand()+rand()+rand()+rand()).substr(0,length);
        const token = await tokenFunc(20);

        // update user
        await User.findOneAndUpdate(
            { login: user.login },
            { token: token },
            { new: false }
        );

        let newUser = await User.findOne({'login': user.login})

        req.session.user = newUser;


        //update COOKIE
        await res.cookie('userToken', token, { maxAge: 900000, httpOnly: true });



        res.redirect("/users/oneUser");
    } else {
        res.redirect("/auth");
    }
}