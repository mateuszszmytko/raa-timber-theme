const path = require('path'),
    MiniCssExtractPlugin = require("mini-css-extract-plugin"),
    autoprefixer = require('autoprefixer'),
    MergeIntoSingleFilePlugin = require('webpack-merge-and-include-globally');

module.exports = {
    devtool: 'source-map',
    entry: {
        polyfills: './src/polyfills.js',
        main: './src/page.js',
        'block-editor': './src/block-editor.js',
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
            },
            {
                test: /\.m?(js|jsx)$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            [
                                "@babel/preset-env",
                                {
                                  "useBuiltIns": "usage"
                                }
                            ],
                            '@babel/preset-react'
                        ],
                    }
                }
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[id].css"
        }),
        new MergeIntoSingleFilePlugin({
            files: {
                "vendors.js": [
                    './src/scripts/vendors/*',
                ]
            },
            transform: {
                'vendors.js': code => require("uglify-js").minify(code).code
            }
        }),
    ]
};