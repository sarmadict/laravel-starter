let mix = require('laravel-mix');

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


mix.js('resources/assets/accounts/auth/js/vendor.js', 'public/assets/accounts/auth/js')
    .js('resources/assets/accounts/auth/js/app.js', 'public/assets/accounts/auth/js')
    .sass('resources/assets/accounts/auth/sass/vendor.scss', 'public/assets/accounts/auth/css')
    .sass('resources/assets/accounts/auth/sass/app.scss', 'public/assets/accounts/auth/css')
    .options({
        fileLoaderDirs: {
            images: 'assets/accounts/auth/images',
            fonts: 'assets/accounts/auth/fonts'
        }
    })
    .version();
