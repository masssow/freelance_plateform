const webpack = require('webpack');

const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .addStyleEntry('global', './assets/styles/global.scss')
    .addStyleEntry('style', './assets/styles/simple_home/style.scss')
    .addEntry('apexcharts-custom', './assets/js/vendor/apexcharts.custom.js')
    .addEntry('apexcharts', './assets/js/vendor/apexcharts.min.js')
    .addEntry('apps', './assets/js/vendor/apps.js')
    .addEntry('bootstrap-datepicker', './assets/js/vendor/bootstrap-datepicker.min.js')
    .addEntry('chart', './assets/js/vendor/chart.min.js')
    .addEntry('config', './assets/js/vendor/config.js')
    .addEntry('d3', './assets/js/vendor/d3.min.js')
    .addEntry('datamaps-all', './assets/js/vendor/datamaps.all.min.js')
    .addEntry('datamaps-custom', './assets/js/vendor/datamaps.custom.js')
    .addEntry('datamaps-zoomto', './assets/js/vendor/datamaps-zoomto.js')
    .addEntry('dataTables-bootstrap4', './assets/js/vendor/dataTables.bootstrap4.min.js')
    .addEntry('daterangepicker', './assets/js/vendor/daterangepicker.js')
    .addEntry('dropzone', './assets/js/vendor/dropzone.min.js')
    .addEntry('fullcalendar-custom', './assets/js/vendor/fullcalendar.custom.js')
    .addEntry('gauge', './assets/js/vendor/gauge.min.js')
    .addEntry('jquery-datatables', './assets/js/vendor/jquery.dataTables.min.js')
    .addEntry('jquery-mask', './assets/js/vendor/jquery.mask.min.js')
    .addEntry('jquery', './assets/js/vendor/jquery.min.js')
    .addEntry('jquery-sparkline', './assets/js/vendor/jquery.sparkline.min.js')
    .addEntry('jquery-steps', './assets/js/vendor/jquery.steps.min.js')
    .addEntry('jquery-stickOnScroll', './assets/js/vendor/jquery.stickOnScroll.js')
    .addEntry('jquery-timepicker', './assets/js/vendor/jquery.timepicker.js')
    .addEntry('jquery-validate', './assets/js/vendor/jquery.validate.min.js')
    // .addEntry('moment', './assets/js/vendor/moment.min.js')
    .addEntry('perfect-scrollbar', './assets/js/vendor/perfect-scrollbar.min.js')
    .addEntry('popper', './assets/js/vendor/popper.min.js')
    .addEntry('quill', './assets/js/vendor/quill.min.js')
    .addEntry('select2', './assets/js/vendor/select2.min.js')
    .addEntry('simplebar', './assets/js/vendor/simplebar.min.js')
    .addEntry('tinycolor', './assets/js/vendor/tinycolor-min.js')
    .addEntry('topojson', './assets/js/vendor/topojson.min.js')
    .addEntry('uppy', './assets/js/vendor/uppy.min.js')
//  Point d'entrée home_simple
    .addStyleEntry('owl_carousel_css', './node_modules/owl.carousel/dist/assets/owl.carousel.min.css')    
    .addStyleEntry('aos', './node_modules/aos/dist/aos.css')
    .addEntry('landingpage', './assets/js/home_js/landingpage.js')
    .addEntry('owl_carousel_js', './node_modules/owl.carousel/dist/owl.carousel.min.js')


 // Activer le traitement des images
    .copyFiles({
        from: './assets/images',

        to: 'images/[path].[hash:8].[ext]',

        to: 'images/[path][name].[hash:8].[ext]',
        
        pattern: /\.(png|jpg|jpeg|svg|ico)$/
    })

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
    // Injecter jQuery dans les modules de l'application
    .addPlugin(new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery'
    }))
;
    
;

module.exports = Encore.getWebpackConfig();
