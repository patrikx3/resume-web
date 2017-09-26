
module.exports = function (grunt) {

    require('time-grunt')(grunt);

    const hostname = require("os").hostname();


    const docker_host = 'docker-patrikx3-resume';
    const server_test = hostname == docker_host ? 'http://localhost/' : 'http://patrikx3.patrikx3.com/';
    const server_production = 'http://www.patrikx3.com/';

    const folder_build = 'build/';
    const folder_build_phpdoc = folder_build + 'phpdoc/';

    const folder_deployment = 'deployment/';

    const folder_deployment_templates = folder_deployment + 'templates/';
    const folder_deployment_application = folder_deployment + 'application/';

    const folder_deployment_build = folder_deployment + 'build/';
    const folder_deployment_handlebars = folder_deployment_build + 'template-compiled-js/';

    const folder_public = folder_deployment + 'public/';
    const folder_public_bower = folder_public + 'bower_components/';
    const folder_public_source = folder_public + 'assets/';
    const folder_public_source_scripts = folder_public_source + 'scripts/';
    const folder_public_source_css = folder_public_source + '/css/';

    const folder_public_production = folder_public + 'production/';
    //const folder_public_production_bootsrap_themes = folder_public_production + 'bootstrap-theme';
    const folder_public_production_fonts = folder_public_production + 'fonts/';
    const folder_public_production_css = folder_public_production + 'css/';
    const folder_public_production_scripts = folder_public_production + 'scripts/';

    const isWin = process.platform.indexOf("win") === 0;

    grunt.loadNpmTasks('grunt-wiredep');
    grunt.loadNpmTasks('grunt-bower-concat');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-handlebars');
    grunt.loadNpmTasks('grunt-contrib-yuidoc');
    grunt.loadNpmTasks('grunt-injector');
//    grunt.loadNpmTasks('grunt-phpunit');
//    grunt.loadNpmTasks('grunt-phpdoc');
    grunt.loadNpmTasks('grunt-sass');

    const handlebars_config_files = {};
    handlebars_config_files[folder_public_production + 'p3x.resume.hbs.js'] = folder_deployment_templates + '**/*.hbs';

    const handlebars_config = {
        compile: {
            options: {
//                namespace: 'p3x.resume.hbs',
                 processName: function(filename) {
                    const actual_filename = filename.substr(folder_deployment_templates.length);
                    return actual_filename.substr(0, actual_filename.length - '.hbs'.length);
                },
                //partialsUseNamespace: true
            },
            files: handlebars_config_files
        }
    }

    const fs = require('fs');
    let enable_test = false;
    let enable_production = true;
    let local = false;
    if (fs.existsSync('local.json') || server_test == docker_host) {
        enable_test = true;
        local = true;
        enable_production = false;
    }
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        injector: {
            options: {
                // Task-specific options go here.
                addRootSlash: false,
                groupByTarget: true,
                ignorePath: folder_public
            },
            p3x: {
                options: {
                    starttag: '<!-- injector:p3x:source:{{ext}} -->'
                },
                files: {
                    'deployment/views/layout/bower.php': [
                        folder_public_bower + 'p3x-resume/src/**/*.js',
                        folder_public_bower + 'p3x-resume/src/**/*.css',
                        folder_public_bower + 'p3x-resume-bootstrap/src/**/*.js'
                    ],
                }
            },
        },
        handlebars: handlebars_config,
        concat: {
            js: {
                src: [
                    folder_public_source_scripts + '**/*.js',
                    '!' + folder_public_source_scripts + '**/*.min.js',
                    '!' + folder_public_source_scripts + '**/Swf.js'
                ],
                dest: folder_public_production + 'patrikx3.js'
            },
            options: {
                separator: ';'
            }
        },
        copy: {
            fonts: {
                expand: true,
                flatten: true,
                src: [
                    folder_public_bower + 'components-font-awesome/fonts/*',
                ],
                dest: folder_public_production_fonts
            },
            fontsRecursive: {
                expand: true,
                flatten: true,
                src: [
                    folder_public_bower + 'p3x-stackicons/fonts/Stackicons/**/*'
                ],
                dest: folder_public_production_fonts + 'Stackicons'
            }

            /*
            ,
            'bootstrap-themes': {
                expand: true,
                flatten: true,
                src: folder_public_source + '/bootstrap-theme/*',
                dest: folder_public_production_bootsrap_themes
            },
            */
        },

        // make sure override use bower_concat as well.
        wiredep: {
            target: {
                src: [
                    'deployment/views/layout/bower.php',
                ],
                //              ..\..\publi
                //ignorePath: /^\.\.\/\.\.\/public\//,
                ignorePath: '../../public/',
                exclude: ['p3x-resume'],
                overrides: {
                    sprintf: {
                        main: [
                            'dist/sprintf.min.js',
                        ]
                    }
                }
            }
        },
        bower_concat: {
            all: {
                mainFiles: {
                    sprintf: [
                        'dist/sprintf.min.js',
                    ],
                },
                dest: {
                    'js': folder_public_production + 'bower.js',
                    'css': folder_public_production + 'bower.css',
                },
                exclude: [ ],
                dependencies: {},
                bowerOptions: {
                    relative: false
                }
            }
        },
        uglify: {
            options: {
                /*
                 compress: false,
                 mangle: false,
                 sourceMap: false,
                 preserveComments: true,
                */
                compress: true,
                mangle: true,
                sourceMap: false,
                preserveComments: false,
            },
            'all': {
                src: [
                    folder_public_production + 'bower.js',
                    folder_public_production + 'p3x.resume.hbs.js',
                    folder_public_production + 'patrikx3.js',
                ],
                dest: folder_public_production_scripts + 'production.patrikx3.all.js'
            }
        },
        sass: {
            options: {
                sourceMap: false,
                outputStyle: 'expanded'
            },
            dist: {
                files: {
                    [folder_public_source_css + 'all.css'] : folder_public_source_css + 'all.scss'
                }
            }
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1,
                report: 'gzip',
                keepSpecialComments: 0
            },
            bower: {
                files: [{
                    expand: false,
                    src: [
                        folder_public_production + 'bower.css'
                    ],
                    dest: folder_public_production_css + 'production.bower.css'
                }]
            },
            patrikx3: {
                files: [{
                    expand: false,
                    src: [
                        folder_public_source_css + 'all.css'
                    ],
                    dest: folder_public_production_css + 'production.patrikx3.css'
                }]
            }
        },
        clean: {
            final: [
                folder_public_production + 'bower.css',
                folder_public_production + 'patrikx3.js',
                folder_public_production + 'bower.js',
                folder_public_production + 'ugly.bower.js',
                folder_public_production + 'ugly.patrikx3.js',
                folder_public_production + 'p3x.resume.hbs.js',
            ],
            build: [
                folder_build
            ]
        },
        watch: {
            scripts: {
                files: [
                    'Gruntfile.js',
                    folder_public_source + '**/*.*'
                ],
                tasks: ['sass'],
                options: {
                    debounceDelay: 5000,
                },
            },
        },
        sitemap: {
            counts: 3,
            server: [
                {
                    url: server_test,
                    wait: 0,
                    enabled: enable_test,
                    dev: true,
                    production: true
                },
                {
                    url: server_production,
                    wait: 500,
                    enabled: enable_production,
                    dev: false
                }
            ]
        },
        phpunit: {
            classes: {
                dir: 'test/phpunit/'
            },
            options: {
                bin: isWin ? 'deployment/vendor/bin/phpunit.bat' : 'deployment/vendor/bin/phpunit',
                bootstrap: 'deployment/vendor/autoload.php',
                colors: true
            }
        },
        yuidoc: {
            compile: {
                name: '<%= pkg.name %>',
                description: '<%= pkg.description %>',
                version: '<%= pkg.version %>',
                url: '<%= pkg.homepage %>',
                options: {
                    paths: folder_public_source_scripts,
                    //themedir: 'path/to/custom/theme/',
                    outdir: folder_build + 'api'
                }
            }
        },
        phpdoc: {
            target: {
                src: [
                    folder_deployment_application
                ],
                dest: folder_build_phpdoc
            }
        }
    });

    /*
     grunt.registerTask('foo', 'My "foo" task.', function() {
     });
     */

    grunt.registerTask('sitemap-task', 'Check Sitemap.XML.', function () {
        require('./test/node/sitemap')(grunt, this, local);
    });

    grunt.registerTask('ensure-folders', 'Ensure directories', function() {
        const done = this.async();
        const ensure_directory = (dir) => {
            return new Promise((resolve, reject) => {
                console.log('Ensure directory: ' + dir);
                fs.stat(dir, (err, stats) => {
                    if (err) {
                        //console.log('Created directory: ' + dir);
                        fs.mkdir(dir, 0o777, (error) => {
                            if (error) {
                                return reject(error)
                            }
                            return resolve();
                        })
                    }
                    //console.log('Directory was exsiting: ' + dir);
                    return resolve();
                })
            })
        };

        Promise.all([
            ensure_directory(folder_build),
            ensure_directory(folder_deployment),
            ensure_directory(folder_deployment_build),
            ensure_directory(folder_deployment_handlebars),
            ensure_directory(folder_public_production),
            //ensure_directory(folder_public_production_bootsrap_themes)
            ensure_directory(folder_public_production_fonts),
            ensure_directory(folder_public_production_css),
            ensure_directory(folder_public_production_scripts),
        ]).then((result) => {
            done();
        }).catch((error) => {
            done(error);
        });
    });

    const default_task = [
        'clean:build',
        'ensure-folders',
        'handlebars',
        'copy',
        'wiredep',
        'bower_concat',
        'concat',
        'uglify',
        'sass',
        'cssmin',
        'injector',
        'yuidoc',
//        'phpunit',
//        'phpdoc',
        'clean:final',
        'version'
    ];
    grunt.registerTask('version', async function() {
        const done = this.async();
        const exec = require('mz/child_process').exec;
        const fs = require('mz/fs');
        const [commit, date] = await Promise.all([
            exec('git rev-list --all --count').then((stdout) => parseInt(stdout.join('').toString())),
            exec('git log -1 --format=%at').then((stdout) => parseInt(stdout.join('').toString()))
        ])
        await fs.writeFile('./deployment/version.txt', `${commit},${date}`);
        done();
    });

    grunt.registerTask('default', default_task);
    grunt.registerTask('build', default_task);
    grunt.registerTask('reload', ['sass', 'watch']);
    grunt.registerTask('bower-wiredep', ['wiredep']);
    grunt.registerTask('sitemap', ['sitemap-task']);
    grunt.registerTask('build-handlebars',  ['ensure-folders', 'handlebars'])

    grunt.registerTask('test-global', ['phpunit', 'sitemap-task']);


};