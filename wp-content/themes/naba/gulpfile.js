var gulp = require('gulp'), // Сообственно Gulp JS
    csso = require('gulp-csso'), // Минификация CSS
    autoprefixer = require('gulp-autoprefixer'),
    sass = require('gulp-sass'),
    //imagemin = require('gulp-imagemin'), // Минификация изображений
    uglify = require('gulp-uglify'), // Минификация JS
    rename = require('gulp-rename'), // Минификация JS
    imageop = require('gulp-image-optimization'),
    gutil = require('gulp-util'),
    runSequence = require('run-sequence'),
    concat = require('gulp-concat'); // Склейка файлов

gulp.task('sass',function(){
    gulp.src([
        './assets/css/main.sass',
        './assets/css/page.sass',
        './assets/css/event.sass',
        './assets/css/map.sass',
        './assets/css/society.sass',
        './assets/css/ras.sass'
    ])
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 5 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./assets/css'));
});
gulp.task('concatcss',['sass'], function(){
    gulp.src([
            './assets/css/normalize.css',
            './assets/css/fonts.css',
            'node_modules/hamburgers/dist/hamburgers.min.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
            './assets/css/main.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(concat('production.main.min.css'))
        .pipe(csso())
        .pipe(gulp.dest('./build/css'));
    gulp.src([
            './assets/css/normalize.css',
            './assets/css/fonts.css',
            'node_modules/hamburgers/dist/hamburgers.min.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
            './assets/css/slick.css',
            './assets/css/slick-theme.css',
            './assets/css/page.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(concat('production.page.min.css'))
        .pipe(csso())
        .pipe(gulp.dest('./build/css'));
    gulp.src([
            './assets/css/normalize.css',
            './assets/css/fonts.css',
            'node_modules/hamburgers/dist/hamburgers.min.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
            './assets/css/event.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(concat('production.event.min.css'))
        .pipe(csso())
        .pipe(gulp.dest('./build/css'));
    gulp.src([
            './assets/css/normalize.css',
            './assets/css/fonts.css',
            'node_modules/hamburgers/dist/hamburgers.min.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
            './assets/css/map.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(concat('production.map.min.css'))
        .pipe(csso())
        .pipe(gulp.dest('./build/css'));
    gulp.src([
            './assets/css/normalize.css',
            './assets/css/fonts.css',
            'node_modules/hamburgers/dist/hamburgers.min.css',
            'node_modules/magnific-popup/dist/magnific-popup.css',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
            './assets/css/society.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(concat('production.society.min.css'))
        .pipe(csso())
        .pipe(gulp.dest('./build/css'));
    gulp.src([
            './assets/css/normalize.css',
            './assets/css/fonts.css',
            'node_modules/hamburgers/dist/hamburgers.min.css',
            './assets/css/ras.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(concat('production.ras.min.css'))
        .pipe(csso())
        .pipe(gulp.dest('./build/css'));
});
gulp.task('copy',function(){
    gulp.src('./assets/fonts/*')
        .pipe(gulp.dest('./build/fonts'))
    gulp.src('./assets/video/*')
        .pipe(gulp.dest('./build/video'))
});

gulp.task('buildjs',function(){
    //gulp.src(['./assets/js/jquery-2.1.4.min.js','./assets/js/ScrollMagic.min.js','./assets/js/TweenMax.min.js','./assets/js/animation.gsap.min.js','./assets/js/modernizr-custom.js','./assets/js/main.js'])
    gulp.src(['./assets/js/main.js'])
        .pipe(uglify().on('error', gutil.log))
        .pipe(rename('main.min.js'))
        .pipe(gulp.dest('./assets/js'));
    gulp.src(['./assets/js/main.*.js','./assets/js/hamburger.js','!./assets/js/main.*.min.js','!./assets/js/main.min.js'])
        .pipe(uglify().on('error', gutil.log))
        .pipe(rename(function(path){
            path.basename += '.min';
            path.extname = '.js';//'main.:name.min.js'
        }))
        .pipe(gulp.dest('./assets/js'))
});


gulp.task('concatjs',['buildjs'], function(){
    gulp.src([
            'node_modules/jquery/dist/jquery.min.js',
            './assets/js/flowtype.js',
            './assets/js/font.js'
        ])
        .pipe(concat('font.jquery.min.js'))
        .pipe(gulp.dest('./build/js'));
    gulp.src([
            //'./assets/js/fittext.js',
            'node_modules/fastclick/lib/fastclick.js',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js',
            './assets/js/three.min.js',
            './assets/js/detector.js',
            './assets/js/parallaxshader.js',
            './assets/js/vivus.js',
            './assets/js/jquery-ui.min.js',
            './assets/js/hamburger.js',
            './assets/js/main.min.js'
        ])
        //gulp.src(['./assets/js/jquery-2.1.4.min.js','./assets/js/modernizr-custom.js','./assets/js/main.js'])
        .pipe(concat('production.min.js'))
        .pipe(gulp.dest('./build/js'));
    gulp.src([
            //'./assets/js/fittext.js',
            'node_modules/fastclick/lib/fastclick.js',
            'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js',
            './assets/js/three.min.js',
            './assets/js/detector.js',
            './assets/js/parallaxshader.js',
            './assets/js/vivus.js',
            './assets/js/jquery-ui.min.js',
            './assets/js/hamburger.js',
            './assets/js/slick.js',
            './assets/js/main.page.min.js'
        ])
        //gulp.src(['./assets/js/jquery-2.1.4.min.js','./assets/js/modernizr-custom.js','./assets/js/main.js'])
        .pipe(concat('production.page.min.js'))
        .pipe(gulp.dest('./build/js'))
    gulp.src([
            //'./assets/js/fittext.js',
            'node_modules/fastclick/lib/fastclick.js',
            './assets/js/jquery-ui.min.js',
            './assets/js/hamburger.js',
            './assets/js/color.js',
            './assets/js/main.event.min.js'
        ])
        .pipe(concat('production.event.min.js'))
        .pipe(gulp.dest('./build/js'))
    gulp.src([
            //'./assets/js/fittext.js',
            'node_modules/fastclick/lib/fastclick.js',
            './assets/js/jquery-ui.min.js',
            './assets/js/hamburger.js',
            './assets/js/main.map.min.js'
        ])
        .pipe(concat('production.map.min.js'))
        .pipe(gulp.dest('./build/js'))
    gulp.src([
            //'./assets/js/fittext.js',
            'node_modules/fastclick/lib/fastclick.js',
            './assets/js/jquery-ui.min.js',
            './assets/js/hamburger.js',
            './assets/js/mask.js',
            './assets/js/main.society.min.js',
            './assets/js/color.js'
        ])
        .pipe(concat('production.society.min.js'))
        .pipe(gulp.dest('./build/js'))
    gulp.src([
            //'./assets/js/fittext.js',
            'node_modules/fastclick/lib/fastclick.js',
            './assets/js/jquery-ui.min.js',
            './assets/js/hamburger.js',
            './assets/js/mask.js',
            './assets/js/main.ras.min.js'
        ])
        .pipe(concat('production.ras.min.js'))
        .pipe(gulp.dest('./build/js'))
});

gulp.task('images',function(){
    gulp.src(['./assets/img/*','./assets/img/*/*'])
        .pipe(imageop({
            optimizationLevel: 80,
            progressive: true,
            interlaced: true
        })).pipe(gulp.dest('build/img'))
    /*gulp.src('./assets/img/particles/*')
        .pipe(imageop({
            optimizationLevel: 5,
            progressive: true,
            interlaced: true
        })).pipe(gulp.dest('build/img/particles'))*/
});

gulp.task('watch',function(){
    gulp.watch('./assets/css/*.sass',function(){
        runSequence(
            'sass'
        )
        setTimeout(function(){
            runSequence(
                'concatcss'
            )
        },1000);
    });
});

gulp.task('js',function() {
    runSequence(
        'buildjs'
    )
    setTimeout(function(){
        runSequence(
            'concatjs'
        )
    },2000);
});

gulp.task('build',['sass', 'concatcss','copy','js','images']);

gulp.task('css',['concatcss']);