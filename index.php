<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress uses a "Template Hierarchy" to decide which file to load:
 *   - Viewing a page?     → page.php
 *   - Viewing a blog post? → single.php
 *   - Viewing an archive?  → archive.php
 *   - Nothing else matches? → index.php (THIS FILE — the ultimate fallback)
 *
 * The "WordPress Loop" below is how WordPress outputs content.
 * Think of it as: "while there are posts to show, show each one."
 * =====================================================================
 */

get_header(); // Loads header.php (your header HTML)

// Get blog page details if set
$blog_page_id = get_option( 'page_for_posts' );
$blog_title = 'Armodafinil Insights';
$blog_subtitle = 'Premium Armodafinil Delivered Australia-Wide';
$blog_description = '';

if ( $blog_page_id ) {
    $blog_title = get_the_title( $blog_page_id );
    $blog_description = apply_filters( 'the_content', get_post_field( 'post_content', $blog_page_id ) );
}

// Fallbacks if empty
if ( empty( $blog_description ) ) {
    $blog_description = '<p>Welcome to Armodafinil Insights, your dedicated resource for everything you need to know about optimizing your cognitive performance and managing wakefulness. Learn more about brain health, overcoming excessive daytime sleepiness, and defeating night-shift fatigue right here on this blog. We explore the most effective ways to sharpen your focus, eliminate brain fog, and put your daily productivity back on track. With our premium solutions, unlocking your mind\'s full potential is all good news.</p>';
}

// If viewing a specific category, override title
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
<section class="bg-[#EAF2FF] py-12 md:py-16 px-4 sm:px-6 lg:px-8 border-b border-white/50">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl lg:text-4xl font-extrabold text-primary mb-3"><?php echo esc_html( $blog_title ); ?></h1>
        
        <?php if ( ! empty( $blog_subtitle ) && ! is_archive() && ! is_search() ) : ?>
            <h2 class="text-[17px] md:text-lg font-bold text-primary mb-6"><?php echo esc_html( $blog_subtitle ); ?></h2>
        <?php endif; ?>
        
        <?php if ( ! empty( $blog_description ) ) : ?>
            <div class="text-[15px] md:text-base text-primary/80 leading-relaxed mb-12 mx-auto max-w-4xl">
                <?php echo wp_kses_post( $blog_description ); ?>
            </div>
        <?php endif; ?>

        <!-- Category Buttons -->
        <?php if ( ! is_search() ) : ?>
            <div class="text-left max-w-5xl mx-auto">
                <h3 class="text-[15px] font-bold text-primary mb-3">Category</h3>
                <div class="flex flex-wrap gap-2 md:gap-3">
                    <?php
                    $categories = get_categories( array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'hide_empty' => true,
                    ) );
                    
                    if ( $categories ) {
                        foreach ( $categories as $category ) {
                            $is_active = is_category( $category->term_id );
                            
                            // Active: Dark Blue bg. Inactive: Medium Blue bg.
                            $btn_class = $is_active 
                                ? 'bg-primary text-white shadow-md ring-2 ring-primary ring-offset-2 ring-offset-[#EAF2FF]' 
                                : 'bg-secondary text-white hover:bg-primary hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300';
                            
                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="inline-flex items-center justify-center px-4 md:px-5 py-2 md:py-2.5 text-[13px] md:text-sm font-semibold rounded-md ' . $btn_class . '">' . esc_html( $category->name ) . '</a>';
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <?php if ( have_posts() ) : ?>
            
            <div class="grid gap-6 md:gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-20 mb-8 flex justify-center">
                <?php
                // Using custom HTML structure to match the design (large blue numbers)
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>',
                    'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>',
                    'class'     => 'armo-blog-pagination',
                ) );
                ?>
            </div>

            <!-- Inline styles to target WordPress pagination classes and match design -->
            <style>
                .armo-blog-pagination .nav-links {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                }
                .armo-blog-pagination .page-numbers {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    min-width: 2.5rem;
                    height: 2.5rem;
                    padding: 0 0.5rem;
                    font-size: 1.125rem;
                    font-weight: 600;
                    color: #00125E; /* primary */
                    border-radius: 0.375rem;
                    transition: all 0.2s ease-in-out;
                    text-decoration: none;
                }
                .armo-blog-pagination .page-numbers:not(.current):hover {
                    background-color: #EAF2FF; /* surface-light */
                    color: #00125E;
                }
                .armo-blog-pagination .page-numbers.current {
                    color: #000000;
                    font-weight: 700;
                }
                .armo-blog-pagination .next,
                .armo-blog-pagination .prev {
                    color: #00125E;
                }
                .armo-blog-pagination .next:hover,
                .armo-blog-pagination .prev:hover {
                    color: #1b4f93; /* secondary */
                    background-color: transparent;
                    transform: translateX(2px);
                }
                .armo-blog-pagination .prev:hover {
                    transform: translateX(-2px);
                }
            </style>

        <?php else : ?>
            
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
            
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>
