// modules
const { 
  src, // to identify a file
  dest,// to save a file
  watch // to watching changes
} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');

//  function css
//    to compile .scss file in a .css file
const css = (done) => {
  src('src/scss/**/*.scss') // identify the .scss file to compile
    .pipe(plumber()) // don't stop watching in error case
    .pipe(sass()) // compile
    .pipe(dest('src/css')); // store
  done(); // to finalize task
};

//  function watchChanges
//    to watching changes in .scss file
const watchChanges = (done) => {
  watch('src/scss/**/*.scss', css);
  done(); // to finalize task
};

exports.css = watchChanges;
