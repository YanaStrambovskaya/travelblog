const path = require('path'); // Node.js build-in module for handling and transforming file pathes.
const MiniCssExtractPlugin = require('mini-css-extract-plugin'); // plugin that extracts CSS into separate file instead of keeping it in JS bundle.
const { CleanWebpackPlugin } = require('clean-webpack-plugin'); // Cleans the output folder before each build, so you do not accumulate old files there.

const isProd = process.env.NODE_ENV === 'production';

module.exports = {
  entry: {
    // this defines where Webpuck starts the building process.
    main: './frontend/src/js/main.js',
    style: './frontend/src/scss/main.scss',
    reactApp: './frontend/src/react/index.jsx',
  },

  output: {
    // define where and how bundles are safed
    filename: 'js/[name].bundle.js', // [name] - will be replaced by 'entry' property keys (main, styles, reactApp).
    path: path.resolve(__dirname, 'public'),
    publicPath: '', // we will handle full URL in PHP
  },

  mode: isProd ? 'production' : 'development',

  devtool: isProd ? false : 'source-map',

  module: {
    rules: [
      // how webpack handes .jsx and .scss
      {
        test: /\.(js|jsx)$/, // ⬅️ handle .js AND .jsx (finds all files that end with .js and .jsx).
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', { targets: 'defaults' }],
              ['@babel/preset-react'], // ⬅️ make sure this is installed
            ],
          },
        },
      },
      {
        test: /\.scss$/i, // finds all .scss files.
        use: [
          MiniCssExtractPlugin.loader, // extracts css to separate file instead injecting it into JS bundle.
          {
            loader: 'css-loader', // handle @import and url() in CSS.
            options: { sourceMap: !isProd, url: false },
          },
          {
            loader: 'sass-loader', // SCSS -> CSS.
            options: {
              sourceMap: !isProd,
            },
          },
        ],
      },
      // {
      //   test: /\.css$/i,
      //   use: [MiniCssExtractPlugin.loader, 'css-loader'],
      // },
      // 🔹 Images (used in SCSS or JS)
      // {
      //   test: /\.(png|jpe?g|gif|svg|webp)$/i,
      //   type: 'asset/resource',
      //   generator: {
      //     filename: 'images/[name][ext]', // public/images/your-image.webp
      //   },
      // },

      // 🔹 Fonts
      // {
      //   test: /\.(woff2?|eot|ttf|otf)$/i,
      //   type: 'asset/resource',
      //   generator: {
      //     filename: 'fonts/[name][ext]', // public/fonts/your-font.woff2
      //   },
      // },
    ],
  },

  plugins: [
    new CleanWebpackPlugin(), // delete old files in /public derectory before each build
    new MiniCssExtractPlugin({
      // create css file
      filename: 'css/[name].css',
    }),
  ],

  // optimization: {
  //   minimize: isProd, // only optimize in production
  //   minimizer: [
  //     '...', // extend existing minimizers (JS, CSS)
  //     new ImageMinimizerPlugin({
  //       minimizer: {
  //         implementation: ImageMinimizerPlugin.imageminMinify,
  //         options: {
  //           plugins: [
  //             ['mozjpeg', { quality: 75 }],
  //             ['pngquant', { quality: [0.65, 0.8] }],
  //             ['svgo', {}],
  //             ['webp', { quality: 75 }],
  //           ],
  //         },
  //       },
  //     }),
  //   ],
  // },

  // So imports like url('../images/..') could be handled later if needed
};
