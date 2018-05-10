var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .autoProvideVariables({
        "window.jQuery": "jquery",
        // "window.Bloodhound": require.resolve('bloodhound-js'),
        "jQuery.tagsinput": "bootstrap-tagsinput"
    })
    .enableSassLoader()
    .enableVueLoader()
    .enableVersioning(false)
    .createSharedEntry('js/common', ['jquery'])
    .addEntry('js/main', './assets/typescript/main.ts')
    .enableTypeScriptLoader()
    .addStyleEntry('css/app', ['./assets/scss/app.scss'])
    .enableSourceMaps(!Encore.isProduction())
    .enableSourceMaps()
;

module.exports = Encore.getWebpackConfig();
