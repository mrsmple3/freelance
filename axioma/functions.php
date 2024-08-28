<?php
/**
 * Axioma Prime functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Axioma_Prime
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function axioma_prime_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Axioma Prime, use a find and replace
		* to change 'axioma-prime' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'axioma-prime', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'axioma-prime' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'axioma_prime_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'axioma_prime_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function axioma_prime_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'axioma_prime_content_width', 640 );
}
add_action( 'after_setup_theme', 'axioma_prime_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function axioma_prime_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'axioma-prime' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'axioma-prime' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'axioma_prime_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function axioma_prime_scripts() {
	wp_enqueue_style( 'axioma-prime-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'axioma-prime-style', 'rtl', 'replace' );

	wp_enqueue_script( 'axioma-prime-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('navigation', get_template_directory_uri() . '/assets/css/navigation.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');


    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', '1.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', '1.0', true);


}
add_action( 'wp_enqueue_scripts', 'axioma_prime_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function custom_theme_menus()
{
    register_nav_menus(
        array(
            'primary-menu' => 'Меню в шапке',
            'footer-menu'  => 'Меню в футере'
        )
    );
}
add_action('init', 'custom_theme_menus');


function theme_customizer_settings($wp_customize)
{
    // Add a section for custom settings
    $wp_customize->add_section('theme_custom_settings', array(
        'title'    => __('Axioma Info', 'your-theme-textdomain'),
        'priority' => 200,
    ));



    // Add a setting for custom option
    $wp_customize->add_setting('address', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address', array(
        'label'    => __('Адрес', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('phone', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone', array(
        'label'    => __('Номер телефона', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('email', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('email', array(
        'label'    => __('Email', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('work_time', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('work_time', array(
        'label'    => __('Временя работы', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

}
add_action('customize_register', 'theme_customizer_settings');




function custom_post_type()
{
    $labels = array(
        'name'               => __('Услуги'),
        'singular_name'      => __('Услуга'),
        'add_new'            => __('Добавить новую услугу'),
        'add_new_item'       => __('Добавить новую услугу'),
        'edit_item'          => __('Редактировать услугу'),
        'new_item'           => __('Новая услуга'),
        'all_items'          => __('Все услуги'),
        'view_item'          => __('Посмотреть услугу'),
        'search_items'       => __('Поиск услуги'),
        'not_found'          => __('Ничего не найдено'),
        'not_found_in_trash' => __('Ничего не найдено в корзине'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Услуги')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'       => array('slug' => 'services'),
        'menu_icon' => 'dashicons-media-document'
    );

    register_post_type('services', $args);



    $labels = array(
        'name'               => __('Новости'),
        'singular_name'      => __('Новость'),
        'add_new'            => __('Добавить новую новость'),
        'add_new_item'       => __('Добавить новую новость'),
        'edit_item'          => __('Редактировать новость'),
        'new_item'           => __('Новая новость'),
        'all_items'          => __('Все новости'),
        'view_item'          => __('Посмотреть новость'),
        'search_items'       => __('Поиск новости'),
        'not_found'          => __('Ничего не найдено'),
        'not_found_in_trash' => __('Ничего не найдено в корзине'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Новости')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'       => array('slug' => 'news'),
        'menu_icon' => 'dashicons-media-document'
    );

    register_post_type('news', $args);

    $labels = array(
        'name'               => __('Публикации'),
        'singular_name'      => __('Публикация'),
        'add_new'            => __('Добавить новую публикацию'),
        'add_new_item'       => __('Добавить новую публикацию'),
        'edit_item'          => __('Редактировать публикацию'),
        'new_item'           => __('Новая публикация'),
        'all_items'          => __('Все публикации'),
        'view_item'          => __('Посмотреть публикацию'),
        'search_items'       => __('Поиск публикации'),
        'not_found'          => __('Ничего не найдено'),
        'not_found_in_trash' => __('Ничего не найдено в корзине'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Публикации')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'       => array('slug' => 'publications'),
        'menu_icon' => 'dashicons-media-document'
    );

    register_post_type('publications', $args);


}
add_action('init', 'custom_post_type');

function custom_taxonomy_for_services()
{
    $labels = array(
        'name'              => __('Категории услуг'),
        'singular_name'     => __('Категория услуги'),
        'search_items'      => __('Поиск категорий'),
        'all_items'         => __('Все категории'),
        'parent_item'       => __('Родительская категория'),
        'parent_item_colon' => __('Родительская категория:'),
        'edit_item'         => __('Редактировать категорию'),
        'update_item'       => __('Обновить категорию'),
        'add_new_item'      => __('Добавить новую категорию'),
        'new_item_name'     => __('Новое имя категории'),
        'menu_name'         => __('Категории'),
    );

    $args = array(
        'hierarchical'      => true, // Позволяет создавать древовидную структуру, как в обычных категориях
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'service-category'),
        'show_in_rest'      => true, // Для поддержки в блоковом редакторе
    );

    register_taxonomy('service_category', array('services'), $args);
}
add_action('init', 'custom_taxonomy_for_services');



// Custom menu
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $active_class = in_array('current-menu-item', $classes) ? ' active' : '';

        $output .= '<a href="' . esc_url($item->url) . '" class="menu__link ' . $active_class . '">';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }
}


function breadrumbs(){
    ?>
    <nav data-mdb-navbar-init class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= home_url() ?>">Главная</a></li>
                    <li class="breadcrumb-item"><a href="#"><?= the_title()?></a></li>
                </ol>
            </nav>
        </div>
    </nav>
    <?php
}