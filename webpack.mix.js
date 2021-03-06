const mix = require('laravel-mix');

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

mix.sass('resources/sass/app.scss', 'public/css/style.css')
   .sass('node_modules/@fortawesome/fontawesome-free/scss/fontawesome.scss', 'public/css/fontawesome.css')
   .sass('node_modules/select2/src/scss/core.scss', 'public/css/select2.css')
   .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
   .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
   .scripts('node_modules/@fortawesome/fontawesome-free/js/all.js', 'public/js/fontawesome.js')
   .scripts('node_modules/clipboard/dist/clipboard.js', 'public/js/clipboard.js')
   .scripts('node_modules/select2/dist/js/select2.full.js', 'public/js/select2.js')
   .copyDirectory('resources/plugins', 'public/plugins')
   .copyDirectory('resources/img', 'public/img');
