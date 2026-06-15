# How to Build Pages with ACF Pro Modules

---

## Two Ways to Code

You have **two approaches**. Pick whichever feels more natural:

| Approach | How | Best for |
|----------|-----|----------|
| **A) One file per page** | Create `page-homepage.php` → code everything inside | When you want full control of one page |
| **B) One file per module** | Create `modules/content-faqs.php` etc. | When you reuse the same modules across many pages |

**You asked for Approach A** — coding an entire page in one single file. Here's how.

---

## Approach A: Code a Full Page in One File

### How WordPress Matches Pages to Files

WordPress pages live in the **database**, not as files. But WordPress automatically looks for a matching PHP file based on the page's **slug**:

```
Page slug in WordPress  →  File WordPress looks for
──────────────────────────────────────────────────
homepage                →  page-homepage.php
about                   →  page-about.php  
contact                 →  page-contact.php
check                   →  page-check.php
```

If the file exists, WordPress uses it. If not, it falls back to `page.php`.

### Your Current Pages

| ID  | Slug            | Title                    |
|-----|-----------------|--------------------------|
| 163 | check           | check                    |
| 50  | test            | Test                     |
| 55  | shop            | Shop                     |
| 56  | cart             | Cart                     |
| 57  | checkout         | Checkout                 |
| 58  | my-account       | My account               |
| 2   | sample-page      | Sample Page              |

---

### Step-by-Step: Build a Homepage

#### 1. Create the page in WordPress
- Go to **Pages → Add New**
- Title: "Homepage"
- Slug will auto-generate to: `homepage`
- **You do NOT need to select any template** — WordPress will auto-detect `page-homepage.php`
- Add your modules (Header Image, Intro, Feature Product, FAQs, etc.)
- Fill in all content
- Click **Publish**

#### 2. Create one file in your theme
Create this file:
```
wp-content/themes/armodafinil-australia/page-homepage.php
```

#### 3. Code your entire page inside that file

Here is a **complete real example** — one file, full page, all modules handled inline:

