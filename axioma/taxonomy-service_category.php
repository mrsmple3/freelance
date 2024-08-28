<?php

/**
 * Template Name:
 */


// Получаем текущую категорию
$current_category = get_queried_object();

// Получаем подкатегории текущей категории
$subcategories = get_terms([
    'taxonomy' => 'service_category',
    'parent' => $current_category->term_id,
    'hide_empty' => false,
]);

get_header();
?>
<div class="container">
    <?php
        breadrumbs();
    ?>


                        <?php if (!empty($subcategories) && !is_wp_error($subcategories)) :
                        ?>
                            <div class="tabs">
                                <?php foreach ($subcategories as $subcategory) : ?>
                                    <a href="javascript:void(0);" class="item-tab" data-subcategory-id="<?php echo esc_attr($subcategory->term_id); ?>">
                                        <?php echo esc_html($subcategory->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <div class="cads-product">
                                <!-- Контейнер для товаров подкатегорий -->
                            </div>
                        <?php endif; ?>

</div>



<?php get_footer(); ?>
