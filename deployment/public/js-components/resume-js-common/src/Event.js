function Event(_name) {
    var self = this;
    self._name = _name;
}

Event.Factories = {};

Event.Factory = function (_named) {
    var self = this;
    if (_named === undefined) {
        _named = config.parameter.default;
    }
    if (self.Factories[_named] === undefined) {
        self.Factories[_named] = new Event(_named);
    }
    return self.Factories[_named];
};

Event.Destruct = function (object) {
    var self = this;
    var _name = object._name;
    delete self.Factories[_name];
    object = null;
};

Event.constructor = Event;

Event._name = null;

Event.prototype.events = [];

Event.prototype.on = function ($element, _name, callback) {
    if (!($element instanceof jQuery)) {
        $element = $($element);
    }
    var self = this;
    var event = {
        $element: $element,
        _name: _name,
        callback: callback
    };
    self.events.push(event);
    $element.on(_name, callback);
    return event;
};


Event.prototype.off = function (event) {
    var self = this;
    event.$element.off(event._name, event.callback);

    var index = self.events.indexOf(event);
    self.events.splice(index, 1);
};

Event.prototype.destruct = function () {
    var self = this;
    for (var index in self.events) {
        var event = self.events[index];
        event.$element.off(event._name, event.callback);
    }
    self.events = [];
    Event.Destruct(self);
};

p3x.Event = Event;
