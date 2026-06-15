<?php
/**
 * The template for displaying all single posts.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress loads this file when viewing a single blog post.
 * (For single PRODUCT pages, WooCommerce has its own templates.)
 *
 * the_title()     → outputs the post title
 * the_content()   → outputs the post body (text, images, etc.)
 * the_date()      → outputs the publish date
 * the_author()    → outputs the author name
 * the_category()  → outputs the categories
 * get_the_tag_list() → outputs the tags
 * =====================================================================
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12' ); ?>>

    <!-- Post Header -->
    <header class="mb-8">
        <!-- Categories -->
        <div class="flex flex-wrap gap-2 mb-4">
            <?php
            $categories = get_the_category();
            if ( $categories ) :
                foreach ( $categories as $category ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                       class="inline-block text-xs font-medium uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-full hover:bg-blue-100 transition-colors">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                <?php endforeach;
            endif;
            ?>
        </div>

        <!-- Title -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
            <?php the_title(); ?>
        </h1>

        <!-- Meta -->
        <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
            <time datetime="<?php echo get_the_date( 'c' ); ?>">
                <?php echo get_the_date(); ?>
            </time>
            <span>·</span>
            <span>By <?php the_author(); ?></span>
        </div>
    </header>

    <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="mb-8 rounded-xl overflow-hidden">
            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
        </div>
    <?php endif; ?>

    <!-- Post Content -->
    <!-- This is where your blog post body appears. WordPress outputs it from the editor. -->
    <div class="prose prose-lg max-w-none">
        <?php the_content(); ?>
    </div>

    <!-- Tags -->
    <?php
    $tags = get_the_tag_list( '', '', '' );
    if ( $tags ) : ?>
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Tags</h3>
            <div class="flex flex-wrap gap-2">
                <?php
                $post_tags = get_the_tags();
                if ( $post_tags ) :
                    foreach ( $post_tags as $tag ) : ?>
                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                           class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors">
                            #<?php echo esc_html( $tag->name ); ?>
                        </a>
                    <?php endforeach;
                endif;
                ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Post Navigation (Previous / Next) -->
    <nav class="mt-12 pt-8 border-t border-gray-200 flex justify-between">
        <div>
            <?php
            $prev_post = get_previous_post();
            if ( $prev_post ) : ?>
                <a href="<?php echo get_permalink( $prev_post ); ?>" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">
                    &larr; <?php echo esc_html( $prev_post->post_title ); ?>
                </a>
            <?php endif; ?>
        </div>
        <div>
            <?php
            $next_post = get_next_post();
            if ( $next_post ) : ?>
                <a href="<?php echo get_permalink( $next_post ); ?>" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">
                    <?php echo esc_html( $next_post->post_title ); ?> &rarr;
                </a>
            <?php endif; ?>
        </div>
    </nav>

</article>

<?php
get_footer();
