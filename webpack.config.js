const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const isProd = process.env.NODE_ENV === 'production';

module.exports = {
  entry: {
    main: './frontend/src/js/main.js',
  },

  output: {
    filename: 'js/[name].bundle.js',
    path: path.resolve(__dirname, 'public'),
    publicPath: '', // we will handle full URL in PHP
  },

  mode: isProd ? 'production' : 'development',

  devtool: isProd ? false : 'source-map',

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', { targets: 'defaults' }],
            ],
          },
        },
      },
      {
        test: /\.scss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { sourceMap: !isProd },
          },
          {
            loader: 'sass-loader',
            options: { sourceMap: !isProd },
          },
        ],
      },
    ],
  },

  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
  ],

  // So imports like url('../images/..') could be handled later if needed
};
