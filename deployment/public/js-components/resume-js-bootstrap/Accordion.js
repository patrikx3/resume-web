/**
 *
 * @constructor
 */
function Accordion() {
}

/**
 *
 * @method
 * @param id
 * @param root
 * @param defaultAccordion
 * @param addonId
 * @param currentAccordion
 * @param cacheId
 * @static
 */
Accordion.Decorate = function (id, root, defaultAccordion, addonId, currentAccordion, cacheId) {

    if (addonId == undefined) {
        addonId = '';
    }

    var $accordionMain = $('#' + id);
    var current_click = false;

    var accordionItemUrl = $accordionMain.attr('data-accordion-item-url');
    if (accordionItemUrl != undefined) {
        accordionItemUrl = Router.Url(accordionItemUrl);
        Event.Factory(AjaxHrefInterface.CurrentContentId).on($accordionMain, 'show.bs.collapse', function (e) {
            var $panel = $(e.target);
            var loaded = $panel.attr('data-accordion-loaded');
            if (loaded === undefined || loaded == 'true') {
                return;
            }
            var id = $panel.attr('id');
            var raw_id = id.substr(addonId.length);

            var deferred = $.Deferred();
            Overlay.Show();
            $.ajax({
                url: accordionItemUrl + '/' + raw_id
            }).then(function (data) {
                $panel.attr('data-accordion-loaded', 'true');
                $panel.html(data.content);
                $accordionMain.trigger(config.parameter.event.bootstrap.accordion.loaded, $panel);
                //var $title = $('[aria-controls="' + id + '"]');
                deferred.resolve();
            });
            $accordionMain.one('shown.bs.collapse', function () {
                deferred.then(function () {
                    AjaxHrefInterface.CacheUpdate(cacheId === undefined ? root : cacheId);
                    Layout.JumpToHash();
                    Overlay.Hide();
                })
            });
        });
    }


    Event.Factory(AjaxHrefInterface.CurrentContentId).on($accordionMain, 'shown.bs.collapse', function (e) {
        if (current_click) {
            current_click = false;
            return;
        }
        var hash = e.target.id;
        hash = hash.slice(addonId.length);
        var push = root + '/' + hash;
        var $e = $(e.target);
        var addon = $e.data('bootstrap-accordion');
        if (addon != undefined) {
            push += '/' + addon;
        }
        push += '#' + e.target.id;
        history.pushState(AjaxHrefInterface.GetCurrentContentData(), document.title, push);
        Layout.JumpToHash(true);
    });

    /*
     event.factory(AjaxHrefInterface.CurrentContentId).on($accordionMain, 'hidden.bs.collapse', function (e) {
     var hash = e.target.id;
     var push = root + '#' + hash;
     history.pushState(AjaxHrefInterface.GetCurrentContent_data(), document.title, push);
     });
     */
    if (AjaxHrefInterface.CurrentContentId == config['content-start-id']) {
        //<?= $data['tab'].$data['accordion'] == $tab_id_content ? 'in' : ''; ?>"
        // <?= $data == $tab_id_content ? 'in' : ''; ?>
        var $current = $accordionMain.find('#' + addonId + current_accordion);
        if ($current.length == 0) {
            $current = $('#' + addonId + defaultAccordion);
        }
        if (!$current.is('.active,.in')) {
            $accordionMain.find('[aria-controls="' + $current.attr('id') + '"]').click();
        }
        return;
    }

    var currentPath = Uri.Current().data.pathname;
    var rootUrlArray = root.split('/');
    var currentPathArray = currentPath.split('/');
    var $panels = $accordionMain.find('[aria-labelledby]');

    var clearPanel = function ($panels) {
        $panels.each(function (index, value) {
            var $value = $(value);
            if ($value.is('.active,.in')) {
                $value.removeClass('active in');
                $accordionMain.trigger({
                    namespace: 'bs.collapse',
                    type: 'hidden',
                    target: value
                });
            }
            /*
             var id = $value.attr('id');
             var $title = $accordionMain.find('[aria-controls="' + id + '"]');
             */
            /*
             if ($value.is('.active,.in')) {
             var id = $value.attr('id');
             var $title = $accordionMain.find('[aria-controls="' + id + '"]');
             console.log($title);
             $title.click();
             }
             */
        });
    };

    if (currentPathArray.length <= rootUrlArray.length) {
        clearPanel($panels);
        return;
    }
    var current_accordion = currentPathArray[rootUrlArray.length];
    var id = addonId + current_accordion;

    clearPanel($panels.not('#' + id));

    if (location.hash != '#' + id) {
        return;
    }

    if (!$accordionMain.find('#' + id).hasClass('in')) {
        current_click = true;
        var $accordion_title = $accordionMain.find('[aria-controls="' + id + '"]');
        $accordion_title.click();
    }
};

p3x.Gui.Bootstrap.Accordion = Accordion;

