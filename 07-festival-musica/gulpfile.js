const { src, dest, series, parallel, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const imagemin = require( 'gulp-imagemin' );
// const rename = require('gulp-rename');
function compilarSASS(){
	return src("./src/scss/*.scss")
		.pipe( sass() )
		.pipe( dest("./build/css") );
}

function minificarCSS(){
	return src('./src/scss/*.scss')
		.pipe( sass({
			outputStyle: 'compressed'
		}) )
		.pipe( dest("./build/min.css"))
}

function imagenes() {
	return src('src/img/**/*')
		.pipe(imagemin())
		.pipe(dest('./build/img'));
}

function watchArchivos(){
	// * = La carpeta actual - ** ? Todos los archivos con esa extensión
	watch( "./src/scss/**/*.scss", parallel(compilarSASS, minificarCSS));
}

exports.compilarSASS = compilarSASS;
exports.minificarCSS = minificarCSS;
exports.imagenes = imagenes;
exports.watchArchivos = watchArchivos;
// Ejecutando gulp tareas se ejecutan todas las tareas en serie
// exports.tareas = series(compilarSASS, compilarJavaScript );
// Ejecutando simplemente gulp se ejecutan todas las funciones
// La función parallel lanza todas las tareas en paralelo
// exports.default = parallel(compilarSASS, compilarJavaScript, minificarCSS );
exports.default = series(compilarSASS, minificarCSS );