<?php
get_header();
$news_page_id = 46;
?>

<div class="container">
    <?php
    breadrumbs();
    ?>
    <?= the_title('<p class="">', '</p>'); ?>
    <?= get_field('news_text')?>
</div>


<?php
get_footer();
