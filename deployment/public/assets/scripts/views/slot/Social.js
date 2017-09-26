(function (window, document, $, p3x) {
    p3x.Language.Ensure('layout').then(function () {
        $(document).ready(function () {
            var language = p3x.Language;
            var growl = p3x.Growl;
            var layout = p3x.Layout;
            var protocolValid = p3x.ProtocolValid;
            var config = p3x.config;

            var data = JSON.parse($('#data-slot-social').html());
            var social_email = data['data-social-email'];
            var social_phone = data['data-social-phone-id'];

            var tooltips = $('.social-tooltip,.social-tooltip > a');
            tooltips.tooltip();

            $('#' + social_email).click(function () {
                var aemail = atob(config.email);
                var message = 'E-mail: ' + aemail;
                if (layout.CopyText(aemail)) {
                    message += '<br/><br/>' + language.Get('layout', 'copied-email');
                }
                growl({
                    message: message,
                    sticky: true
                });
            });

            $('#' + social_phone).click(function () {
                var message = language.Get('layout', 'social-phone') + ': ' + config.phone;
                if (layout.CopyText(config.phone)) {
                    message += '<br/><br/>' + language.Get('layout', 'copied-phone');
                }
                growl({
                    message: message,
                    sticky: true
                });

                var url = 'tel:' + config.phone;
                protocolValid(url, null, function () {
                    window.open(url, '_self');
                })
            });


        });
    });

})(window, document, jQuery, p3x);
