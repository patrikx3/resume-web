(function (window, document, $, p3x) {
    p3x.Boot(
        JSON.parse(
            $('#layout-data-config').html()
        )
    );
    $(document).ready(function () {
        p3x.AjaxHrefInterface.Animate = false;
        p3x.Module.LayoutManager.Decorate();
    });
})(window, document, jQuery, p3x);
