define([
    'jquery',
    'mage/validation/validation'
],function($, validator) {
    'use strict';
    $.each({
            'phoneUA': [
                function (value) {
                    if (!$.mage.isEmpty(value)) {
                        if (!((value.length > 14) && (value.match(/^(\+38\(0)([3-9]{1}[0-9]{1})\)?((\d{3}?(-|\s)?\d{4})|(\d{2}?(-|\s)?\d{2}?(-|\s)?\d{3}))/ig)))) {

                                return false;
                        }

                       return !$.mage.isEmpty(value);
                    }

                    return !$.mage.isEmpty(value);
                }
            ]
        },
        function (i, rule) {
            rule.unshift(i);
            $.validator.addMethod.apply($.validator, rule);
        });

    $.validator.addClassRules({
        phoneUA: {
            'required': true
        }
    });
    $.validator.messages = $.extend($.validator.messages, {
             phoneUA: $.mage.__('!Not valid Ukrainian Phone Number')

    });
});
