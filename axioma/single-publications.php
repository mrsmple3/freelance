<?php
get_header();
?>

    <div class="container">
        <?php
        breadrumbs();
        ?>
        <?= the_title('<p class="">', '</p>'); ?>
        <?= get_field('publications_text')?>
    </div>


<?php
get_footer();
