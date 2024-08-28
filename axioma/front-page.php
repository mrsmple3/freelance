<?php
/**
 * Template Name: Главная Страница
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package merit
 */
$news_page_id = 46;
$publications_page_id = 53;

get_header();
?>

    <div class="category">

        <div class="container">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'service_category',
                'hide_empty' => false, // Показывать даже пустые категории
                'parent' => 0,

            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<div class="btn-group category__container" role="group" aria-label="Basic outlined example">';
                foreach ($terms as $term) {
    //                echo '<button type="button" class="btn btn-outline-primary">';
                    echo '<a class="btn btn-outline-primary menu__category" href="' . get_term_link($term) . '">' . $term->name . '</a>';
    //                echo '</button>';
                }
                echo '</div>';
            } else {
                echo 'Категории не найдены.';
            }

            ?>
        </div>
        <div class="container">
            <div class="btn-group category__container" role="group" aria-label="Basic outlined example">

            </div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Новости</h5>
                        <p class="card-text">
                            <?php
                            // Создаем новый запрос
                            $latest_news_query = new WP_Query(array(
                                'post_type'      => 'news',       // Указываем тип поста
                                'posts_per_page' => 1,            // Выводим только 1 пост
                                'orderby'        => 'date',       // Сортировка по дате
                                'order'          => 'DESC'        // От последнего к первому
                            ));

                            // Проверяем, есть ли посты
                            if ($latest_news_query->have_posts()) {
                                while ($latest_news_query->have_posts()) {
                                    $latest_news_query->the_post();
                                    // Выводим заголовок и контент
                                    the_title( );
                                }
                                // Восстанавливаем глобальные данные поста
                                wp_reset_postdata();
                            }
                            ?>

                        </p>
                        <a href="<?= get_page_link($news_page_id) ?>" class="btn btn-primary">
                            Все новости →
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Публикации</h5>
                        <p class="card-text">
                            <?php
                            // Создаем новый запрос
                            $latest_publications_query = new WP_Query(array(
                                'post_type'      => 'publications',       // Указываем тип поста
                                'posts_per_page' => 1,            // Выводим только 1 пост
                                'orderby'        => 'date',       // Сортировка по дате
                                'order'          => 'DESC'        // От последнего к первому
                            ));

                            // Проверяем, есть ли посты
                            if ($latest_publications_query->have_posts()) {
                                while ($latest_publications_query->have_posts()) {
                                    $latest_publications_query->the_post();
                                    // Выводим заголовок и контент
                                    the_title( );
                                }
                                // Восстанавливаем глобальные данные поста
                                wp_reset_postdata();
                            }
                            ?>

                        </p>
                        <a href="<?= get_page_link($publications_page_id) ?>" class="btn btn-primary">
                            Все публикации →
                        </a>
                    </div>
                </div>
            </div>
        </div>




    </div>


<?php
get_footer();
