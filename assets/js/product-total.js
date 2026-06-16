document.addEventListener('DOMContentLoaded', function() {
    const qtyInput = document.querySelector('form.cart input.qty');
    const dynamicTotal = document.getElementById('armo-dynamic-total');
    
    if (!dynamicTotal) return;

    let currentPrice = 0;

    // Listen to WooCommerce variation found event (jQuery is required by WooCommerce here)
    if (typeof jQuery !== 'undefined') {
        jQuery('.variations_form').on('show_variation', function(event, variation) {
            if (variation.display_price) {
                currentPrice = variation.display_price;
                updateTotal();
            }
        });

        jQuery('.variations_form').on('hide_variation', function() {
            currentPrice = 0;
            dynamicTotal.innerText = '$0.00';
        });
    }

    // Listen to quantity changes
    if (qtyInput) {
        qtyInput.addEventListener('change', updateTotal);
        qtyInput.addEventListener('keyup', updateTotal);
        
        // Listen to plus/minus buttons if they trigger a click
        document.addEventListener('click', function(e) {
            if (e.target.closest('.qty-btn')) {
                setTimeout(updateTotal, 50); // wait for value to update
            }
        });
    }

    function updateTotal() {
        if (!currentPrice || !qtyInput) return;
        
        let qty = parseInt(qtyInput.value) || 1;
        let total = currentPrice * qty;
        
        // Format to currency
        dynamicTotal.innerText = '$' + total.toFixed(2);
    }
});
