<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title>
        <?php wp_title(''); ?>
        <?php if (wp_title('', false)) {
            echo ' | ';
        } ?>
        <?php bloginfo('name'); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php require_once get_template_directory() . '/template-parts/header/header.php'; ?>
