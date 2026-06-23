<?php
/**
 * The main template file — Blog index & archive listing.
 *
 * Supports ACF modules on the blog page (admin can add content sections
 * above/below the post grid via the same Flexible Content field used on pages).
 */

get_header();

// Pull the blog page details from WordPress settings
$blog_page_id  = get_option( 'page_for_posts' );
$blog_title    = 'Armodafinil Insights';
$blog_subtitle = 'Premium Armodafinil Delivered Australia-Wide';
$blog_description = '';

if ( $blog_page_id ) {
    $page_title = get_the_title( $blog_page_id );
    if ( ! empty( $page_title ) ) {
        $blog_title = $page_title;
    }
    $blog_description = get_post_field( 'post_content', $blog_page_id );
}

// Default description if admin hasn't written one
if ( empty( trim( strip_tags( $blog_description ) ) ) ) {
    $blog_description = 'Welcome to Armodafinil Insights, your dedicated resource for everything you need to know about optimizing your cognitive performance and managing wakefulness. Learn more about brain health, overcoming excessive daytime sleepiness, and defeating night-shift fatigue right here on this blog. We explore the most effective ways to sharpen your focus, eliminate brain fog, and put your daily productivity back on track. With our premium solutions, unlocking your mind\'s full potential is all good news.';
}

// Category / tag / search overrides
if ( is_category() ) {
    $blog_title = single_cat_title( '', false );
    $cat_desc   = category_description();
    if ( ! empty( $cat_desc ) ) {
        $blog_description = strip_tags( $cat_desc );
    }
} elseif ( is_tag() ) {
    $blog_title = single_tag_title( '', false );
} elseif ( is_search() ) {
    $blog_title       = 'Search Results for: ' . get_search_query();
    $blog_subtitle    = '';
    $blog_description = '';
}
?>

<?php
// ── ACF Modules BEFORE the blog grid (admin can stack modules on the blog page) ──
if ( $blog_page_id && function_exists('have_rows') && have_rows( 'modules', $blog_page_id ) ) :
    while ( have_rows( 'modules', $blog_page_id ) ) : the_row();
        $layout_name = get_row_layout();
        get_template_part( 'modules/content', $layout_name );
    endwhile;
endif;
?>

<!-- Blog Header -->
<section class="bg-surface-light py-14 lg:py-20">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-primary leading-tight mb-3">
            <?php echo esc_html( $blog_title ); ?>
        </h1>

        <?php if ( ! empty( $blog_subtitle ) && ! is_archive() && ! is_search() ) : ?>
            <p class="text-base md:text-lg font-semibold text-primary/80 mb-5">
                <?php echo esc_html( $blog_subtitle ); ?>
            </p>
        <?php endif; ?>

        <?php if ( ! empty( $blog_description ) ) : ?>
            <p class="text-sm md:text-[15px] text-primary/70 leading-relaxed max-w-2xl mx-auto">
                <?php echo esc_html( wp_strip_all_tags( $blog_description ) ); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- Category Filter -->
<?php if ( ! is_search() ) : ?>
<section class="bg-surface-light pb-10">
    <div class="max-w-5xl mx-auto px-6">
        <p class="text-sm font-semibold text-primary mb-3">Category</p>
        <div class="flex flex-wrap gap-2">
            <?php
            $categories = get_categories( array(
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false,
            ) );

            if ( $categories ) :
                foreach ( $categories as $category ) :
                    if ( $category->slug === 'uncategorized' ) continue;

                    $is_active = is_category( $category->term_id );
                    $classes   = $is_active
                        ? 'bg-primary text-white shadow-sm'
                        : 'bg-secondary text-white hover:bg-primary transition-colors duration-200';
                    ?>
                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                       class="inline-block px-5 py-2 text-[13px] font-semibold rounded-lg <?php echo $classes; ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Blog Grid -->
<section class="bg-white py-14 lg:py-20">
    <div class="max-w-5xl mx-auto px-6">

        <?php if ( have_posts() ) : ?>

            <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <nav class="mt-16 flex justify-center" aria-label="Blog pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&lsaquo;',
                    'next_text' => '&rsaquo;',
                ) );
                ?>
            </nav>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
