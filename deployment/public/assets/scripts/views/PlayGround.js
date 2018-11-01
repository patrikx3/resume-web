(function (window, document, $, p3x) {
    p3x.Module.PlayGround = function () {
        p3x.Language.Ensure('playground').then(function () {
            $(document).ready(function () {
                var layout_manager = p3x.Module.LayoutManager;

                var isFixed = layout_manager.RandomBoolOpening('playground-opening-bg', 'playground-opening');

                var periodical = p3x.Periodical;
                var language = p3x.Language;
                var data_cache = p3x.DataCache;
                var ajax_href_interface = p3x.AjaxHrefInterface;
                var bootstrap_accordion = p3x.Gui.Bootstrap.Accordion;

                var data_config = JSON.parse($('#data-playground').html());
                var root = data_config ['data-root-accordion'];
                var root_addon = data_config ['data-root-addon'];
                var data_accordion = data_config['data-accordion'];
                var data_title_left_default = data_config['data-title-left-default'];

                $('.playground-tooltip').tooltip();

                bootstrap_accordion.Decorate('playground-accordion', root, null, root_addon, data_accordion);

                var $canvas = $('#playground-opening-title');
                $canvas.empty();

                var title = language.Get('playground', 'title');
                var chars = title.split('');
                var $title = [];
                for (var index in chars) {
                    var char = chars[index];
                    var $char = $('<div style="display: none;" class="playground-title-char">' + char + '</div>');
                    $char.css('zIndex', index);
                    $canvas.append($char);
                    $title.push($char);
                }

                var data = data_cache.Get('playground-title', function () {
                    var angle = 0;
                    var angle_stepsize = 0.02;
                    var max_y = $canvas.height();
                    var data = [];
                    for (var angle = 0; angle < Math.PI * 2; angle = angle + angle_stepsize) {
                        var data_data = [];
                        for (var index in $title) {
                            var $char = $title[index];
                            var calculate_y = max_y / 2 - $char.outerHeight() / 2;
                            data_data.push({
                                top: 75 * Math.cos(angle - (index * angle_stepsize * 2 * $title.length)) + calculate_y
                            });
                        }
                        angle = angle + angle_stepsize;
                        data.push(data_data);
                    }
                    return data;
                });
                var index = 0;
                periodical.Factory(ajax_href_interface.CurrentContentId).animate(function () {
                    if (index == data.length) {
                        index = 0;
                    }
                    var firstIndex = data_title_left_default;
                    for (var char_index in data[index]) {
                        var char_data = data[index][char_index];
                        $title[char_index].css({
                            'top': char_data['top'],
                            'left': firstIndex
                        });
                        firstIndex += $title[char_index].width();
                    }
                    index++;
                });

                periodical.Factory(ajax_href_interface.CurrentContentId).work(function () {
                    $('.playground-titlize').removeClass('playground-titlize');
                    var $char = $title[Math.floor(Math.random() * $title.length)];
                    $char.addClass('playground-titlize');
                }, 2000);


                var $shine = $('#playground-opening-shine');

                periodical.Factory(ajax_href_interface.CurrentContentId).work(function () {
                    if (!isFixed) {
                        $shine.removeClass('effect-shine')
                        $shine.removeClass('effect-shine-active')
                        $shine.addClass('effect-shine-vertical')
                    } else {
                        $shine.removeClass('effect-shine-vertical')
                        $shine.removeClass('effect-shine-vertical-active')
                        $shine.addClass('effect-shine')
                    }
                    $shine.toggleClass(!isFixed ? 'effect-shine-vertical-active'  : 'effect-shine-active');
                }, 2000, 500, true);


                periodical.Factory().once(function () {
                    for (var title_index in $title) {
                        $title[title_index].show();
                    }
                }, 1)
            });
        })
    };
})(window, document, jQuery, p3x);
