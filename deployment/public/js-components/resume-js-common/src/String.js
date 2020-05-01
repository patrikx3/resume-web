if (typeof String.prototype.endsWith !== 'function') {
    String.prototype.endsWith = function (suffix) {
        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };
}

if (!String.prototype.startsWith) {
    String.prototype.startsWith = function (searchString, position) {
        position = position || 0;
        return this.substr(position, searchString.length) === searchString;
    };
}

if (!String.prototype.pad) {
    String.prototype.pad = function (width, z) {
        z = z || '0';
        var n = this + '';
        return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
    }
}

String.prototype.idilize = function () {
    var result = this.toLowerCase();
    result = latinize(result);
    result = result.replace(/\./g, '');
    result = result.replace(/[^A-Za-z0-9]/g, '-');
    result = result.replace(/-+/g, '-');
    return result;
}

String.prototype.uniCheck = function () {
    return JSON.stringify(this.replace(/(\r\n|\n|\r)/gm, '\n'));
}
