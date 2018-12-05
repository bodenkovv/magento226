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
            if(!$('#phone').val().match('^3'))
            {
                document.getElementById('phone-error').style.backgroundColor="red";
                document.getElementById('phone-error').textContent='Not valid Ukrainian Phone Number';
                validationAlert('Not valid Ukrainian Phone Number');
                document.getElementById('phone').title='Not valid Ukrainian Phone Number';
                return;
            }

            document.getElementById('phone-error').textContent='';
            document.getElementById('phone').title='Phone Number';

            var sendQuestionTime = new Date(new Date().getTime() + 120 * 1000);
            document.getElementById('hideit2').value=sendQuestionTime.toUTCString();
            var sendQuestTime = sendQuestionTime.toUTCString()-$.mage.cookies.get(this.options.cookieName);
            var sendQuestTime2 = document.getElementById('hideit2').value-document.getElementById('hideit1').value;
            if ((($.mage.cookies.get(this.options.cookieName)=="undefined")||($.mage.cookies.get(this.options.cookieName)==null)||(!($.mage.cookies.get(this.options.cookieName)))))
            {
                document.cookie = this.options.cookieName+"="+ sendQuestionTime.toUTCString()+"; path=/; expires=" + sendQuestionTime.toUTCString();
                document.getElementById('hideit1').value=$.mage.cookies.get(this.options.cookieName);
                this.ajaxSubmit();
            }
            else
            {
                alert({
                    title: $.mage.__('Atantion!!!'),
                    content: $.mage.__('Please waite to time '+$.mage.cookies.get(this.options.cookieName)+' and tray again')
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
                    debugger;
                    $('body').trigger('processStop');
                    alert({
                        title: $.mage.__(response.status),
                        content: $.mage.__(response.message)
                    });
                    if (response.status === 'Success') {
                        document.getElementById('phone').value='';
                        document.getElementById('name').value='';
                        document.getElementById('email').value='';
                        document.getElementById('question').value='';
                        var sendQuestionTime = new Date(new Date().getTime() + 120 * 1000);
                        if (($.mage.cookies.get(this.options.cookieName)=="undefined")||($.mage.cookies.get(this.options.cookieName)==null)||(!($.mage.cookies.get(this.options.cookieName))))
                        {
                            document.cookie = this.options.cookieName+"="+ sendQuestionTime.toUTCString()+"; path=/; expires=" + sendQuestionTime.toUTCString();
                        }
                        document.getElementById('hideit1').value=$.mage.cookies.get(this.options.cookieName);
                        document.getElementById('hideit2').value=sendQuestionTime.toUTCString();
                    }
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
