const mix = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');
        var webpackConfig = {
                plugins: [
                    new VuetifyLoaderPlugin()
                    // other plugins ...
                ]
            // other webpack config ...
        }
        mix.webpackConfig(webpackConfig);

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/bootstrap.js', 'public/js');
/*
if (mix.inProduction()) {

    // disable notifications
    mix.disableNotifications();

    // version all the assets
    mix.version();

} else {
    mix.browserSync({
        proxy: 'localhost',
        open: false,
        watch: true,
    })
};*/