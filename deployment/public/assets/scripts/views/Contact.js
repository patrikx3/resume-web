(function (window, document, $, p3x) {
    p3x.Module.Contact = function () {
        var periodical = p3x.Periodical;
        var dataCache = p3x.DataCache;
        var config = p3x.config;
        var _event = p3x.Event;

        var ajaxHrefInterface = p3x.AjaxHrefInterface;

        var contact_url = config.page.contact.url;
        var errorClass = 'Form-Error-item';

        var FormMessage = function () {
        };

        FormMessage.Form = null;
        FormMessage.Email = null;
        FormMessage.Message = null;
        FormMessage.Send = null;
        FormMessage.SuccessMessage = null;
        FormMessage.WindowForm = null;
        FormMessage.WindowSuccess = null;

        FormMessage.Implement = function () {
            var self = this;
            self.WindowForm = $('#contact-window-form');
            self.WindowSuccess = $('#contact-window-success');
            self.Form = $('#contact-form');
            self.Send = $('#contact-form-send');
            self.Send.click(self.Transport.bind(self));
            self.Email = self.Form.find('#contact-form-email');
            self.Message = self.Form.find('#contact-form-message');

            var inputs = self.Form.find('input,textarea');
            _event.Factory(ajaxHrefInterface.CurrentContentId).on(inputs, 'focus', function () {
                $e = $(this);
                $e.parent().find('.' + errorClass).slideDown();
            });
            _event.Factory(ajaxHrefInterface.CurrentContentId).on(inputs, 'blur', function () {
                $e = $(this);
                $e.parent().find('.' + errorClass).slideUp();
            });

            self.Form.find(':input').not('textarea').keypress(function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    self.Transport();
                }
            });
            self.Email.focusWithoutScrolling();
        };

        FormMessage.ErrorClear = function () {
            var self = this;
            self.Form.find('.has-error').removeClass('has-error');
            self.Form.find('.' + errorClass).remove();
        };

        FormMessage.Error = function (data) {
            var self = this;
            self.ErrorClear();
            for (var error_index in data.error) {
                var error = data.error[error_index];
                var input = self.Form.find('#' + error_index);
                var control = input.parent();
                control.addClass('has-error');
                control.find('label').after('<div style="display:none; clear: both;" class="' + errorClass + ' alert alert-danger">' + error + '</div>');
            }
        };

        FormMessage.Success = function (data) {
            var self = this;
            self.WindowForm.hide();
            self.WindowSuccess.show();

            $('#contact-window-success-email').html(self.Email.val());
            $('#contact-window-success-message').html(self.Message.val());

        };

        FormMessage.Transport = function () {
            var self = this;
            var data = self.Form.serialize();
            self.ErrorClear();
            self.Form.find(':input').prop('disabled', true);
            var options = {
                url: contact_url,
                dataType: 'json',
                data: data,
                method: 'post',
                success: function (data) {
                    switch (data.result) {
                        case 'error':
                            self.Error(data);
                            break;

                        default:
                            self.Success(data);
                    }
                },
                complete: function () {
                    self.Form.find(':input').prop('disabled', false);
                    self.Email.focus();
                }
            }
            options[config.parameter.ajax.analytics] = true;
            $.ajax(options);
        };

        $(document).ready(function () {
            FormMessage.Implement();

            $title = $('#contact-opening');

            var lines_count = 5;
            var lines = [lines_count];
            var line_height = 50;
            for (var index = 0; index < lines_count; index++) {
                $line = $('<div class="contact-line">&nbsp;</div>');
                $line.css('height', String(line_height) + 'px');
                lines[index] = $line;
                $title.append($line);
            }


            var data = dataCache.Get('contact-title', function () {
                var angle = 0;
                var angle_stepsize = 0.01;
                var line_step = 0.025;
                var max_y = $('#contact-opening').height();
                var calculate_y = max_y / 2 - line_height / 2;
                var max_opacity = 0.5;
                var data = [];
                for (var angle = 0; angle < Math.PI * 2; angle = angle + angle_stepsize) {
                    var data_data = [];
                    for (var index = 0; index < lines.length; index++) {
                        data_data.push({
                            y: calculate_y * Math.sin(angle - (index * line_step * 2 * lines.length )) + calculate_y,
                            opacity: max_opacity - (index * max_opacity / lines_count)
                        });
                    }
                    angle = angle + angle_stepsize;
                    data.push(data_data);
                }
                return data;
            });

            var index = 0;
            periodical.Factory(ajaxHrefInterface.CurrentContentId).animate(function () {
                if (index == data.length) {
                    index = 0;
                }
                for (var line_index in data[index]) {
                    var line_data = data[index][line_index];
                    lines[line_index].css({
                        'top': line_data['y'],
                        'opacity': line_data['opacity']
                    });
                }
                index++;
            });

            periodical.Factory(ajaxHrefInterface.CurrentContentId).work(function () {
                $('.effect-shine').toggleClass('effect-shine-active');
            }, 2000, 500, true);
        });
    };
})(window, document, jQuery, p3x);
