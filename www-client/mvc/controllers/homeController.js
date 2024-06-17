const User = require("./../models/user");
exports.index = async function (request, response) {
    //const fileUsers = fs.readFileSync(filePath,"utf8");
    //const users = JSON.parse(fileUsers);
    //response.send("О сайте");
    const sess = request.session;

    if (sess.username && sess.password) {
        if (sess.username) {
            response.write(`<h1>Welcome ${sess.username} </h1><br>`)
            response.write(
                `<h3>This is the Home page</h3>`
            );
            response.end('<a href=' + '/logout' + '>Click here to log out</a >')
        }
    } else {
        response.render('index', {users: []});
    }
};
exports.about = function (request, response) {
    response.send("О сайте");
};