// Gulpfile.js

// Check required packages
var gulp = require('gulp');
var rename = require("gulp-rename");
// CSS compiling
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');


function style() {
    return gulp.src('scss/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('.'))
    .pipe(cleanCSS({compatibility: 'ie9', debug: true}))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('.'));
}

function watch() {
    gulp.watch('scss/**/*.scss', style);
}

exports.style = style;
exports.default = watch;
