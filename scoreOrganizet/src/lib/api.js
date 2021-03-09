const axios = require("axios");

const api = axios.create({
  baseURL: process.env.SERVICE || "http://localhost:8000/api"
});

module.exports = api;
