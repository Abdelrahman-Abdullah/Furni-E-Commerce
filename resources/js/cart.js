import Alpine from 'alpinejs'
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
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
$('.remove').on('click' ,function () {
    var id = $(this).data('id');
    var forRemove = $(this);
    $.ajax({
        url: '/cart/remove/' + id,
        method: 'DELETE',
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        },
        success: function(data) {
            forRemove.closest('tr').fadeOut(400, function() {
                $(this).remove();
                // After removing, check if there are no more rows left
                if($('#cartTable tbody tr').length === 0) {
                    $('#cartTable thead').remove(); // Remove just the header
                    $('#cartTable tbody').append('<tr id="emptyMessageRow"><td colspan="12"><h2>Your cart is empty.</h2></td></tr>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error); // Handle error
        }
    })
});


Alpine.start()
