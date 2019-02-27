const webpackMerge = require('webpack-merge'),
    baseConfig = require('./webpack.base'),
    BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const ENV = process.env.NODE_ENV = process.env.ENV = 'production';

module.exports = webpackMerge(baseConfig, {
    mode: ENV,
    watch: true,
    devtool: 'source-map',
    plugins: [
        new BrowserSyncPlugin({
            proxy: 'localhost/wp_theme',
            files: ['./*.php', './views/**/*.twig', './assets/**/*.*'],
        }),
    ]
});