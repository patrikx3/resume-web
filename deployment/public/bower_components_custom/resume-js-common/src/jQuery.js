var rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi;
jQuery.htmlPrefilter = function( html ) {
    return html.replace( rxhtmlTag, "<$1></$2>" );
};

$.fn.center = function () {
    $window = $(window);
    this.css("position", "absolute");
    this.css("top", ($window.height() - this.height()) / 2 + $window.scrollTop() + "px");
    this.css("left", ($window.width() - this.width()) / 2 + $window.scrollLeft() + "px");
    return this;
};

$.fn.focusWithoutScrolling = function () {
    var x = window.scrollX, y = window.scrollY;
    this.focus();
    window.scrollTo(x, y);
};
