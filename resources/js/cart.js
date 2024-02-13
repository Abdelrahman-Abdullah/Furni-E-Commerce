import Alpine from 'alpinejs'
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.addEventListener('alpine:init', () => {
    Alpine.data('showSuccessMessage', () => ({
        display: false,
        init() {
            this.addToCart();
        },
        addToCart() {
            const self = this;
            $('.addToCart').on('click', function () {
                var id = $(this).data('id');
            $.ajax({
                url: '/cart/add/' + id,
                method: 'POST',
                data: {
                    id: id
                },

                success: function(data) {
                    self.display = true; // Show success message using Alpine.js
                    setTimeout(() => self.display = false, 3000); // Hide after 3 seconds
                },
                error: function(xhr, status, error) {
                    console.error(error); // Handle error
                }
            })
            });
        }

    }));
});
Alpine.start();
$('.increase').on('click', function () {
    var id = $(this).data('id');
    let $thisButton = $(this);
    $.ajax({
        url: '/cart/add/' + id,
        method: 'POST',
        data: {
            id: id
        },
        success: function(data) {
            console.log("cart increased");
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Error increasing quantity')
        }
    });
});

