const mongoose = require("mongoose");

const Schema = mongoose.Schema;

const characterScheme = new Schema({
    name: {
        type: String,
        required: true
    },

    serverId: {
        type: Number,
        required: true
    },

    population: {
        type: Schema.Types.ObjectId,
        ref: 'Population',
    }
});

module.exports = mongoose.model("Population", characterScheme);