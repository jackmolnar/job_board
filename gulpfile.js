var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('css', function(){
    return gulp.src('public/assets/css/site_styles.css')
        .pipe(autoprefixer('last 10 versions'))
        .pipe(minifycss())
        .pipe(gulp.dest('public/assets/css/min'))
});


gulp.task('default', function(){
    gulp.run('css');
    gulp.watch('public/assets/css/*.css', function(){
        gulp.run('css');
    })
});