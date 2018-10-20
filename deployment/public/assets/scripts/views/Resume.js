(function (window, document, $, p3x) {
    console.warn('#resume-opening random bool fixed should be working in the future on android chrome')
    p3x.Module.Resume = function () {
        p3x.Language.Ensure('resume').then(function () {
            $(document).ready(function () {
                var layout_manager = p3x.Module.LayoutManager;

                layout_manager.RandomBoolOpening('resume-opening');

                var language = p3x.Language;
                var data_cache = p3x.DataCache;
                var periodical = p3x.Periodical;
                var _event = p3x.Event;
                var uri = p3x.Uri;
                var ajaxHrefInterface = p3x.AjaxHrefInterface;
                var bootstrap_accordion = p3x.Gui.Bootstrap.Accordion;
                var bootstrap_tab = p3x.Gui.Bootstrap.Tab;
                var config = p3x.config;

                var view_data = JSON.parse($('#data-resume').html());
                var title = language.Get('resume', 'title').split('');

                var $block = $('#resume-opening-block');
                var $text = $('#resume-opening-title');
                var current_base_y;

                var posite_block = function () {
                    var pos = $text.position();
                    $block.width(pos.left - 2);
                    var height = $text.height();
                    $block.css('top', pos.top);
                    $block.height(height);
                    current_base_y = parseInt($('#resume-opening-title-position').css('top'));
                };

                var data = data_cache.Get('resume-title', function () {
                    var angle = 0;
                    var angle_stepsize = 0.01;
                    var length_y = 120;
                    var data = [];
                    for (var angle = 0; angle < Math.PI * 2; angle = angle + angle_stepsize) {
                        var step = length_y * (
                                Math.sin(angle)
                            );
                        data.push(step);
                    }
                    return data;
                });

                var index = 0;
                periodical.Factory(ajaxHrefInterface.CurrentContentId).animate(function () {
                    if (index == data.length) {
                        index = 0;
                    }
                    var new_y = data[index];
                    var top = current_base_y + new_y;
                    $text.css('top', top);
                    $block.css('top', top);
                    index++;
                    posite_block();
                });

                _event.Factory(ajaxHrefInterface.CurrentContentId).on($(window), 'resize', function () {
                    posite_block();
                });

                periodical.Factory().once(posite_block, 100);

                periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                    $('#resume-opening-title').html(
                        layout_manager.Titlize(
                            language.Get('resume', 'title'), 'resume-opening-titlize'
                        )
                    );
                }, 2000);

                periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                    $('.effect-shine-vertical').toggleClass('effect-shine-vertical-active');
                }, 2000, 500, true);

                var root = view_data.root;
                var current_tab = view_data.current_tab;
                var normal = view_data.icon_employment_normal;
                var check = view_data.icon_employment_checked;

                var employmentAccordionId = 'employment-accordion';
                var employmentAccordion = $('#' + employmentAccordionId);
                _event.Factory(ajaxHrefInterface.CurrentContentId).on(employmentAccordion, config.parameter.event.bootstrap.accordion.loaded, function (e, panel) {
                    $(panel).find('.resume-tooltip').tooltip();
                });

                var resumeTabId = 'resume-tab';
                var resumeTab = $('#' + resumeTabId);
                _event.Factory(ajaxHrefInterface.CurrentContentId).on(resumeTab, config.parameter.event.bootstrap.tab.loaded, function (e, panel) {
                    runEmploymentAccordion();
                });

                _event.Factory(ajaxHrefInterface.CurrentContentId).on(employmentAccordion, 'hidden.bs.collapse', function (e) {
                    $(e.target).parent().find('[aria-controls]').find('.' + check).removeClass(check).addClass(normal);
                });
                var runEmploymentAccordion = function() {
                    _event.Factory(ajaxHrefInterface.CurrentContentId).on('a.resume-link', 'click', function () {
                        $('a.resume-link .fa').removeClass(check).addClass(normal);

                        var $el = $(this);
                        var $fa = $el.find('.fa');
                        var id = new uri($el.attr('href')).data.hash;
                        if ($('#' + id).hasClass('in')) {
                            $fa.removeClass(check).addClass(normal);
                        } else {
                            $fa.removeClass(normal).addClass(check);
                        }
                    });
                    bootstrap_accordion.Decorate(employmentAccordionId, view_data.root_accordion, null, view_data.root_addon, view_data.view_data_accordion, view_data.root);
                    $('.resume-tooltip').tooltip();
                };
                bootstrap_tab.Decorate(resumeTabId, 1, root, current_tab, 'R');

                runEmploymentAccordion();

            });
        });
    };
})(window, document, jQuery, p3x);
