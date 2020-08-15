(function (window, document, $, p3x) {
    p3x.Module.Projects = function () {
        p3x.Language.Ensure('projects').then(function () {
            $(document).ready(function () {
                var layout_manager = p3x.Module.LayoutManager;

                layout_manager.RandomBoolOpening('projects-opening-bg', 'projects-opening');

                var periodical = p3x.Periodical;
                var language = p3x.Language;
                var data_cache = p3x.DataCache;
                var ajax_href_interface = p3x.AjaxHrefInterface;
                var bootstrap_accordion = p3x.Gui.Bootstrap.Accordion;
                var bootstrap_tab = p3x.Gui.Bootstrap.Tab;
                var _event = p3x.Event;
                var config = p3x.config;



                var accordion_decorate = function (current_accordion) {
                    if ($('#' + current_accordion.accordion_id).length == 0) {
                        return;
                    }
                    bootstrap_accordion.Decorate(
                        current_accordion.accordion_id,
                        current_accordion.root,
                        null,
                        current_accordion.root_addon,
                        current_accordion.current_accordion,
                        view_data.root_tab
                    );
                    $('.project-tooltip').tooltip();
                };

                var view_data = JSON.parse($('#data-projects').html());
                for (var accordion_key in view_data.accordions) {
                    accordion_decorate(view_data.accordions[accordion_key]);
                }

                var root = view_data.root_tab;
                var current_tab = view_data.current_tab;

                var projectTabId = 'projects-tab';
                var projectTab = $('#' + projectTabId);
                var $content;
                _event.Factory(ajax_href_interface.CurrentContentId).on(projectTab, config.parameter.event.bootstrap.tab.loaded, function (e, content) {
                    $content = $(content);
                    for (var accordion_key in view_data.accordions) {
                        var accordion_info = view_data.accordions[accordion_key];
                        if ($content.attr('id') + '-' == accordion_info.root_addon) {
                            accordion_decorate(accordion_info);
                            break;
                        }
                    }
                });


                bootstrap_tab.Decorate(projectTabId, config.era, root, current_tab);
                var $bg1 = $('#projects-bg-1');
                var $bg2 = $('#projects-bg-2');

                var data = data_cache.Get('projects-opening', function () {
                    var data = [];
                    var angle_stepsize = 0.015;
                    var length_y = 200;
                    var max_height = $('#projects-opening').height();
                    var max_opacity = 0.5;

                    for (var angle = 0; angle < Math.PI * 2; angle = angle + angle_stepsize) {
                        var bg1_height = length_y + length_y * Math.cos(angle);
                        var bg2_height = length_y + length_y * Math.sin(angle);
                        var bg1_opacity = 1 - bg1_height / max_height * max_opacity - max_opacity;
                        var bg2_opacity = 1 - bg2_height / max_height * max_opacity - max_opacity;
                        data.push({
                            bg1_height: bg1_height,
                            bg2_height: bg2_height,
                            bg1_opacity: bg1_opacity,
                            bg2_opacity: bg2_opacity
                        });
                    }
                    return data;
                });

                var index = 0;
                periodical.Factory(ajax_href_interface.CurrentContentId).animate(function () {
                    if (index == data.length) {
                        index = 0;
                    }
                    var item = data[index];
                    $bg2.css('opacity', item.bg1_opacity);
                    $bg2.css('opacity', item.bg2_opacity);
                    $bg1.height(item.bg1_height);
                    $bg2.height(item.bg2_height);
                    index++;
                });

                periodical.Factory(ajax_href_interface.CurrentContentId).work(function () {
                    $('#projects-title').html(
                        layout_manager.Titlize(
                            language.Get('projects', 'title'), 'projects-opening-titlize'
                        )
                    );
                }, 2000);

                periodical.Factory(ajax_href_interface.CurrentContentId).work(function () {
                    $('.effect-shine').toggleClass('effect-shine-active');
                }, 2000, 500, true);
            });
        });
    };

})(window, document, jQuery, p3x);