```php
<?php
/**
 * Page: Homepage
 * Slug: homepage
 * 
 * This file controls the ENTIRE homepage layout.
 * Modules are added in WordPress, content is pulled here.
 */

get_header();
?>

<div id="primary" class="content-area">
<main id="main" class="site-main">
<?php while ( have_posts() ) : the_post(); ?>

    <?php if ( have_rows('modules') ) : ?>
        <?php while ( have_rows('modules') ) : the_row(); ?>

            <?php // ========================================== ?>
            <?php // MODULE: Header Image (hero banner)         ?>
            <?php // ========================================== ?>
            <?php if ( get_row_layout() == 'header_image' ) : 
                $image   = get_sub_field('image');
                $content = get_sub_field('content');
                $img_url = is_array($image) ? $image['url'] : (is_numeric($image) ? wp_get_attachment_url($image) : $image);
            ?>

                <section class="relative w-full min-h-[600px] flex items-center justify-center">
                    <?php if ($img_url) : ?>
                        <img src="<?php echo esc_url($img_url); ?>" class="absolute inset-0 w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-black/50"></div>
                    <?php endif; ?>
                    <div class="relative z-10 max-w-3xl mx-auto text-center text-white px-6">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Intro (black background)           ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'intro_black_background' ) : 
                $content = get_sub_field('content');
            ?>

                <section class="bg-gray-900 text-white py-20 px-6">
                    <div class="max-w-3xl mx-auto prose prose-lg prose-invert">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Intro (dark background)            ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'intro_dark_background' ) : 
                $content = get_sub_field('content');
            ?>

                <section class="bg-gray-800 text-gray-100 py-20 px-6">
                    <div class="max-w-3xl mx-auto prose prose-lg prose-invert">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Text - Full Width                  ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'text_-_full_width' ) : 
                $content = get_sub_field('content');
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-4xl mx-auto prose prose-lg">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Text - 1/2 & 1/2                  ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'text_-_12_&_12' ) : 
                $left  = get_sub_field('content_left');
                $right = get_sub_field('content_right');
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="prose"><?php echo wp_kses_post($left); ?></div>
                        <div class="prose"><?php echo wp_kses_post($right); ?></div>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Text - 2/3 & 1/3                  ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'text_-_23_&_13' ) : 
                $left  = get_sub_field('content_left');
                $right = get_sub_field('content_right');
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
                        <div class="md:col-span-2 prose"><?php echo wp_kses_post($left); ?></div>
                        <div class="prose"><?php echo wp_kses_post($right); ?></div>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Text - Side Image                  ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'text_-_side_image' ) : 
                $image   = get_sub_field('image');
                $content = get_sub_field('content');
                $img_url = is_array($image) ? $image['url'] : (is_numeric($image) ? wp_get_attachment_url($image) : $image);
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div class="prose"><?php echo wp_kses_post($content); ?></div>
                        <?php if ($img_url) : ?>
                            <img src="<?php echo esc_url($img_url); ?>" class="w-full rounded-lg shadow-lg" />
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Feature Product                    ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'feature_product' ) : 
                $heading  = get_sub_field('heading');
                $products = get_sub_field('feature_product');
            ?>

                <section class="py-16 px-6 bg-gray-50">
                    <div class="max-w-6xl mx-auto">
                        <?php if ($heading) : ?>
                            <h2 class="text-3xl font-bold text-center mb-10"><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>
                        <?php if ($products) : ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                                <?php foreach ($products as $product) : 
                                    $pid = is_object($product) ? $product->ID : $product;
                                    $wc  = wc_get_product($pid);
                                    if (!$wc) continue;
                                ?>
                                    <a href="<?php echo get_permalink($pid); ?>" class="block bg-white rounded-lg shadow p-5 text-center hover:shadow-lg transition">
                                        <?php echo $wc->get_image('woocommerce_thumbnail', array('class' => 'mx-auto mb-4 rounded')); ?>
                                        <h3 class="font-semibold text-lg mb-2"><?php echo esc_html($wc->get_name()); ?></h3>
                                        <div class="text-blue-600 font-bold text-xl"><?php echo $wc->get_price_html(); ?></div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: FAQs                               ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'faqs' ) : 
                $title = get_sub_field('faq_title');
            ?>

                <section class="py-16 px-6 bg-gray-50">
                    <div class="max-w-3xl mx-auto">
                        <?php if ($title) : ?>
                            <h2 class="text-3xl font-bold text-center mb-10"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        <?php if ( have_rows('faqs') ) : ?>
                            <div class="space-y-4">
                                <?php while ( have_rows('faqs') ) : the_row(); ?>
                                    <details class="border border-gray-200 rounded-lg bg-white">
                                        <summary class="cursor-pointer px-6 py-4 font-semibold text-lg">
                                            <?php echo esc_html( get_sub_field('question') ); ?>
                                        </summary>
                                        <div class="px-6 pb-4 text-gray-600">
                                            <?php echo wp_kses_post( get_sub_field('answer') ); ?>
                                        </div>
                                    </details>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: CTA                                ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'cta' ) : 
                $content = get_sub_field('content');
            ?>

                <section class="py-20 px-6 bg-blue-600 text-white text-center">
                    <div class="max-w-3xl mx-auto prose prose-lg prose-invert">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: CTA 2                              ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'cta_2' ) : 
                $content = get_sub_field('content');
            ?>

                <section class="py-20 px-6 bg-gray-900 text-white text-center">
                    <div class="max-w-3xl mx-auto prose prose-lg prose-invert">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Icons                              ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'icons' ) : 
                $intro = get_sub_field('intro_content');
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-6xl mx-auto">
                        <?php if ($intro) : ?>
                            <div class="text-center prose mx-auto mb-12"><?php echo wp_kses_post($intro); ?></div>
                        <?php endif; ?>
                        <?php if ( have_rows('icons') ) : ?>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                                <?php while ( have_rows('icons') ) : the_row(); ?>
                                    <div class="p-4">
                                        <?php // Add your icon sub-fields here ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: How to Order                       ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'how_to_order' ) : 
                $intro = get_sub_field('intro');
            ?>

                <section class="py-16 px-6 bg-gray-50">
                    <div class="max-w-4xl mx-auto">
                        <?php if ($intro) : ?>
                            <div class="text-center prose mx-auto mb-12"><?php echo wp_kses_post($intro); ?></div>
                        <?php endif; ?>
                        <?php if ( have_rows('how_to_order') ) : ?>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <?php $step = 1; while ( have_rows('how_to_order') ) : the_row(); ?>
                                    <div class="text-center p-6 bg-white rounded-lg shadow">
                                        <div class="text-4xl font-bold text-blue-600 mb-4"><?php echo $step; ?></div>
                                        <?php // Add your step sub-fields here ?>
                                    </div>
                                <?php $step++; endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Why Choose / Location              ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'why_choose' ) : 
                $intro = get_sub_field('intro');
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-6xl mx-auto">
                        <?php if ($intro) : ?>
                            <div class="prose mx-auto mb-12"><?php echo wp_kses_post($intro); ?></div>
                        <?php endif; ?>
                        <?php if ( have_rows('location') ) : ?>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <?php while ( have_rows('location') ) : the_row(); ?>
                                    <div class="p-6 bg-white rounded-lg shadow">
                                        <?php // Add your location sub-fields here ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: Dosage                             ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'dosage' ) : 
                $intro = get_sub_field('intro');
            ?>

                <section class="py-16 px-6">
                    <div class="max-w-4xl mx-auto">
                        <?php if ($intro) : ?>
                            <div class="prose mx-auto mb-12"><?php echo wp_kses_post($intro); ?></div>
                        <?php endif; ?>
                        <?php if ( have_rows('dosage') ) : ?>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <?php while ( have_rows('dosage') ) : the_row(); ?>
                                    <div class="p-6 bg-white rounded-lg shadow text-center">
                                        <?php // Add your dosage sub-fields here ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


            <?php // ========================================== ?>
            <?php // MODULE: HTML (raw code)                    ?>
            <?php // ========================================== ?>
            <?php elseif ( get_row_layout() == 'html' ) : 
                $content = get_sub_field('content');
            ?>

                <div class="raw-html-module">
                    <?php echo $content; // Raw HTML, no escaping ?>
                </div>


            <?php // ========================================== ?>
            <?php // FALLBACK: Unknown module                   ?>
            <?php // ========================================== ?>
            <?php else : ?>
                <!-- Unknown module: <?php echo esc_html( get_row_layout() ); ?> -->

            <?php endif; ?>

        <?php endwhile; // end modules loop ?>
    <?php else : ?>
        <?php the_content(); // No modules? Show regular content ?>
    <?php endif; ?>

<?php endwhile; // end WordPress loop ?>
</main>
</div>

<?php get_footer(); ?>
```

---

## Approach B: One File Per Module (reusable)

This is the `template-modular.php` + `modules/content-*.php` approach already set up.
Use this when multiple pages share the same modules.

---

## When to Use Which

| Scenario | Use |
|----------|-----|
| Homepage — unique design, full control | **Approach A**: `page-homepage.php` |
| About page — unique layout | **Approach A**: `page-about.php` |
| 10 pages that all use the same FAQ style | **Approach B**: `modules/content-faqs.php` |
| Mix of both | **Both!** Page file + shared modules |

You can even **mix both approaches**: code some modules inline and load shared ones:

```php
<?php if ( get_row_layout() == 'header_image' ) : ?>
    <!-- coded inline right here -->
    <section>...</section>

<?php elseif ( get_row_layout() == 'faqs' ) : ?>
    <!-- load from shared module file -->
    <?php get_template_part('modules/content', 'faqs'); ?>

<?php endif; ?>
```
