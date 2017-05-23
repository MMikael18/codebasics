// Gulp.js configuration
// https://www.sitepoint.com/fast-gulp-wordpress-theme-development-workflow/

'use strict';

const  
dir = { // source and build folders
  src         : '/var/www/wp_mmikael/wp-content/themes/codebasics/app/',
  build       : '/var/www/wp_mmikael/wp-content/themes/codebasics/'
}, // Gulp and plugins
gulp          = require('gulp'),
gutil         = require('gulp-util'),
newer         = require('gulp-newer'),
imagemin      = require('gulp-imagemin'),
sass          = require('gulp-sass'),
postcss       = require('gulp-postcss'),
deporder      = require('gulp-deporder'),
concat        = require('gulp-concat'),
stripdebug    = require('gulp-strip-debug'),
uglify        = require('gulp-uglify');

// PHP
const php = {
  src           : dir.src + 'template/**/*.php',
  build         : dir.build
};
gulp.task('php', () => {
  return gulp.src(php.src)
    .pipe(newer(php.build))
    .pipe(gulp.dest(php.build));
});

// image
const images = {
  src         : dir.src + 'img/**/*',
  build       : dir.build + 'img/'
};
gulp.task('images', () => {
  return gulp.src(images.src)
    .pipe(newer(images.build))
    .pipe(imagemin())
    .pipe(gulp.dest(images.build));
});

// SCSS
var css = {
  src         : dir.src + 'scss/**/*.scss',
  watch       : dir.src + 'scss/**/*',
  build       : dir.build,
  sassOpts: {
    outputStyle     : 'nested',
    imagePath       : images.build,
    precision       : 3,
    errLogToConsole : true
  },
  processors: [
    require('postcss-assets')({
      loadPaths: ['images/'],
      basePath: dir.build
    }),
    require('autoprefixer')({
      browsers: ['last 2 versions', '> 2%']
    }),
    require('css-mqpacker'),
    require('cssnano')
  ]
};
gulp.task('css', ['images'], () => {
  return gulp.src(css.src)
    .pipe(sass(css.sassOpts))    
    .pipe(postcss(css.processors))    
    .pipe(gulp.dest(css.build));
});

// JavaScript
const js = {
  src         : dir.src + 'js/**/*',
  build       : dir.build + 'js/',
  filename    : 'scripts.js'
};
gulp.task('js', () => {
    return gulp.src(js.src)
    .pipe(deporder())
    .pipe(concat(js.filename))
    //.pipe(stripdebug())
    .pipe(uglify())
    .pipe(gulp.dest(js.build));
});

// run all tasks
gulp.task('build', ['php', 'css', 'js']);

// watch for file changes
gulp.task('watch', () => {  
  gulp.watch(php.src, ['php']);       // page changes
  gulp.watch(images.src, ['images']); // image changes 
  gulp.watch(css.watch, ['css']);     // CSS changes
  gulp.watch(js.src, ['js']);         // JavaScript main changes
});

// default task
gulp.task('default', ['build', 'watch']);