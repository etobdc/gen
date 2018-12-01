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

mix.setResourceRoot('/');
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
	   		'public/css/app.css',
			'public/css/skin-custom.css',
	   		'node_modules/select2/dist/css/select2.css',
	   		'node_modules/admin-lte/dist/css/AdminLTE.css'
   		],
   		'public/css/all.css'
   );