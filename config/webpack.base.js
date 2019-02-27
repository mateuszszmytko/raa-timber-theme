const path = require('path'),
    MiniCssExtractPlugin = require("mini-css-extract-plugin"),
    autoprefixer = require('autoprefixer');

module.exports = {
    devtool: 'source-map',
    entry: {
        polyfills: './src/polyfills.js',
        main: './src/page.js',
    },
    
    output: {
        path: path.resolve('./static'),
        publicPath: '',
        filename: '[name].js',
        chunkFilename: '[id].chunk.js'
    },
    resolve: {
        extensions: ['.ts', '.tsx', ".js", ".json"],
    },

    module: {
        rules: [
            { test: /\.ts?$/, use: "ts-loader" },
            {
				test: /\.(png|jpe?g|gif|svg|woff|woff2|ttf|eot|ico)$/,
				loader: 'file-loader?name=assets/[name].[ext]'
			},
			{
				test: /\.(webm|mp4)$/,
				loader: 'file-loader?name=assets/[name].[ext]'
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: 'css-loader', options: { sourceMap: true, url: false } },
                    { loader: 'postcss-loader', options: { sourceMap: true, importLoaders: 1, plugins: () => [autoprefixer({ browsers: ["Explorer >= 11", "last 2 versions"] })] } },
                    { loader: 'sass-loader', options: { sourceMap: true, } }
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[id].css"
        })
    ]
};