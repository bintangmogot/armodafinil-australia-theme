<?php
/**
 * Layout: Info With Image
 * Fields: image (image), content (wysiwyg)
 * Design: Image pulled left, light blue background extending to the right, custom green checkmarks for lists.
 */
$image   = get_sub_field('image');
$content = get_sub_field('content');
?>
<section class="py-16 lg:py-24 relative overflow-hidden bg-white">
    <!-- Light Blue Background extending to the right edge of the screen -->
    <div class="absolute bottom-0 left-0 right-0 top-32 md:top-0 md:bottom-0 md:left-auto md:right-0 md:w-5/6 lg:w-3/4 bg-[#EAF8FF] z-0"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-10 lg:gap-20">
            
            <!-- Image Side -->
            <div class="w-full md:w-1/2 lg:w-5/12">
                <?php 
                $image_url = '';
                if ($image) {
                    if (is_array($image) && isset($image['url'])) {
                        $image_url = $image['url'];
                    } elseif (is_numeric($image)) {
                        $image_url = wp_get_attachment_image_url($image, 'large');
                    } elseif (is_string($image)) {
                        $image_url = $image;
                    }
                }
                ?>
                <?php if ($image_url) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="" class="w-full h-auto object-cover rounded-2xl shadow-xl">
                <?php else : ?>
                    <div class="bg-gray-200 rounded-2xl h-[400px] flex items-center justify-center text-gray-500 italic shadow-xl">
                        [ Image — add in ACF ]
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Text Content Side -->
            <div class="w-full md:w-1/2 lg:w-7/12 py-10 md:py-0">
                <div class="module-info-content prose prose-lg md:prose-xl text-[#2A3342] max-w-none leading-relaxed">
                    <?php if ($content) : ?>
                        <?php echo wp_kses_post($content); ?>
                    <?php else : ?>
                        <h2 class="text-[#00125E] font-bold text-3xl">What Is Armodafinil?</h2>
                        <p>Armodafinil is a popular wakefulness-support medication commonly used by adults looking to improve alertness, focus, concentration, and mental performance during long working hours or demanding schedules.</p>
                        <p>Many Australians choose Armodafinil because it is known for:</p>
                        <ul>
                            <li>Long-lasting wakefulness support</li>
                            <li>Smoother focus throughout the day</li>
                            <li>Reduced mental fatigue</li>
                            <li>Improved productivity</li>
                            <li>Better concentration during study or work</li>
                        </ul>
                        <p>Armodafinil is commonly preferred by professionals, shift workers, university students, business owners, remote workers, gamers, developers, and creatives who need sustained mental clarity without the heavy crash associated with traditional stimulants.</p>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>

<style>
/* Custom styling for the WYSIWYG editor content in this specific module */
.module-info-content h1, 
.module-info-content h2, 
.module-info-content h3 {
    color: #00125E;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 1rem;
}
.module-info-content p {
    margin-bottom: 1.5rem;
}
.module-info-content ul {
    list-style-type: none;
    padding-left: 0;
    margin-bottom: 1.5rem;
}
.module-info-content ul li {
    position: relative;
    padding-left: 2.25rem;
    margin-bottom: 0.75rem;
}
/* Creates the custom green rounded-square checkmark */
.module-info-content ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.35rem; /* Aligns with the first line of text */
    width: 1.25rem;
    height: 1.25rem;
    background-color: #22c55e; /* Tailwind green-500 */
    border-radius: 0.25rem; /* Rounded square */
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='3.5' d='M5 13l4 4L19 7' /%3E%3C/svg%3E");
    background-size: 70%;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
