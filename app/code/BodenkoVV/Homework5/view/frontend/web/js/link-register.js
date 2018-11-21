define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'mage/url'
    ],
    function(
        $,
         modal,
         urlBuilder
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
                    $('#registration-for-dealer').empty();
                    this.closeModal();
                    // $("#header-head-rfd").empty();
                }
            }]
        };
        var popup = modal(options, $('#header-rfd'));
         debugger;
            $("#link-register").on('click',function(){
                // debugger;
                var modalContent = '<iframe width="800" height="900"'+
                    'src="'+urlBuilder.build('customer/account/create')+'" frameborder="0" allowfullscreen>'+'</iframe>';
                $('#registration-for-dealer').html(modalContent);
                $("#header-rfd").modal("openModal");
            });

            $("#link-register2").on('click',function(){
                // debugger;
                var modalContent = '<iframe width="800" height="900"'+
                    'src="'+urlBuilder.build('homework5/account/create')+'" frameborder="0" allowfullscreen>'+'</iframe>';
                $('#registration-for-dealer').html(modalContent);
                $("#header-rfd").modal("openModal");
            });



    }
);
