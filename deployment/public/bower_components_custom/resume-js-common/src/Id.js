var Uuid = function () {
    var d = new Date().getTime();
    var result = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
    return result;
}

var UniqueId = function () {
    UniqueId.UniqueidCounter++;
    var hex = Number(UniqueId.UniqueidCounter).toString(36);
    var id = 'U' + Uuid() + '-' + hex.pad(36);
    return id;
};
UniqueId.UniqueidCounter = 0;

p3x.UniqueId = UniqueId;
p3x.Uuid = Uuid;
