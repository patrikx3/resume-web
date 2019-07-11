module.exports = function (grunt, grunt_this, local) {
    // Fail task if "foo" task failed or never ran.
    //grunt.task.requires('foo');
    // This code executes if the "foo" task ran successfully.
    //grunt.log.writeln('Hello, world.');
    var rp = require('request-promise');
    var clear_cli = require("cli-clear");

    var clear = function () {
        if (!local) {
            return;
        }
        if (process.platform.indexOf("win") === 0 && process.stdout.getWindowSize == undefined) {
            return;
        }
        clear_cli();
    };

    var done = grunt_this.async();

    var random = function (min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    var urls = {};

    var check_progres = function () {
        clear();
        grunt.log.writeln('SITEMAP PROBE WHOLE SYSTEM');
        for (var count_index in urls) {
            for (var server_index in urls[count_index]) {
                var urls_item = urls[count_index][server_index];
                var count = 0;
                for (var index  in urls_item) {
                    if (urls_item[index] == true) {
                        count++;
                    }
                }
                var count_all = Object.keys(urls_item).length;
                var percentage = ((count / count_all) * 100).toFixed(2);
                if (isNaN(percentage)) {
                    percentage = 0;
                }
                grunt.log.writeln('SERVER ' + count_index + ': ' + server_index + ' ' + String(count) + '/' + count_all + ' | ' + percentage + '%');
            }
        }
    };

    var test = function (count_index, server_config) {
        var server = server_config.url;
        var wait_calculator = server_config.wait;
        var site_query = 'analytics=false';
        if (server_config.production !== undefined && server_config.production === true) {
            site_query += '&production'
        }
        var sitemap;
        if (urls[count_index] == undefined) {
            urls[count_index] = {};
        }
        if (urls[count_index][server] == undefined) {
            urls[count_index][server] = {};
        }
        var sitemapurl = server + 'sitemap.xml?' + site_query;
        grunt.log.writeln('TESTING DOWNLOADING SITEMAP SERVER: ' + sitemapurl);
        rp(sitemapurl)
            .then(function (sitemap_xml) {
                var check_url = function (url) {
                    if (url.indexOf('?') == -1) {
                        url = url + '?' + site_query;
                    } else {
                        url = url + site_query;
                    }
                    if (urls[count_index][server][url] !== undefined) {
                        return;
                    }
                    urls[count_index][server][url] = false;

                    var run = function () {
                        rp(url).then(function (result) {
                            grunt.log.writeln('DONE: ' + url);
                            urls[count_index][server][url] = true;
                            check_progres();
                        }).catch(function (error) {
                            grunt.log.error('ERROR: ' + url);
                            grunt.log.error(error);
                            done();
                        });
                    };
                    if (wait == 0) {
                        run();
                    } else {
                        var wait = random(1, sitemap.urlset.url.length);
                        setTimeout(run, wait * wait_calculator);
                    }
                };

                var parser = require('xml2json-temporary');
                var sitemap_json = parser.toJson(sitemap_xml);
                sitemap = JSON.parse(sitemap_json);
                for (var index in sitemap.urlset.url) {
                    var sitemap_url = sitemap.urlset.url[index];
                    var url = sitemap_url.loc;
                    check_url(url);
                    if (sitemap_url['image:image'] !== undefined) {
                        if (sitemap_url['image:image']['image:loc'] !== undefined) {
                            check_url(sitemap_url['image:image']['image:loc']);
                        } else {
                            for (var image_index in sitemap_url['image:image']) {
                                var sitemap_url_data = sitemap_url['image:image'][image_index];
                                var sitemap_url_data_url = sitemap_url_data['image:loc'];
                                check_url(sitemap_url_data_url);
                            }
                        }
                    }
                }
            })
            .catch(function (err) {
                grunt.log.error('ERROR SERVER: ' + server);
                grunt.log.error(err);
                done();
            });
    };

    var config = grunt.config.get('sitemap');
    for (var index in config.server) {
        var server = config.server[index];
        if (server.enabled) {
            if (!server.dev) {
                test('PRODUCTION', server);
            } else {
                for (var count_index = 0; count_index < config.counts; count_index++) {
                    test(count_index, server);
                }
            }
        }
    }
};
