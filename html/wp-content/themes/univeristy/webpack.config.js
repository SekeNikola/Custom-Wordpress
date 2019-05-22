const path = require('path');

module.exports = {
  entry: {
    App: "./js/scripts.js"
  },
  output: {
    path: path.resolve(__dirname, "./js"),
    // path: path.resolve(__dirname, settings.themeLocation + "js"),
    filename: "scripts-bundled.js"
  },
  module: {
    rules: [{
      test: /\.js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: ['@babel/preset-env']
        }
      }
    }]
  },
  mode: 'development'
}