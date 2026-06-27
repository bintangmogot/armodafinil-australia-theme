import sys

with open('inc/woocommerce.php', 'r', encoding='utf-8') as f:
    content = f.read()

old_html = '''    <div class="grid grid-cols-2 gap-y-4 gap-x-2 md:gap-x-4">
        <!-- 100% Genuine -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
            100% Genuine
        </div>
        <!-- Delivery -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            8-12 Days USA<br>Tracked Delivery
        </div>
        <!-- Packaging -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            Discreet Packaging
        </div>
        <!-- Secure Payment -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
            Secure Payment
        </div>
    </div>'''

new_html = '''    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3">
        <!-- 100% Genuine -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-green-500 flex-shrink-0">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
            100% Genuine
        </div>
        <!-- Delivery -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-[#6B7280] flex-shrink-0">
                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 010 1.06L4.81 8.25H15a6.75 6.75 0 010 13.5h-3a.75.75 0 010-1.5h3a5.25 5.25 0 100-10.5H4.81l4.72 4.72a.75.75 0 11-1.06 1.06l-6-6a.75.75 0 010-1.06l6-6a.75.75 0 011.06 0z" clip-rule="evenodd" />
            </svg>
            Easy Return
        </div>
        <!-- Packaging -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-[#E85D04] flex-shrink-0">
                <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.318c.105.809.824 1.425 1.682 1.425s1.577-.616 1.682-1.425h6.818c.105.809.824 1.425 1.682 1.425s1.577-.616 1.682-1.425h.318c1.036 0 1.875-.84 1.875-1.875V15h-4.5z" />
                <path d="M15 11.25v-3.75h3.375a3 3 0 012.122.878l1.621 1.622a3 3 0 01.878 2.122V13.5h-7.996z" />
            </svg>
            Fast Delivery
        </div>
        <!-- Secure Payment -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-[#D4AF37] flex-shrink-0">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
            </svg>
            Secure Payment
        </div>
    </div>'''

if old_html not in content:
    print("Error: Could not find old_html in content")
    sys.exit(1)

content = content.replace(old_html, new_html)

new_hooks = '''/**
 * Wrap Excerpt and Add to Cart in a white box on Mobile only.
 * Priority 15 is after Price (10), before Excerpt (20).
 */
add_action('woocommerce_single_product_summary', 'armo_mobile_box_open', 15);
function armo_mobile_box_open() {
    echo '<div class="bg-white shadow-md rounded-xl p-5 lg:bg-transparent lg:shadow-none lg:rounded-none lg:p-0 mb-6 lg:mb-0">';
}

/**
 * Priority 32 is after Add to Cart (30), before Feature Pills Mobile (35).
 */
add_action('woocommerce_single_product_summary', 'armo_mobile_box_close', 32);
function armo_mobile_box_close() {
    echo '</div>';
}
'''
if "armo_mobile_box_open" not in content:
    content += "\n" + new_hooks

with open('inc/woocommerce.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Success!")
