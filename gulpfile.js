// Gulp.js configuration
// https://www.sitepoint.com/fast-gulp-wordpress-theme-development-workflow/

'use strict';

const 
dir = { // source and build folders
  src         : '/var/www/recapnotes.com/wp-content/themes/codebasics/',
  build       : '/var/www/recapnotes.com/wp-content/themes/recapnotes/'
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
//uglify        = require('gulp-uglify'),
uglify        = require('gulp-uglify-es').default,
babel         = require('gulp-babel'),
browserify    = require('gulp-browserify'),
plumber       = require('gulp-plumber'),
browserSync   = require('browser-sync').create(),
gulpif        = require('gulp-if');

// Browser Sync
gulp.task('browser-sync', () => {
  browserSync.init({
      open: false,
      proxy: {
        target: "dev.recapnotes.com", // can be [virtual host, sub-directory, localhost with port]
        ws: true // enables websockets        
      }
  });
});

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
  src         : dir.src + 'scss/*',
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
    require('cssnano'), 
  ]
};

gulp.task('css', ['images'], () => {
  return gulp.src(css.src)
    .pipe(plumber())
    .pipe(sass(css.sassOpts))      
    .pipe(postcss(css.processors))    
    //.pipe(concat('style.css'))
    .pipe(gulp.dest(css.build))
    .pipe(browserSync.stream());
});

// JavaScript
const js = {
  src         : dir.src + 'js/**/*',
  srcLoad     : dir.src + 'js/**/*',
  build       : dir.build + 'js/',
  files       : dir.src + 'js/scripts.js ', // + dir.src + 'js/admin.js'
  //fileadmin   : 'admin.js'  
};
gulp.task('js', () => {
    return gulp.src(js.files)
    .pipe(plumber())    
    .pipe(babel({
      presets: ['@babel/preset-env']
    }))
    .pipe(browserify({
      insertGlobals : true,
      debug : !gutil.env.production
    }))
    .pipe(gulpif(build,deporder()))
    // .pipe(concat(js.filename))
    .pipe(gulpif(build,stripdebug()))
    .pipe(gulpif(build,uglify()))
    .pipe(gulp.dest(js.build));
});

var build = true;
// run all tasks
gulp.task('build', ['php', 'css', 'js']);
 
// watch for file changes
gulp.task('watch', ['browser-sync'], () => {  
  build = false;
  gulp.watch(php.src, ['php']);       // page changes
  gulp.watch(images.src, ['images']); // image changes 
  gulp.watch(css.watch, ['css']);     // CSS changes
  gulp.watch(js.src, ['js']);         // JavaScript main changes
  // Browser Sync
  gulp.watch(dir.src + 'js/**/*').on('change', browserSync.reload);
  gulp.watch(dir.src + 'template/**/*').on('change', browserSync.reload);
});

// default task
gulp.task('default', ['build', 'watch']);