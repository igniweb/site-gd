;(function (app, $, window, document) {

    'use strict';

    var module = {};

    // --------------------------------------------------------------------------------------------

    function _onDocumentReady() {
        _initSelect2($('#search'));
    }

    function _initSelect2($input) {
        $input.select2({
            ajax: {
                url: '/search',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, page) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            language: 'fr',
            minimumInputLength: 3,
            templateResult: _templateResult,
            templateSelection: _templateSelection
        });
    }

    function _templateResult(result) {
        return result.templateResult;
    }

    function _templateSelection(result) {
        return result.templateSelection;
    }

    // --------------------------------------------------------------------------------------------

    module.run = function () {
        $(document).ready(_onDocumentReady);
    };

    app.search = module;

})(App, jQuery, window, document);
