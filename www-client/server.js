const express = require('express');

const cookieParser = require("cookie-parser");
let bodyParser = require('body-parser');

const session = require('express-session');
const redisStore = require('connect-redis')(session);
const { createClient } = require('redis');

const client = createClient( {
    host: "session",
    port: 6379,
    legacyMode: true,
   url: "redis://redis"
});


const mongoose = require("mongoose");
const app = express();

const  sessionStore = new redisStore({ client: client });

app.use(session({
    store: sessionStore,
    secret: "lobster",
    resave: false,
    saveUninitialized: false,
    cookie: {
        resave: false,
        saveUninitialized: false,

        secure: false, // if true only transmit cookie over https
        httpOnly: true, // if true prevent client side JS from reading the cookie
        maxAge: 1000 * 60 * 60 * 24 // session max age in miliseconds

    }
}));

const path = require('path');
app.use(express.static(__dirname));


// Initialization
app.use(cookieParser());

//app.use(bodyParser.json());
//app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.urlencoded({ extended: false }));

app.set("view engine", "ejs");
app.set('views', path.join(__dirname, 'views'));

// определяем Router
const homeRouter = require("./mvc/routes/homeRouter.js")
const userRouter = require("./mvc/routes/userRouter.js");
const authRouter = require("./mvc/routes/authRouter.js");

// определяем маршруты и их обработчики внутри роутера userRouter
app.use("/auth", authRouter);
app.use("/users", userRouter);
app.use("/", homeRouter);


//app.use("/", async (request, response)=>{
    //await client.connect();
    //await  response.status(200).send("nice");
    //await client.disconnect();
//});


// обработка ошибки 404
app.use(function (req, res, next) {
    res.status(404).send("Not Found")
});

async function main() {
    try{
        mongoose.set('strictQuery', false);
        await client.connect();
        await mongoose.connect("mongodb://mongo:27017/usersdb"
            ,{
                useNewUrlParser: true,
                useUnifiedTopology: true,
            }
        );

        //await client.connect().catch(console.error);
        //console.log(client.isOpen); // this is true
        //await client.disconnect();

        await app.listen(3000);
        console.log("Сервер ожидает подключения...");
    }
    catch(err) {
        return console.log(err);
    }
}
main(); // запускаем приложение

// прослушиваем прерывание работы программы (ctrl-c)
process.on("SIGINT", async() => {
    await mongoose.disconnect();
    console.log("Приложение завершило работу");
    process.exit();
});

//app.listen(3000, () => {
//    console.log('Express is listening on port 3000!')
//})*/