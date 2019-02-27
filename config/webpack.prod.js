const webpackMerge = require('webpack-merge'),
    baseConfig = require('./webpack.base'),
    OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin"),
    UglifyJsPlugin = require("uglifyjs-webpack-plugin");

const ENV = process.env.NODE_ENV = process.env.ENV = 'production';

module.exports = webpackMerge(baseConfig, {
	mode: ENV,
    devtool: 'source-map',
    optimization: {
        minimizer: [
            new OptimizeCSSAssetsPlugin({
                cssProcessorOptions: { map: { annotation: true, inline: false, } }
            }),
            new UglifyJsPlugin({
                cache: true,
                parallel: true,
                sourceMap: true
            }),
        ]
    },
    plugins: [
    ]
});