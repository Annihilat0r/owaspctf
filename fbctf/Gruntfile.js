module.exports = function(grunt) {
  grunt.initConfig({
    env: {
      release: {
        NODE_ENV: 'production'
      }
    },
    sass: {
      options: {
        sourceMapEmbed: true
      },
      dist: {
        files: {
          'src/static/css/fb-ctf.css': 'src/static/css/scss/fb-ctf.scss'
        }
      }
    },
    eslint: {
      options: {
        force: true
      },
      dist: {
        src: ['src/static/js/**/*.js']
      }
    },
    run: {
      flow: {
        cmd: 'flow',
        args: [
          'src'
        ]
      }
    },
    browserify: {
      options: {
        browserifyOptions: {
          debug: true
        },
        transform: [
          [
            'babelify', {
              presets: [
                // 'es2015',
                'react'
              ]
            }
          ]
        ]
      },
      dist: {
        src: 'src/static/js/app.js',
        dest: 'src/static/build/app-browserify.js'
      }
    },
    uglify: {
      dist: {
        src: 'src/static/build/app-browserify.js',
        dest: 'src/static/dist/js/app.js'
      }
    },
    watch: {
      files: ['src/static/js/**/*.js'],
      tasks: ['default']
    },
    copy: {
      browserify: {
        src: 'src/static/build/app-browserify.js',
        dest: 'src/static/dist/js/app.js'
      }
    }
  });

  grunt.loadNpmTasks('grunt-browserify');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-env');
  grunt.loadNpmTasks('grunt-eslint');
  grunt.loadNpmTasks('grunt-force-task');
  grunt.loadNpmTasks('grunt-run');

  grunt.registerTask('check', ['force:eslint', 'run:flow']);
  grunt.registerTask('build', ['browserify', 'copy:browserify', 'sass']);
  grunt.registerTask('default', ['check', 'build']);
  grunt.registerTask('release', ['env:release', 'eslint', 'run:flow', 'browserify', 'uglify', 'sass']);
};
