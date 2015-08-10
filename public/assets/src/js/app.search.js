;(function (app, $, window, document) {

    'use strict';

    var module = {
        url: null
    };

    // --------------------------------------------------------------------------------------------

    function _init(options) {
        $('.ui.search').search({
            apiSettings: {
                url: module.url
            },
            type: 'category',
            minCharacters: (typeof options.minCharacters !== 'undefined') ? options.minCharacters : 3
        });
    }

    function _trimTrailingSlash(url) {
        return url.replace(/\/$/, '');
    }

    // --------------------------------------------------------------------------------------------

    module.run = function () {
        //
    };

    module.setup = function (options) {
        if (typeof options.url !== 'undefined') {
            module.url = _trimTrailingSlash(options.url) + '?q={query}';
            _init(options);
        }
    };

    app.search = module;

})(App, jQuery, window, document);
