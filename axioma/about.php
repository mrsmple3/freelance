<?php
/**
 * Template Name: О компании
 */

get_header();
?>


<div class="container">
    <?php
    breadrumbs();
    ?>
    <h1 class=""><?= the_title()?></h1>

    <div>
        <?= get_field('about_pg_text')?>
    </div>

    <!--    --><?php //get_sidebar();?>

</div>


<?php get_footer();?>
