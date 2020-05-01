var Boot = function (config_boot) {

    config = $.extend(true, config, config_boot);
    var checkConfig = function (paramater, name) {
        if (paramater === undefined) {
            console.log('p3x.boot => ' + name + ' is not specified!');
            return false;
        }
        return true;
    }
    checkConfig(config.base_url, 'config.base_url');
    checkConfig(config.analytics, 'config.analytics');
    if (config.analytics) {
        checkConfig(config.google_analytics_id, 'config.google_analytics_id');
    }
    if (checkConfig(config.parameter, 'config.parameter')) {
        checkConfig(config.parameter.language_switcher, 'config.parameter.language_switcher');
    }

    var uri = p3x.Uri;
    config.base_href_correct = new uri($('base[href]').prop('href')).stringify() == new uri(config.base_url).stringify();

    p3x.config = config;

    if (config.google_analytics_id !== undefined && config.analytics) {
        Analytics.Boot();
    }
    Language.Boot(config.language.current, config.language.available, config.language.text);
    Ajax.Boot();
    Template.Boot();
    $(document).ready(function () {
        AjaxHrefInterface.Boot();
    });
}

p3x.Boot = Boot;
