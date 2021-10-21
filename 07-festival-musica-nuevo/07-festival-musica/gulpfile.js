const { src, dest, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');

function css( done ) {
    src('src/scss/**/*.scss')   // Identificar el archivo .SCSS a compilar
        .pipe( sass() )         // Compilarlo
        .pipe( plumber() )
        .pipe( dest('build/css') )
    done();
}

function dev( done ) {
    watch('src/scss/**/*.scss', css);
}

exports.css = css;
exports.dev = dev;