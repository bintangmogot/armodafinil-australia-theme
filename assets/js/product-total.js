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
                const btn = e.target.closest('.qty-btn');
                const isPlus = btn.classList.contains('plus');
                let val = parseInt(qtyInput.value) || 1;
                let min = parseInt(qtyInput.min) || 1;
                let max = parseInt(qtyInput.max) || 9999;
                
                if (isPlus && val < max) {
                    qtyInput.value = val + 1;
                } else if (!isPlus && val > min) {
                    qtyInput.value = val - 1;
                }
                
                // Trigger change event for WooCommerce and our total calculator
                qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
                
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
