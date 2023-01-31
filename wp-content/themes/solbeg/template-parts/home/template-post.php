<?php
$blog_post = $args['blogPost'];
$max_page = $blog_post->max_num_pages;
$pages = [];
$current_page = $blog_post->query['paged'];

if (!empty($blog_post)):
    if ($blog_post->have_posts()) :
        while ($blog_post->have_posts()) : $blog_post->the_post();
            ?>
            <div class="col-lg-4 col-12">
                <div class="post-card">
                    <?php if (!empty(get_the_post_thumbnail_url())): ?>
                        <img class="post-card-img" src="<?= get_the_post_thumbnail_url() ?>" alt=""/>
                    <?php endif; ?>
                    <div class="post-card-text">
                        <div class="post-card-text-caracter">
                            <?php foreach (get_the_terms(get_the_ID(), 'park_category') as $category): ?>
                                <div class="post-card-text-caracter-item"><?= $category->name ?></div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (!empty(get_post_field('post_title'))): ?>
                            <div class="post-card-text-title"><?= get_post_field('post_title') ?></div>
                        <?php endif; ?>
                        <div class="description">
                            <?php $description = explode(" ", get_post_field('description'));
                            $count = count($description);
                            if ($count > 10) {
                                array_splice($description, 10);
                                $description = implode(' ', $description) . ' ...';
                            } else {
                                $description = get_post_field('description') . ' ...';
                            }
                            ?>
                            <div><?= $description ?></div>
                            <?php
                            if( !empty( get_post_field('_location' ) ) ):
                            ?>
                            <a class="location" href="<?= get_post_field('_location') ?>" >Click here to see location</a>
                            <?php
                        endif;
                            ?>
                        </div>
                        <a href="<?= get_permalink() ?>">
                            <button class="button-green-ligth-var">
                                <p>Read more</p>
                                <div class="arrow-green-sm ">
                                    <img class="static"
                                         src="<?= get_stylesheet_directory_uri() ?>/assets/images/right-sm.svg" alt=""/>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile;
    endif;
endif;
?>
<?php
if ($max_page > 1 && !empty($current_page)):
    ?>
    <div class="case-pagination" id="pagination">
        <div class="case-pagination-number">
            <?php
            $firstNumber = ($current_page - 1) > 1 ? $current_page - 1 : 1;
            $lastNumber = ($current_page + 1) <= $max_page ? $current_page + 1 : $current_page;
            if (($current_page - 1) > 2):
                ?>
                <a class="pagination" data-page="1">1</a>
                <div>...</div>
            <?php
            endif;
            ?>
            <?php
            for ($i = $firstNumber; $i <= $lastNumber; $i++):?>
                <a class="pagination <?= $current_page == $i ? 'actual-page' : '' ?>"
                   data-page="<?= $i ?>"><?= $i ?></a>
                <?php
                if ($i == $lastNumber && ($max_page - $lastNumber) > 1):
                    ?>
                    <div>...</div>
                    <a class="pagination" data-page="<?= $max_page ?>"><?= $max_page ?></a>
                <?php
                endif;
            endfor; ?>
        </div>
    </div>
<?php
endif;
?>