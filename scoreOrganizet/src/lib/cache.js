const Redis = require("ioredis");

class cache {
  constructor() {
    this.redis = new Redis({
      host: process.env.REDIS_HOST || "localhost",
      port: process.env.REDIS_PORT || 6379,
      keyPrefix: "cache:",
    });
  }

  async get(key) {
    const value = await this.redis.get(key);

    return value ? JSON.parse(value) : null;
  }

 async set(key, value, timeExp) {
    try {
      return await this.redis.set(key, JSON.stringify(value), "EX", timeExp);
    } catch (error) {
      // console.dir("errooooooooe")
      console.log(error)
      
    }
  }

  del(key) {
    return this.redis.del(key);
  }

  async delPrefix(prefix) {
    const keys = (await this.redis.keys(`cache:${prefix}:*`)).map((key) =>
      key.replace("cache:", "")
    );

    return this.redis.del(keys);
  }
}
module.exports = new cache();
