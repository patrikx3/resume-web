function DataCache() {
}

DataCache.Cache = {};

DataCache.Get = function (name, work) {
    var self = this;
    if (self.Cache[name] == undefined) {
        self.Cache[name] = work();
    }
    return self.Cache[name];
};
p3x.DataCache = DataCache;
