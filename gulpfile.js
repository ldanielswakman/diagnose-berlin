// Gulpfile.js

// Check required packages
var gulp = require('gulp');
var rename = require("gulp-rename");
// CSS compiling
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');



// Concatenate Sass task
gulp.task('sass', function() {
  gulp.src('scss/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('.'));
});

// Clean & minify CSS (after Sass)
gulp.task('clean_css', ['sass'], function() {
  gulp.src('style.css')
    .pipe(cleanCSS({compatibility: 'ie9', debug: true}))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('.'));
});

gulp.task('styles', ['sass', 'clean_css']);



// Watch task
gulp.task('default',function() {
    gulp.watch('scss/**/*.scss',['styles']);
});
