define([], function () {
    var mageJsComponent = function(config, node)
    {
        // alert("Your Js module is working");
        console.log(config);
        // alert(config);
        console.log(node);
    };
    return mageJsComponent;
});

require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: '',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    $('#registrationfordealer').empty();
                    this.closeModal();
                }
            }]
        };
        var popup = modal(options, $('#header-mpdal'));
        $("#click-header").on('click',function(){
            var modalContent = '<iframe width="1024" height="760"'+
                'src="https://magento226.local/customer/account/create/">'+
                '</iframe>';
            $('#registrationfordealer').html(modalContent);
            $("#header-mpdal").modal("openModal");
        });
    }
);