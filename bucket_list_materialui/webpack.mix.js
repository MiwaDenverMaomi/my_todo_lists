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
mix.webpackConfig({
    stats: { children: true, },
    watchOptions: {
        ignored: /node_modules/
    }
});
// mix.ts('resources/ts/index.tsx', 'public/js')
//     .react()
mix.ts('resources/ts/**/*', 'public/js')
.sass('resources/sass/app.scss', 'public/css');
