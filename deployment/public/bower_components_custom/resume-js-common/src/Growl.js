function Growl() {
    jQuery.jGrowl.apply(jQuery.jGrowl, arguments);
};

Growl.Alert = function (message, sticky) {
    if (sticky == undefined) {
        sticky = true;
    }
    Growl({
        group: 'alert-danger',
        message: message,
        sticky: sticky
    });
}

p3x.Growl = Growl;

