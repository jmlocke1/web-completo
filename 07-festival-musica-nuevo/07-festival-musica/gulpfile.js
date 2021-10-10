const { src, dest, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function css( done ) {
	// Identificar el archivo css a compilar
	src('src/scss/**/*.scss')
		.pipe( sass() )  // Compilarlo
		.pipe( dest('./build/css') )  // Almacenarla en el disco duro
	done();
}

function dev( done ) {
	watch('src/scss/**/*.scss', css);
	done();
}

exports.css = css;
exports.dev = dev;