;(function ($, window, document) {

    'use strict';

    var app = {
        locales: {}
    };

    // --------------------------------------------------------------------------------------------

    app.ready = function (callable) {
        $(document).ready(callable);
    };
    
    // --------------------------------------------------------------------------------------------

    window.App = app;

})(jQuery, window, document);
