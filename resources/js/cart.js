    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".addToCart").on('click' , (function(){
        var product = $(this).data('id');
        var url = '/cart/add/'+product;
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: product
            },
            success: function (data) {
                // TODO:: Show Success Message
               console.log(data);
            }
        });
    }));
