module.exports = {
  transpileDependencies: ["vuetify"],
  devServer: {
    proxy: "http://php:8000"
  }
};
