(function (window, document, $, p3x) {
    var language;
    var periodical;
    var config;
    var uri;
    var mobile;
    var layout;
    var ajaxHrefInterface;
    var growl;

    function LayoutManager() {
    }

    LayoutManager.HeaderOver = false;

    LayoutManager.GetNavigationHeight = function () {
        var self = this;

        var navigation_height = $('#layout-top .navbar-header').height();
        if (navigation_height == 0) {
            navigation_height = $('#layout-top').height();
        }
        return navigation_height;
    };

    LayoutManager.Update = function () {
        var self = this;

        var switcher = $('#language-flag-switcher');
        var themeMenu = $('#navigation-theme .dropdown-menu');
        var $window = $(window);
        var update = function () {
            var navigationHeight = self.GetNavigationHeight();
            $('#layout-main').css('margin-top', navigationHeight + 'px');
            if ($('#navigation-menu-button').is(':visible')) {
                switcher.css('top', navigationHeight + 10);
                switcher.css('right', 20);
                if ($(window).scrollTop() > 400) {
                    switcher.hide();
                } else {
                    switcher.show();
                }
                switcher.css('zIndex', 5);

                themeMenu.css({
                    'maxHeight': 'auto',
                    'overflowX': 'visible'
                });

            } else {
                var themeMenuHeight = $window.innerHeight() - navigationHeight - 10;
                themeMenu.css({
                    'maxHeight': themeMenuHeight + 'px',
                    'overflowX': 'auto'
                });


                switcher.css('zIndex', 9989);
                switcher.css('top', navigationHeight / 2 - switcher.height() / 2);
                switcher.css('right', 5);
                switcher.fadeIn('slow');
            }
            $('.tooltip').hide();

            var $header = $('#layout-top');
            var $header_button = $('#navigation-menu-button');

            var show = $header_button.is(':visible');
            var header_button_expanded = $header_button.attr('aria-expanded');
            header_button_expanded = typeof (header_button_expanded) == 'undefined' ? false : header_button_expanded == 'true';
            var show_result = self.HeaderOver || (show && header_button_expanded);
            var height_result = $window.scrollTop() > navigationHeight;
            if (show_result == false && height_result) {
                $header.fadeTo(500, 0.90);
            } else {
                $header.fadeTo(500, 1);
            }

        };
        switcher.addClass('language-flag-switcher-done');
        periodical.Factory().delayRepeat(update, 100);
    };

    LayoutManager.Decorate = function () {

        var self = this;
        growl = p3x.Growl;
        language = p3x.Language;
        periodical = p3x.Periodical;
        config = p3x.config;
        uri = p3x.Uri;
        mobile = p3x.Mobile;
        layout = p3x.Layout;
        layout.TopHeight = function () {
            return 2 * self.GetNavigationHeight();
        };
        ajaxHrefInterface = p3x.AjaxHrefInterface;

        ajaxHrefInterface.ClickUpdate = self.UpdateMenu.bind(self);

        self.IsMobile = false;
//        self.IsMobile= mobile.any() || p3x.uri.current().data.query['mobile'] !== undefined;

        $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
            var error = '';
            thrownError = String(thrownError);
            if (thrownError != '') {
                error = '<br/>' + thrownError;
            }

            language.Ensure('layout').then(function () {
                "use strict";
                //console.log(arguments);
                growl({
                    group: 'alert-danger',
                    message: '<i class="' + config.icons.ICON_ERROR + '" aria-hidden="true"></i>&nbsp;' + language.Get('layout', 'ajax-error') + error,
                    sticky: true
                });
            });
        });

        language.Ensure('layout').then(function () {
            "use strict";
            $.jGrowl.defaults.closerTemplate = '<div class="alert alert-default">' + language.Get('layout', 'jgrowl-close') + '</span></div>';
            $.jGrowl.defaults.group = 'alert-default';
            $.jGrowl.defaults.position = 'bottom-right';
        });


        self.Update();
        //setInterval(self.Update, 100);
        $(window).resize(self.Update.bind(self));
        $(window).scroll(self.Update.bind(self));

        $('#layout-top').hover(function () {
            self.HeaderOver = true;
            self.Update();
        }, function () {
            self.HeaderOver = false;
            self.Update()
        }).click(self.Update.bind(self));

        // if (self.IsMobile) {
        //$.support.transition = false;
        //$.fx.off = true;
        //$('body').addClass('p3x-no-animation');
        // }
    };

    LayoutManager.Titlize = function (text, css) {
        var text_chars = text.split('');
        var index = Math.floor(Math.random() * text_chars.length);
        var item = text_chars[index];
        text_chars[index] = '<span class="' + css + '">' + item + '</span>';
        var new_text = text_chars.join('');
        return new_text;
    };

    LayoutManager.SwitchTheme = function (name) {
        var self = this;
        var url;
        if (name == 'bootstrap') {
            url = config.base_url + 'bower_components/bootstrap/dist/css/bootstrap.min.css';
        } else {
            url = config.base_url + 'assets/bootstrap-theme/bootstrap-' + name + '.theme.min.css';
        }
        $.get(url).then(function (result) {
            var style = document.getElementById("bootstrap-theme");
            style.setAttribute("href", url);
            $('#navigation-theme .active').removeClass('active');
            $('#theme-' + name).addClass('current-theme active');
            $('#navigation-menu-button:visible').trigger('click');
            config.theme = name;
            Cookies.set(config.parameter.theme, name, {expires: 365, path: config.base_url});

            if (config.themes.light.indexOf(name) == -1) {
                $('body').removeClass(config.parameter['theme-light']).addClass(config.parameter['theme-dark']);
            } else {
                $('body').removeClass(config.parameter['theme-dark']).addClass(config.parameter['theme-light']);
            }
            setTimeout(function () {
                self.Update();
            }, 1000)
        });
//        var url = uri.Current();
//        url.data.query[config.parameter.theme] = name;
//        location = url.stringify();
    };

    LayoutManager.IsMobile = false;

    LayoutManager.UpdateMenu = function (url) {
        var self = this;

        var menu = $('#navigation-menu-button:visible');
        if (menu.hasClass('change')) {
            menu.trigger('click');
        }

        var dropdown = $('.dropdown-menu');
        if (dropdown.is(':visible')) {
            dropdown.dropdown('toggle');
        }
        var $remove = $('#navigation li:not(.keep)');
        $remove.blur().removeClass('active');

        var pathname = new uri(url).data.pathname;
        var pathname_check = pathname.substr(1);
        var $findActive = $('#navigation [href]');
        var findActive = null;
        $findActive.each(function () {
            var $current = $(this);
            var href = $(this).attr('href').substring(1);
            if (pathname_check.indexOf(href) != -1) {
                findActive = $current.parent();
            }
        });
        if (findActive == null) {
            findActive = $('#navigation li a').first().parent();
        }
        findActive.addClass('active');
        findActive.children().blur();
    }

    var firstRandomBoolOpening = undefined
    var slides = {}
    // var $document = $(document)
    LayoutManager.RandomBoolOpening = function (id, id2) {
        var $opening = $('#' + id);
        var $opening2 = $('#' + id2);

        /*
        var scroll = function(e) {
            var scrollTop = $(window).scrollTop();
            $opening.css('top', scrollTop + 'px')
            console.log(scrollTop, $opening.css('top'), $opening)
        }
        $document.off('scroll', scroll)
        $opening.css('top', 0 + 'px')
        */

        if (!slides.hasOwnProperty(id)) {
            if (firstRandomBoolOpening === undefined) {
                firstRandomBoolOpening = Math.random() >= 0.5;
            } else {
                firstRandomBoolOpening = !firstRandomBoolOpening
            }
            slides[id] = firstRandomBoolOpening
        } else {
            slides[id] = !slides[id]
        }

        if (slides[id]) {
            $opening.addClass('p3x-resume-opening-fixed')
            $opening2.addClass('p3x-resume-opening-fixed')
            $opening.removeClass(id + '-start');

            //$document.on('scroll', scroll)

        } else {
            $opening.addClass(id + '-start');
            $opening.removeClass('p3x-resume-opening-fixed')
            $opening2.removeClass('p3x-resume-opening-fixed')

        }
        return slides[id];
    }

    LayoutManager.RecaptchaLoaded = false
    LayoutManager.Recaptcha = function () {
        LayoutManager.RecaptchaLoaded = true;
    }

    window.lm = LayoutManager;
    window.lmRecaptcha = LayoutManager.Recaptcha;
    p3x.Module.LayoutManager = LayoutManager;
})(window, document, jQuery, p3x);
