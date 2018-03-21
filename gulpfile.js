var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');


// Static Server + watching scss/html files
gulp.task('serve', ['sass'], function() {

    browserSync.init({
        proxy: "localhost/theoffcut/",
        port: 8080
    });

    gulp.watch("wp-content/themes/theoffcut-child/dist/scss/*.scss", ['sass']);
    gulp.watch("wp-content/themes/theoffcut-child/dist/scss/*/*.scss", ['sass']);
    gulp.watch("wp-content/themes/theoffcut/*.php").on('change', browserSync.reload);
    gulp.watch("wp-content/themes/theoffcut-child/*.php").on('change', browserSync.reload);
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("wp-content/themes/theoffcut-child/dist/scss/*.scss")
        .pipe(sass())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest("wp-content/themes/theoffcut-child"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);