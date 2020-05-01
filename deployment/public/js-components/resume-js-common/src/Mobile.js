function Mobile() {
}

Mobile.Android = function () {
    return navigator.userAgent.match(/Android/i);
};
Mobile.BlackBerry = function () {
    return navigator.userAgent.match(/BlackBerry/i);
};
Mobile.iOs = function () {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
};
Mobile.Opera = function () {
    return navigator.userAgent.match(/Opera Mini/i);
};
Mobile.Windows = function () {
    return navigator.userAgent.match(/IEMobile/i);
};
Mobile.Any = function () {
    var self = this;
    if (self.Android() || self.BlackBerry() || self.iOs() || self.Opera() || self.Windows()) {
        return true;
    }
    return false;
};

Mobile.PhantomJs = function () {
    return /PhantomJS/.test(window.navigator.userAgent);
}

p3x.Mobile = Mobile;
