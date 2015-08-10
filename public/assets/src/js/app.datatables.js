;(function (app, $, window, document) {

    'use strict';

    var module = {
        tables: {}
    };

    // --------------------------------------------------------------------------------------------

    function _initInstance($table, options) {
        var language = app.locales.datatables;
        language.sProcessing = '<div class="ui loader"></div>';

        $table.on('processing.dt', function (event, settings, processing) {
            if (processing) {
                $('.dimmer').dimmer('show');
            } else {
                $('.dimmer').dimmer('hide');
            }
        })

        return $table.DataTable({
            language: language,
            processing: true,
            serverSide: true,
            ajax: options.dataUrl,
            columnDefs: [{
                orderable: false,
                targets: options.nonOrderableIndexes
            }]
        });
    }

    // --------------------------------------------------------------------------------------------

    module.run = function () {
        //
    };

    module.setup = function (options) {
        var $table = $('#' + options.table);
        if ($table.length) {
            module.tables[options.table] = _initInstance($table, options);
        }
    };

    app.datatables = module;

})(App, jQuery, window, document);
