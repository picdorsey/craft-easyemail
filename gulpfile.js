/**
 * Gulp Build Script
 * -----------------------------------------------------------------------------
 * @category   Node.js Build File
 * @package    Frunt
 * @copyright  Copyright (c) 2015 Piccirilli Dorsey
 * @license    https://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0
 * @link       https://github.com/picdorsey/frunt
 */

var flixir = require('flixir');

flixir.extend('email', function () {
    var inlineCss = require('gulp-inline-css');
    var Task = flixir.Task;
    var gulp = require('gulp');

    new Task('email', function () {
        return gulp.src('./src/emails/*.twig')
            .pipe(inlineCss())
            .pipe(gulp.dest('./easyemail/templates/_layouts'))
            .pipe(new flixir.Notification('Emails Compiled'))
    });

});

flixir(function (mix) {
    // Emails
    mix.sass('./src/scss/email.scss', './src/css/email.css');
    mix.email();
});