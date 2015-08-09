(function (window, document, undefined) {

    var factory = function ($, DataTable) {

        'use strict';

        $.extend(DataTable.ext.classes, {
            sWrapper: 'dataTables_wrapper',
            sLength: 'two wide field',
            sLengthSelect: 'ui dropdown dataTables_length',
            sFilter: 'two wide field',
            sFilterInput: 'dataTables_search',
            sProcessing: 'ui dimmer',
            sPageButton: '',
            sPageButtonActive: '',
            sPageButtonDisabled: '',
            sSortAsc: 'sorted ascending',
            sSortDesc: 'sorted descending',
            sTable: 'ui sortable celled compact table'
        });

        // Set the defaults for DataTables initialisation
        $.extend(true, DataTable.defaults, {
            dom: "<'ui segment'<'ui small form'<'fields'lf>>r>t<'ui grid'<'eight wide column'i><'eight wide column right aligned'p>>",
            renderer: 'semantic'
        });

        // Page button renderer
        DataTable.ext.renderer.pageButton.semantic = function (settings, host, idx, buttons, page, pages) {
            var api = new DataTable.Api(settings);
            var classes = settings.oClasses;
            var lang = settings.oLanguage.oPaginate;
            var btnDisplay, btnClass;

            var attach = function (container, buttons) {
                var i, ien, node, button;
                var clickHandler = function (e) {
                    e.preventDefault();
                    if (e.data.action !== 'ellipsis') {
                        api.page(e.data.action).draw(false);
                    }
                };

                for (i = 0, ien = buttons.length ; i < ien ; i ++) {
                    button = buttons[i];

                    if ($.isArray(button)) {
                        attach(container, button);
                    } else {
                        btnDisplay = '';
                        btnClass = '';

                        switch (button) {
                            case 'ellipsis':
                                btnDisplay = '&hellip;';
                                btnClass = ' disabled item';
                                break;
                            case 'first':
                                btnDisplay = button + 1;
                                btnClass = button + (page > 0 ? ' item' : ' disabled item');
                                break;
                            case 'previous':
                                btnDisplay = '<i class="left arrow icon"></i>';
                                btnClass = button + (page > 0 ? ' icon item' : ' disabled item');
                                break;
                            case 'next':
                                btnDisplay = '<i class="right arrow icon"></i>';
                                btnClass = button + (page < pages - 1 ? ' item' : ' disabled item');
                                break;
                            case 'last':
                                btnDisplay = button + 1;
                                btnClass = button + (page < pages - 1 ? ' item' : ' disabled item');
                                break;
                            default:
                                btnDisplay = button + 1;
                                btnClass = page === button ? 'active item' : ' item';
                                break;
                        }

                        if (btnDisplay) {
                            node = $('<a>', {
                                'class': classes.sPageButton + ' ' + btnClass,
                                'aria-controls': settings.sTableId,
                                'tabindex': settings.iTabIndex,
                                'id': idx === 0 && typeof button === 'string' ? settings.sTableId + '_' + button : null
                            }).html(btnDisplay).appendTo(container);

                            settings.oApi._fnBindAction(node, { action: button }, clickHandler);
                        }
                    }
                }
            };

            attach($(host).empty().html('<div class="ui pagination menu"/>').children('div'), buttons);
        };
    };

    // Define as an AMD module if possible
    if (typeof define === 'function' && define.amd) {
        define(['jquery', 'datatables'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS
        factory(require('jquery'), require('datatables'));
    } else if (jQuery) {
        // Otherwise simply initialise as normal, stopping multiple evaluation
        factory(jQuery, jQuery.fn.dataTable);
    }

})(window, document);
