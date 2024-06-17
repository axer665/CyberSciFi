const express = require("express");
const userController = require("./../controllers/userController.js");
const userRouter = express.Router();

const session_check = require("./middleware");

userRouter.use("/addPopulation", userController.addPopulation);
userRouter.use("/postUser", userController.postUser);
userRouter.use("/create", userController.addUser);
userRouter.use("/oneUser", session_check, userController.getUserData);
userRouter.use("/addPopulation", session_check, userController.addPopulation);
userRouter.use("/", userController.getUsers);

module.exports = userRouter;