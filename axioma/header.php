<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Axioma_Prime
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
    <div class="container">


        <div class="header">
            <div class="logo">
                <!--Logo-->
                <?=the_custom_logo()?>
            </div>
            <nav class="menu">
                <!--Menu-->
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary-menu', // Укажите здесь ID вашего меню
                        'container' => false,
                        'items_wrap'     => '%3$s', // Убираем контейнер
                        'link_before'    => false, // Добавляем span перед текстом ссылки
                        'link_after'     => false, // Добавляем span после текста ссылки
                        'walker'         => new Custom_Walker_Nav_Menu(), // Используем кастомный walker для доп. функциональности
                    )
                );
                ?>
            </nav>

            <div class="phone-number">
                <?php
                $phone = get_theme_mod('phone', '');
                if (!empty($phone)) {
                    echo '<a href="tel:'.esc_html($phone).'" class="">'.esc_html($phone).'</a>';
                }
                ?>
            </div>
        </div>


    </div>
</header>





