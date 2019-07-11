(function (window, document, $, p3x) {
    p3x.Module.AboutMe = function () {
        $('#download-resume-secondary-button').tooltip();

        p3x.Language.Ensure('about-me').then(function () {
            $(document).ready(function () {
                var layoutManager = p3x.Module.LayoutManager;

                var isFixed = layoutManager.RandomBoolOpening('about-me-opening-bg', 'about-me-opening');

                var periodical = p3x.Periodical;
                var language = p3x.Language;
                var ajaxHrefInterface = p3x.AjaxHrefInterface;

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

                var $shine = $('#about-me-opening-shine');

                periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                    if (isFixed) {
                        $shine.removeClass('effect-shine')
                        $shine.removeClass('effect-shine-active')
                        $shine.addClass('effect-shine-vertical')
                    } else {
                        $shine.removeClass('effect-shine-vertical')
                        $shine.removeClass('effect-shine-vertical-active')
                        $shine.addClass('effect-shine')
                    }
                    $shine.toggleClass(isFixed ? 'effect-shine-vertical-active' : 'effect-shine-active');
                }, 1900, 500);


            });
        })
    };
})(window, document, jQuery, p3x);

