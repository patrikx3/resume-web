function Uri(url) {
    var self = this;
    self.data = Uri.Parse(url);
}

Uri.constructor = Uri;
Uri.prototype.data = null;
Uri.prototype.stringify = function () {
    var self = this;
    return Uri.Stringify(self.data);
};

Uri.prototype.host = function () {
    var self = this;
    return Uri.Host(self.data);
};

Uri.Host = function (data) {
    return data.protocol + '//' + data.hostname;
};

Uri.Stringify = function (data) {
    var self = this;
    var result = '';
    result += Uri.Host(data);
    result += data.pathname;
    if (Object.keys(data.query).length > 0) {
        result += '?' + $.param(data.query);
    }
    if (data.hash != '') {
        result += '#' + data.hash;
    }
    return result;
};


Uri.Parse = function (url) {

    var self = this;

    var l = document.createElement("a");
    l.href = url;
    url = l.href;
// The RFC (see appendix B) provides a regular expression to Parse the Uri parts:
//    ^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?
//    12            3  4          5       6  7        8 9
    var pattern = RegExp("^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\\?([^#]*))?(#(.*))?");
    var matches = url.match(pattern);

    var result = {
        protocol: matches[1],
        hostname: matches[4],
        pathname: matches[5],
        query: self.Unparam(matches[7]),
        hash: matches[9] || ''
    };
    return result;
};

Uri.Unparam = function (value) {

    if (undefined == value || value == null || value == '' || value == '?') {
        return {};
    }

    // Object that holds names => values.
    var params = {};
    // Get query string pieces (separated by &)
    var pieces = value.split('&');
    // Temporary variables used in loop.
    var pair, i, l;

    // Loop through query string pieces and assign params.
    for (i = 0, l = pieces.length; i < l; i++) {
        pair = pieces[i].split('=', 2);
        // Repeated parameters with the same name are overwritten. Parameters
        // with no value get set to boolean true.
        params[decodeURIComponent(pair[0])] = (pair.length == 2 ?
            decodeURIComponent(pair[1].replace(/\+/g, ' ')) : true);
    }

    return params;
};

Uri.Current = function () {
    var self = this;
    return new Uri(location);
};

Uri.UrlToCurrent = function (url) {
    var url_object = new Uri(url);
    url_object.data.query = $.extend(url_object.data.query, Uri.Current().data.query);
    url_object.data.hash = location.hash.substr(1);
    return url_object;
};

p3x.Uri = Uri;
