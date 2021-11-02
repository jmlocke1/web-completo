const { src, dest, watch, parallel } = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');

// Imágenes
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');
// const avif = require('gulp-avif');
const squoosh = require('gulp-libsquoosh');


function css( done ) {
    src('src/scss/**/*.scss')   // Identificar el archivo .SCSS a compilar
        .pipe( plumber() )
        .pipe( sass() )         // Compilarlo
        .pipe( dest('build/css') )
    done();
}

function imagenes( done ) {
    const opciones = {
        optimizationLevel: 3
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( cache( imagemin(opciones) ) )
        .pipe( dest('build/img') )
    
    done();
}

function versionWebp( done ){
    const opciones = {
        quality: 50
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( webp(opciones) )
        .pipe( dest('build/img') );

    done();
}

function versionAvif( done ){
    const opciones = {
        quality: 50
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( avif(opciones) )
        .pipe( dest('build/img') );

    done();
}

function versionSquoosh( done ) {
    src('src/img/**/*.{png,jpg}')
        .pipe(squoosh())
        .pipe( dest('build/pruimg') );

    done();
}

function dev( done ) {
    watch('src/scss/**/*.scss', css);
    done();
}

exports.css = css;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.versionSquoosh = versionSquoosh;
exports.minImages = parallel(imagenes, versionWebp);
exports.dev = dev;