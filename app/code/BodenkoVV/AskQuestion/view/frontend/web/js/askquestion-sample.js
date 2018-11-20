define([
    'jquery',
    'homework6_validationAlert',
    'Magento_Ui/js/modal/alert',
    'mage/cookies',
    'mage/translate',
    'jquery/ui'
], function ($, validationAlert, alert) {
    'use strict';
    $.widget('homework6.requestSample', {
        options: {
            // action: ''
            cookieName: 'homework6_sample_was_requested'
        },
        /** @inheritdoc */
        _create: function () {
            //debugger;
            $(this.element).submit(this.submitForm.bind(this));
            $('body').on('homework6_request_sample_clear_cookie', this.clearCookie.bind(this));
        },

        /**
         * Validate request and submit the form if able
         */

        submitForm: function () {
            //debugger;
            if (!this.validateForm()) {
               // validationAlert();
               //console.log('Form was not submitte');
                return;
            }
            //debugger;
            if(!$('#phone').val().match('^3'))
            {
                //debugger;
                document.getElementById('phone-error').style.backgroundColor="red";
                document.getElementById('phone-error').textContent='Not valid Ukrainian Phone Number';
                validationAlert('Not valid Ukrainian Phone Number');
                document.getElementById('phone').title='Not valid Ukrainian Phone Number';

                return;

            }

             // debugger;
            // alert('Form was submitted');
            document.getElementById('phone-error').textContent='';
            document.getElementById('phone').title='Phone Number';
            console.log('Form was submitted');
            this.ajaxSubmit();
        },
        /**
         * Submit request via AJAX. Add form key to the post data.
         */
        ajaxSubmit: function () {
            var formData = new FormData($(this.element).get(0));

            formData.append('form_key', $.mage.cookies.get('form_key'));
            formData.append('isAjax', 1);
            //debugger;

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
                    alert({
                        title: $.mage.__(response.status),
                        content: $.mage.__(response.message)
                    });
                    //debugger;
                    if (response.status === 'Success') {
                        // Prevent from sending requests too often
                        $.mage.cookies.set(this.options.cookieName, true);
                    }
                },

                /** @inheritdoc */
                error: function () {
                    //debugger;
                    // console.log(JSON.stringify(error));
                    $('body').trigger('processStop');
                    alert({
                        title: $.mage.__('Error'),
                        /*eslint max-len: ["error", { "ignoreStrings": true }]*/
                        content: $.mage.__('Your request can not be submitted right now. Please, contact us directly via email or phone to get your Sample.')
                    });
                    }
                });
        },

        /**
         * Validate request form
         */
        validateForm: function () {
            //return true;
            //debugger;
            //console.log("valid");
            return $(this.element).validation().valid();
        },

        /**
         * Clear that `geekhub_request_sample_clear_cookie` cookie
         * when the event `geekhub_request_sample_clear_cookie` is triggered
         */
        clearCookie: function () {
            //debugger;
            $.mage.cookies.clear(this.options.cookieName);
        }
    });
    return $.homework6.requestSample;
});
