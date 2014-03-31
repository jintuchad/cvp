/*global module:false*/
module.exports = function(grunt) {

  grunt.initConfig({

    /* PKG ============================================================= */
    pkg: grunt.file.readJSON('package.json'),

    /* UGLIFY ========================================================== */
    uglify: {
      options: {
        report: 'min'
      },
      modernizr: {
        src: 'public/js/vendor/modernizr/modernizr.js',
        dest: 'public/js/modernizr.min.js'
      },
      vendor: {
        src: 'public/js/vendor.js',
        dest: 'public/js/vendor.min.js'
      },
      app: {
        src: 'public/js/app.js',
        dest: 'public/js/app.min.js'
      },
      home: {
        src: 'public/js/home.js',
        dest: 'public/js/home.min.js'
      },
      dashboard: {
        src: 'public/js/dashboard.js',
        dest: 'public/js/dashboard.min.js'
      }
    },

    /* COPY ============================================================ */
    copy: {
      main: {
        files: [
          // src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js
          {src: ['public/js/vendor/jquery/jquery.min.js'], dest: 'public/js/jquery.min.js'},
          {src: ['public/js/vendor/bootstrap/dist/js/bootstrap.min.js'], dest: 'public/js/bootstrap.min.js'}
        ]
      }
    },

    /* CONCAT ========================================================== */
    concat: {
      vendor_js: {
        src: [
          'public/js/vendor/jquery.scrollTo/jquery.scrollTo.min.js',
          'public/js/vendor/jquery.localScroll/jquery.localScroll.min.js',
          'public/js/vendor/jquery-backstretch/jquery.backstretch.min.js'
        ],
        dest: 'public/js/vendor.js'
      },
      app_js: {
        src: [
          'app/assets/js/app/app.js'
        ],
        dest: 'public/js/app.js'
      },
      home_js: {
        src: [
          'app/assets/js/app/home.js'
        ],
        dest: 'public/js/home.js'
      },
      dashboard_js: {
        src: [
          'app/assets/js/app/dashboard.js'
        ],
        dest: 'public/js/dashboard.js'
      }
    },

    /* JS HINT ========================================================= */
    jshint: {
      all: ['app/assets/js/app/*.js', '!app/assets/js/vendor/*.js'],
      options: {
        browser: true,
        curly: false,
        eqeqeq: false,
        eqnull: true,
        expr: true,
        immed: true,
        newcap: true,
        noarg: true,
        smarttabs: true,
        sub: true,
        undef: false
      }
    },

    /* CLEAN =========================================================== */
    clean: [
      'public/js/app.js',
      'public/js/home.js', 
      'public/js/dashboard.js',
      'public/js/vendor.js'
    ],

    /* WATCH =========================================================== */
    // watch: {
    //   options: {
    //     livereload: true
    //   },
    //   js: {
    //     files: 'app/assets/js/*.js',
    //     tasks: ['jshint', 'concat', 'copy'],
    //     options: {
    //       nospawn: true,
    //       interrupt: true
    //     }
    //   },
    //   css: {
    //     files: 'app/assets/sass/*.scss',
    //     tasks: ['compass'],
    //     options: {
    //       nospawn: true,
    //       interrupt: true
    //     }
    //   }
    // },

    gruntfile: {
      src: 'Gruntfile.js'
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-clean');
  // grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // grunt.loadNpmTasks('grunt-responsive-images');
  // grunt.loadNpmTasks('grunt-contrib-watch');

  // grunt.registerTask('default', ['watch']);
  grunt.registerTask('default', ['concat', 'copy', 'uglify', 'clean']);

   /*
    DEV Mode: 
  */
  grunt.registerTask('build-dev', ['concat', 'copy', 'uglify', 'clean']);

   /*
    PROD Mode: Run this when you are ready to DEPLOY.
  */
  grunt.registerTask('build-prod', ['concat', 'copy', 'uglify', 'clean']);

};