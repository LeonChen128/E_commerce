const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// vue.js
mix.js('resources/js/app.js', 'public/js').vue();
// scss
mix.sass('resources/sass/_/core.scss', 'public/_/css')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/product.scss', 'public/css');
