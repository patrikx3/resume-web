(function (window, document, $, p3x) {
    p3x.Boot(
        JSON.parse(
            $('#layout-data-config').html()
        )
    );
    $(document).ready(function () {
        $.support.transition = false;
        $.fx.off = false;
        AjaxHrefInterface.Animate = false
        //$('body').addClass('p3x-no-animation');
        p3x.Module.LayoutManager.Decorate();
    });
})(window, document, jQuery, p3x);
