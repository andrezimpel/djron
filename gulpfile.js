var gulp = require('gulp'),
    watch = require('gulp-watch'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    path = require('path'),
    cleanhtml = require('gulp-cleanhtml'),
    minifyCSS = require('gulp-minify-css'),
    plumber = require('gulp-plumber');


// ------------------------------------------


// paths
var paths = {
  scripts: ['wp-content/themes/djron/assets/javascripts/**/*.js'],
  images: 'wp-content/themes/djron/assets/img/**/*',
  sass: "wp-content/themes/djron/assets/scss/**/*.scss",
  html: "content/index.html",
  public_dist: "dist/**/*.*"
};


// ------------------------------------------


// Retrun the task when a file changes
gulp.task('watch', function () {
  gulp.watch(paths.scripts, ['scripts']);
  gulp.watch(paths.images, ['images']);
  gulp.watch(paths.sass, ['sass']);
  gulp.watch(paths.html, ['html_dev', "html_prod"]);
  gulp.watch(paths.public_dist, ['public_dist']);
});



// copy index to /public for developing with pow
gulp.task('html_dev', function () {
  gulp.src(paths.html)
    .pipe(cleanhtml())
    .pipe(gulp.dest('./public/'));
});
gulp.task('html_prod', function () {
  gulp.src(paths.html)
    .pipe(cleanhtml())
    .pipe(gulp.dest('./'));
});



// compile sass to css and store it in dist
gulp.task('sass', function () {
  gulp.src('./wp-content/themes/djron/assets/scss/djron.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(minifyCSS({
      removeEmpty: true
    }))
    .pipe(gulp.dest('./wp-content/themes/djron/dist/css/'));
});



gulp.task('scripts', function() {
  gulp.src([
            './wp-content/themes/djron/assets/bower_components/jquery/dist/jquery.js',

            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/transition.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/alert.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/button.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/carousel.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/modal.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tooltip.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/popover.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/scrollspy.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tab.js',
            './wp-content/themes/djron/assets/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/affix.js',
            './wp-content/themes/djron/assets/js/main.js'
            ])
    .pipe(uglify())
    .pipe(concat('app.min.js'))
    .pipe(gulp.dest('./wp-content/themes/djron/dist/js'));
});

// images
gulp.task('images', function () {
  gulp.src(paths.images)
  .pipe(gulp.dest('./wp-content/themes/djron/dist/img'));
});

// copy files from dist to public dist as they change
gulp.task('public_dist', function () {
  gulp.src(paths.public_dist)
    .pipe(gulp.dest('./public/dist'));
});

// ------------------------------------------


// The default task (called when you run `gulp` from cli)
gulp.task('default', ['sass','images', 'scripts', 'watch']);
