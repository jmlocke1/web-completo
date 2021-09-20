const { src, dest, series, parallel, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const imagemin = require( 'gulp-imagemin' );
// const rename = require('gulp-rename');
const notify = require('gulp-notify');
const webp = require('gulp-webp');
const concat = require('gulp-concat');

const paths = {
	imagenes: 'src/img/**/*',
	scss: 'src/scss/**/*.scss',
	js: 'src/js/**/*.js'
}

function compilarSASS(){
	return src(paths.scss)
		.pipe( sass() )
		.pipe( dest("./build/css") );
}

function minificarCSS(){
	return src(paths.scss)
		.pipe( sass({
			outputStyle: 'compressed'
		}) )
		.pipe( dest("./build/min.css"))
}

function javascript(){
	return src(paths.js)
		.pipe( concat('bundle.js') )
		.pipe( dest('./build/js'));
}

function imagenes() {
	return src(paths.imagenes)
		.pipe(imagemin())
		.pipe(dest('./build/img'));
}

function versionWebp () {
	return src(paths.imagenes)
		.pipe( webp() )
		.pipe( dest('./build/img') );
}

function notifyImages() {
	return src('.')
		.pipe(notify({message: 'Imágenes minificadas y convertidas a Webp'}));
}

function watchArchivos(){
	// * = La carpeta actual - ** ? Todos los archivos con esa extensión
	watch( paths.scss, parallel(compilarSASS, minificarCSS));
	watch( paths.js, javascript);
}

exports.compilarSASS = compilarSASS;
exports.minificarCSS = minificarCSS;
exports.imagenes = imagenes;
exports.watchArchivos = watchArchivos;
exports.minImages = series(imagenes, versionWebp, notifyImages);
//exports.notifyImages = notifyImages;
// Ejecutando gulp tareas se ejecutan todas las tareas en serie
// exports.tareas = series(compilarSASS, compilarJavaScript );
// Ejecutando simplemente gulp se ejecutan todas las funciones
// La función parallel lanza todas las tareas en paralelo
// exports.default = parallel(compilarSASS, compilarJavaScript, minificarCSS );
//exports.default = series(compilarSASS, minificarCSS, javascript, this.minImages, watchArchivos);
exports.default = series(javascript, watchArchivos);