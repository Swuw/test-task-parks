<?php

/*
    Template Name: Home Page
*/

$args = array(
    'post_type' => 'parks',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'paged' => 1,
    'order' => 'ASC',
);
$blog_post = new WP_Query($args);
$arr = [];
$arr['blogPost'] = $blog_post;
$cats = get_terms('park_category') ?: '';

get_header();
?>

    <main>
        <section class="post">
            <div class="post-content" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)">
                <?php if (!empty(get_post_field('post_title'))): ?>
                    <h1><?= get_post_field('post_title') ?></h1>
                <?php endif; ?>
                <?php if (!empty(get_post_field('post_content'))): ?>
                    <div class="post-tab"><?= get_post_field('post_content') ?></div>
                <?php endif; ?>
            </div>
            <div class="container">
                <div class="row margin">
                    <?php if (count($cats) > 0): ?>
                        <div class="col-lg-3 col-12 center">
                            <button class="categories green-hover" data-id="">
                                <span>All categories</span>
                            </button>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php foreach ($cats as $cat):
                        if ($cat->count > 0):?>
                            <div class="col-lg-3 col-12 center">
                                <button class="categories" data-id="<?= $cat->term_id ?>">
                                    <span><?= $cat->name ?></span>
                                </button>
                            </div>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </div>
                <div class="row cards-container">
                    <?php get_template_part("template-parts/home/template", "post", $arr); ?>
                </div>
            </div>
        </section>
    </main>
<?php

get_footer();