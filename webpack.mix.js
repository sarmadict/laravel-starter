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

mix.js('resources/assets/auth/js/app.js', 'public/assets/auth/js')
    .sass('resources/assets/auth/scss/app.scss', 'public/assets/auth/css')
    .options({
        fileLoaderDirs: {
            images: 'assets/auth/images',
            fonts: 'assets/auth/fonts'
        }
    })
    .version();

mix.js('resources/assets/admin/js/app.js', 'public/assets/admin/js')
    .sass('resources/assets/admin/sass/app.scss', 'public/assets/admin/css')
    .sass('resources/assets/admin/sass/themes/theme-2.scss', 'public/assets/admin/css/themes')
    .options({
        fileLoaderDirs: {
            images: 'assets/admin/images',
            fonts: 'assets/admin/fonts'
        }
    })
    .version();