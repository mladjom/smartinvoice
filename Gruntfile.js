module.exports = function(grunt) {
    'use strict';

    // Force use of Unix newlines
    grunt.util.linefeed = '\n';

    RegExp.quote = function(string) {
        return string.replace(/[-\\^$*+?.()|[\]{}]/g, '\\$&');
    };

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // Task configuration.   
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all:[
                'Gruntfile.js'
            ]
        },
        less: { 
            dist: {
                files: {
                    'public/assets/css/main.min.css': [
                        'resources/less/main.less'
                    ]
                },
                options: {
                    compress: true,
                    sourceMap: true,
                    cleancss: true
                }
            }
        },
        uglify: {
            dist: {
                files: {
                    'public/assets/js/scripts.min.js': [
                        'resources/vendor/bootstrap/js/transition.js',
                        'resources/vendor/bootstrap/js/alert.js',
                        'resources/vendor/bootstrap/js/button.js',
                        'resources/vendor/bootstrap/js/carousel.js',
                        'resources/vendor/bootstrap/js/collapse.js',
                        'resources/vendor/bootstrap/js/dropdown.js',
                        'resources/vendor/bootstrap/js/modal.js',
                        'resources/vendor/bootstrap/js/tooltip.js',
                        'resources/vendor/bootstrap/js/popover.js',
                        'resources/vendor/bootstrap/js/scrollspy.js',
                        'resources/vendor/bootstrap/js/tab.js',
                        'resources/vendor/bootstrap/js/affix.js',
                        'resources/vendor/jasny-bootstrap/js/inputmask.js',
                        'resources/vendor/jasny-bootstrap/js/fileinput.js',
                    ]
                }
            }
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        cwd: 'resources/vendor/jquery/dist',
                        src: ['./**/jquery*.min.*'],
                        dest: 'public/assets/lib/jquery'
                    },
                    {
                        expand: true,
                        cwd: 'resources/vendor/bootstrap',
                        src: ['./js/*.*'],
                        dest: 'public/assets/lib/bootstrap'
                    }, 
                    {
                        expand: true,
                        cwd: 'resources/vendor/datatables/media',
                        src: ['./images/*.*','./js/*.*'],
                        dest: 'public/assets/lib/datatables'
                    },
                    {
                        expand: true,
                        cwd: 'resources/vendor/datatables-bootstrap3/BS3/assets',
                        src: ['./images/*.*','./js/*.*','./css/*.*'],
                        dest: 'public/assets/lib/datatables-bootstrap3'
                    }, 
                    {
                        expand: true,
                        cwd: 'resources/vendor/bootstrap-datepicker',
                        src: ['css/datepicker3.css','js/bootstrap-datepicker.js'],
                        dest: 'public/assets/lib/bootstrap-datepicker'
                    },
                    {
                        expand: true,
                        cwd: 'resources/vendor/jspdf/dist',
                        src: ['jspdf.min.js'],
                        dest: 'public/assets/lib/jspdf'
                    },
                    {
                        expand: true,
                        cwd: 'resources/vendor/jspdf/dist',
                        src: ['jspdf.min.js'],
                        dest: 'public/assets/lib/jspdf'
                    },                    
                    {
                        expand: true,
                        cwd: 'resources/vendor/font-awesome',
                        src: ['./css/*.*','./fonts/*.*'],
                        dest: 'public/assets/lib/font-awesome'
                    }                
                 ]
            }
        },       
        watch: {
            less: {
                files: [
                    'resources/less/*.less'
                ],
                tasks: ['less']
            },
            js: {
                files: [
                    '<%= jshint.all %>'
                ],
                tasks: ['uglify']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    'public/assets/css/main.min.css',
                    'public/assets/js/scripts.min.js'
                ]
            }
        },
        clean: {
            dist: [
                'public/assets/css/main.min.css',
                'public/assets/js/scripts.min.js'
            ]
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-copy');
    // Register tasks
    grunt.registerTask('default', [
        'clean',
        'copy',
        'less',
        'uglify'
    ]);
    grunt.registerTask('dev', [
        'watch'
    ]);

};
