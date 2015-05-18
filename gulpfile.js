var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

/*

scripts([
        'moment.js',
        'bootstrap-datetimepicker.min.js',
        'selectize.min.js',
        ], 'public/js/combined.js')
    .styles([
        'custom.css',
        'bootstrap-datetimepicker.min.css',
        'selectize.default.css'
        ], 'public/css/combined.css');
 */
var bower = elixir.config.bowerDir;
var assets = elixir.config.assetsDir;

elixir(function(mix) {
    mix
    .copy(bower + '/jquery/dist/jquery.min.js','public/js/')
    .copy(bower + '/jquery/dist/jquery.min.map', 'public/js/')
    .copy(bower + '/bootstrap/dist/js/bootstrap.min.js','public/js/')
    .copy(bower + '/bootstrap/dist/fonts/**','public/fonts/')
    .copy(bower + '/fontawesome/fonts/**','public/fontawesome/fonts/')
    .copy(bower + '/fontawesome/css/font-awesome.min.css','public/fontawesome/css/')
    .copy(bower + '/selectize/dist/css/selectize.default.css','public/css/')
    .copy(bower + '/selectize/dist/js/standalone/selectize.min.js','public/js/')
    .copy(bower + '/moment/min/moment.min.js','public/js/')
    .copy(bower + '/moment/min/moment.min.js','public/js/')
    .copy(bower + '/moment/min/locales.min.js','public/js/')
    .copy(bower + '/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/css/')
    .copy(bower + '/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js')
    .copy(assets + '/css/bootstrap.min.css', 'public/css')
    .scripts([
        'custom.js'
        ], 'public/js/combined.js')
    .styles([
        'custom.css',
        ], 'public/css/combined.css');
});