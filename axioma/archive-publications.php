<?php
/**
 * Template Name: Публикации
 */

get_header();
?>

    <div class="container">
        <?php
        breadrumbs();
        ?>

        <h1 class=""><?= the_title()?></h1>


        <?php
        $args = array(
            'post_type' => 'publications', // Указываем кастомный пост-тип
            'posts_per_page' => -1,    // Получаем все записи
        );

        $publications_query = new WP_Query($args);
        if ($publications_query->have_posts()) :
            while ($publications_query->have_posts()) : $publications_query->the_post();
                $title = get_the_title();
                ?>
                <div class="card text-center mb-2">
                    <div class="card-header "><?=get_the_date('d.m.Y', get_the_ID())?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?= esc_attr($title); ?></h5>
                        <p class="card-text"><?= get_field('publications_text')?></p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="<?= get_permalink() ?>" class="publications-btn btn-primary-else">Подробнее →</a>
                    </div>

                </div>


            <?php
            endwhile;
        endif;
        ?>




        <?php
        $categories = get_categories(array(
            'taxonomy' => 'service_category', // Укажите вашу таксономию, если она отличается от 'category'
            'parent'   => 0,           // Только родительские категории
            'hide_empty' => false,     // Показывать даже пустые категории
        ));

        if ($categories) : ?>
            <div class="category-list">
                <?php foreach ($categories as $category) : ?>
                    <p>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseCategory<?php echo $category->term_id; ?>" role="button" aria-expanded="false" aria-controls="collapseCategory<?php echo $category->term_id; ?>">
                            <?php echo $category->name; ?>
                        </a>
                    </p>
                    <div class="collapse" id="collapseCategory<?php echo $category->term_id; ?>">
                        <div class="card card-body " style="border: none; padding: 0">
                            <?php
                            // Получаем подкатегории
                            $subcategories = get_categories(array(
                                'taxonomy' => 'service_category',
                                'parent'   => $category->term_id,
                                'hide_empty' => false,
                            ));

                            if ($subcategories) : ?>
                                <ul class="list-group">
                                    <?php foreach ($subcategories as $subcategory) : ?>
                                        <li class="list-group-item"><a class="text-decoration-none" href="<?php echo get_category_link($subcategory->term_id); ?>"><?php echo $subcategory->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <p>Подкатегорий нет.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>




        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                        Orders
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                        Products
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                        Customers
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>




    </div>
<?php
get_footer();