;(function (app, $, window, document) {

    'use strict';

    var module = {
        locales: null
    };

    // --------------------------------------------------------------------------------------------

    function _init() {
        var $forms = $('.form-validation');
        if ($forms.length) {
            $forms.each(function () {
                _validateForm($(this));
            });
        }
    }

    function _validateForm($form) {
        $form.form({
            fields: _fields($form),
            inline: true
        });
    }

    function _fields($form) {
        var fields = [];

        $('input, select', $form).each(function () {
            var $input = $(this);
            var id = $input.attr('id');
            var validate = $input.data('validate');

            if ((typeof validate !== 'undefined') && (validate !== '')) {
                fields[id] = {
                    identifier: id,
                    rules: _rules(validate)
                };
            } 
        });

        return fields;
    }

    function _rules(validate) {
        var rules = [];

        var validates = validate.split(',');
        for (var i = 0 ; i < validates.length ; i++) {
            rules.push({
                type: validates[i],
                prompt: _prompt(validates[i])
            });
        }

        return rules;
    }

    function _prompt(validate) {
        validate = validate.replace(']', '');
        var rule = validate.split('[');

        var prompt = module.locales[rule[0]];
        if (rule.length === 2) {
            prompt = module.locales[rule[0]].replace('{attribute}', _label(rule[1]));
        }

        return prompt;
    }

    function _label(attribute) {
        var label = '"' + attribute + '"';

        var $target = $('#' + attribute);
        if ($target.length) {
            var targetLabel = $target.data('validate-label');
            if ((typeof targetLabel !== 'undefined') && (targetLabel !== '')) {
                label = '"' + targetLabel + '"';
            }
        }

        return label;
    }

    // --------------------------------------------------------------------------------------------

    module.setup = function (options) {
        module.locales = options.locales;
        _init();
    };

    app.form_validation = module;

})(App, jQuery, window, document);
