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

mix.js('resources/assets/panel/admin/js/vendor.js', 'public/assets/panel/admin/js')
    .js('resources/assets/panel/admin/js/app.js', 'public/assets/panel/admin/js')
    .sass('resources/assets/panel/admin/sass/vendor.scss', 'public/assets/panel/admin/css')
    .sass('resources/assets/panel/admin/sass/app.scss', 'public/assets/panel/admin/css')
    .sass('resources/assets/panel/admin/sass/themes/theme-2.scss', 'public/assets/panel/admin/css/themes')
    .options({
        fileLoaderDirs: {
            images: 'assets/panel/admin/images',
            fonts: 'assets/panel/admin/fonts'
        }
    })
    .version();