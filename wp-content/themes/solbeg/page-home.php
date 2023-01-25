<?php

/*
    Template Name: Home Page
*/
get_header();

$args = array(
    'post_type' => 'parks',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'order' => 'ASC',
);
$blog_post = new WP_Query($args);


//$args = array(
//    'post_type' => 'parks',
//    'post_status' => 'publish',
//    'posts_per_page' => 6,
//    'paged' => 1,
//    'order' => 'ASC',
//    'tax_query' => [
//        [
//            'taxonomy' => 'park_category',
//            'terms' => 18,
//            'include_children' => false
//        ],
//    ],
//
//);
//$blog_post = new WP_Query($args);
$cats = get_terms( 'park_category' );
?>

<main>
    <section class="post">
        <div class="post-content" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)">
            <?php if(!empty(get_post_field( 'post_title'))):?>
                <h1><?= get_post_field( 'post_title') ?></h1>
            <?php endif;?>
            <?php if(!empty(get_post_field( 'post_content'))):?>
                <div class="post-tab"><?= get_post_field( 'post_content')?></div>
            <?php endif;?>
        </div>
        <div class="container">
            <div class="row padding">
                <?php if(count($cats) > 0): ?>
                <div class="col-lg-3 col-12">
                    <div class="categories" data-id="">All categories</div>
                </div>
                <?php
                endif;
                ?>
                <?php foreach ($cats as $cat):
                if($cat->count > 0):?>
                <div class="col-lg-3 col-12">
                    <div class="categories" data-id="<?= $cat->term_id ?>"><?= $cat->name ?></div>
                </div>
                <?php
                endif;
                endforeach;
                ?>
            </div>
            <div class="row">
<?php
    if ($blog_post->have_posts()) :
        while ($blog_post->have_posts()) : $blog_post->the_post();
            ?>

                                <div class="col-lg-4 col-12">
                                    <div class="post-card">
                                        <?php if(!empty( get_the_post_thumbnail_url() )):?>
                                            <img class="post-card-img" src="<?= get_the_post_thumbnail_url() ?>" alt=""/>
                                        <?php endif;?>
                                        <div class="post-card-text">
                                            <div class="post-card-text-caracter">
                                                <?php foreach (get_the_terms(get_the_ID(), 'park_category') as $category):?>
                                                    <div class="post-card-text-caracter-item"><?= $category->name ?></div>
                                                <?php endforeach;?>
                                            </div>
                                            <?php if(!empty(get_post_field( 'post_title'))):?>
                                                <div class="post-card-text-title"><?= get_post_field( 'post_title') ?></div>
                                            <?php endif;?>
                                            <a href="<?=get_permalink()?>">
                                                <button class="button-green-ligth-var">
                                                        <p>Read more</p>
                                                    <div class="arrow-green-sm ">
                                                        <img class="static" src="<?=get_stylesheet_directory_uri()?>/assets/images/right-sm.svg" alt=""/>
                                                    </div>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>

        <?php endwhile;
    endif;
        ?>
                <?php
                if($blog_post->max_num_pages > 1):
                ?>
                <div class="case-pagination" id="pagination">
                    <div class="case-pagination-prev ">
                        <button>
                            <img src="<?=get_stylesheet_directory_uri()?>/assets/images/prev.svg" alt=""/>
                        </button>
                    </div>
                        <div class="case-pagination-number">
                        <?= $blog_post->max_num_pages ?>
                        </div>
                    <div class="case-pagination-next ">
                        <button>
                            <img src="<?=get_stylesheet_directory_uri()?>/assets/images/next.svg" alt=""/>
                        </button>
                    </div>
                </div>
                    <?php
                endif;
                    ?>
            </div>
        </div>
    </section>

</main>


<?php

get_footer();