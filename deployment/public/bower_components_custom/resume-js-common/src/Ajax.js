/**
 * This module is for handling Ajax
 * @class Ajax
 */

/**
 * Ajax class.
 * Right now it is not using objects, all static.
 * But it is extensible.
 * @constructor Ajax class
 * @static
 */
function Ajax() {
}

/**
 * This is the static Boot.
 * @method Static Boot.
 */
Ajax.Boot = function () {
    $.ajaxSettings.cache = true;
    $.ajaxSetup({
        beforeSend: function (xhr) {
            xhr.setRequestHeader(config.parameter.header.debug, config.debug);
        }
    });
    $(document)
        .ajaxStart(Overlay.Show.bind(Overlay))

        .ajaxSuccess(function (event, jqXHR, options, data) {
            if (options[config.parameter.ajax.analytics] != undefined) {
                if (options[config.parameter.ajax.analytics] == true && data.result == 'success') {
                    Analytics.SendAnalytics(options.url);
                }
            }
        })

        .ajaxStop(Overlay.Hide.bind(Overlay))

        .ajaxError(function (event, jqxhr, settings, thrownError) {
            Debug.Info(arguments)
        });
};
p3x.Ajax = Ajax;
