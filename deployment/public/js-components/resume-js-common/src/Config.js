var config = {
    html: {
        loader: '<div id="p3x-loading-container"><div id="p3x-loading-element-1" class="p3x-keep-animation"></div><div id="p3x-loading-element-2" class="p3x-keep-animation"></div></div>'
    },
    analytics: false,
    parameter: {
        default: 'p3x-default',
        debug: 'debug',
        mobile: 'mobile',
        analytics: 'analytics',
        production: 'production',
        content: {
            start: 'content-start-id'
        },
        data: {
            template: 'p3x-default'
        },
        language_switcher: 'patrikx3-language-switch',
        header: {
            language: 'P3x-Language-Ensured-Areas',
            template: 'P3x-Template-Ensured-Templates',
            debug: 'P3x-Debug'
        },
        id: {
            content: 'p3x-layout-content',
            debug: 'p3x-debug-box'
        },
        ajax: {
            analytics: 'p3x-analytics'
        },
        attribute: {
            ajax: 'p3x-ajax-href'
        },
        url: {
            language: 'p3x/language/area/',
            template: 'p3x/template/load/'
        },
        json: {
            languages: 'language-areas',
            templates: 'templates',
            run: 'run-id'
        },
        type: {
            template: 'template',
            ajax: 'ajax',
            reload: 'reload',
        },
        event: {
            bootstrap: {
                accordion: {
                    loaded: 'p3x-bootstrap-accordion-loaded'
                },
                tab: {
                    loaded: 'p3x-bootstrap-tab-loaded'
                }
            }
        }
    },
    base_url: null
};

p3x.config = config;
p3x.Module = {};
p3x.Controller = {};
window.p3x = p3x;
