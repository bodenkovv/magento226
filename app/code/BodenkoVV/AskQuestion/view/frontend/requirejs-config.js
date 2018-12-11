var config = {
    config: {
        mixins: {
            'Magento_Swatches/js/swatch-renderer': {
                'BodenkoVV_AskQuestion/js/swatch-renderer-mixin': true
            },
            'BodenkoVV_AskQuestion/js/askquestion-sample': {
                'BodenkoVV_AskQuestion/js/askquestion-sample-mixin': true
            }
        }
    },
    map: {
        '*': {
            homework6_askquestionSample: 'BodenkoVV_AskQuestion/js/askquestion-sample',
            homework6_validationAlert: 'BodenkoVV_AskQuestion/js/validation-alert'
        }
    }
};
