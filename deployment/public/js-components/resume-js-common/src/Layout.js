function Layout() {
}

Layout.Top = function () {
    //$('html, body').animate({scrollTop: 0});
    $('html, body').scrollTop(0);
};

// this can be overridden for custom top height
Layout.TopHeight = function () {
    return 0;
}

Layout.CopyText = function (text) {
    var copy = $('<textarea>' + text + '</textarea>');
    $('body').append(copy);
    copy.select();
    var successful = false;
    try {
        successful = document.execCommand('copy');
    } catch (err) {
    }
    copy.remove();
    return successful;
};

Layout.JumpToHash = function (disable_top) {
    var self = this;

    Periodical.Factory().delayRepeat(function () {
        if (disable_top == undefined) {
            disable_top = false;
        }
        var hash = location.hash;
        if (hash == '#' || hash == '') {
            if (disable_top) {
                return;
            }
            self.Top();
            return;
        }
        var element = $("a[href$='" + hash + "']");
        if (element.length == 0) {
            return;
        }
        var offset = element.offset();
        $('html, body').scrollTop(offset.top - self.TopHeight());
    }, 255);

    /*
     Periodical.factory().delay_repeat(function () {
     var element = $("a[href$='" + hash + "']");
     var offset = element.offset();

     var info = JSON.stringify(offset) + ' ' + JSON.stringify($(window).height());
     $('html, body').animate({
     scrollTop: offset.top - (self.get_navigation_height() * 2)
     }, 333);
     }, 250);
     */
};

Layout.IsModifierKey = function (e) {
    var self = this;

    if (e.ctrlKey) {
        return true;
    }
    if (e.altKey) {
        return true;
    }
    if (e.shiftKey) {
        return true;
    }
    return false;
};

p3x.Layout = Layout;
