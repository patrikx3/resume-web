var bootstrapConfig = {
    parameter: {
        event: {
            bootstrap: {
                accordion: {
                    loaded: 'p3x-bootstrap-accordion-loaded'
                },
                tab: {
                    loaded: 'p3x-bootstrap-tab-loaded'
                }
            }
        }
    }
};

p3x.config = $.extend(true, p3x.config, bootstrapConfig);

var AjaxHrefInterface = p3x.AjaxHrefInterface;
var Event = p3x.Event;
var Uri = p3x.Uri;
var config = p3x.config;
var Overlay = p3x.Overlay;
var Router = p3x.Router;
var Layout = p3x.Layout;

AjaxHrefInterface.RenderContentCallback.push(function (data, html) {

    if (data.dialog == undefined) {
        return false;
    }

    var previousTitle = document.title;
    if (data.title !== undefined) {
        document.title = data.title;
    }
    var dialogId = '#' + data.dialog;
    if ($(dialogId).length == 0) {
        $('body').append(html);
        var previousTitleFix = (function (title) {
            return function () {
                document.title = title
            }
        })(previousTitle);
        $(dialogId).on('hidden.bs.modal', function (e) {
            previousTitleFix();
        });
    }
    $('#' + data.dialog).modal('show')

    return true;
})
