const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const minify = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
const rename = require("gulp-rename");

//SCSS
function compileScss(){
    return src('assets/sass/widgets/*.scss')
    .pipe(sass())
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(dest('assets/css/unminified'))
}
// Minified CSS
function minifyCssfile(){
    return src('assets/css/unminified/*.css')
    .pipe(minify())
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(rename({suffix:'.min'}))
    .pipe(dest('assets/css/minified'))
}

// Watch Task
function watchTask(){
    watch('assets/sass/**/*.scss', compileScss);
    watch('assets/css/unminified/*.css', minifyCssfile);
}

// Default Task
exports.default = series(
    compileScss,
    minifyCssfile,
    watchTask
)