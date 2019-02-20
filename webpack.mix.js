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

//mix.js('resources/js/app.js', 'public/js')
//   .sass('resources/sass/app.scss', 'public/css');

mix.autoload({
    jquery: ['$','window.jQuery',"jQuery","window.$","jquery","window.jquery"]});
mix.js('resources/js/app.js', 'public/js/')
    .js('resources/js/index.js', 'public/js/')
    .js('resources/js/create.js', 'public/js/')
    .js('resources/js/downloads/upload.js', 'public/js/')
    .extract(['jquery', 'bootstrap'])
    .sourceMaps();
mix.styles(
    ['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/css/inline.css'], 
    'public/css/app.css'
);
