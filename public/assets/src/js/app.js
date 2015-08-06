;(function ($, window, document) {

    'use strict';

    var app = {};

    // --------------------------------------------------------------------------------------------

    app.ready = function (callable) {
        $(document).ready(callable);
    };

    app.module = function () {
        $.each($.makeArray(arguments), function (index, module) {
            window.App[module].run();
        });
    };
    
    // --------------------------------------------------------------------------------------------

    window.App = app;

})(jQuery, window, document);
