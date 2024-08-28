<?php
/**
 * Template Name: Стоимость услуг
 */

get_header();
?>
<div class="container">
    <?php
    breadrumbs();
    ?>


    <h1 class=""><?= the_title()?></h1>

    <div>
        <?= get_field('service_page_description')?>
    </div>

    <h2>БУХГАЛТЕСКИЕ УСЛУГИ</h2>
    <?php
    // Выводим данные из бух услуг
    $interator = 0;
    if (have_rows('service_page_accounting')) :
        $interator++;
        while (have_rows('service_page_accounting')) : the_row();
            $title = get_sub_field('service_page_accounting_title');
            $description = get_sub_field('service_page_accounting_description');
            $price = get_sub_field('service_page_accounting_price');
            ?>
            <div class="d-flex">
                <p><?= $interator?></p>
                <p><?= esc_html($title)?></p>
                <p><?= esc_html($description)?></p>
                <p><?= esc_html($price)?></p>
            </div>
        <?php
        endwhile;
    endif;
    ?>





    <h2>ЮРИДИЧЕСКИЕ УСЛУГИ</h2>
    <?php
    // Получаем данные из группы "service_page_legal"
    $service_page_legal = get_field('service_page_legal');

    if ($service_page_legal) {
        // Выводим данные из услуг для физ лиц
        if (isset($service_page_legal['service_page_legal_individuals']) && $service_page_legal['service_page_legal_individuals']) {
            echo '<h2>Услуги для физических лиц:</h2>';
            echo '<ul class="list-unstyled">';
            foreach ($service_page_legal['service_page_legal_individuals'] as $individual) {
                echo '<div class="d-flex">';
                echo '<li>' . esc_html($individual['service_page_legal_individuals_title']) . '</li>';
                echo '<li>' . esc_html($individual['service_page_legal_individuals_price']) . '</li>';
                echo '</div>';
            }
            echo '</ul>';
        }

        // Выводим данные из услуг для юр лиц
        if (isset($service_page_legal['service_page_legal_entities']) && $service_page_legal['service_page_legal_entities']) {
            echo '<h2>Услуги для юридических лиц:</h2>';
            echo '<ul class="list-unstyled">';
            foreach ($service_page_legal['service_page_legal_entities'] as $entity) {
                echo '<div class="d-flex">';
                echo '<li>' . esc_html($entity['service_page_legal_entities_title']) . '</li>';
                echo '<li>' . esc_html($entity['service_page_legal_entities_price']) . '</li>';
                echo '<li>' . esc_html($entity['service_page_legal_entities_desc']) . '</li>';
                echo '</div>';

            }
            echo '</ul>';
        }
    }
    ?>
</div>




<?php get_footer();?>
