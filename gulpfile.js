var fs = require('fs');
var gulp = require('gulp');
var concat = require('gulp-concat');
var jshint = require('gulp-jshint');
var minify = require('gulp-minify-css');
//var notify = require('gulp-notify');
//var rename = require('gulp-rename');
var rimraf = require('rimraf');
var uglify = require('gulp-uglify');
var assets = require('./resources/assets.json');

// ------------------------------------------------------------------------------------------------

gulp.task('default', ['lint', 'clean', 'copy', 'minify', 'uglify', 'version']);

gulp.task('clean', ['lint'], function (callback) {
    rimraf(assets.paths.dist, callback);
});

gulp.task('copy', ['clean'], function () {
    for (var i = 0 ; i < assets.medias.length ; i++) {
        gulp.src(assets.medias[i] + '/**/*')
            .pipe(gulp.dest(assets.paths.dist + lastSegments(assets.medias[i])));
    }
});

gulp.task('lint', function () {
    gulp.src(appScripts(assets.scripts))
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('minify', ['clean'], function () {
    // Options: https://www.npmjs.com/package/clean-css
    gulp.src(assets.styles)
        .pipe(concat('styles.min.css'))
        .pipe(minify({ keepSpecialComments: 0, processImport: false }))
        .pipe(gulp.dest(assets.paths.dist));
});

gulp.task('uglify', ['clean'], function () {
    gulp.src(assets.scripts)
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(assets.paths.dist));
});

gulp.task('version', function () {
    fs.writeFile(assets.paths.src + '.version', (new Date()).getTime());
});

// ------------------------------------------------------------------------------------------------

function appScripts(scripts) {
    for (var i = 0, appScripts = [] ; i < scripts.length ; i++) {
        if (scripts[i].indexOf(assets.paths.src) > -1) {
            appScripts.push(scripts[i]);
        }
    }

    return appScripts;
}

function lastSegments(path) {
    path = path.replace(/\/$/, '');
    var segments = path.split('/');

    return segments[segments.length - 1];
}
