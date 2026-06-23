<?php
/**
 * The main template file.
 */

get_header();

$blog_page_id = get_option( 'page_for_posts' );
$blog_title = 'Armodafinil Insights';
$blog_subtitle = 'Premium Armodafinil Delivered Australia-Wide';
$blog_description = '';

if ( $blog_page_id ) {
    $blog_title = get_the_title( $blog_page_id );
    $blog_description = apply_filters( 'the_content', get_post_field( 'post_content', $blog_page_id ) );
}

if ( empty( $blog_description ) ) {
    $blog_description = '<p>Welcome to Armodafinil Insights, your dedicated resource for everything you need to know about optimizing your cognitive performance and managing wakefulness. Learn more about brain health, overcoming excessive daytime sleepiness, and defeating night-shift fatigue right here on this blog. We explore the most effective ways to sharpen your focus, eliminate brain fog, and put your daily productivity back on track. With our premium solutions, unlocking your mind\'s full potential is all good news.</p>';
}

if ( is_category() ) {
    $blog_title = single_cat_title( '', false );
    $cat_desc = category_description();
    if ( ! empty( $cat_desc ) ) {
        $blog_description = $cat_desc;
    }
} elseif ( is_tag() ) {
    $blog_title = single_tag_title( '', false );
} elseif ( is_search() ) {
    $blog_title = 'Search Results for: ' . get_search_query();
    $blog_subtitle = '';
    $blog_description = '';
}
?>

<!-- Hero Section -->
<section class="bg-[#EAF2FF] pt-12 pb-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-4xl mx-auto text-center mb-10">
            <h1 class="text-[28px] md:text-[32px] font-bold text-[#00125E] mb-2"><?php echo esc_html( $blog_title ); ?></h1>
            
            <?php if ( ! empty( $blog_subtitle ) && ! is_archive() && ! is_search() ) : ?>
                <h2 class="text-[17px] md:text-lg font-semibold text-[#00125E] mb-4"><?php echo esc_html( $blog_subtitle ); ?></h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $blog_description ) ) : ?>
                <div class="text-[15px] text-[#00125E] leading-relaxed mx-auto max-w-4xl">
                    <?php echo wp_kses_post( $blog_description ); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Category Buttons -->
        <?php if ( ! is_search() ) : ?>
            <div class="mt-8">
                <h3 class="text-[15px] font-semibold text-[#00125E] mb-3">Category</h3>
                <div class="flex flex-wrap gap-2 md:gap-3">
                    <?php
                    $categories = get_categories( array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'hide_empty' => false,
                    ) );
                    
                    if ( $categories ) {
                        foreach ( $categories as $category ) {
                            // Skip the default "Uncategorized" category if it's empty or we just don't want it
                            if ( $category->slug === 'uncategorized' ) continue;
                            
                            $is_active = is_category( $category->term_id );
                            $btn_class = $is_active 
                                ? 'bg-[#00125E] text-white' 
                                : 'bg-[#1b4f93] text-white hover:bg-[#00125E] transition-colors';
                            
                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="inline-flex items-center justify-center px-4 py-2 text-[14px] font-medium rounded-sm ' . $btn_class . '">' . esc_html( $category->name ) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Blog Grid Section -->
<div class="bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <?php if ( have_posts() ) : ?>
            
            <div class="grid gap-6 md:gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16 mb-8 flex justify-center">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
                    'next_text' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
                    'class'     => 'armo-blog-pagination',
                ) );
                ?>
            </div>

            <style>
                .armo-blog-pagination .nav-links {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }
                .armo-blog-pagination .page-numbers {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.125rem;
                    font-weight: 500;
                    color: #00125E;
                    text-decoration: none;
                    padding: 0 0.5rem;
                }
                .armo-blog-pagination .page-numbers:hover {
                    color: #1b4f93;
                }
                .armo-blog-pagination .page-numbers.current {
                    color: #000000;
                    font-weight: 600;
                }
            </style>

        <?php else : ?>
            
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
            
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>
