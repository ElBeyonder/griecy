var gulp = require('gulp');
var babel = require('gulp-babel');
var sourcemaps = require('gulp-sourcemaps');
var eslint = require('gulp-eslint');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

gulp.task('bower', function(){
    return gulp.src(['src/stackable-bower.js'])
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(gulp.dest('dist'))

        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('dist'));
});

gulp.task('node', function(){
    return gulp.src(['src/stackable.js', 'src/stackable-node.js', 'src/stackable-browsify.js'])
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(gulp.dest('dist'));
});

gulp.task('default', ['bower', 'node'], function(){});
