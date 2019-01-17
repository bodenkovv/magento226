define([
    'underscore',
    'Magento_Ui/js/grid/columns/select'
], function (_, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            additionalCustomClass: '',
            customClasses: {
                pending: 'red',
                processed: 'yellow',
                success: 'green',
                answered: 'green',
                missed: 'grey',
                error: 'red'
            }
            // ,
            // bodyTmpl: 'BodenkoVV_AskQuestion/grid/cells/text'
        },

        getCustomClass: function (row) {
            var customClass = this.customClasses[row.status] || '';
            // debugger;
            return customClass + ' ' + this.additionalCustomClass;
        }
    });
});
