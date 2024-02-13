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
                let id = $(this).data('id');
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
function updateCartQuantity(isIncrease, id, $thisButton) {
    let $input = $thisButton.closest('.input-group').find('.quantity-amount');
    let currentQuantity = parseInt($input.val(), 10);
    $.ajax({
        url: '/cart/update/' + id,
        method: 'POST',
        data: {
            id: id,
            increment: isIncrease
        },
        success: function(data) {
            let $productRow = $thisButton.closest('tr'); // Assuming your structure is within a <tr>
            let pricePerItem = parseFloat($productRow.find('.product-price').text().replace('$', ''));
            // Recalculate totalPrice if not provided by server
            let totalPrice = (pricePerItem * currentQuantity).toFixed(2);

            // Update the quantity input field and the total price cell
            $input.val(currentQuantity);
            let $totalPriceCell = $thisButton.closest('td').next('td');
            $totalPriceCell.text('$' + totalPrice);
            },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Error updating cart');
        }
    });
}

$('.increase, .decrease').on('click', function () {
    let id = $(this).data('id');
    let isIncrease = $(this).hasClass('increase');
    updateCartQuantity(isIncrease, id, $(this));
});



