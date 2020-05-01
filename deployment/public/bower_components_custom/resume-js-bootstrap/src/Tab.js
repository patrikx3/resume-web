function Tab() {
}

Tab.Decorate = function (id, defaultTabId, rootUrl, currentTab, addonId, cacheId) {
    var $tab = $('#' + id);

    if (addonId == undefined) {
        addonId = '';
    }

    var currentClick = false;
    var $tabClick = $tab.find('a[data-toggle="tab"]');

    var tabItemUrl = $tab.attr('data-tab-item-url');
    if (tabItemUrl !== undefined) {
        tabItemUrl = Router.Url(tabItemUrl);
        Event.Factory(AjaxHrefInterface.CurrentContentId).on($tabClick, 'show.bs.tab', function (e) {
            var $title = $(e.target);
            var id = new Uri($title.attr('href')).data.hash;
            var actualId = id.substr(addonId.length);
            var $content = $('#' + id);
            var loaded = $content.attr('data-tab-loaded');
            if (loaded === undefined || loaded == 'true') {
                return;
            }
            var deferred = $.Deferred();
            Overlay.Show();
            $.ajax({
                url: tabItemUrl + '/' + actualId
            }).then(function (data) {
                $content.attr('data-tab-loaded', 'true');
                $content.html(data.content);
                $tab.trigger(config.parameter.event.bootstrap.tab.loaded, $content);
                deferred.resolve();
            });
            $tab.one('shown.bs.tab', function () {
                deferred.then(function () {
                    AjaxHrefInterface.CacheUpdate(cacheId === undefined ? rootUrl : cacheId);
                    Overlay.Hide();
                })
            });
        });
    }

    Event.Factory(AjaxHrefInterface.CurrentContentId).on($tabClick, 'shown.bs.tab', function (e) {
        if (currentClick) {
            currentClick = false;
            return;
        }
        var hash = e.target.hash.substr(1);
        hash = hash.slice(addonId.length);
        var push = rootUrl + '/' + hash;
        var $e = $(e.target);
        var addon = $e.data('bootstrab-tab');
        if (addon != undefined) {
            push += '/' + addon;
        }
        push += e.target.hash;
        history.pushState(AjaxHrefInterface.GetCurrentContentData(), document.title, push);
    });

    var currentPath = Uri.Current().data.pathname;
    if (currentPath == rootUrl || AjaxHrefInterface.CurrentContentId == config['content-start-id']) {
        var defaultTabId = addonId + defaultTabId;
        var tabId = addonId + currentTab;
        if (currentPath == rootUrl) {
            tabId = defaultTabId;
        }
        var $currentTab = $tab.find('#' + tabId);
        if ($currentTab.length == 0) {
            tabId = defaultTabId;
            $currentTab = $tab.find('#' + tabId);
        }
        var $current_tab_menu = $tab.find('[href$="#' + tabId + '"]');
        $currentTab.addClass('active in');
        $current_tab_menu.click();
        return;
    }
    var current_path = Uri.Current().data.pathname;
    var rootUrlArray = rootUrl.split('/');
    var currentPathArray = current_path.split('/');
    var currentTab = currentPathArray[rootUrlArray.length];

    var $tabList = $tab.find('> [role="tablist"] > li');
    var find = rootUrl + '/' + currentTab;
    var $foundTab = $tabList.find('> [href^="' + find + '"]');

    currentClick = true;
    $foundTab.click();
};

p3x.Gui.Bootstrap.Tab = Tab;
