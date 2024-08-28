<?php
/**
 * Template Name: Новости
 */

get_header();
?>

  <div class="container">
      <?php
      breadrumbs();
      ?>


      <h1 class=""><?= the_title()?></h1>




      <div class="news-container d-flex flex-column">
          <?php
          $args = array(
              'post_type' => 'news', // Указываем кастомный пост-тип
              'posts_per_page' => -1,    // Получаем все записи
          );

          $news_query = new WP_Query($args);
          if ($news_query->have_posts()) :
              while ($news_query->have_posts()) : $news_query->the_post();
                  $title = get_the_title();
                  ?>
                  <div class="card text-center mb-2">
                      <div class="card-header"><?=get_the_date('d.m.Y', get_the_ID())?></div>
                      <div class="card-body">
                          <h5 class="card-title"><?= esc_attr($title); ?></h5>
                          <p class="card-text"><?= get_field('news_text')?></p>
                      </div>
                      <div class="card-footer text-muted">
                          <a href="<?= get_permalink() ?>" class="news-btn btn-primary-else">Подробнее →</a>
                      </div>

                  </div>
              <?php
              endwhile;
          endif;
          ?>
      </div>

  </div>
<?php
get_footer();