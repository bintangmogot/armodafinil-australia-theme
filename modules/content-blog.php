<?php
/**
 * Layout: Blog
 * Fields: (none) — auto-displays latest blog posts
 */
$recent = new WP_Query(array('posts_per_page' => 6, 'post_type' => 'post', 'post_status' => 'publish'));
?>
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if ($recent->have_posts()) : ?>
            <div class="grid md:grid-cols-3 gap-6">
                <?php while ($recent->have_posts()) : $recent->the_post(); ?>
                    <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large', array('class' => 'w-full h-48 object-cover')); ?></a>
                        <?php endif; ?>
                        <div class="p-5">
                            <p class="text-xs text-gray-400 mb-1"><?php echo get_the_date(); ?></p>
                            <h3 class="font-semibold text-gray-900 mb-2"><a href="<?php the_permalink(); ?>" class="hover:text-blue-600"><?php the_title(); ?></a></h3>
                            <p class="text-sm text-gray-600 line-clamp-3"><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">No blog posts found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
