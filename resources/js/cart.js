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
    var $totalPriceCell = $thisButton.closest('td').next('td');
    var $input = $thisButton.closest('.input-group').find('.quantity-amount');
    var currentQuantity = parseInt($input.val(), 10);
    $.ajax({
        url: '/cart/update/' + id,
        method: 'POST',
        data: {
            id: id,
            increment: true
        },
        success: function(data) {
            var $productRow = $thisButton.closest('tr'); // Assuming your structure is within a <tr>
            var pricePerItem = parseFloat($productRow.find('.product-price').text().replace('$', ''));
            var totalPrice = (pricePerItem * currentQuantity).toFixed(2);

            // Update the quantity input field and the total price cell
            $totalPriceCell.text('$' + totalPrice);
            console.log("cart increased");
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Error increasing quantity')
        }
    });
});

$('.decrease').on('click', function () {
    var id = $(this).data('id');
    let $thisButton = $(this);
    var $totalPriceCell = $thisButton.closest('td').next('td');
    var $input = $thisButton.closest('.input-group').find('.quantity-amount');
    var currentQuantity = parseInt($input.val(), 10);
    $.ajax({
        url: '/cart/update/' + id,
        method: 'POST',
        data: {
            id: id
        },
        success: function(data) {
            var $productRow = $thisButton.closest('tr'); // Assuming your structure is within a <tr>
            var pricePerItem = parseFloat($productRow.find('.product-price').text().replace('$', ''));
            var totalPrice = (pricePerItem * currentQuantity).toFixed(2);

            // Update the quantity input field and the total price cell
            $totalPriceCell.text('$' + totalPrice);
            console.log("cart Decreased");
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Error increasing quantity')
        }
    });
});


