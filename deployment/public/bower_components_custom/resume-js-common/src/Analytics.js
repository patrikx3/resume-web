function Analytics() {
};

Analytics.SendAnalytics = function (url) {
    var self = this;
    var config = p3x.config;
    if (config.analytics && ga) {
        var url = new Uri(url);
        ga('send', 'pageview', url.data.pathname, {
            location: url.host()
        });
    }
};

Analytics.Boot = function () {
    if (config.google_analytics_id === undefined) {
        console.log('config.google_analytics_id is empty');
    }
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', config.google_analytics_id);
}

p3x.Analytics = Analytics;
