const mongoose = require("mongoose");

const Schema = mongoose.Schema;

const populationScheme = new Schema({
    name: {
        type: String,
        required: true
    },
    creator: {
        type: Schema.Types.ObjectId,
        ref: 'User',
    }
});

module.exports = mongoose.model("Population", populationScheme);