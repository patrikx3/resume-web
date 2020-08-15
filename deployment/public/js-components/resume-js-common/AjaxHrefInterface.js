function AjaxHrefInterface() {
}

AjaxHrefInterface.Cache = {};

AjaxHrefInterface.Hrefs = null;

AjaxHrefInterface.ClickClosure = null;

AjaxHrefInterface.CacheAdd = function (url, data) {
    var self = this;

    url = self.UpdateAppUrl(url);
    self.Cache[url] = data;

    Debug.ShowCache('Cache HTML', self.Cache);
};

AjaxHrefInterface.CacheGet = function (url) {
    var self = this;
    url = self.UpdateAppUrl(url);
    var data = self.Cache[url];
    return data === undefined ? false : data;
};

AjaxHrefInterface.CacheUpdate = function (url) {
    var self = this;
    self.LoadHrefs();
    var data = self.GetCurrentContentData();
    self.CacheAdd(url, data);
};

AjaxHrefInterface.UpdateAppUrl = function (url) {
    var self = this;
    var uri_url = new Uri(url);
    if (config.debug) {
        uri_url.data.query[config.parameter.debug] = true;
    }
    var current = Uri.Current();
    //debug.show(current.stringify(), 'mobile');
    if (current.data.query[config.parameter.mobile] != undefined) {
        uri_url.data.query[config.parameter.mobile] = true;
    }
    if (current.data.query[config.parameter.analytics] != undefined) {
        uri_url.data.query[config.parameter.analytics] = true;
    }
    if (current.data.query[config.parameter.production] != undefined) {
        uri_url.data.query[config.parameter.production] = true;
    }
    url = uri_url.stringify();
    return url;
};

AjaxHrefInterface.CurrentContentId = null;
AjaxHrefInterface.CurrentRunId = null;

AjaxHrefInterface.GetCurrentContent = function () {
    var self = this;
    return $('#' + self.CurrentContentId).html();
};

AjaxHrefInterface.GetCurrentContentData = function () {
    var self = this;
    var data = {
        content: self.GetCurrentContent(),
        'run-id': self.CurrentRunId,
        title: document.title,
        type: 'ajax'
    };
    return data;
};

AjaxHrefInterface.LoadHrefs = function () {
    var self = this;
    if (self.Hrefs != null) {
        self.Hrefs.off('click', self.click_closure);
    }
    self.Hrefs = $('[' + config.parameter.attribute.ajax + ']');
    self.Hrefs.click(self.ClickClosure);
};

AjaxHrefInterface.ClickUpdate = function () {
};

AjaxHrefInterface.Click = function (e) {
    var self = this;

    if (Layout.IsModifierKey(e)) {
        return;
    }
    e.preventDefault();

    var $click = $(e.currentTarget);

    var url = $click.attr('href');
    url = self.UpdateAppUrl(url);
    var ajax_url = $click.attr(config.parameter.attribute.ajax);

    self.ClickUpdate(url);

    var navigate = function (data, url, send_analytics) {
        if (data.dialog == undefined) {
            history.pushState(data, document.title, url, send_analytics);
        }
        self.LoadContent(data, url);
    };

    var current_cache = self.CacheGet(ajax_url);
    if (current_cache !== false) {
        navigate(current_cache, url);
    } else {
        var headers = self.GetHeaders();
        $.ajax({
            url: new Uri(url).stringify(),
            headers: headers
        }).then(function (data) {
            self.CacheAdd(ajax_url, data);
            navigate(data, url);
        });
    }
    return false;
};

AjaxHrefInterface.GetHeaders = function () {
    var self = this;
    var headers = {};
    headers[config.parameter.header.language] = JSON.stringify(Language.EnsuredAreas());
    headers[config.parameter.header.template] = JSON.stringify(Template.EnsuredTemplates());
    return headers;
}

AjaxHrefInterface.Run = function (id) {
    var self = this;
//  might be need this
//    layout_manager.update();
    if (id !== undefined) {
        p3x.Module[id]();
    }
    Layout.JumpToHash();
};

AjaxHrefInterface.Animate = false;

AjaxHrefInterface.LoadContentCounter = 0;

AjaxHrefInterface.RenderContentCallback = [];

AjaxHrefInterface.NewContentId = function () {
    var self = this;
    return config.parameter.id.content + UniqueId();
}

AjaxHrefInterface.RenderContent = function (data, html) {
    var self = this;

    for (var i in self.RenderContentCallback) {
        var done = self.RenderContentCallback[i](data, html);
        if (done) {
            return;
        }
    }
    self.RenderContentHtml(data, html);
}

