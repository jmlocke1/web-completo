const { src, dest, watch, parallel, series } = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');

// Imágenes
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');

function css( done ) {
	// Identificar el archivo css a compilar
	src('src/scss/**/*.scss')
		.pipe( plumber() )
		.pipe( sass() )  // Compilarlo
		.pipe( dest('./build/css') )  // Almacenarla en el disco duro
	done();
}

function imagenes( done ) {
	const opciones = {
		optimizationLevel: 3
	};
	src('src/img/**/*.{png,jpg}')
		.pipe( cache( imagemin(opciones) ) )
		.pipe( dest('build/img'))

	done();
}

function versionWebp( done ) {
	const opciones = {
		quality: 50
	};
	src('src/img/**/*.{png,jpg}')
		.pipe( webp(opciones) )
		.pipe( dest('build/img') );

	done();
}

function dev( done ) {
	watch('src/scss/**/*.scss', css);
	done();
}

exports.css = css;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.minImages = parallel(imagenes, versionWebp)
exports.dev = parallel( dev );