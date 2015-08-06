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
                cache: true
            },
            language: 'fr',
            minimumInputLength: 3,
            templateResult: _templateResult,
            templateSelection: _templateSelection
        });
    }
    
    function _templateResult(user) {
        return user.first_name + ' ' + user.last_name;
    }

    function _templateSelection(user) {
        return '';
        return user.first_name + ' ' + user.last_name;
    }

    // --------------------------------------------------------------------------------------------

    module.run = function () {
        $(document).ready(_onDocumentReady);
    };

    app.search = module;

})(App, jQuery, window, document);
