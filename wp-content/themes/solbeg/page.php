<?php
get_header();

if (have_posts()) {
    echo the_content();
}

get_footer();
