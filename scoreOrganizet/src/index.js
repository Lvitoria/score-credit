require("dotenv/config");
const express = require("express");
const expressListEndpoints = require('express-list-endpoints')
const user = require('./controllers/user');
const score = require('./controllers/score')

const app = express();

app.use(express.json())

app.get("/test", async (req, res) => {
  return res.json({'status':200,'message': "Api rodando"});
});


//user
app.post("/cadastar-usuario", user.registerUser);

app.post("/logar", user.logar);


//score
app.post("/cadastar-score",score.registerScore);

app.get("/baseA/:cpf", score.baseA);

app.get("/baseB/:cpf", score.baseB);

app.get("/baseC/:cpf", score.baseC);



app.listen(process.env.PORT || "3000", ()=> {
    // console.log(expressListEndpoints(app))
    console.log(`Api rodando na porta ${process.env.PORT || "3000"}`)
});
