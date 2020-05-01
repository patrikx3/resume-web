
function Analytics() {
};

Analytics.SendAnalytics = function (url) {
    var self = this;
    var config = p3x.config;

    if (config.analytics && window['gtag']) {
        var url = new Uri(url);

        window['gtag']('config', config.google_analytics_id,
            {
                'page_path': url.data.pathname
            }
        );
    }
};

Analytics.Boot = function () {
    var config = p3x.config;
    if (config.google_analytics_id === undefined) {
        console.log('config.google_analytics_id is empty');
        return;
    }
    const head = document.getElementsByTagName("head")[0];

    const script = document.createElement("script");
    script.type = 'text/javascript';
    script.async = true
    script.src = `https://www.googletagmanager.com/gtag/js?id=${config.google_analytics_id}`
    head.appendChild(script);

    const scriptInline =document.createElement("script");
    scriptInline.type = 'text/javascript';
    scriptInline.innerHTML = `
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', '${config.google_analytics_id}');
`
    head.appendChild(scriptInline);
}

p3x.Analytics = Analytics;
