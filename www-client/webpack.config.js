const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCSSPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');

module.exports = {
    mode: 'development',
    devServer: {
        historyApiFallback: true,
        contentBase: path.resolve(__dirname, './dist'),
        open: true,
        compress: true,
        hot: true,
        port: 8080,
    },

    entry: {
        main: path.resolve(__dirname, './src/js/index.js'),
        user: path.resolve(__dirname, './src/js/user.js'),
    },

    output: {
        path: path.resolve(__dirname, './dist'),
        filename: '[name].bundle.js',
    },

    module: {
        rules: [
            // JavaScript
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader'],
            },
            // изображения
            {
                test: /\.(?:ico|gif|png|jpg|jpeg)$/i,
                type: 'asset/resource',
            },
            // шрифты и SVG
            {
                test: /\.(woff(2)?|eot|ttf|otf|svg|)$/,
                type: 'asset/inline',
            },
            // CSS, PostCSS, Sass
            {
                //test: /\.(scss|css)$/,
                //use: ['style-loader', 'css-loader', 'postcss-loader', 'sass-loader'],
                test: /\.(s*)css$/,
                use: [
                    MiniCSSPlugin.loader,
                    'css-loader',
                    'sass-loader',
                ]
            },
        ]
    },

    plugins:[
        new HtmlWebpackPlugin({
            title: 'webpack Titile',
            template: path.resolve(__dirname, './src/html/index.html'), // шаблон
            filename: 'index.html', // название выходного файла
        }),
        new CleanWebpackPlugin(),
        new MiniCSSPlugin({
            filename: '[name].css'
        }),
        new webpack.HotModuleReplacementPlugin(),
    ]
}