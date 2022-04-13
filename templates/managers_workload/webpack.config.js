const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
 
module.exports = {
    mode: 'development',
    entry: './src/index.js',
    output: {
        path: path.resolve(__dirname, './'),
        filename: './script.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            },
            {
                test: /\.js$/,
                use: {
                    loader: "babel-loader"
                }
            },   
            {
                test: /\.scss$/,
                use: [
                'style-loader',
                'css-loader',
                'sass-loader'
                ]
            }        
        ],
 
    },    
    plugins: [
        new VueLoaderPlugin()
    ]
}

