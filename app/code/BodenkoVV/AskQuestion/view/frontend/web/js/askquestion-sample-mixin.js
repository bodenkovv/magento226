define([
    'jquery',
    'BodenkoVV_AskQuestion/js/validation-ua-tell'
], function ($) {
    'use strict';

    return function () {

        $.widget('homework6.requestSample', $['homework6']['requestSample'],{
            options: {
                cookieName: 'homework6_sample_was_requested2'
            },

            /** @inheritdoc */
            _create: function () {
                $(this.element).submit(this.submitForm.bind(this));
                $('body').on('homework6_request_sample_clear_cookie', this.clearCookie.bind(this), this);
            }
        });

        return $.homework6.requestSample;
    };
});
