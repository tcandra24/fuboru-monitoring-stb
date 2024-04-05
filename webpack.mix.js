const mix = require("laravel-mix");
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
const path = require("path");

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        //
    ])
    .alias({ "ziggy-js": path.resolve("./vendor/tightenco/ziggy") })
    .vue({ version: 3 });
