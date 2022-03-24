/**
 *  IMPORTS
 *    from gulp:
 *      src:      to identify a file
 *      dest:     to save a file
 *      watch:    to watching changes
 *      parallel: to execute two or more tasks
 *  To CSS tasks:
 *    sass:     to compile .scss files to .css files
 *    plumber:  to don't stop watching in error case
 *  To images tasks:
 *    cache:    save images in cache
 *    webp:     to convert images in .webp images
 *    imagemin: to create an optimized version of an image
 *    avif:     to convert images in .avif images
 */

// Gulp
const { 
  src,
  dest,
  watch,
  parallel,
} = require('gulp');
// CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
// Images
const cache = require('gulp-cache');
const webp = require('gulp-webp');
const imagemin = require('gulp-imagemin');
const avif = require('gulp-avif');

/*
 *  Summary
 *
 *    Compile .scss to .css files
 *
 *  Description
 *
 *    Compile any .scss file in any location in src/scss/ folder
 *    and save the .css compiled in build/css/ folder
 *
 *  @param  {function}  done  a function that finalize the task
 */
const css = done => {
  src('src/scss/**/*.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(dest('build/css'));
  done();
};

/*
 *  Summary
 *
 *    Create optimized images files
 *
 *  Description
 *
 *    Create an optimized version from any .jpg or .png file in 
 *    any location in src/img/ folder and save in build/img/ folder
 *
 *  @param  {function}  done  a function that finalize the task
 */
const images = done => {
  const options = {
    optimizationLevel: 3
  };
  src('src/img/**/*.{jpg,png}')
    .pipe(cache(imagemin(options)))
    .pipe(dest('build/img'));
  done();
};

/*
 *  Summary
 *
 *    Convert images in wepb
 *
 *  Description
 *
 *    Convert any .jpg or .png file in any location in src/img/ 
 *    folder in a .webp file and save in build/img folder
 *
 *  @param  {function}  done  a function that finalize the task
 */
const webpConversion = done => {
  const options = {
    quality: 100
  };
  src('src/img/**/*.{jpg,png}')
    .pipe(webp(options))
    .pipe(dest('build/img'));
  done();
};

/*
 *  Summary
 *
 *    Convert images in avif
 *
 *  Description
 *
 *    Convert any .jpg or .png file in any location in src/img/ 
 *    folder in a .avif file and save in build/img folder
 *
 *  @param  {function}  done  a function that finalize the task
 */
const avifConversion = done => {
  const options = {
    quality: 100
  };
  src('src/img/**/*.{jpg,png}')
    .pipe(avif(options))
    .pipe(dest('build/img'));
  done();
};

/*
 *  Summary
 *
 *    Watch changes in sass compile
 *
 *  Description
 *
 *    Watch changes to compile sass in css every time that the
 *    .scss files changes
 *
 *  @param  {function}  done  a function that finalize the task
 */
const watchChanges = done => {
  watch('src/scss/**/*.scss', css);
  done();
};

/*
 *  Exports
 */
exports.css = css;
exports.webpConversion = webpConversion;
exports.avifConversion = webpConversion;
exports.watchChanges = watchChanges;
exports.images = images;
exports.dev = parallel(images, webpConversion, avifConversion, watchChanges,);
