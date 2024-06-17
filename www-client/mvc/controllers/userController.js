const User = require("./../models/user");
const Population = require("./../models/population")
const bcrypt = require("bcrypt");
const SALT_WORK_FACTOR = 10;

const token = async (length) => {
    //edit the token allowed characters
    let a = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".split("");
    let b = [];
    for (let i=0; i<length; i++) {
        let j = (Math.random() * (a.length-1)).toFixed(0);
        b[i] = a[j];
    }
    let c = b.join("")
    return c;
}

const hashPassword = async (password, saltRounds = 10) => {
    try {
        // Generate a salt
        const salt = await bcrypt.genSalt(saltRounds)

        // Hash password
        return await bcrypt.hash(password, salt)
    } catch (error) {
        console.log(error)
    }

    // Return null if error
    return null
}


const createPopulation = async function(userId, population) {
    return Population.create(population).then(docPopulation => {
        return User.findByIdAndUpdate(
            userId,
            { $push: { populations: docPopulation._id } },
            { new: false, useFindAndModify: false }
        );
    });
};

const getTutorialWithPopulate = function(id) {
    return User.findById(id).populate("populations");
};


exports.getUsers = async function(request, response){
    const allUsers = await User.find({});
    const user = request.session.user;
    response.render("../mvc/views/users.ejs", { users: allUsers, user: user });
};

exports.addUser = function (request, response){
    response.render("../mvc/views/createUser.ejs");
};


exports.postUser = async function(request, response){
    if(!request.body) return response.sendStatus(400);

    //const token = await token(12);
    const password = await bcrypt.hash(request.body.password, 10);

    const rand=()=>Math.random(0).toString(36).substr(2);
    const tokenFunc=(length)=>(rand()+rand()+rand()+rand()).substr(0,length);
    const token = tokenFunc(20);

    const userName = request.body.login;
    const userAge = request.body.age;
    const email =  request.body.email;

    const user = new User({
        login: userName,
        email: email,
        age: userAge,
        password: password,
        token: token
    });

    //response.render("../mvc/views/users.ejs", { users: user, count:0 });
    request.session.user = user;
    response.cookie('userToken', token, { maxAge: 60 * 60 * 24, httpOnly: true });

    await user.save();
    response.redirect("/users");
};

exports.addPopulation = async function(request, response) {
    let user = request.session.user;
    /*let population = {
        name: request.body.populationName,
        creator: user._id
    };
    await createPopulation(user._id, population);
    */
    let population = await new Population({
            name: request.body.populationName,
            creator: user._id
        });
    await population.save();
    await User.findByIdAndUpdate(
        user._id,
        { $push: { populations: population._id } },
        { new: false, useFindAndModify: false }
    );

    response.send(population);
};

exports.getUserData = async function(request, response) {
    const userData = request.session.user;
    //let user = await getTutorialWithPopulate(userData._id);
    let user = await User.findOne({ _id: userData._id });
    let populations = await Population.find({creator: user._id});
    response.render("../mvc/views/user.ejs", { user: user, populations: populations });
    //let login = await JSON.parse(user);
    //response.send(user.login);
};

/*
exports.postUser= async function(request, response){
    if(!request.body) return response.sendStatus(400);
    const userName = request.body.name;
    const userAge = request.body.age;
    const user = new User({name: userName, age: userAge});

    await user.save();
    response.redirect("/users");
};
*/