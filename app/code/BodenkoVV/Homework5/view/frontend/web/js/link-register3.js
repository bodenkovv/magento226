define (
    [
        'jquery','Magento_Ui/js/modal/modal'
    ],
    function(
        $, modal
    )
    {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            modalClass: 'form-create-account',
            buttons: false,
        };
        $('#register-popup').click(function(){
        var popup = modal(options, $('#popup-register-modal'));
        $('#popup-register-modal').modal('openModal');
        });
    }
);
