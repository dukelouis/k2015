// Inserting the gulp plugins
var gulp         = require('gulp'),
uglify       = require('gulp-uglify'),
watch        = require('gulp-watch'),
concat       = require('gulp-concat'),
minify       = require('gulp-minify-css'),
rename       = require('gulp-rename'),
notify       = require('gulp-notify'),
autoprefixer = require('gulp-autoprefixer'),
sass         = require('gulp-sass') 
plumber      = require('gulp-plumber'),
sourcemaps   = require('gulp-sourcemaps'),
bourbon      = require('node-bourbon');
bower        = require('gulp-bower');
    bourbon.includePaths // Array of Bourbon paths

// Defining paths
var dirs = {
  js       : './assets/js',
  css      : './assets/css',
  img      : './assets/img',
  fonts    : './assets/fonts',
  sassPath : './assets/sass',
  bowerDir : './bower_components' 
};

// Instalar o Bower
gulp.task('bower', function() { 
  return bower()
           .pipe(gulp.dest(dirs.bowerDir)) 
  });

// Instalar o FontAwesome
gulp.task('icons', function() { 
  return gulp.src(dirs.bowerDir + '/fontawesome/fonts/**.*') 
  .pipe(gulp.dest(dirs.fonts)); 
  });

// Instalar js do bootstrap
gulp.task('bootstrap', function() { 
  
  var onError = function(err) {
    notify.onError({
      title    : "Gulp",
      subtitle : "Failure!",
      message  : "Error: <%= error.message %>",
      sound    : "Beep"
      })(err);

      this.emit('end');
    }

  // Enables task running scripts
  return gulp
  .src( [ dirs.bowerDir + '/bootstrap-sass-official/assets/javascripts/bootstrap.js' ] )
  .pipe( plumber( { errorHandler: onError } ) )
  .pipe( sourcemaps.init() )
  .pipe( concat( 'bootstrap.min.js' ) )
  .pipe( uglify() )
  .pipe( sourcemaps.write( '.' ) )
  .pipe( gulp.dest( dirs.js ) )
  .pipe( notify({message: "Scripts Compilados com sucesso!", onLast: true}));

});

// Defining tasks of the SASS
gulp.task( 'styles', function(){

  // Enables the display of errors that occur during execution and prevents the gulp lock
  var onError = function(err) {
    notify.onError({
      title    : "Gulp",
      subtitle : "Failure!",
      message  : "Error: <%= error.message %>",
      sound    : "Beep"
      })(err);
      this.emit('end');
    }

  //Set the output of the type of SASS and loads files that can be included in theme
  return gulp
  .src( dirs.sassPath + '/**/*.scss' )
  .pipe(plumber({errorHandler: onError}))
  .pipe( sass({ 
    includePaths: [
      'assets/sass/**/*.scss',
      require('node-bourbon').includePaths,
      dirs.bowerDir + '/bootstrap-sass-official/assets/stylesheets', 
      dirs.bowerDir + '/fontawesome/scss'
    ] 
  }) )
  .pipe( concat( 'the-style.css' ) )
  .pipe( autoprefixer( { browsers: [ '> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1' ] } ) )
  .pipe( minify() )
  .pipe( rename( 'the-style.min.css' ) )
  .pipe( gulp.dest( dirs.css ))
  .pipe( notify({message: "Sass Compilado com sucesso!", onLast: true}));
  });

// Defining tasks of the scripts
gulp.task( 'scripts', function(){

  var onError = function(err) {
    notify.onError({
      title    : "Gulp",
      subtitle : "Failure!",
      message  : "Error: <%= error.message %>",
      sound    : "Beep"
      })(err);

      this.emit('end');
    }

  // Enables task running scripts
  return gulp
  .src( [ dirs.js + '/front-end/**/*.js' ] )
  .pipe( plumber( { errorHandler: onError } ) )
  .pipe( sourcemaps.init() )
  .pipe( concat( 'the-action.min.js' ) )
  .pipe( uglify() )
  .pipe( sourcemaps.write( '.' ) )
  .pipe( gulp.dest( dirs.js ) )
  .pipe( notify({message: "Scripts Compilados com sucesso!", onLast: true}));
  });

gulp.task( 'cssplugins', function() {

  var cssplugins = [
    'assets/css/jquery.fancybox.css', 
    'assets/css/jquery.fancybox-thumbs.css', 
    'assets/css/nanoscroller.css', 
    'assets/css/swiper.css'
  ];

  return gulp
  .src( cssplugins )
  .pipe( concat( 'plugins.css' ) )
  .pipe( autoprefixer( { browsers: [ '> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1' ] } ) )
  .pipe( minify() )
  .pipe( rename( 'plugins.min.css' ) )
  .pipe( gulp.dest( dirs.css ))
  });

gulp.task( 'jsplugins', function() {

  var jsplugins = [
    'assets/js/bootstrap.min.js', 
    'assets/js/jquery.bxslider.js', 
    'assets/js/jquery.zaccordion.min.js', 
    'assets/js/jquery.easing.min.js', 
    'assets/js/jquery.fancybox.js', 
    'assets/js/jquery.fancybox-thumbs.js', 
    'assets/js/jquery.nanoscroller.js', 
    'assets/js/googleMaps.min.js', 
    'assets/js/gMap.min.js', 
    'assets/js/jquery.autocomplete.min.js', 
    'assets/js/swiper.jquery.js'
  ];

  return gulp
  .src( jsplugins )
  .pipe( concat( 'plugins.min.js' ) )
  .pipe( uglify() )
  .pipe( gulp.dest( dirs.js ) )
  .pipe( notify({message: "Scripts Compilados com sucesso!", onLast: true}));
  });


gulp.task('plugins', ['cssplugins', 'jsplugins']);

// Rerun the task when a file changes
 gulp.task('watch', function() {
     gulp.watch(dirs.sassPath + '/**/*.scss', ['styles']); 
    gulp.watch(dirs.js + '/front-end/**/*.js', [ 'scripts' ]);
});

  gulp.task('default', ['bower', 'icons', 'styles', 'scripts']);
