const api = require("../lib/api");

module.exports = {
  async registerUser(req, res) {
    try {
        const {status, ...result} = (await api.post('/store', req.body)).data
        if(status == 201)
        return res.json({ statusCode: status, result })
        else
        throw result.message
    } catch (error) {
        return res.json({ statusCode: 500, error })
    }
  },
  async logar(req, res) {
    try {
        const {status, ...result} = (await api.post('/login', req.body)).data
        if(status == 200)
        return res.json({ statusCode: status, result })
        else throw result.message
    } catch (error) {
        return res.json({ statusCode: 500, error })
    }
  }
}

