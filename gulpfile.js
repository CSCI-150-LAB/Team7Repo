var gulp = require('gulp'),
	sass = require('gulp-sass'),
	path = require('path');

var sassConfig = {
	inputDirectory: path.join(__dirname, './public/css/style.scss'),
	outputDirectory: path.join(__dirname, './public/css'),
	options: {
		outputStyle: 'expanded'
	}
}

gulp.task('build-css', function() {
	return gulp
		.src(sassConfig.inputDirectory)
		.pipe(sass(sassConfig.options).on('error', sass.logError))
		.pipe(gulp.dest(sassConfig.outputDirectory));
});

gulp.task('watch', function() {
	gulp.watch('./public/**/*.scss', gulp.series('build-css'));
});

gulp.task('default', gulp.series('build-css'));