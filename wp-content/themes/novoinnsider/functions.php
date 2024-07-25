<?php 
/* 
* Novo Innsider functions
*
*/

date_default_timezone_set('America/Bogota');

setlocale(LC_TIME, 'es.ES.UTF-8');

setlocale(LC_TIME, 'spanish');

/**
 * 
 * Load Custom login register 
 */
require_once 'inc/custom-login-and-register/custom-login-and-register.php';

/**
 * 
 * Load Custom validation User 
 */
// require_once 'inc/custom-validation-user/custom-validation-user.php';


/**
 * 
 * Load Custom Class Nav
 */
require_once 'inc/custom-class-nav/custom-class-nav.php';

/**
 * 
 * Load Custom post types
 */
require_once 'inc/post-types/post-types.php';



function novo_inssider_support()
{
    add_theme_support('custom-logo');

    add_theme_support('post-thumbnails');

    add_theme_support('category-thumbnails');

    add_theme_support('title_tag');
}    

add_action('after_setup_theme', 'novo_inssider_support');

// Función para agregar una clase a la imagen del logotipo personalizado
function custom_logo_class($html) {
    $html = str_replace('custom-logo', 'custom-logo mx-2', $html);
    return $html;
}
add_filter('get_custom_logo', 'custom_logo_class');

/*
* Register and Enqueue Styles.
*/

function novo_inssider_styles()
{

    $version = rand(0, 1000);
    wp_enqueue_style('style-co', get_stylesheet_uri(), array(), $version);
    
}

add_action('wp_enqueue_scripts', 'novo_inssider_styles');


/**
 * Register and Enqueue Scripts 
 */
function novo_inssider_scripts()
{       
    $version = rand(0, 1000);
    wp_enqueue_script('main-co', get_template_directory_uri() . '/main.js', array(), $version, false);

    wp_localize_script('main-co', 'ajax_object',
        [
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('ajax_check'),
            'site_url' => get_site_url()
        ]
    );

}    

add_action('wp_enqueue_scripts', 'novo_inssider_scripts');

/**
 * Register navigation menus.
 */
function novo_inssider_menus()
{

    $locations = array(
        'primary' => __('Menú principal', 'novo_inssider'),
    );

    register_nav_menus($locations);
}

add_action('init', 'novo_inssider_menus');


/**
 * Function name user
*/
function novo_innsider_name_user()
{
    $userData = wp_get_current_user();

    $full_name = get_user_meta($userData->ID, 'first_name', true);
    $emai_user =  $userData->user_email;
    $document = get_user_meta($userData->ID, 'document_number', true);

    $data = [
        'name' => $full_name,
        'email' => $emai_user,
        'document' => $document
    ];

    return $data;
}

/**
 * Function logout
*/
function novo_innsider_logout()
{
    return '<a class="" href="'. wp_logout_url(home_url()) .'">Cerrar sesión</a>';
}


/**
 * Adds support for menu link class (<a>) in wp_nav_menu.
 *
 * @param array $atts The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 *
 * @return mixed
 */
function novo_inssider_add_menu_link_class($atts, $item, $args)
{

    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'novo_inssider_add_menu_link_class', 1, 3);

/**
 * Adds support for menu item class (<li>) in wp_nav_menu.
 *
 * @param string[] $classes Array of the CSS classes that are applied to the menu item's <li> element.
 * @param WP_Post $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 *
 * @return mixed
 */
function novo_inssider_add_menu_list_item_class($classes, $item, $args)
{

    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'novo_inssider_add_menu_list_item_class', 1, 3);

/**
 * Adds .active class to menu link <a> depending on current location.
 *
 * @param string[] $classes The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post $item The current menu item.
 *
 * @return mixed
 */
function novo_inssider_special_menu_class($classes, $item)
{

    if (
        in_array('current-post-ancestor', $classes, true) ||
        in_array('current-page-ancestor', $classes, true) ||
        in_array('current-menu-item', $classes, true)
    ) {
        $classes[] = 'active';
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'novo_inssider_special_menu_class', 10, 2);

/**
 * Function return list categories
 * @return string
 */
function novo_inssider_get_list_categories()
{
    return novo_inssider_get_list_subcategories(0);
}

/**
 * Function return category
 * @param $id
 */
function novo_inssider_get_category($id)
{
    return get_category($id);
}

/**
 * Function return list subcategories
 *
 * @param $parent
 *
 * @return string
 */
function novo_inssider_get_list_subcategories($parent)
{
    $result = "";

    $args = array(
        'taxonomy' => "category",
        'parent' => $parent,
        'hide_empty' => 0
    );

    $categories = get_categories($args);

    return $categories;
}

/**
 * Funcition Subcategory Template
 * @param $template
 * @return mixed
 */
function novo_inssider_subcategory_template($template)
{
    $cat = get_queried_object();
    if (0 < $cat->category_parent) {
        $template = locate_template('subcategory.php');
    }

    return $template;
}

add_filter('category_template', 'novo_inssider_subcategory_template');


?>