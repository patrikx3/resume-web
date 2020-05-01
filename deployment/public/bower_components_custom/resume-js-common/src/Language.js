function Language() {
}

Language.Boot = function (language, available_languages, text) {
    var self = this;
    self.Language = language;
    self.AvailableLanguages = available_languages;
    self.SetAreas(text);
};

Language.Language = null;
Language.AvailableLanguages = null;
Language.Text = {};

Language.Promises = {};

Language.SetAreas = function (data) {
    var self = this;

    if (data == undefined) {
        return;
    }

    for (var area in data) {
        if (self.Promises[area] == undefined) {
            self.Promises[area] = $.Deferred();
        }
        self.Text[area] = data[area];
        self.Promises[area].resolve();
    }
    Debug.ShowCache('Cache:Language', self.Text);
};

Language.Get = function (area, atom) {
    var self = this;

    if (self.Text[area] == undefined || self.Text[area][atom] == undefined) {
        Growl.Alert('Missing language item: ' + area + ' / ' + atom);
        return;
    }
    return self.Text[area][atom];
};

Language.EnsuredAreas = function () {
    var self = this;
    return Object.keys(self.Text);
};

Language.EnsuredArea = function (area) {
    var self = this;
    if (self.Tex[area] == undefined) {
        return false;
    }
    return true;
}

Language.Ensure = function (area) {
    var self = this;

    if (!$.isArray(area)) {
        area = [area];
    }
    var promises = [];
    for (var area_index in area) {
        var current_area = area[area_index];
        if (self.Promises[current_area] == undefined) {
            self.Promises[current_area] = $.Deferred();
            self.FulfillAjaxDeferred(current_area);
        }
        promises.push(self.Promises[current_area]);
    }
    return $.when.apply($, promises);
};

Language.FulfillAjaxDeferred = function (area) {
    var self = this;
    $(document).ready(function () {
        var url = Router.Url(config.parameter.url.language) + encodeURI(area);
        $.ajax({
            url: url,
            async: true,
            success: function (data) {
                self.SetAreas(data);
            }
        })
    })
};

Language.Switch = function (language, e) {
    var self = this;
    if (Layout.IsModifierKey(e) || !config.base_href_correct) {
        return true;
    }
    var url = Uri.Current();
    url.data.query[config.parameter.language_switcher] = language;
    location = url.stringify();
    return false;
};
p3x.Language = Language;
