/* global module:false */
module.exports = function (grunt) {
    grunt.initConfig({

            // configuration
            config: {
                app: "src/application",
                dist: "dist/application"
            },

            // banner
            pkg: grunt.file.readJSON('package.json'),
            banner: '/*! <%= pkg.name %> - <%= pkg.version %> - ' +
            '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
            '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
            '* Copyright (c) <%= grunt.template.today("yyyy") %> - <%= _.map(pkg.authors, function(el) { return el.name + " <" + el.email + ">" }).join(", ") %>' +
            '\n*/\n',

            // JavaScript concatenation
            concat: {
                options: {
                    banner: '<%= banner %>',
                    stripBanners: true
                },
                dist: {
                    src: [
                        '<%= config.app %>/vendor/jquery/dist/jquery.js',
                        '<%= config.app %>/vendor/bootstrap/dist/js/bootstrap.js',
                        '<%= config.app %>/vendor/angular/angular.js',
                        '<%= config.app %>/vendor/angular-bootstrap/ui-bootstrap.js',
                        '<%= config.app %>/vendor/angular-bootstrap/ui-bootstrap-tpls.js',
                        '<%= config.app %>/js/**/*.js'
                            ],
                    dest: '<%= config.dist %>/js/<%= pkg.name %>.js'
                }
            },


            // JavaScript minification
            uglify: {
                options: {
                    banner: '<%= banner %>'
                },
                dist: {
                    src: '<%= concat.dist.dest %>',
                    dest: '<%= config.dist %>/js/<%= pkg.name %>.min.js'
                }
            },


            // Less to CSS
            less: {
                compile: {
                    files: {
                        '<%= config.dist %>/css/<%= pkg.name %>.css': '<%= config.app %>/less/app.less'
                    }
                }
            },


            // CSS minification
            cssmin: {
                options: {
                    compatibility: 'ie8',
                    keepSpecialComments: '*',
                    noAdvanced: true
                },
                core: {
                    files: {
                        '<%= config.dist %>/css/<%= pkg.name %>.min.css': '<%= config.dist %>/css/<%= pkg.name %>.css'
                    }
                }
            },

            // Copy
            copy: {
                main: {
                    files: [
                        {
                            expand: true,
                            cwd: '<%= config.app %>/vendor/angular',
                            src: ['*.map'],
                            dest: '<%= config.dist %>/js/',
                            filter: 'isFile'
                        },
                        {
                            expand: true,
                            cwd: '<%= config.app %>/vendor/html5shiv/dist',
                            src: ['html5shiv.min.js'],
                            dest: '<%= config.dist %>/js/',
                            filter: 'isFile'
                        },
                        {
                            expand: true,
                            cwd: '<%= config.app %>/vendor/respond/dest',
                            src: ['respond.min.js'],
                            dest: '<%= config.dist %>/js/',
                            filter: 'isFile'
                        }

                    ]
                },
                fonts: {
                    files: [
                        {
                            expand: true,
                            cwd: '<%= config.app %>/vendor/fontawesome/fonts',
                            src: ['*.*'],
                            dest: '<%= config.dist %>/fonts/'
                        }
                    ]
                },
                images: {
                    files: [
                        {
                            expand: true,
                            cwd: '<%= config.app %>/img',
                            src: ['*.*'],
                            dest: '<%= config.dist %>/img/'
                        }
                    ]
                }
            },



            // Clean
            clean: {
                build: ["<%= config.dist %>/"]
            },


            // Watch
            watch: {
                js: {
                    files: [
                        '<%= config.app %>/js/app.js'
                    ],
                    tasks: ['concat', 'uglify'],
                    options: {
                        spawn: false
                    }
                },
                less: {
                    files: [
                        '<%= config.app %>/less/app.less',
                        '<%= config.app %>/less/variables.less'
                    ],
                    tasks: ['stylesheet']
                }
            }
        }
    );


    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-cssmin');


    // Grunt force default
    grunt.option('force', true);


    // Default task
    grunt.registerTask('stylesheet', ['less:compile', 'cssmin', 'copy:fonts']);
    grunt.registerTask('javascript', ['concat', 'uglify', 'copy:main']);
    grunt.registerTask('default', ['clean:build', 'stylesheet', 'javascript', 'copy:images']);
};
