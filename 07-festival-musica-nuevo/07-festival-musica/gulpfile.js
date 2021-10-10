const { src, dest } = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function css( done ) {
	// Identificar el archivo css a compilar
	src('src/scss/app.scss')
		.pipe( sass() )  // Compilarlo
		.pipe( dest('build/css') )  // Almacenarla en el disco duro
	done();
}

exports.css = css;