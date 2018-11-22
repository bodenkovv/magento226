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
            modalClass: 'custom-block-customer-login',
            buttons: false,
        };
        //debugger;
        $('#login-popup').click(function(){
        var popup = modal(options, $('#popup-modal'));
        // debugger;
        $('#popup-modal').modal('openModal');
        });

    }
);
