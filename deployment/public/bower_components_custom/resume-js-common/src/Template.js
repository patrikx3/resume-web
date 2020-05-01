function Template() {
}

Template.Cache = {};
Template.CacheRaw = {};
Template.DeferredCache = {};
Template.Partials = {};

Template.CompileOptions = {};

Template.Boot = function () {
    var self = this;
    Handlebars.registerHelper({
        'p3x-language': function (area, item) {
//        var options = arguments[arguments.length - 1];
//        console.log(result);
            //throw new Handlebars.Exception('Unknown field: ' + options.name);
            return Language.Get(area, item);
        },
        'p3x-icon-unicode': function (code) {
            if (jQuery.trim(code) === '') {
                return '';
            }
            return new Handlebars.SafeString(Icon.Unicode(code));
        },
        'p3x-base64-decode': function (value) {
            try {
                return new Handlebars.SafeString(atob(value));
            } catch (e) {
                return '';
            }
        },
        'p3x-date': function (format, timestamp_milli, options) {
            var date;
            if (options === undefined) {
                options = timestamp_milli;
                date = new Date();
            } else {
                date = new Date(timestamp_milli);
            }
            if (typeof (format) == 'object') {
                format = new String(format);
            }
            var result = date_format(date, format);
//            console.log(result);
            return result;
        },
        'p3x-route-url': function (url) {
            return Router.Url(url);
        },
        'p3x-sprintf': function () {
            var args = [].splice.call(arguments, 0);
            return sprintf.apply(null, args.splice(0, args.length - 1));
        },
        'p3x-expr': function ($v1, $op, $v2) {
            switch ($op) {
                case '=':
                case '==':
                    return $v1 == $v2;

                case '!=':
                case '<>':
                    return $v1 != $v2;

                case '<':
                    return $v1 < $v2;

                case '>':
                    return $v1 > $v2;

                case '<=':
                    return $v1 <= $v2;

                case '>=':
                    return $v1 >= $v2;

                case '&&':
                case 'and':
                    return $v1 && $v2;

                case '||':
                case 'or':
                    return $v1 || $v2;

                case '+':
                    return parseFloat($v1) + parseFloat($v2);

                case '-':
                    return parseFloat($v1) - parseFloat($v2);

                case '*':
                    return parseFloat($v1) * parseFloat($v2);

                case '/':
                    return parseFloat($v1) / parseFloat($v2);

                case '%':
                    return parseFloat($v1) % parseFloat($v2);

                default:
                    throw new Exception(sprintf('Unknown p3x-expr operand: %s', $op));
            }
            ;
        },
        'p3x-count': function (obj) {
            if (jQuery.isArray(obj)) {
                return obj.length;
            } else if (jQuery.isPlainObject(obj)) {
                return Object.keys(obj).length;
            }
            return 0;
        },
        'p3x-string-id': function (string) {
            if (jQuery.trim(string) === '') {
                return '';
            }
            return string.idilize();
        },
        'p3x-replace': function ($str, $find, $replace) {
            var result = $str.replace(new RegExp($find, 'g'), $replace);
            return result;
        },
        'p3x-json': function (context) {
            return JSON.stringify(context);
        }
    });

    if (window.JST) {
        for (var template in window.JST) {
            self.SetCompiledTemplate(template, window.JST[template]);
        }
    }
}

Template.SetTemplates = function (templates) {
    var self = this;
    for (var template in templates) {
        var data = templates[template];
        self.SetTemplate(template, data);
    }
}

Template.SetCompiledTemplate = function (template, compiled) {
    var self = this;
    self.Cache[template] = compiled;
    if (self.DeferredCache[template] === undefined) {
        self.DeferredCache[template] = $.Deferred();
    }
    self.DeferredCache[template].resolve(self.Cache[template]);
}

Template.SetTemplate = function (template, data) {
    var self = this;
    self.CacheRaw[template] = data;
    var compiledTemplate = Handlebars.compile(data, self.CompileOptions);
    self.SetCompiledTemplate(template, compiledTemplate);
    Debug.ShowCache('Cache:Template', self.CacheRaw);
}

Template.GetDeferredTemplate = function (template) {
    var self = this;
    if (self.Cache[template] === undefined) {
        var deferred = $.Deferred();
        self.DeferredCache[template] = deferred;
        $.ajax({
            url: Router.Url(config.parameter.url.template + template)
        }).then(function (template_data) {
            self.SetTemplate(template, template_data);
        });
    }
    return self.DeferredCache[template];
}

Template.DeferredContent = function (spec) {
    var self = this;
    var deferreds = [];
    deferreds.push(self.GetDeferredTemplate(spec.template))
    if (spec.compile !== undefined && spec.compile.partials !== undefined) {
        for (var template_key in spec.compile.partials) {
            if (self.Partials[template_key] !== undefined) {
                continue;
            }
            var partial_deferred = self.GetDeferredTemplate(spec.compile.partials[template_key]);
            deferreds.push(partial_deferred);
            partial_deferred.then(function (template_data) {
                Handlebars.registerPartial(template_key, template_data);
                self.Partials[template_key] = true;
            });
        }
    }
    return self.Render(spec.template, spec.data, deferreds);
}

Template.Render = function (template, data, deferreds) {
    var self = this;

    if (data === undefined) {
        data = {};
    }
    var referredContent = $.Deferred();
    var renderer = function () {
        data[config.parameter.data.template] = config;
        var html = self.Cache[template](data);
        referredContent.resolve(html);
    };

    if (deferreds !== undefined) {
        $.when.apply($, deferreds).then(renderer);
    } else {
        renderer();
    }
    return referredContent;
}

Template.EnsuredTemplates = function () {
    var self = this;
    return Object.keys(self.Cache);
}

p3x.Template = Template;

