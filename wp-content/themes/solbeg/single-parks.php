<?php
$cats = get_terms('park_category');

get_header();

?>

    <div class="post-content" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)">
        <?php if (!empty(get_post_field('post_content'))): ?>
            <div class=""><?= get_post_field('post_content') ?></div>
        <?php endif; ?>
        <?php if (!empty(get_post_field('post_title'))): ?>
            <h1 class="post-name"><?= get_post_field('post_title') ?></h1>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="category-margin">Category:</div>
        <div class="post-card-text-caracter">
            <?php foreach (get_the_terms(get_the_ID(), 'park_category') as $category): ?>
                <div class="post-card-text-caracter-item"><?= $category->name ?></div>
            <?php endforeach; ?>
        </div>
        <div class="category-margin">Description:</div>
        <?php if (!empty(get_post_field('description'))): ?>
            <div class=""><?= get_post_field('description') ?></div>
        <?php endif; ?>
        <div class="col-12 col-lg-2 button-back">
            <button type="button" class="categories" onclick="history.back();">
                <span>Back</span>
            </button>
        </div>

    </div>


<?php
get_footer();

