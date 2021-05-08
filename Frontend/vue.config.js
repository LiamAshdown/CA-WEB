const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

module.exports = {
  configureWebpack: {
    devtool: 'source-map',
    plugins: [
      new BundleAnalyzerPlugin()
    ]
  },
  chainWebpack: (config) => {
    config
      .plugin('html')
      .tap(args => {
        args[0].meta = { viewport: 'width=device-width, height=device-height, viewport-fit=cover, initial-scale=1, user-scalable=no' }
        return args
      })
  },
  css: {
    loaderOptions: {
      sass: {
        additionalData: `
          @import "@/styles/global.scss";
        `,
        implementation: require('node-sass')
      }
    }
  }
}
