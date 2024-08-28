<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Axioma_Prime
 */

?>








<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i><?= get_bloginfo('name'); ?>
                    </h6>
                    <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Страницы
                    </h6>
                    <!--Manu-->
                    <?php
                    $locations = get_nav_menu_locations();
                    $menu_items = wp_get_nav_menu_items($locations['primary-menu']);
                    foreach ($menu_items as $n => $menu_item) {
                        // Проверяем, что элемент меню является родительским
                        if ($menu_item->menu_item_parent == 0) {
                            echo '<p>';
                            echo '<a href="' . esc_url($menu_item->url) . '" class="text-reset">' . esc_html($menu_item->title) . '</a>';
                            echo '</p>';
                        }
                    }
                    ?>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Контакты
                    </h6>

                    <!--Phone-->
                    <?php
                    $phone = get_theme_mod('phone', '');
                    if (!empty($phone)) {
                        echo '<p>';
                        echo '<a href="tel:'.esc_html($phone).'" class="">'.esc_html($phone).'</a>';
                        echo '</p>';
                    }
                    ?>

                    <!--Email-->
                    <?php
                    $mail = get_theme_mod('email', '');
                    if (!empty($mail)) {
                        echo '<p>';
                        echo '<a href="mailto:'.esc_html($mail).'" class="text-reset">'.esc_html($mail).'</a>';
                        echo '</p>';
                    }
                    ?>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->



<?php wp_footer(); ?>

</body>
</html>
