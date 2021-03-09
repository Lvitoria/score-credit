const api = require("../lib/api");
const cache = require("../lib/cache");

module.exports = {
  async registerScore(req, res) {
    try {
        const {status, ...result} = (await api.post('/credit', req.body)).data
        if(status == 201)
        return res.json({ statusCode: status, result })
        else
        throw result.message
    } catch (error) {
        return res.json({ statusCode: 500, error })
    }
  },
  async baseA(req, res) {
    try {
        try {
          const {status, ...result} = (await api.get(`/credit/baseA/${req.params.cpf}`,
          {
            headers: { authorization: req.headers.authorization }
          }
          )).data
          return res.json({ statusCode: status, result })  
        } catch (error) {
          throw error.response.data
        }
    } catch (error) {
        return res.json({ statusCode: error.status || 500, message: error.error })
    }
  },
  async baseB(req, res) {
    try {

        const cached = await cache.get("baseB" + req.params.cpf + req.headers.authorization);
        if (cached) {
          const {result} = cached
          return res.json({ statusCode: cached.status, result  })
        }
        
          const {status, ...result} = (await api.get(`/credit/baseB/${req.params.cpf}`,
           {
            headers: { authorization: req.headers.authorization }
          }
          )).data

          cache.set("baseB" + req.params.cpf + req.headers.authorization, {status, result}, 60 * 15);
          return res.json({ statusCode: status, result })
              
      } catch (error) {
        cache.set("baseB" + req.params.cpf + req.headers.authorization,{ status: error.response.data.status || 500, result: error.response.data.error }, 60 * 15);
        return res.json({ statusCode: error.response.data.status || 500, result: error.response.data.error })
    }
  },
  async baseC(req, res) {
    try {
        const cached = await cache.get("baseC"+req.params.cpf);
        if (cached) {
          const {result} = cached
          return res.json({ statusCode: cached.status, result })
        }
        const {status, ...result} = (await api.get(`/credit/baseC/${req.params.cpf}`)).data
        
        cache.set("baseC"+req.params.cpf, {status, result}, 60 * 15);
        return res.json({ statusCode: status, result })
        
    } catch (error) {
        console.dir("error")
        console.log(error)
        cache.set("baseC"+req.params.cpf,{ status: error.response.data.status || 500, result: error.response.data.error }, 60 * 15);
        return res.json({ statusCode: error.response.data.status || 500, result: error.response.data.error })
    }
  }
}

