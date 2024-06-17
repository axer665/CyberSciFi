const express = require("express");
const authController = require("../controllers/authController.js");
const authRouter = express.Router();

authRouter.post("/confirm", authController.confirm);
authRouter.get("/", authController.index);


module.exports = authRouter;