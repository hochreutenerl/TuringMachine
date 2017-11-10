var gulp = require('gulp'),
uglify = require('gulp-uglify'),
concat = require('gulp-concat'),
minifyCSS = require('gulp-minify-css'),
sass = require('gulp-sass');

var tasks = ['sass', 'js', 'css'];

gulp.task('sass', function() {
	gulp.src('src/sass/**/*.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(gulp.dest('src/css'))
});

gulp.task('css', function() {
	gulp.src([
		'src/css/**/*.css',
		])
//	.pipe(minifyCSS())
	.pipe(concat('styles.css'))
	.pipe(gulp.dest('public/css'));
});

gulp.task('js', function() {
	gulp.src([
		'src/js/**/*.js',
		])
	.pipe(uglify())
	.pipe(concat('scripts.js'))
	.pipe(gulp.dest('public/js'));
});

gulp.task('default', tasks);

gulp.task('watch', function() {
	gulp.watch('src/sass/**/*.scss', tasks);

	gulp.watch('src/css/**/*.css', ['css']);

	gulp.watch('src/js/**/*.js', ['js']);
});