AjaxHrefInterface.RenderContentHtml = function (data, html) {
    var self = this;

    if (html == undefined) {
        html = data.content;
    }

    if (data.title !== undefined) {
        document.title = data.title;
    }

    Overlay.Show(false);
    self.LoadContentCounter++;

    var lastContentId = self.CurrentContentId;
    self.CurrentContentId = self.NewContentId();
    self.CurrentRunId = data[config.parameter.json.run];

    var slideUp = $.Deferred();
    var slideDown = $.Deferred();
    var slideUpFade = $.Deferred();

    var duration = 500;

    $('#layout-content').prepend('<div style="display: none;" id="' + self.CurrentContentId + '">' + html + '</div>');

    var $hide_content = $('#' + lastContentId);
    var $show_content = $('#' + self.CurrentContentId);

    if (self.Animate) {

        $hide_content.slideUp({
            duration: duration,
            done: function () {
                slideUp.resolve();
            }
        });

        $hide_content.fadeTo(duration, 0, function () {
            slideUpFade.resolve();
        })

        $show_content.slideDown({
            duration: duration,
            done: function () {
                slideDown.resolve();
            }
        });

    } else {
        $hide_content.hide();
        $show_content.show();
        slideUp.resolve();
        slideDown.resolve();
        slideUpFade.resolve();
    }

    $.when(slideUp, slideDown, slideUpFade).then(function () {
        Periodical.Factory(lastContentId).destruct();
        Event.Factory(lastContentId).destruct();
        $hide_content.remove();
        self.LoadHrefs();
        self.LoadContentCounter--;
        if (self.LoadContentCounter == 0) {
            self.Run(data[config.parameter.json.run]);
        }
        Overlay.Hide();
    });
}

AjaxHrefInterface.LoadContent = function (data) {
    var self = this;

    if (data[config.parameter.json.languages] != undefined) {
        Language.SetAreas(data[config.parameter.json.languages]);
    }
    if (data[config.parameter.json.templates] != undefined) {
        Template.SetTemplates(data[config.parameter.json.templates]);
    }

    if (data.type !== undefined && data.type == config.parameter.type.template) {
        Template.DeferredContent(data.content).then(function (html) {
            self.RenderContent(data, html);
        });
    } else {
        self.RenderContent(data);
    }
};

AjaxHrefInterface.Boot = function () {
    var self = this;

    self.ClickClosure = self.Click.bind(self);
    self.CurrentContentId = config[config.parameter.content.start];
    self.CurrentRunId = config.start_run_id;

    history._replaceState = history.replaceState;
    history._pushState = history.pushState;

    history.replaceState = function (data, title, url, send_analytics) {
        if (send_analytics == undefined) {
            send_analytics = true;
        }
        url = self.UpdateAppUrl(url);
        if (send_analytics) {
            Analytics.SendAnalytics(url);
        }
        return history._replaceState(data, title, url);
    };

    history.pushState = function (data, title, url, send_analytics) {
        if (send_analytics == undefined) {
            send_analytics = true;
        }
        url = self.UpdateAppUrl(url);
        if (send_analytics) {
            Analytics.SendAnalytics(url);
        }
        return history._pushState(data, title, url);
    };
    if (config.response_status == 200) {
        var data = self.GetCurrentContentData();

        var current_url = self.UpdateAppUrl(Uri.UrlToCurrent(config.current_route).stringify());
        self.CacheAdd(current_url, data);

        var url_history = self.UpdateAppUrl(Uri.UrlToCurrent(config.current_route_with_args).stringify());
        history.replaceState(data, document.title, url_history);
    }

    window.onpopstate = function (event) {
        if (event.state == null) {
            return;
        }
        if (event.state.type == undefined) {
            event.state.type = config.parameter.type.ajax;
        }
        switch (event.state.type) {
            case config.parameter.type.ajax:
                self.ClickUpdate(location);
                self.LoadContent(event.state, location.pathname);
                break;

            case config.parameter.type.reload:
                location.reload();
                break;

            default:
                console.error('AjaxHrefInterface invalid onpopstate type:' + event.state.type);
        }
    };

    if (config.base_href_correct) {
        self.LoadHrefs();
    }
    if (p3x.Module[config.start_run_id] !== undefined) {
        self.Run(config.start_run_id)
    }
};
p3x.AjaxHrefInterface = AjaxHrefInterface;
