define([
    'jquery',
    'homework6_validationAlert',
    'Magento_Ui/js/modal/alert',
    'mage/cookies',
    'mage/translate',
    'mage/validation/validation',
    'jquery/ui'
], function ($, validationAlert, alert) {
    'use strict';

    $.widget('homework6.requestSample', {
        options: {
            cookieName: 'homework6_sample_was_requested'
        },

        /** @inheritdoc */
        _create: function () {
            $(this.element).submit(this.submitForm.bind(this));
            $('body').on('homework6_request_sample_clear_cookie', this.clearCookie.bind(this));
        },

        /**
         * Validate request and submit the form if able
         */

        submitForm: function () {
            if (!this.validateForm()) {

                return;
            }

            if (!($.mage.cookies.get(this.options.cookieName))) {
                this.ajaxSubmit();
            } else {
                alert({
                    title: $.mage.__('Atantion!!!'), content: $.mage.__('120s has not passed yet. Please waite and tray again.')
                });

            }
        },

        /**
         * Submit request via AJAX. Add form key to the post data.
         */
        ajaxSubmit: function () {
            var formData = new FormData($(this.element).get(0));

            formData.append('form_key', $.mage.cookies.get('form_key'));
            formData.append('isAjax', 1);

            $.ajax({
                url: $(this.element).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                dataType: 'json',
                context: this,

                /** @inheritdoc */
                beforeSend: function () {
                    $('body').trigger('processStart');
                },

                /** @inheritdoc */
                success: function (response) {
                    $('body').trigger('processStop');

                    if (response.status === 'Success') {
                        $('#phone').val('');
                        $('#name').val('');
                        $('#email').val('');
                        $('#question').val('');

                        if (!($.mage.cookies.get(this.options.cookieName))) {
                            $.mage.cookies.set(this.options.cookieName, this.options.cookieName,{lifetime: 120});
                        }
                    }
                    alert({
                        title: $.mage.__(response.status),
                        content: $.mage.__(response.message)
                    });
                },

                /** @inheritdoc */
                error: function () {
                    $('body').trigger('processStop');
                    alert({
                        title: $.mage.__('Error'),
                        content: $.mage.__('Your request can not be submitted right now. Please, contact us directly via email or phone to get your Sample.')
                    });
                    }
                });
        },

        /**
         * Validate request form
         */
        validateForm: function () {
            return $(this.element).validation().valid();
        },

        /**
         * Clear that `geekhub_request_sample_clear_cookie` cookie
         * when the event `geekhub_request_sample_clear_cookie` is triggered
         */
        clearCookie: function () {
            $.mage.cookies.clear(this.options.cookieName);
        }
    });

    return $.homework6.requestSample;
});
