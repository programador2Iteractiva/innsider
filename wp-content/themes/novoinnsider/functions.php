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

/**
 * 
 * Load taxonomies
 */
require_once 'inc/taxonomies/taxonomies.php';

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

    if(is_user_logged_in()){
        $html = str_replace('custom-logo', 'custom-logo mx-5', $html);
        return $html;
    }else{
        $html = str_replace('custom-logo', 'custom-logo mx-2', $html);
        return $html;
    }
    
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
    $userData = wp_get_current_user();
    $full_name = get_user_meta($userData->ID, 'first_name', true);

    $version = rand(0, 1000);
    wp_enqueue_script('main-co', get_template_directory_uri() . '/main.js', array(), $version, false);

    wp_localize_script('main-co', 'ajax_object',
        [
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('ajax_check'),
            'site_url' => get_site_url(),
            'full_name' => $full_name,
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


function novo_innsider_display_user_name() {

    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $link_logout = novo_innsider_logout();
        $full_name = get_user_meta( $current_user->ID, 'first_name', true );

        return "

            <div class='container-user-btn'>
                <div class='half'>
                    <label for='profile2' class='profile-dropdown'>
                        <input type='checkbox' id='profile2'>
                        <span>Hola, {$full_name}</span>
                        <label for='profile2'><i class='bi bi-chevron-down'></i></label>
                        <ul>
                            <li>{$link_logout}</li>
                        </ul>
                    </label>
                </div>
            </div> 
        ";
    }
    else {
        return false;
    }

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
        $template = locate_template('category.php');
    }

    return $template;
}

add_filter('category_template', 'novo_inssider_subcategory_template');


/**
 * Toma el post-type por default que tiene el nombre de entradas en español y se ajusta
 * tambien los nombres en el administrador de las opciones y vistas internas segun las debamos asignar
 */
function cambiar_etiquetas_entrada() {
    global $wp_post_types;

    // Cambiar las etiquetas para el tipo de entrada "post"
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Academia';
    $labels->singular_name = 'Academia';
    $labels->add_new = 'Agregar Academia';
    $labels->all_items = 'Todas las Academia';
    $labels->add_new_item = 'Agregar Nueva Academia';
    $labels->edit_item = 'Editar Academia';
    $labels->new_item = 'Nueva Academia';
    $labels->view_item = 'Ver Academia';
    $labels->search_items = 'Buscar Academia';
    $labels->not_found = 'No se encontraron Academias';
    $labels->not_found_in_trash = 'No se encontraron Academia en la papelera';
}
add_action('init', 'cambiar_etiquetas_entrada');


/**
 * Toma el post-type por default que tiene el nombre de entradas en español y se ajusta
 * al nombre que debamos asignar
 */
function cambiar_nombre_menu_entrada() {
    global $menu;

    // Encuentra la posición del menú "Entradas" en el array $menu
    foreach ($menu as $key => $item) {
        if ($item[0] == 'Entradas') {
            // Cambia el nombre del menú
            $menu[$key][0] = 'Academia';
            break;
        }
    }
}
add_action('admin_menu', 'cambiar_nombre_menu_entrada');


/**
 * Desactivar comentarios en publicaciones y páginas
 */
function desactivar_comentarios() {
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('init', 'desactivar_comentarios');


/**
 * Desactivar menú de comentarios en el admin
*/
function eliminar_comentarios_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'eliminar_comentarios_admin_menu');


/**
 * Redirigir cualquier intento de acceso a la página de comentarios al panel de control
*/
function redirigir_a_panel_control() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit();
    }
}
add_action('admin_init', 'redirigir_a_panel_control');


/* Funcion que restringe el ingreso de usuarios con rol de Suscriptor al admin / Backend de Wordpress */
function restrict_admin_area_by_rol() {
    if ( ! current_user_can( 'manage_options' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
      wp_redirect( site_url() );
      exit;
    }
  }
  add_action( 'admin_init', 'restrict_admin_area_by_rol', 1 );


  
// Ocultar el plugin "login-customizer" del menú izquierdo del administrador y de "Apariencia" -> "Personalizar"
function ocultar_login_customizer_menu_personalizar() {
    // Identificador único de la página de opciones del plugin
    $plugin_page_id = 'login-customizer-settings';

    // Verificar si el plugin está activo
    if (is_plugin_active('login-customizer/login-customizer.php')) {
        global $menu, $submenu;

        // Ocultar en el menú izquierdo del administrador
        foreach ($menu as $key => $item) {
            if (isset($item[2]) && $item[2] === $plugin_page_id) {
                unset($menu[$key]);
                break;
            }
        }

    }
}

add_action('admin_menu', 'ocultar_login_customizer_menu_personalizar');


/**
 * Funcion que deshabilita categorias y tags del post Nuestras Historias
*/
function deshabilitar_categorias_y_etiquetas() {
    unregister_taxonomy_for_object_type('category', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

add_action('init', 'deshabilitar_categorias_y_etiquetas');


/**
 * Function get all academies
 */
function novo_inssider_get_all_academies()
{
    $list_academies = get_terms(
        array(
            'taxonomy' => 'academia',
            'hide_empty' => false,
        )
    );

    return $list_academies;
}


?>