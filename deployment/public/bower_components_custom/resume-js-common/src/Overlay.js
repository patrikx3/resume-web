function Overlay() {
}

Overlay.Count = 0;
Overlay.$Loading = null;
Overlay.Show = function (show) {
    var self = this;
    self.Count++;
    if (self.Count > 1) {
        return;
    }
    if (typeof (show) !== "boolean") {
        show = true; // && !layout_manager.is_mobile;
    }
    self.$Loading = $(config.html.loader);
    $('body').append(self.$Loading);
};
Overlay.Hide = function () {
    var self = this;
    self.Count--;
    if (self.Count > 0) {
        return;
    }
    self.$Loading.remove();
};
p3x.Overlay = Overlay;
