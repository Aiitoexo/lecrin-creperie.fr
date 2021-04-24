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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),

    ])
    .js('resources/js/show_section_menu.js', 'public/js',)
    .js('resources/js/access_carte.js', 'public/js',)
    .js('resources/js/modal_fail_postal.js', 'public/js',)
    .js('resources/js/show_sub_nav_mobile.js', 'public/js',)
    .js('resources/js/delete_item_admin.js', 'public/js',)
    .js('resources/js/command_admin.js', 'public/js',)
    .copyDirectory('resources/img', 'public/img')
    .version();
