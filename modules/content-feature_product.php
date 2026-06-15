<?php
/**
 * Layout: Feature Product
 * Fields: heading (text), feature_product (relationship, return=object, post_type=product)
 */
$heading  = get_sub_field('heading');
$products = get_sub_field('feature_product'); // Returns array of WP_Post objects
?>

<div class="module-feature-product py-12 px-4 max-w-7xl mx-auto">
    <?php if ( $heading ) : ?>
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-900"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>

    <?php if ( $products && is_array($products) ) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            foreach ( $products as $product ) : 
                $post_id = is_object( $product ) ? $product->ID : $product;
                $wc_product = wc_get_product( $post_id );
                
                if ( $wc_product ) :
                    $permalink  = esc_url( get_permalink( $post_id ) );
                    $name       = esc_html( $wc_product->get_name() );
                    $price_html = $wc_product->get_price_html();
                    $image_html = $wc_product->get_image('woocommerce_thumbnail', array(
                        'class' => 'w-full h-auto object-cover rounded-md mb-4'
                    ));
                    ?>
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-lg transition-shadow text-center">
                        <a href="<?php echo $permalink; ?>" class="block no-underline text-inherit">
                            <?php echo $image_html; ?>
                            <h3 class="text-base font-semibold text-gray-900 mb-2 min-h-[44px] flex items-center justify-center leading-tight">
                                <?php echo $name; ?>
                            </h3>
                            <div class="text-lg font-bold text-blue-600 mb-4">
                                <?php echo $price_html; ?>
                            </div>
                        </a>
                        <a href="<?php echo $permalink; ?>" class="block w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-colors no-underline">
                            View Options
                        </a>
                    </div>
                <?php 
                endif; 
            endforeach; 
            ?>
        </div>
    <?php else : ?>
        <p class="text-center text-gray-400 italic">No products selected.</p>
    <?php endif; ?>
</div>
