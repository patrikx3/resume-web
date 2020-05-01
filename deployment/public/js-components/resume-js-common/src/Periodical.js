function Periodical(name) {
    var self = this;
    self.name = name;
}

Periodical.Factories = {};

Periodical.Factory = function (named) {
    var self = this;
    if (named === undefined) {
        named = config.parameter.default;
    }
    if (self.Factories[named] === undefined) {
        self.Factories[named] = new Periodical(named);
    }
    return self.Factories[named];
};


Periodical.Destruct = function (object) {
    var self = this;
    var name = object.name;
    delete self.Factories[name];
    object = null;
};

Periodical.constructor = Periodical;

Periodical.prototype.name = null;

Periodical.prototype.timeouts = [];

Periodical.prototype.onceTimeours = [];

Periodical.prototype.work = function (callback, period, wait, disable_mobile) {
    var self = this;
    if (wait == undefined) {
        wait = 0;
    }
    if (disable_mobile == undefined) {
        disable_mobile = false;
    }
    if (Mobile.Any() && disable_mobile) {
        return;
    }

    var index = self.timeouts.length;
    self.timeouts.push({
        type: 'interval',
        id: 0
    });
    self.timeouts[index].id = setInterval(callback, period);
    self.once(callback, wait);
    return index;
};

Periodical.prototype.destruct = function () {
    var self = this;
    for (var index in self.timeouts) {
        if (self.timeouts[index].type == 'interval') {
            clearInterval(self.timeouts[index].id);
        } else {
            cancelAnimationFrame(self.timeouts[index].id);
        }
    }
    self.clearTimeout(self.onceTimeours);
    self.clearTimeout(self.delayRepeatCallbacks);
    self.timeouts = [];
    Periodical.Destruct(self);
};

Periodical.prototype.clearTimeout = function (list) {
    var self = this;
    for (var clear in list) {
        clearTimeout(list[clear]);
        delete list[clear];
    }
};

Periodical.prototype.animate = function (callback) {
    var self = this;

    if (!window.requestAnimationFrame) {
        self.work(callback, 1000 / 60);
        return;
    }
    var index = self.timeouts.length;
    self.timeouts.push({
        type: 'frame',
        id: 0
    });
    var anim = function () {
        callback();
        self.timeouts[index].id = window.requestAnimationFrame(anim);
    };
    self.timeouts[index].id = window.requestAnimationFrame(anim);
};

Periodical.prototype.once = function (callback, delay) {
    var self = this;

    if (delay == undefined) {
        delay = 0;
    }

    var once = setTimeout(function () {
        callback();
        delete self.onceTimeours[callback];
    }, delay);
    self.onceTimeours[callback] = once;
};


Periodical.prototype.delayRepeatCallbacks = {};

Periodical.prototype.delayRepeat = function (callback, wait) {
    var self = this;

    if (wait === undefined) {
        wait = 500;
    }
    if (self.delayRepeatCallbacks[callback] == undefined) {
        self.delayRepeatCallbacks[callback] = 0;
    }
    clearTimeout(self.delayRepeatCallbacks[callback]);
    self.delayRepeatCallbacks[callback] = setTimeout(callback, wait);
};

p3x.Periodical = Periodical;
