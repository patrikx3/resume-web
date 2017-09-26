(function (window, document, $, p3x) {
    p3x.Module.AboutMe = function () {
        $('#download-resume-secondary-button').tooltip();

        p3x.Language.Ensure('about-me').then(function () {
            $(document).ready(function () {
                var periodical = p3x.Periodical;
                var language = p3x.Language;
                var ajaxHrefInterface = p3x.AjaxHrefInterface;

                var layoutManager = p3x.Module.LayoutManager;

                periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                    $('#about-me-welcome-2').html(
                        layoutManager.Titlize(
                            language.Get('about-me', 'welcome-2'), 'about-me-welcome-notify'
                        )
                    );
                }, 2100);

                periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                    $('.about-me-slogan').toggleClass('about-me-slogan-active');
                }, 2000);

                periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                    $('.effect-shine').toggleClass('effect-shine-active');
                }, 1900, 500);
            });
        })
    };
})(window, document, jQuery, p3x);

