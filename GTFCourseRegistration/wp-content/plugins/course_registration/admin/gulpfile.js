var gulp = require('gulp'),
		sass = require('gulp-ruby-sass'),
		notify = require("gulp-notify"),
		bower = require('gulp-bower'),
		autoprefixer = require('gulp-autoprefixer'),
		minifycss = require('gulp-minify-css'),
		rename = require('gulp-rename');


var config = {
	sassPath: './sass',
	bowerDir: './bower_components'
}

gulp.task('bower', function() {
	return bower()
		.pipe(gulp.dest(config.bowerDir));
});

gulp.task('style', function() {
	return gulp.src(config.sassPath + '/course-registration-admin.scss')
		.pipe(sass({
		style: 'expanded',
		loadPath: [
			'./sass',
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


// Rerun the task when a file changes

gulp.task('watch', function() {
	gulp.watch(config.sassPath + '/**/*.scss', ['style']);
});

gulp.task('default', ['bower', 'style']);
