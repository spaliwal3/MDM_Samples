var gulp = require('gulp'),
		sass = require('gulp-ruby-sass'),
		notify = require("gulp-notify"),
		bower = require('gulp-bower'),
		autoprefixer = require('gulp-autoprefixer'),
		minifycss = require('gulp-minify-css'),
		rename = require('gulp-rename'),
		fontello_importer = require('gulp-fontello-import');


var config = {
	sassPath: './sass',
	bowerDir: './bower_components',
	npmDir: './node_modules',
}

gulp.task('bower', function() {
	return bower()
		.pipe(gulp.dest(config.bowerDir));
});

gulp.task('style', function() {
	return gulp.src(config.sassPath + '/course-registration-public.scss')
		.pipe(sass({
		style: 'expanded',
		loadPath: [
			'./resources/sass',
			config.bowerDir + '/bootstrap-sass/assets/stylesheets',
		]})
		.on("error", notify.onError(function (error) {
			return "Error: " + error.message;
		})))
		.pipe(gulp.dest('./css'))
		.pipe(rename({suffix: '.min'}))
		.pipe(minifycss())
		.pipe(gulp.dest('./css'));
});

gulp.task('import-svg', function(cb) {
    fontello_importer.importSvg({
        config : config.npmDir + '/gulp-fontello-import/config.json',
        svgsrc : './images/svg'
    }, cb);
});

gulp.task('get-icon-font', ['import-svg'], function(cb) {
    fontello_importer.getFont({
        host   : 'http://fontello.com',
        config : config.npmDir + '/gulp-fontello-import/config.json',
        css    : './css',
        font   : './font'
    },cb);
});


// Rerun the task when a file changes

gulp.task('watch', function() {
	gulp.watch(config.sassPath + '/*.scss', ['style']);
});

gulp.task('default', ['bower', 'style']);
