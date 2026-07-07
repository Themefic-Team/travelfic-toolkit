const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// Custom plugin to prevent emitting the temporary .js / .js.map files generated for CSS-only entries
class RemoveStyleJsPlugin {
    apply(compiler) {
        compiler.hooks.emit.tap('RemoveStyleJsPlugin', (compilation) => {
            Object.keys(compilation.assets).forEach((asset) => {
                if (asset.endsWith('.js') || asset.endsWith('.js.map')) {
                    const cssAsset = asset.replace(/\.js(\.map)?$/, '');
                    if (compilation.assets[cssAsset] || compilation.assets[cssAsset + '.map']) {
                        delete compilation.assets[asset];
                    }
                }
            });
        });
    }
}

// Style Entry Points
const StyleEntryPoints = {
    'style': './sass/app/style.scss'
};

const styleMinConfig = {
    entry: StyleEntryPoints,
    devtool: 'source-map',
    performance: {
        hints: false,
        maxEntrypointSize: 500,
        maxAssetSize: 500
    },
    output: {
        path: path.resolve(__dirname, 'assets/app/css/'),
        filename: '[name].min.css.js',
        clean: false
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    'style-loader',
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            esModule: false,
                        },
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            sourceMap: true
                        },
                    },           
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                            sassOptions: {
                                outputStyle: "compressed",
                              },
                        },
                    },         
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].min.css',
        }),
        new RemoveStyleJsPlugin()
    ]
}

const StyleConfig = {
    entry: StyleEntryPoints,
    devtool: 'source-map',
    performance: {
        maxEntrypointSize: 500,
        maxAssetSize: 500
    },
    output: {
        path: path.resolve(__dirname, 'assets/app/css/'),
        filename: '[name].css.js',
        clean: false
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    'style-loader',
                    {
                        loader: MiniCssExtractPlugin.loader, 
                        options: {
                            esModule: false,
                        },
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            sourceMap: true
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                            sassOptions: {
                                outputStyle: "expanded",
                              },
                        },
                    },         
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
        new RemoveStyleJsPlugin()
    ]
}

module.exports = [StyleConfig, styleMinConfig];
