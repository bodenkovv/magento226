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
        },

        getCustomClass: function (row) {
            var customClass = this.customClasses[row.status] || '';
            return customClass + ' ' + this.additionalCustomClass;
        }
    });
});
