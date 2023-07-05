const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = {
    entry: {
        main: './src/app.js',
        'invoices': './src/invoices.js',
        'ckeditor': './src/js/ckeditor.js',
        'geos': './src/js/geos.js'
    },
    output: {
        path: path.resolve(__dirname, './assets'),
        filename: 'js/[name].min.js',
        publicPath: 'auto',
        clean: true
    },
    resolve: {
        alias: {
            jquery: "jquery/src/jquery",
            cascadingDropdown: 'jquery-cascading-dropdown/src/jquery.cascadingdropdown.js'
//            '@animate': path.resolve(__dirname, './assets/src/js/animate.js'),
//            '@form': path.resolve(__dirname, './assets/src/js/custom-form.js'),
//            'vanillaSelectBox': 'vanillaselectbox/vanillaSelectBox.js'
        }
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: './css/[name].min.css'
        }),
        new CleanWebpackPlugin({
            cleanOnceBeforeBuildPatterns: [path.join(__dirname, 'assets/**/*')]
        }),
//        new webpack.ProvidePlugin({
//            gsap: "gsap"
//        })
    ],
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    {
                        loader: "css-loader"
                    },
                    {
                        loader: "resolve-url-loader"
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true,
                        }
                    }
                ]
            },
            {
                test: /\.(png|jp(e*)g|svg|webp)$/,
                type: 'asset/resource',
                generator: {
                    filename: './images/[name][ext]'
                }
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: "asset/resource",
                generator: {
                    filename: "./fonts/[name][ext]",
                }
            }
        ]
    },
    optimization: {
        minimize: true,
        minimizer: [
            new CssMinimizerPlugin(),
            new TerserPlugin()
        ]
    }
};