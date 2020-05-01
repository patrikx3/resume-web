function Debug() {
}

Debug.ShowCache = function (container, cache_data) {
    var self = this;
    if (!config.debug) {
        return;
    }
    var cacheSize = Math.round(JSON.stringify(cache_data).length / 1024, 2);
    var message = $('<a href="javascript:void(0);">' + container + ': ' + cacheSize + 'kb</a>');
    message.click(function () {
        console.log(cache_data);
    });
    self.Show(message, container.idilize());
};

Debug.Show = function (message, container) {

    if (!config.debug) {
        return;
    }

    if (container === undefined) {
        container = config.parameter.default;
    }
    $(document).ready(function () {
        var $box = $('#' + config.parameter.id.debug);
        if ($box.length == 0) {
            $box = $('<div id="' + config.parameter.id.debug + '"></div>');
            $('body').append($box)
        }
        var container_id = config.parameter.id.debug + '-' + container;
        var $container = $box.find('#' + container_id);
        if ($container.length == 0) {
            $container = $('<div id="' + container_id + '"></div>');
            $box.append($container);
        }
        $container.empty().append(message);
    })
};


Debug.Time = function () {
    var now = new Date();

    var keepZero = function (num, length) {
        if (undefined == length) {
            length = 2;
        }
        if (num < 10) {
            num = '0' + String(num);
        }
        if (length == 3 && num < 100) {
            num = '0' + String(num);
        }
        return num;
    };

    var result = '';
    result += now.getFullYear();
    result += '/' + keepZero(now.getMonth() + 1);
    result += '/' + now.getDate();
    result += ' ' + keepZero(now.getHours());
    result += ':' + keepZero(now.getMinutes());
    result += ':' + keepZero(now.getSeconds());
    result += '.' + keepZero(now.getMilliseconds(), 3);

    return result;
};

Debug.Message = function (message) {
    if (config.debug) {
        var self = this;
        var now = new Date();
        var timestamp = now.get;
        console.log(self.Time());
        console.log(message);
    }

};

Debug.Info = function () {
    var self = this;
    for (var i in arguments) {
        self.Message(arguments[i]);
    }
};

p3x.Debug = Debug;

