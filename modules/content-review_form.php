<?php
/**
 * Layout: Review Form
 * Fields: heading (text)
 * Design: Dark blue background section, white/light form card in center.
 */

$heading = get_sub_field('heading');
if ( ! $heading ) {
    $heading = 'Leave us a review 🙏';
}
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-[#00125E]">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-10">
            <?php echo esc_html( $heading ); ?>
        </h2>

        <div class="bg-[#f5f7fb] rounded-2xl p-8 lg:p-12 text-left shadow-xl max-w-2xl mx-auto">
            <form action="#" method="POST" class="flex flex-col gap-6">
                <!-- Rating -->
                <div>
                    <label class="block text-sm font-bold text-[#00125E] mb-2">Your overall rating *</label>
                    <div class="flex gap-2">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <svg class="w-8 h-8 text-gray-300 hover:text-[#EAA800] cursor-pointer transition-colors fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <label class="block text-sm font-bold text-[#00125E] mb-2">Title of your review *</label>
                    <input type="text" placeholder="Enter your title" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-[#00125E] transition-colors" required>
                </div>

                <!-- Review Content -->
                <div>
                    <label class="block text-sm font-bold text-[#00125E] mb-2">Your review *</label>
                    <textarea placeholder="Write your review" rows="4" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-[#00125E] transition-colors resize-none" required></textarea>
                </div>

                <!-- Grid for Name and Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-bold text-[#00125E] mb-2">Your name *</label>
                        <input type="text" placeholder="Enter your name" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-[#00125E] transition-colors" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-[#00125E] mb-2">Your email address *</label>
                        <input type="email" placeholder="Enter your email" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-[#00125E] transition-colors" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-[#d61e1e] text-white font-bold py-4 px-10 rounded-full hover:bg-red-700 transition-colors w-full md:w-auto">
                        Submit your review
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
