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
            // display: true,
            innerScroll: true,
            modalClass: 'form-create-account',
            buttons: false,
        };
        debugger;
        $('#register-popup').click(function(){
        var popup = modal(options, $('#popup-register-modal'));
        // debugger;
        $('#popup-register-modal').modal('openModal');
        });

    }
);
