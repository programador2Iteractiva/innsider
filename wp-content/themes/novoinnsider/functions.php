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
 * Load Custom help support
 */
require_once 'inc/custom-help-support/custom-help-support.php';


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
// function custom_logo_class($html) {

//     if(is_user_logged_in()){
//         $html = str_replace('custom-logo', 'custom-logo mx-2', $html);
//         return $html;
//     }else{
//         $html = str_replace('custom-logo', 'custom-logo mx-2', $html);
//         return $html;
//     }

// }
// add_filter('get_custom_logo', 'custom_logo_class');

/*
* Register and Enqueue Styles.
*/

function novo_inssider_styles()
{

    $version = wp_get_theme()->get('Version'); // Usa la versión del tema
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

    $version = filemtime(get_template_directory() . '/main.js');
    wp_enqueue_script('main-co', get_template_directory_uri() . '/main.js', array(), $version, false);

    wp_localize_script(
        'main-co',
        'ajax_object',
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
        'secundary' => __('Menú principal Movil', 'novo_inssider'),
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
    return '<a class="" href="' . wp_logout_url(home_url()) . '">Cerrar sesión</a>';
}


function novo_innsider_display_user_name()
{

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $link_logout = novo_innsider_logout();
        $full_name = get_user_meta($current_user->ID, 'first_name', true);

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
    } else {
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
function cambiar_etiquetas_entrada()
{
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
function cambiar_nombre_menu_entrada()
{
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
function desactivar_comentarios()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('init', 'desactivar_comentarios');


/**
 * Desactivar menú de comentarios en el admin
 */
function eliminar_comentarios_admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'eliminar_comentarios_admin_menu');


/**
 * Redirigir cualquier intento de acceso a la página de comentarios al panel de control
 */
function redirigir_a_panel_control()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit();
    }
}
add_action('admin_init', 'redirigir_a_panel_control');


/* Funcion que restringe el ingreso de usuarios con rol de Suscriptor al admin / Backend de Wordpress */
function restrict_admin_area_by_rol()
{
    if (! current_user_can('manage_options') && (! defined('DOING_AJAX') || ! DOING_AJAX)) {
        wp_redirect(site_url());
        exit;
    }
}
add_action('admin_init', 'restrict_admin_area_by_rol', 1);



// Ocultar el plugin "login-customizer" del menú izquierdo del administrador y de "Apariencia" -> "Personalizar"
function ocultar_login_customizer_menu_personalizar()
{
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
function deshabilitar_categorias_y_etiquetas()
{
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

function novo_inssider_get_all_academies_actives()
{
    global $wpdb;

    $taxonomy = 'academia';
    $meta_key = 'Status_Categories';
    $meta_value = '1';

    // Construir el nombre de la tabla termmeta
    $table_termmeta = $wpdb->prefix . 'termmeta';

    // Obtener los IDs de términos que cumplen con el meta valor
    $term_ids = $wpdb->get_col($wpdb->prepare(
        "SELECT term_id 
        FROM {$table_termmeta}
        WHERE meta_key = %s
        AND meta_value = %s",
        $meta_key,
        $meta_value
    ));

    if (empty($term_ids)) {
        return array(); // Si no hay términos, devolver un arreglo vacío
    }

    // Obtener los términos que tienen los IDs obtenidos
    $list_academies = get_terms(array(
        'taxonomy' => $taxonomy,
        'include' => $term_ids,
        'hide_empty' => false,
    ));

    return $list_academies;
}

function novo_inssider_get_all_visioninnsider_category_actives()
{
    global $wpdb;

    $taxonomy = 'visioninnsider-category';
    $meta_key = 'Status_Categories';
    $meta_value = '1';

    // Construir el nombre de la tabla termmeta
    $table_termmeta = $wpdb->prefix . 'termmeta';

    // Obtener los IDs de términos que cumplen con el meta valor
    $term_ids = $wpdb->get_col($wpdb->prepare(
        "SELECT term_id 
        FROM {$table_termmeta}
        WHERE meta_key = %s
        AND meta_value = %s",
        $meta_key,
        $meta_value
    ));

    if (empty($term_ids)) {
        return array(); // Si no hay términos, devolver un arreglo vacío
    }

    // Obtener los términos que tienen los IDs obtenidos
    $list_academies = get_terms(array(
        'taxonomy' => $taxonomy,
        'include' => $term_ids,
        'hide_empty' => false,
    ));

    return $list_academies;
}


function novo_inssider_get_all_trends_actives()
{
    global $wpdb;

    $taxonomy = 'tendencias';
    $meta_key = 'Status_Categories';
    $meta_value = '1';

    // Construir el nombre de la tabla termmeta
    $table_termmeta = $wpdb->prefix . 'termmeta';

    // Obtener los IDs de términos que cumplen con el meta valor
    $term_ids = $wpdb->get_col($wpdb->prepare(
        "SELECT term_id 
        FROM {$table_termmeta}
        WHERE meta_key = %s
        AND meta_value = %s",
        $meta_key,
        $meta_value
    ));

    if (empty($term_ids)) {
        return array(); // Si no hay términos, devolver un arreglo vacío
    }

    // Obtener los términos que tienen los IDs obtenidos
    $list_trends = get_terms(array(
        'taxonomy' => $taxonomy,
        'include' => $term_ids,
        'hide_empty' => false,
    ));

    return $list_trends;
}

/* breadcrumb */
function custom_breadcrumbs()
{
    // Obtén el nombre del sitio
    $home = 'Inicio'; // Cambia este texto si lo deseas

    // Obtén el objeto global de la consulta
    global $post;

    // Si estamos en la página de inicio, no mostrar breadcrumbs
    if (is_front_page()) {
        return;
    }

    // Inicializa el breadcrumb
    echo '<nav class="breadcrumbs">';
    echo '<a class="" style="text-decoration:none !important" href="' . esc_url(home_url()) . '">' . esc_html($home) . '</a> / ';
    $page = get_page_by_title('Academia');
    $page_id = $page->ID;
    $page_url = get_permalink($page_id);

    // Breadcrumbs para páginas
    if (is_page() && !is_page($page_id) && !is_page('vision-innsider')) {
        echo '<span>' . esc_html(get_the_title()) . '</span>';
    } elseif (is_page('vision-innsider')) {
        echo '<span>' . 'Podcast iNNsider' . '</span>';
    } elseif (is_page() && is_page($page_id)) {
        echo '<span>' . wp_redirect($page_url) . '</span>';
    }

    // Breadcrumbs para la taxonomía 'academia'
    if (is_tax('academia')) {
        $term = get_queried_object();

        // Muestra el nombre de la taxonomía
        echo '<a href="' . esc_url(get_permalink(get_page_by_path('academia'))) . '">Academia</a> / ';

        // Si hay ancestros, muéstralos
        if ($term->parent) {
            $ancestors = get_ancestors($term->term_id, 'academia');
            foreach (array_reverse($ancestors) as $ancestor_id) {
                $ancestor = get_term($ancestor_id, 'academia');
                echo '<a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a> / ';
            }
        }

        echo '<span>' . esc_html($term->name) . '</span>';
    }

    elseif (is_tax('visioninnsider-category')) {
        $term = get_queried_object();

        // Muestra el nombre de la taxonomía
        echo '<a href="' . esc_url(get_permalink(get_page_by_path('vision-innsider'))) . '">Podcast iNNsider</a> / ';

        // Si hay ancestros, muéstralos
        if ($term->parent) {
            $ancestors = get_ancestors($term->term_id, 'vision-innsider');
            foreach (array_reverse($ancestors) as $ancestor_id) {
                $ancestor = get_term($ancestor_id, 'visioninnsider-category');
                echo '<a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a> / ';
            }
        }

        echo '<span>' . esc_html($term->name) . '</span>';
    }

    // Breadcrumbs para categorías
    elseif (is_category()) {
        $category = get_queried_object();
        echo '<a href="' . esc_url(get_permalink(get_page_by_path('academia'))) . '">Academia</a> / ';

        // Si hay ancestros, muéstralos
        if ($category->parent) {
            $ancestors = get_ancestors($category->term_id, 'category');
            foreach (array_reverse($ancestors) as $ancestor_id) {
                $ancestor = get_category($ancestor_id);
                echo '<a href="' . esc_url(get_category_link($ancestor_id)) . '">' . esc_html($ancestor->name) . '</a> / ';
            }
        }

        echo '<span>' . esc_html($category->name) . '</span>';
    }

    // Breadcrumbs para subcategorías de academia
    elseif (is_category() && !is_tax('academia')) {
        $category = get_queried_object();
        echo '<a href="' . esc_url(get_permalink(get_page_by_path('academia'))) . '">Academia</a> / ';

        // Mostrar la categoría actual
        echo '<span>' . esc_html($category->name) . '</span>';
    }

    // Breadcrumbs para posts individuales
    elseif (is_single()) {

        if (is_singular('tendencia')) {
            // Agregar enlace a "Tendencias"
            $tendencia_page = get_page_by_title('Tendencias');
            $tendencia_url = get_permalink($tendencia_page->ID);
            echo '<a href="' . esc_url($tendencia_url) . '">Tendencias</a> / ';
            
            // Mostrar el título del post actual
            echo '<span>' . esc_html(get_the_title()) . '</span>';
        }elseif (is_singular('herramientas')) {
            // Agregar enlace a "Tendencias"
            $tendencia_page = get_page_by_title('Herramientas');
            $tendencia_url = get_permalink($tendencia_page->ID);
            echo '<a href="' . esc_url($tendencia_url) . '">Herramientas</a> / ';
            
            // Mostrar el título del post actual
            echo '<span>' . esc_html(get_the_title()) . '</span>';
        }elseif (is_singular('innsiderdata')) {
            // Agregar enlace a "Tendencias"
            $tendencia_page = get_page_by_title('Innsider Data');
            $tendencia_url = get_permalink($tendencia_page->ID);
            echo '<a href="' . esc_url($tendencia_url) . '">INNSIDER DATA</a> / ';
            
            // Mostrar el título del post actual
            echo '<span>' . esc_html(get_the_title()) . '</span>';
        }elseif(is_singular('vision-innsiders')){

            $termsacademia = get_the_terms($post->ID, 'visioninnsider-category');

            if ($termsacademia && !is_wp_error($termsacademia)) {
    
                // Agregar el enlace de "Academia" antes de mostrar los términos
                $academia_page = get_page_by_title('Visión iNNsider');
                $academia_url = get_permalink($academia_page->ID);
                echo '<a href="' . esc_url($academia_url) . '">Podcast iNNsider</a> / ';
    
    
                $main_term = $termsacademia[0];
                if ($main_term->parent) {
                    $ancestors = get_ancestors($main_term->term_id, 'academia');
                    foreach (array_reverse($ancestors) as $ancestor_id) {
                        $ancestor = get_term($ancestor_id, 'academia');
                        echo '<a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a> / ';
                    }
                }
                echo '<a href="' . esc_url(get_term_link($main_term)) . '">' . esc_html($main_term->name) . '</a> / ';
            }
            
            echo '<span>' . esc_html(get_the_title()) . '</span>';
            
        }else{

            $termsacademia = get_the_terms($post->ID, 'academia');

            if ($termsacademia && !is_wp_error($termsacademia)) {
    
                // Agregar el enlace de "Academia" antes de mostrar los términos
                $academia_page = get_page_by_title('Academia');
                $academia_url = get_permalink($academia_page->ID);
                echo '<a href="' . esc_url($academia_url) . '">Academia</a> / ';
    
    
                $main_term = $termsacademia[0];
                if ($main_term->parent) {
                    $ancestors = get_ancestors($main_term->term_id, 'academia');
                    foreach (array_reverse($ancestors) as $ancestor_id) {
                        $ancestor = get_term($ancestor_id, 'academia');
                        echo '<a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a> / ';
                    }
                }
                echo '<a href="' . esc_url(get_term_link($main_term)) . '">' . esc_html($main_term->name) . '</a> / ';
            }
            
            echo '<span>' . esc_html(get_the_title()) . '</span>';
    
        }

    }
    

    echo '</nav>';
}




function obtenerMiniaturaVimeo($videoUrl)
{
    $parsedUrl = parse_url($videoUrl);

    // Construye la parte que te interesa (path + query)
    $videoPath = isset($parsedUrl['path']) ? ltrim($parsedUrl['path'], '/') : '';
    $videoQuery = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';

    // Combina la ruta y la consulta
    $videoId = $videoPath . ($videoQuery ? '?' . $videoQuery : '');

    // URL base de la API de Vimeo
    $base_url = "https://vimeo.com/api/oembed.json?url=https://vimeo.com/";

    // Construye la URL completa con el ID del video
    $url = $base_url . $videoId;

    // Realiza una solicitud GET a la API de Vimeo usando wp_remote_get
    $response = wp_remote_get($url);

    // Verifica si la solicitud fue exitosa
    if (is_wp_error($response)) {
        // Maneja el error aquí, por ejemplo, registrando el error o mostrando un mensaje al usuario
        $error_message = $response->get_error_message();
        error_log("Error al obtener el contenido de Vimeo: " . $error_message);
        return null;
    }

    // Obtiene el cuerpo de la respuesta
    $body = wp_remote_retrieve_body($response);

    // Decodifica el JSON obtenido en un array asociativo
    $data = json_decode($body, true);

    // Extrae la URL de la miniatura del array
    $thumbnail_url = isset($data['thumbnail_url']) ? $data['thumbnail_url'] : null;

    if ($thumbnail_url) {
        $thumbnail_url = str_replace('_295x166', '_1280x720', $thumbnail_url);
    }

    return $thumbnail_url;
}


function importInstitutions()
{
    global $wpdb;


    $institutions = [
        'VIRREY SOLIS IPS. S.A.',
        'CAJA DE COMPENSACIÓN FAMILIAR CAFAM',
        'CAJA DE COMPENSACION FAMILIAR DE ANTIOQUIA COMFAMA',
        'Servicios de Salud IPS Suramericana S.A.S',
        'CAJA COLOMBIANA DE SUBSIDIO FAMILIAR COLSUBSIDIO',
        'Viva 1A IPS SA',
        'INSTITUTO DE DIAGNOSTICO MEDICO S.A.',
        'REHABILITAR SAS',
        'PROMOTORA MEDICA Y ODONTOLOGICA DE ANTIOQUIA SA',
        'sanacion y vida ips s.a.s',
        'INTEGRAL DE COLOMBIA IPS S.A.S',
        'Caminos IPS S.A.S Soledad',
        'IPS SALUD DEL CARIBE S.A.',
        'SALUD TOTAL EPS-S S.A.',
        'ENTIDAD PROMOTORA DE SALUD SANITAS S.A.S',
        'COOPERATIVA ANTIOQUEÑA DE SALUD COOPSANA',
        'COOPERATIVA DE SERVICIOS INTEGRALES DE SALUD RED MEDICRON IPS',
        'BIENESTAR IPS S.A.S.',
        'CALIDAD MEDICA IPS SAS',
        'SALUD SOCIAL SOCIEDAD POR ACCIONES SIMPLIFICADA',
        'SOMEDYT IPS E.U. SERVICIOS MEDICO DE DIAGNOSTICO Y TERAPIA',
        'COOPERATIVA DE TRABAJO ASOCIADO DE PROFESIONALES DE LA SALUD DE DONMATIAS - PROSALCO',
        'EMPRESA SOCIAL DEL ESTADO VIDASINU',
        'ANGIOGRAFIA DE OCCIDENTE S.A.',
        'SERVICIOS MEDICOS OLIMPUS I.P.S. SOCIEDAD POR ACCIONES SIMPLIFICADA',
        'SALUD VITAL DEL HUILA IPS SAS',
        'FORPRESALUD IPS SAS',
        'INTERCONSULTAS S.A.S.',
        'INVERSIONES EN SALUD SAS',
        'IPS COOMULTRASAN',
        'COOMSOCIAL IPS SAS',
        'Empresa Social del Estado Instituto de Salud de Bucaramanga',
        'CENTRO DE MEDICINA DEL EJERCICIO Y REHABILITACION CARDIACA S A S CEMDE S A S',
        'A&G SERVICIOS DE SALUD S.A.S.',
        'MULTISALUD SAS',
        'MEDICINA INTEGRAL S.A.',
        'LOS COMUNEROS HOSPITAL UNIVERSITARIO DE BUCARAMANGA',
        'UNIDAD MEDICA SANTAFE SAS',
        'IPS SALUD A TU LADO SAS',
        'NORDVITAL IPS S.A.S.',
        'Fundación Javeriana de Servicios Medico Odontologicos Interuniversitarios Carlos Marquez Villegas-Javesalud',
        'FISIOREHABILITAR TERAPIAS INTEGRALES SAS',
        'Clinica Chia S.A.S.',
        'ORGANIZACION CLINICA GENERAL DEL NORTE S.A.S.',
        '+IPSMEDIC S.A.S',
        'Hospital Universitario del Valle "Evaristo Garcia" E.S.E.',
        'SOCIEDAD MEDICA DE ESPECIALISTAS DIAGNOSTICO E IMAGENOLOGIA MEDSALUD LTDA',
        'DR PROSALUD IPS S.A.S',
        'CPO S A',
        'CENTRO INTEGRAL DE ATENCION DIAGNOSTICA ESPECIALIZADA',
        'SERVICIOS INTEGRALES DE SALUD DEL MAGDALENA SAS',
        'SANTA SALUD IPS LTDA',
        'FUNDACION HOSPITAL INFANTIL NAPOLEON FRANCO PAREJA',
        'ASISTIR SALUD SAS',
        'ESE HOSPITAL LOCAL JORGE CRISTO SAHIUM VILLA DEL ROSARIO',
        'AMIGOS DE LA SALUD, AMISALUD SAS',
        'SUBRED INTEGRADA DE SERVICIOS DE SALUD SUR E.S.E.',
        'RED DE SALUD DEL NORTE EMPRESA SOCIAL DEL ESTADO',
        'UBA VIHONCO SAS',
        'ESE HOSPITAL LA MERCED',
        'CAJA DE COMPENSACIÓN FAMILIAR DEL VALLE DEL CAUCA - COMFAMILIAR ANDI',
        'PROMOSALUD IPS T&E S.A.S.',
        'ESE HOSPITAL SAN JUAN DE DIOS YARUMAL',
        'IPS DIVINA MISERICORDIA MEDICINA ESPECIALIZADA S.A.S.',
        'INSTITUTO DEL TORAX S.A.S',
        'Clínica Giron ESE',
        'CAJA DE COMPENSACION FAMILIAR DE CALDAS',
        'CENTRO MEDICO BUENOS AIRES SAS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL JOSE CAYETANO VASQUEZ',
        'UNIDAD MEDICA HUMANIZARTE S.A.S.',
        'MIRED BARRANQUILLA IPS S.A.S.',
        'SUBRED INTEGRADA DE SERVICIOS DE SALUD CENTRO ORIENTE E.S.E',
        'Subred Integrada de Servicios de Salud Sur Occidente E.S.E',
        'FAMILIA IPS SALUD INTEGRAL S.A.S.',
        'SERVICIOS DE ATENCION DOMICILIARIA EN SALUD S.A.S sigla SADISALUD SAS',
        'ALIRIO GUTIERREZ MILLAN Y CIA SAS UNIDAD DE ATENCIÓN PRIMARIA DARSALUD',
        'SOLUCIONES Y EMPRENDIMIENTO EMPRESARIAL SIEMPREE SAS',
        'ALIANZA DIAGNOSTICA S.A.',
        'LIFESTYLE MEDICINE S.A.S.',
        'CLINICA MEDILASER S.A.S.',
        'CENTROS DE CONSULTA S.A.S.',
        'IPS MUNICIPAL DE IPIALES E.S.E.',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN RAFAEL DE YOLOMBO',
        'RAYOS X DEL HUILA S.A.S',
        'UNIDAD MEDICA ORLUZ SAS',
        'TERAPIAS INTEGRALES S.A.S.',
        'CLINICA NUEVA RAFAEL URIBE URIBE SAS',
        'SOCIEDAD MEDICA SURSALUD S.A.S',
        'INTEGRALES HEALTH S.A.S',
        'TORRES Y JARAMILLO S.A.S',
        'ESE HOSPITAL SANTA MARGARITA',
        'E.S.E. RED DE SALUD DEL CENTRO EMPRESA SOCIAL DEL ESTADO HOSPITAL PRIMITIVO IGLESIAS',
        'CENTRO DE EXCELENCIA CLINICA SANTA HELENA LTDA',
        'IPS COBERTURA INTEGRAL EN SALUD SA COBERSALUD',
        'CENTRO MEDICO SAN JUAN EU',
        'SALUD TIERRALTA IPS SAS',
        'ESE HOSPITAL LA MARIA',
        'CARDIOLOGIA FAMILIAR CARFAM SAS',
        'E.A.T. CENTRO MEDICO SANTA MARIA I.P.S.',
        'EMPRESA SOCIAL DEL ESTADO DEL MUNICIPIO DE VILLAVICENCIO',
        'FUNDACION SOCIAL PARA PROMOCION DE VIDA',
        'MEDICADIZ S.A.S',
        'MEDICLINICOS IPS S.A.S',
        'SUBRED INTEGRADA DE SERVICIOS DE SALUD NORTE E.S.E',
        'ALIADOS EN SALUD S.A.',
        'MEDICAL ARMONY LIMITADA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL MATERNO INFANTIL CIUDADELA METROPOLITANA DE SOLEDAD',
        'EMPRESA SOCIAL DEL ESTADO ESE CENTRO I',
        'ESE HOSPITAL LOCAL MUNICIPIO LOS PATIOS',
        'COMFAMILIAR ATLÁNTICO',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN RAFAEL',
        'ELECTROFISIATRIA SAS',
        'FUNDACION SOCIAL BIOSSANAR',
        'RED SALUD CASANARE E.S.E.',
        'FUNDACION DE PROFESIONALES',
        'FUNDACION HOSPITAL INFANTIL UNIVERSITARIO DE SAN JOSE',
        'OINSAMED S.A.S.',
        'RED INTEGRADA SALUD COLOMBIA IPS S.A.S (REDINSALUD IPS S.A.S)',
        'EMPRESA SOCIAL DEL ESTADO SALUD YOPAL',
        'ESE HOSPITAL SAN JUAN DE DIOS',
        'INSTITUTO NEUMOLOGICO DEL ORIENTE S.A.',
        'SOCIEDAD DE CIRUGIA DE BOGOTA HOSPITAL DE SAN JOSE',
        'IPS UNIONSALUD SAS',
        'SERVICIOS INTEGRALES DE REHABILITACION EN BOYACA LIMITADA - SIREB LTDA.',
        'SERVICIOS MEDICOS FAMEDIC S.A.S',
        'EMPRESA SOCIAL DEL ESTADO PASTO SALUD E.S.E.',
        'IPS SALUD INTEGRAL DE SUCRE SAS',
        'CLINICA SALUD SOCIAL S.A.S',
        'COMFACAUCA I.P.S.',
        'SOCIEDAD CLINICA BOYACA LIMITADA',
        'CLINICA SAN JOSE SAS',
        'CENTRO MEDICO SAN LUIS CLINICA QUIRURGICA S.A.S.',
        'VALLE DEL SOL IPS SAS',
        'E.S.E. HOSPITAL MONTELIBANO',
        'CLINICA PAJONAL S.A.S',
        'EMPRESA MULTIACTIVA DE SALUD',
        'CLINICA MEISEL S.A.S.',
        'COOPERATIVA MULTIACTIVA DE SERVICIOS INTEGRALES GESTIONARBIENESTAR',
        'HOSPITAL UNIVERSITARIO CLINICA SAN RAFAEL',
        'CENTRAL MEDICA LAS NIEVES EMPRESA UNIPERSONAL E.U',
        'CLINICA PIEDECUESTA S.A.',
        'PREMISALUD S.A.',
        'GRUPO GARANTE LTDA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL REGIONAL DE CHIQUINQUIRA',
        'ESE HOSPITAL NUESTRA SEÑORA DEL CARMEN',
        'FUNDACION OFTALMOLOGICA DE SANTANDER - FOSCAL',
        'THERACLINIC S.A.S',
        'MI IPS S.A.S.',
        'GESENCRO S.A.S',
        'EMPRESA SOCIAL DEL ESTADO SAN JUAN DE DIOS',
        'MEDICAUCA S.A.S',
        'CENTRO MEDICO INTEGRAL SERVICIOS DE SALUD "C.M.I." S.A.',
        'COOPERATIVA COMUNITARIA DEL PACIFICO "COOMULCOPAC" - COOPESALUD IPS',
        'GESTAR SALUD DE COLOMBIA IPS SAS',
        'Hospital Regional San Andres ESE',
        'PSQ SAS',
        'CLINICA CHINITA S.A.',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL NUESTRA SEÑORA DEL CARMEN',
        'EMPRESA SOCIAL DEL ESTADO IVAN RESTREPO GOMEZ',
        'PREVENCION Y SALUD IPS LIMITADA',
        'CIMAD IPS LTDA',
        'E.S.E. HOSPITAL SAN ANTONIO DE GUATAVITA',
        'CLINICA CARDIO VID',
        'GASTROQUIRURGICA S.A.S.',
        'MVC INVERSIONES CASALUD IPS VALLEDUPAR',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL ISABEL LA CATOLICA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN JUAN DE DIOS',
        'E.S.E. HOSPITAL SAN RAFAEL DE PACHO',
        'CAJA DE COMPENSACION FAMILIAR DE RISARALDA COMFAMILIAR RISARALDA',
        'FUNDACIÓN HOSPITAL UNIVERSIDAD DEL NORTE',
        'ESE HOSPITAL SAN RAFAEL',
        'ESE HOSPITAL LOCAl TURBACO',
        'MEDIFACA IPS S.A.S',
        'CENTRO MEDICO PROVINSALUD IPS SOCIEDAD DE RESPONSABILIDAD LTDA',
        'NEO SALUD SAS',
        'I.P.S. CLINICA GUARANDA SANA S.A.S.',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL BENJAMIN BARNEY GASCA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN ANTONIO',
        'PROVIDA FARMACEUTICA SAS',
        'CLINICA REGIONAL INMACULADA CONCEPCION',
        'FUNDACION NEUMOLOGICA COLOMBIANA',
        'MESALUD LIMITADA',
        'IPS PASTO ESPECIALIDADES SAS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL EDUARDO ARREDONDO DAZA',
        'E.S.E. HOSPITAL PEDRO LEON ALVAREZ DIAZ',
        'CENTRO MEDICO Y DE REHABILITACION E.U.',
        'FUNDACION CARDIO INFANTIL INSTITUTO DE CARDIOLOGIA',
        'ESE CAMU SANTA TERESITA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN VICENTE DE PAUL',
        'INSTITUCION PRESTADORA DE SERVICIOS DE SALUD LOS ANGELES IPS',
        'SERVICIOS INTEGRALES DE SALUD CENTRO MEDICO CENTENARIO S.A.S',
        'E.S.E HOSPITAL SANTANDER HERRERA DE PIVIJAY',
        'UNIDAD CARDIOLOGICA Y PERINATAL DEL HUILA LTDA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SANTAMARIA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL FRANCISCO LUIS JIMENEZ MARTINEZ',
        'Grupo Salud Cordoba SAS',
        'E.S.E. HOSPITAL MUNICIPAL SAN ROQUE',
        'ESE HOSPITAL DEPARTAMENTAL SAN ANTONIO DE PITALITO',
        'EMPRESA SOCIAL DEL ESTADO MARIA AUXILIADORA DE GARZON',
        'E.S.E HOSPITAL EL CARMEN',
        'EMPRESA SOCIAL DEL ESTADO METROSALUD',
        'LABORATORIO CLINICO PROCESAR IPS SAS',
        'INSTITUTO VASCULAR E IMÁGENES DIAGNOSTICAS SAS',
        'ARMONY CLÍNICA DE ESPECIALISTAS Y CIRUGÍA S.A.S',
        'IPS CENTRO MEDICO SANTA MARIA LIMITADA',
        'FUNDACION VALLE DEL LILI',
        'MEDISINU IPS SAS',
        'CLINICA IPS CABECERA SAS',
        'HOSPITAL DEPARTAMENTAL SAN RAFAEL DE ZARZAL E.S.E.',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL NUESTRA SEÑORA DEL PERPETUO SOCORRO',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN JOSE',
        'ESE HOSPITAL CLARITA SANTOS DE SANDONA',
        'FUNDACION IDEAL PARA LA REHABILITACION INTEGRAL "JULIO H CALONJE"',
        'ASOCIACION DE AUTORIDADES Y CABILDOS AWA UNIPA',
        'INSTITUCIÓN PRESTADORA DE SERVICIOS DE SALUD CUIDADO SEGURO EN CASA SA',
        'HOSPITAL EL BUEN SAMARITANO E.S.E. LA CRUZ',
        'CENTRO MÉDICO SINAPSIS IPS S.A.',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL FRANCISCO VALDERRAMA',
        'ESE HOSPITAL LA MISERICORDIA',
        'Promotora Clinica Zona Franca de Uraba SAS',
        'HOSPITAL SAN JUAN BOSCO E.S.E',
        'Instituto Nacional de Demencias Emanuel SAS',
        'ESE HOSPITAL SAN SEBASTIAN DE URABA',
        'orosalud caucasia ips s.a.s.',
        'SERVINTEGRALES A&A SAS',
        'UNIPSALUD GUADUAS IPS SAS',
        'IPS FISIO S.A.S',
        'ESE HOSPITAL SAN FRANCISCO',
        'EMPRESA SALUD DEL PACIFICO SAS "PRESTACION DE SERVICIOS EN SALUD"',
        'INSTITUTO DE REHABILITACIÓN ISSA ABUCHAIBE LTDA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN JUAN DE DIOS DE FLORIDABLANCA',
        'SANA IPS S.A.S.',
        'ESE HOSPITAL SAN FERNANDO',
        'NUEVO HOSPITAL LA CANDELARIA EMPRESA SOCIAL DEL ESTADO',
        'PALERMO IMAGEN LTDA',
        'E.S.E. HOSPITAL SAN RAFAEL DE FUSAGASUGA',
        'ASORSALUD SM LTDA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL UNIVERSITARIO SAN RAFAEL DE TUNJA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL MARIA ANTONIA TORO DE ELEJALDE',
        'LIGA CONTRA EL CANCER SECCIONAL RISARALDA',
        'CORPORACION HOSPITAL SAN JUAN DE DIOS - UNIREMINGTON, SANTA ROSA DE OSOS',
        'E.S.E HOSPITAL SAN JUAN DE DIOS VALDIVIA',
        'IPS TOLUSALUD LTDA',
        'E.S.E. HOSPITAL SAN RAFAEL DE CAQUEZA',
        'CENTRO DE SALUD SANTIAGO DE MALLAMA E.S.E.',
        'INSTITUTO DEL CORAZON S.A.S',
        'CLINICA DE OCCIDENTE',
        'ESE HOSPITAL ARSENIO REPIZO VANEGAS',
        'EMPRESA SOCIAL DEL ESTADO SURORIENTE E.S.E',
        'MEDFAM S.A.S.',
        'MEDISALUD MONTERIA SAS',
        'NOVASALUD CARIBE IPS SA',
        'ESE ALEJANDRO PROSPERO REVEREND',
        'SALUD BET-EL IPS SAS',
        'FUNDACION NACER PARA VIVIR IPS',
        'ESE CENTRO DE SALUD DE LOS PALMITOS',
        'FUNDACION ABOOD SHAIO',
        'CENTRAL DE ESPECIALISTAS DE COLOMBIA S.A.S.',
        'CENTRO MEDICO CUBIS LIMITADA',
        'CENTRO DE SALUD DE SAN BARTOLOME DE CORDOBA ESE',
        'ASOCIACIÓN PROFAMILIA',
        'SALUD SOGAMOSO EMPRESA SOCIAL DEL ESTADO',
        'ESE HOSPITAL SAN VICENTE DE PAUL',
        'ESE HOSPITAL SAN JUAN DE DIOS DE LEBRIJA',
        'SAMUEL VILLANUEVA VALEST EMPRESA SOCIAL DEL ESTADO',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL REGIONAL DEL MAGDALENA MEDIO',
        'CLINICA SAN FRANCISCO S.A',
        'EMPRESA SOCIAL DEL ESTADO DEL DEPARTAMENTO DEL META ESE "SOLUCION SALUD"',
        'ESE HOSPITAL PRESBITERO EMIGDIO PALACIO',
        'E.S.E. HOSPITAL LOCAL MAHATES',
        'VIDA INTEGRA IPS S.A.S.',
        'E.S.E. HOSPITAL INTEGRADO SABANA DE TORRES',
        'ESE HOSPITAL VENANCIO DIAZ DIAZ',
        'ESE HOSPITAL DE SANTO TOMAS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL UNIVERSITARIO DE LA SAMARITANA',
        'EMPRESA SOCIAL DEL ESTADO CENTRO 2 E.S.E.',
        'ESE HOSPITAL EMIRO QUINTERO CAÑIZAREZ',
        'CLINICA SANTA ANA S.A.S',
        'HOSPITAL DE AGUAZUL JUAN HERNANDO URREGO EMPRESA SOCIAL DEL ESTADO',
        'ESE HOSPITAL GABRIEL PELAEZ MONTOYA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL ANTONIO ROLDAN BETANCUR',
        'GARCIA PEREZ MEDICA Y COMPAÑIA SAS',
        'SOCIEDAD MÉDICA RIONEGRO S.A. SOMER S.A.',
        'CLINICA FARALLONES S A',
        'CLINICA SAN JOSE DE CUCUTA SA',
        'ESE CENTRO DE SALUD GIOVANI CRISTINI',
        'IPS NUESTRA SEÑORA DE FATIMA SAS',
        'ESE HOSPITAL SAN LUIS BELTRAN',
        'IPS MEDCARE DE COLOMBIA S.A.S.',
        'CLINICA TUNDAMA S.A.',
        'ESE HOSPITAL LOCAL SAN PABLO',
        'SALUD RH LTDA',
        'KARISALUD IPS LTDA.',
        'Santa Sofia IPS Espinal S.A.S.',
        'UNIDAD DE GASTROENTEROLOGÍA, NUTRICIÓN Y ENDOSCOPIA PEDIATRICA SAS',
        'INVERSIONES MEDICAS DE ANTIOQUIA S.A. CLINICA LAS VEGAS',
        'E.S.E. HOSPITAL EL CARMEN',
        'Clinica Universitaria Medicina Integral S.A. - CUMI',
        'ESE CENTRO DE SALUD CARTAGENA DE INDIAS COROZAL',
        'CLINICA Y DROGUERIA NTRA SRA DE TORCOROMA S.A.S.',
        'FRC UNIDAD AMBULATORIA SAS',
        'ESE HOSPITAL SAN CRISTOBAL DE CIENAGA',
        'IPS VITAL SALUD S.A.S',
        'MASVIDA DE LA COSTA SAS',
        'UNIDAD BASICA DE ATENCION PROSANAR LTDA.',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL REGIONAL NOROCCIDENTAL',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN JUAN DE DIOS DE ABEJORRAL',
        'ESE HOSPITAL LA INMACULADA',
        'SANATORIO DE AGUA DE DIOS E.S.E.',
        'Hospital Departamental de Granada - Empresa Social del Meta',
        'SERVICIOS MEDICOS DEL CASANARE S.A.S',
        'ESE HOSPITAL OSCAR EMIRO VERGARA CRUZ',
        'EMPRESA SOCIAL DEL ESTADO CENTRO DE SALUD CAMILO RUEDA',
        'CLINICA SANTA MARIA SAS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL LOCAL DE SAN CARLOS DE GUAROA',
        'SOCIEDAD INTEGRAL DE ESPECIALISTAS EN SALUD S.A.S Sigla SIES SALUD S.A.S',
        'CORPORACIÓN HOSPITALARIA JUAN CIUDAD',
        'EMPRESA SOCIAL DEL ESTADO HORACIO MUÑOZ SUESCUN',
        'EMPRESA SOCIAL DEL ESTADO SAN ANTONIO RIONEGRO SANTANDER',
        'CCICOL S.A.S',
        'ESE CAMU PUEBLO NUEVO',
        'SOCIEDAD CARDIOLOGICA COLOMBIANA S.A.S',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL DE REPELON',
        'UNIDAD CARDIOQUIRURGICA DE NARIÑO SAS',
        'CAJA DE COMPENSACION FAMILIAR COMPENSAR',
        'SALUD DARIEN I.P.S. S.A.',
        'CENTRO MEDICO SAN MARTIN IPS S.A.',
        'NUEVA ESE HOSPITAL SAN RAFAEL JERICO',
        'HOSPITAL RICAURTE EMPRESA SOCIAL DEL ESTADO',
        'Hospital San Rafael - Empresa Social del Estado',
        'CAJA DE COMPENSACION FAMILIAR COMFENALCO SANTANDER',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN LORENZO',
        'ESE HOSPITAL REGIONAL NORTE',
        'HOSPITAL LOCAL DE PUERTO LOPEZ ESE',
        'ESE HOSPITAL NUESTRA SEÑORA DE FATIMA DE SUAZA',
        'FUNDACION CENTRO COLOMBIANO DE EPILEPSIA Y ENFERMEDADES NEUROLOGICAS',
        'CLINICA SAN JOSE IPS LTDA',
        'ESE HOSPITAL CUMBAL',
        'ESE SAN ANDRES APOSTOL',
        'E.S.E. HOSPITAL SAN ANTONIO DE BARBACOAS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN ANTONIO DE SOATA',
        'CENTRO DE RADIOLOGIA ELISA CLARA R.F S.A.S',
        'UCI DEL CARIBE SAS',
        'RED DE SALUD DEL ORIENTE EMPRESA SOCIAL DEL ESTADO E.S.E',
        'ONCOMEDICA S.A.S',
        'HOSPITAL DE SAN JUAN DE DIOS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL LOCAL DE SAN MARTIN DE LOS LLANOS',
        'E.S.E. Hospital Pasteur Melgar Tolima.',
        'EMPRESA SOCIAL DEL ESTADO REGION DE SALUD CENTRO ORIENTE ALMEIDAS',
        'CENTRO DE FISIOTERAPIA REHABILITAR DRA. MARTA CANTILLO MARTINEZ S.A.S.',
        'ESE HOSPITAL SAN ANTONIO',
        'HOSPITAL DEPARTAMENTAL FELIPE SUAREZ ESE',
        'SERVICIOS INTEGRALES DE SALUD LIMITADA',
        'ESE CARMEN EMILIA OSPINA',
        'ESE HOSPITAL DEL ROSARIO',
        'ESE HOSPITAL SAN CARLOS',
        'RESPIREMOS UNIDAD DE NEUMOLOGIA Y ENDOSCOPIA RESPIRATORIA DEL EJE CAFETERO S.A.S',
        'GASTRICARE SAS',
        'ESE HOSPITAL SAN JOSE DE TIERRALTA',
        'E.S.E. C.A.M.U. LA APARTADA',
        'E.S.E. HOSPITAL SAN VICENTE DE PAUL DE FOMEQUE',
        'FUNDACION HOSPITALARIA SAN VICENTE DE PAUL',
        'IPS SERVIMED SAS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL UNIVERSITARIO JULIO MENDEZ BARRENECHE',
        'ESE HOSPITAL LOCAL YOTOCO',
        'ESE HOSPITAL SAN JOSE',
        'RIESGO DE FRACTURA S.A. CAYRE',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL UNIVERSITARIO DEL CARIBE',
        'DUMIAN MÉDICAL S.A.S',
        'HOSPITAL REGIONAL SEGUNDO NIVEL DE ATENCIÓN VALLE DE TENZA E.S.E.',
        'CIMELL CENTRO INTEGRAL DE MÉDICOS ESPECIALISTAS DEL LLANO IPS SAS',
        'FUNDACION SANTA FE DE BOGOTA',
        'ESE HOSPITAL SAN JERÓNIMO DE MONTERÍA',
        'CLINICENTRO DE REHABILITACION CARDIACA Y PULMONAR LTDA',
        'E.S.E HOSPITAL SAN JOSE DE SAN BERNARDO DEL VIENTO',
        'ESE HOSPITAL SAN RAFAEL DE SANTO DOMINGO',
        'E.S.E HOSPITAL SAN JORGE',
        'CLINICA DE URGENCIAS BUCARAMANGA S.A.S',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL TOBIAS PUERTA',
        'Clínica Universidad de La Sabana',
        'HOSPITAL ISAIAS DUARTE CANCINO EMPRESA SOCIAL DEL ESTADO',
        'E.S.E. HOSPITAL SALAZAR VILLETA',
        'ESE HOSPITAL PBRO ALONSO MARIA GIRALDO',
        'ESE CENTRO DE SALUD SAN JOSE',
        'ESE HOSPITAL FRANCISCO ELADIO BARRERA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL LOCAL ALEJANDRO MAESTRE SIERRA',
        'IPS CENTRO MEDICO SAN LUCAS',
        'HOSPITAL LA BUENA ESPERANZA ESE',
        'Integrar Soluciones en Salud IPS SAS',
        'HOSPITAL DE CASTILLA LA NUEVA ESE',
        'ESE HOSPITAL SAN JUAN DE DIOS DE COCORNA',
        'SANATORIO DE CONTRATACION EMPRESA SOCIAL DEL ESTADO',
        'E.S.E CAMU IRIS LÓPEZ DURAN',
        'CLINICA DE LA COSTA S.A.S.',
        'EMPRESA SOCIAL DEL ESTADO SAN SEBASTIAN DE LA PLATA HUILA',
        'CENTRO DE SALUD FUNES E.S.E.',
        'HOSPITAL HENRY VALENCIA OROZCO E.S.E',
        'MEDDYZ DEL NORTE IPS SAS',
        'UNIDAD CLINICA SAN NICOLAS LIMITADA',
        'CAMBIARSALUD S.A.S',
        'SOCIEDAD DE ESPECIALISTAS DE GIRARDOT S.A.S',
        'ESE HOSPITAL NUESTRA SEÑORA DEL CARMEN DE EL COLEGIO',
        'confimed s.a.s. servicios medicos confiables s.a.s',
        'ESE HOSPITAL LA ANUNCIACION',
        'ESE HOSPITAL LA SAGRADA FAMILIA',
        'CENTRO CARDIOVASCULAR DEL MAGDALENA S.A.',
        'E.S.E. CENTRO DE SALUD MUNICIPAL DE CARTAGO',
        'Centro de Salud Municipal Nivel I Luis Acosta E.S.E',
        'HEEDSALUD DEL CARIBE S.A.S.',
        'fundacion Participar IPS',
        'CLINICA DEL PRADO S.A.S',
        'ESE HOSPITAL LOCAL SAN JUAN NEPOMUCENO',
        'ESE HOSPITAL REGIONAL MANUELA BELTRAN',
        'SHARON MEDICAL GROUP SAS',
        'E.S.E CENTRO DE SALUD MUNICIPIO DE PARAMO',
        'ESE HOSPITAL SAN VICENTE DE PAUL DE NEMOCON',
        'CENTRO DE ESTUDIOS DE REUMATOLOGÍA Y DERMATOLOGÍA S.A.S.',
        'E.S.E. HOSPITAL SAN VICENTE DE PAUL DE LORICA',
        'ESE HOSPITAL SAN JUAN DE SAHAGUN',
        'CENTRO DE SALUD SAGRADO CORAZON DE JESUS E.S.E.',
        'COOPERATIVA MEDICA DE SALUD DEL NORTE DEL CASANARE IPS',
        'PREVICARE LTDA',
        'FUNDACION SER IPS MOMPOX',
        'HOSPITAL SAN CARLOS E.S.E.',
        'ESE HOSPITAL SAN RAFAEL DE CHINU',
        'E.S.E. CENTRO DE SALUD GUACHAVÉS',
        'ANGIOGRAFIA DE COLOMBIA S.A.S.',
        'Unidad Medico Quirurgica y Odontologica Santa Carolina S.A.S',
        'ASISDE IPS SAS',
        'CARDIOSALUD EJE CAFETERO S.A.S.',
        'Salud Vital Integral SAS',
        'E.S.E. HOSPITAL GUILLERMO GAVIRIA CORREA',
        'CENTRO DE SALUD CAMILO HURTDAO CIFUENTES ESE.',
        'ESE CENTRO DE SALUD SAN BERNARDO',
        'HOSPITAL SAN ANDRES E.S.E.',
        'CARDIOLOGIA SIGLO XXI S.A.S',
        'EMPRESA SOCIAL DEL ESTADO REGION DE SALUD MEDINA',
        'CENTROS HOSPITALARIOS DEL CARIBE S.A.S.',
        'ESE PRIMER NIVEL GRANADA SALUD',
        'ESE CAMU BUENAVISTA',
        'ESE HOSPITAL SAN FRANCISCO DE ASIS',
        'HOSPITAL ALMA MÁTER DE ANTIOQUIA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL EL SAGRADO CORAZON',
        'CORPORACIÓN MI IPS HUILA',
        'HOSPITAL MARIA AUXILIADORA EMPRESA SOCIAL DEL ESTADO DEL MUNICIPIO DE MOSQUERA',
        'E.S.E. HOSPITAL INTEGRADO SAN ANTONIO',
        'EMPRESA SOCIAL DEL ESTADO MARCO A. CARDONA',
        'CENTRO DE MEDICINA FISICA Y REHABILITACION RECUPERAR',
        'CENTRO HOSPITAL NUESTRO SEÑOR DE LA DIVINA MISERICORDIA PUERRES E.S.E.',
        'E.S.E HOSPITAL INTEGRADO DE LANDAZURI',
        'E.S.E. HOSPITAL UNIVERSITARIO HERNANDO MONCALEANO PERDOMO DE NEIVA',
        'E.S.E. HOSPITAL SAN JOSÉ DE CANALETE',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN PABLO',
        'E.S.E. CENTRO DE SALUD NUESTRA SEÑORA DE FÁTIMA',
        'HOSPITAL REGIONAL DE MONIQUIRA ESE',
        'INSTITUCIÓN PRESTADORA DE SERVICIOS DE SALUD INDÍGENA MANEXKA IPSI',
        'SUMEDICA IPS S.A.S',
        'ESE HOSPITAL LOCAL SANTA ROSA DE LIMA',
        'ESE HOSPITAL 7 DE AGOSTO',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL GUSTAVO GONZALEZ OCHOA',
        'E.S.E. HOSPITAL SAN JULIAN',
        'CLINICA CASANARE S.A',
        'E.S.E HOSPITAL INTEGRADO SAN ROQUE',
        'EMPRESA SOCIAL DEL ESTADO BELLO SALUD',
        'ESE CAMU SAN RAFAEL',
        'CENTRO DE SALUD DE CONSACA EMPRESA SOCIAL DEL ESTADO',
        'E.S.E. HOSPITAL PEDRO NEL CARDONA',
        'RTS S.A.S',
        'E.S.E HOSPITAL AGUSTIN CODAZZI',
        'UNIDAD MEDICA INTEGRAL DEL SAN JORGE LIMITADA',
        'DEXA DIAB SERVICIOS MEDICOS LTDA',
        'GUADALUPE IPS S.A.S',
        'ESE HOSPITAL SANTIAGO DE TOLU',
        'CENTRO CARDIOVASCULAR ARISTIDES SOTOMAYOR SANTA LUCIA SOCIEDAD POR ACCIONES SIMPLIFICADA-IPS ASTALUC SAS IPS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL REGIONAL DE OCCIDENTE',
        'ESE HOSPITAL SAN JUAN DIOS',
        'SERVICLINICOS DROMEDICA S.A',
        'ESE HOSPITAL SAN JUAN DEL SUROESTE',
        'ESE HOSPITAL SAN PEDRO CLAVER DE MOGOTES SANTANDER.',
        'ESE CENTRO DE SALUD SAN PEDRO SUCRE',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL NUESTRA SEÑORA DEL ROSARIO',
        'PROMOTORES DE LA SALUD DE LA COSTA PROMOCOSTA S.A.S',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SANDIEGO DE CERETE',
        'ESE HOSPITAL LOCAL DE NUEVA GRANADA',
        'E.S.E HOSPITAL SAN ANTONIO DE PADUA',
        'E.S.E. CAMU LOS CORDOBAS',
        'HOSPITAL KENNEDY ESE',
        'EMRESA SOCIAL DEL ESTADO HOSPITAL LOCAL SANTA Bárbara DE PINTO',
        'HOSPITAL LOCAL DE GUAMAL PRIMER NIVEL E.S.E.',
        'ESE Hospital Héctor Abad Gómez',
        'E.S.E. HOSPITAL HILARIO LUGO DE SASAIMA',
        'E.S.E. CENTRO DE SALUD SANTA BARBARA ISCUANDE',
        'HOSPITAL DEPARTAMENTAL SAN RAFAEL DE RISARALDA EMPRESA SOCIAL DEL ESTADO',
        'E.S.E. HOSPITAL MARCO FELIPE AFANADOR DE TOCAIMA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL DE MALAMBO',
        'ESE CENTRO DE SALUD SAN JOSE I NIVEL SAN MARCOS',
        'E.S.E. HOSPITAL JUAN PABLO II ARATOCA',
        'ESE HOSPITAL SANTA MÓNICA',
        'CLINICA CARDIODAJUD SAS',
        'ESE HOSPITAL SAN PEDRO',
        'ESE HSOPITAL NIVEL I PUERTO RICO',
        'ESE HOSPITAL LOCAL NUESTRA SEÑORA DEL SOCORRO DE SINCE',
        'SERVICIOS INTEGRALES EN SALUD DE CÓRDOBA IPS. S.A.S.',
        'E.S.E. CENTRO DE SALUD SAN SEBASTIAN',
        'MI ATENCION INTEGRAL S.A.S. IPS',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL DE CAMPO DE LA CRUZ',
        'HOSPITAL LOCAL SANTA CATALINA DE SENA DE SUCRE-SUCRE E.S.E.',
        'ESE CENTRO DE SALUD DE GUARANDA',
        'CLINICA INTEGRAL DE EMERGENCIAS LAURA DANIELA S.A.',
        'E.S.E. HOSPITAL MUNICIPAL NUESTRA SEÑORA DE GUADALUPE',
        'MEDICINA DOMICILIARIA DE COLOMBIA S.A.S',
        'E.S.E CAMU DE PURISIMA',
        'CLINICA MONTERIA S.A',
        'HOSPITAL HELI MORENO BLANCO E.S.E',
        'HOSPITAL MUNICIPAL DE ACACIAS ESE',
        'ESE INSTITUTO NACIONAL DE CANCEROLOGIA',
        'INSTITUCION PRESTADORA DE SERVICIOS DE SALUD "SU IPS SAS"',
        'ESE DE PRIMER NIVEL DE EL MUNICIPIO DE EL ROSARIO',
        'ESE HOSPITAL LOCAL DE PUERTO LIBERTADOR EL DIVINO NIÑO',
        'IPS GONZALEZ RACERO S.A.S',
        'CENTRO DE SALUDYA E.S.E. DE YACUANQUER',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL SAN MARTIN DE PORRES',
        'E.S.E CENTRO DE SALUD DE LOS ANDES',
        'IPS-I ASOCIACION DE CABILDOS DE GUACHUCAL Y COLIMBA',
        'EMPRESA SOCIAL DEL ESTADO CENTRO DE SALUD PAZ DEL RIO',
        'Hospital Sagrado Corazón de Jesús Empresa Social del Estado de El Charco',
        'Centro De Rehabilitación Funcional (CRF) S.A.S',
        'E.S.E EDMUNDO GERMAN ARIAS DUARTE',
        'EMPRESA SOCIAL DEL ESTADO RIO GRANDE DE LA MAGDALENA DEL MUNICIPIO DE MAGANGUE',
        'EMPRESA SOCIAL DEL ESTADO DE PRIMER NIVEL DE ATENCION HOSPITAL ISABEL CELIS YAÑEZ',
        'EMPRESA SOCIAL DEL ESTADO SAN FRANCISCO JAVIER',
        'E.S.E. HOSPITAL PEDRO CLAVER AGUIRRE YEPES',
        'CENTRO HOSPITAL DE LA FLORIDA EMPRESA SOCIAL DEL ESTADO',
        'IPS SALUD PARA SUCRE SAS',
        'EMPRESA SOCIAL DEL ESTADO CENTRO DE SALUD SAN BLAS DE MORROA',
        'HOSPITAL SERAFIN MONTAÑA CUELLAR ESE',
        'ESE HOSPITAL SAN PEDRO DE EL PIÑON',
        'ESE HOSPITAL LAUREANO PINO',
        'E.S.E CENTRO DE SALUD SAN ISIDRO DE EL PEÑOL',
        'UNIDAD DE MEDICINA PREVENTIVA Y RESOLUTIVA UMPRE LTDA',
        'EMPRESA SOCIAL DEL ESTADO CENTRO DE SALUD MAJAGUAL',
        'ESE CENTRO DE SALUD DE OVEJAS',
        'DIAGNOS TALAIGUA NUEVO S.A.S',
        'ESE HOSPITAL LOCAL SANTA MARIA',
        'ESE HOSPITAL SAN JOAQUIN NARIÑO ANTIOQUIA',
        'ESE HOSPITAL SAN BERNARDO',
        'SOLOSALUD IPS SAN BERNARDO S.A.S',
        'FUNDACION MEDICENTER',
        'INSTITUCION PRESTADORA DE SERVICIOS CLINIMAS LTDA',
        'EMPRESA SOCIAL DEL ESTADO SALUD PEREIRA',
        'CENTRO DE SALUD DE SAMPUES (Sucre) EMPRESA SOCIAL DEL ESTADO',
        'ESE HOSPITAL NUESTRA SEÑORA DE GUADALUPE',
        'ESE HOSPITAL SAN JUAN DE DIOS DE PAMPLONA',
        'ESE HOSPITAL LOCAL SABANAS DE SAN ANGEL',
        'E.S.E. HOSPITAL SAN PIO X',
        'IPS INTEGRAL FUTURO LIMITADA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL DE PONEDERA',
        'CLINICA LA ERMITA DE CARTAGENA S.A.S.',
        'HOSPITAL DEPARTAMENTAL SAN JUAN DE DIOS DE RIOSUCIO CALDAS ESE',
        'UNIDAD CLINICA LA MAGDALENA SAS',
        'DAMOSALUD LTDA',
        'IPS INTEGRAL SANTA MARIA S.A.S',
        'E.S.E. HOSPITAL SAN NICOLAS',
        'E.S.E. HOSPITAL NUESTRA SEÑORA SANTA ANA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL LA DIVINA MISERICORDIA',
        'E.S.E. HOSPITAL LOCAL SAN JACINTO',
        'sociedad medica maria auxiliadora sas',
        'ESE HOSPITAL LOCAL DE SAN ONOFRE',
        'CENTRO DE SALUD SAN JUAN BAUTISTA DE PUPIALES EMPRESA SOCIAL DEL ESTADO',
        'CONGREGACION DE DOMINICAS DE SANTA CATALINA DE SENA',
        'ESE HOSPITAL SAGRADO CORAZON DE JESUS',
        'E.S.E HOSPITAL REGIONAL SURORIENTAL',
        'E.S.E. CENTRO DE SALUD BELEN',
        'ESE HOSPITAL LOCAL DE SALAMINA',
        'E.S.E. CENTRO DE SALUD SAN LORENZO',
        'ESE HOSPITAL LOCAL SAN SEBASTIAN',
        'clinica regional de especialistas sinais vitais sas',
        'RED DE SALUD DEL SURORIENTE ESE - HOSPITAL CARLOS CARMONA M.',
        'E.S.E. CENTRO DE SALUD DE COTORRA',
        'ESE HOSPITAL HECTOR ABAD GOMEZ',
        'CENTRO DE EXCELENCIA PARA EL MANEJO DE LA DIABETES S.A.S. SIGLA CEMDI SAS',
        'ASISTENCIAS INTEGRALES IPS SAS',
        'IPS BEST HOME CARE S.A.S',
        'ESE HOSPITAL LOCAL SAN JOSE DEACHI',
        'ESE HOSPITAL TULIA DURAN DE BORRERO',
        'FUNDACIÓN CENTRO DE EXCELENCIA EN ENFERMEDADES CRÓNICAS NO TRANSMISIBLES',
        'BOSTON MEDICAL CARE SAS IPS',
        'SUR SALUD IPS SAS',
        'HOSPITAL LOCAL ALVARO RAMIREZ GONZALEZ E.S.E',
        'MEDISAN SAS',
        'FUNDACION OFTALMOLOGICA NACIONAL',
        'ESE HOSPITAL SAN JUAN DE DIOS DE ANORI',
        'ESE HOSPITAL NUESTRA SEÑORA DE LA CANDELARIA',
        'E.S.E. CENTRO DE SALUD LA BUENA ESPERANZA',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL LOCAL DE ZONA BANANERA',
        'ESE SUR OCCIDENTE',
        'ESE HOSPITAL LOCAL MANUELA PABUENA LOBO',
        'HOSPITAL SAN JOSE E.S.E.',
        'ORGANIZACION BONSALUTI S.A.S.',
        'IPS CLINICA MEDICO FAMILIAR SAS',
        'HOSPITAL LOCAL PEDRO SAENZ DIAZ EMPRESA SOCIAL DEL ESTADO',
        'ENFOQUES EMPRESARIALES S.A.S.',
        'IPS FUNDACION SERSOCIAL SEDE CARTAGENA',
        'IPS HORIZONTE SOCIAL LA ESPERANZA SOCIEDAD POR ACCIONES SIMPLIFICADA',
        'Asociación Médica la Fe SAS',
        'IPS NUEVO HORIZONTE MOMPOX',
        'EMPRESA SOCIAL DEL ESTADO HOSPITAL OCTAVIO OLIVARES',
        'CENTRO DE SALUD SANTA LUCIA E.S.E.',
        'ESE HOSPITAL LOCAL DE RIO DE ORO',
        'ESE HOSPITAL LOCAL DE CONCORDIA',
        'FUNDACIÓN CAMPBELL',
        'E.S.E. HOSPITAL LOCAL DE SITIO NUEVO',
        'HOSPITAL LOCAL PRIMER NIVEL E.S.E. FUENTE DE ORO',
        'IPS CLINICA SAN IGNACIO LTDA',
        'NUEVA EPS',
        'FAMISANAR EPS',
        'MUTUAL SER E.S.S.',
        'COOSALUD ENTIDAD PROMOTORA DE SALUD SA',
        'ASMET SALUD EPS SAS',
        'EMSSANAR EPS',
        'SAVIA SALUD EPS',
        'CAJACOPI EPS SAS',
        'CAPITAL SALUD EPS-S',
        'S.O.S EPS SA',
        'CAJA DE COMPENSACION COMFENALCO',
        'ALIANSALUD EPS',
        'MALLAMAS EPS',
        'REGIMEN ESPECIAL',
        'OTRO',
    ];

    // Nombre de la tabla
    $tableInstitutions = $wpdb->prefix . 'institutions';

    // Verificar si la función se debe ejecutar
    $makeImport = false;

    // Comprobar si la tabla está vacía
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $tableInstitutions");
    if ($count == 0) {
        $makeImport = true;
    } else {
        // Comprobar si alguna de las instituciones ya existe
        foreach ($institutions as $institution) {
            $exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM $tableInstitutions WHERE institution_name = %s",
                $institution
            ));
            if ($exists == 0) {
                $makeImport = true;
                break;
            }
        }
    }

    // Insertar datos si es necesario
    if ($makeImport) {
        foreach ($institutions as $institution) {
            $wpdb->insert(
                $tableInstitutions,
                [
                    'institution_name' => sanitize_text_field($institution),
                    'code' => NULL,
                    'quantity' => NULL,
                    'uses' => NULL,
                    'created' => current_time('mysql')
                ],
                [
                    '%s',
                    '%s',
                    '%d',
                    '%d',
                    '%s'
                ]
            );
        }
    }
}

// Llamar a la función para importar instituciones
add_action('init', 'importInstitutions');



function importSpecialities()
{
    global $wpdb;


    $specialities = [
        'Auxiliar de enfermeria',
        'Cardiología',
        'Cirugia Bariatrica',
        'Deportología',
        'Endocrinología',
        'Endocrinología Pediátrica',
        'Enfermeria',
        'Epidemiología',
        'Fisiatría',
        'Fisioterapia',
        'Gastroenterología',
        'Genetista',
        'Geriatría',
        'Ginecología',
        'Hemato-Oncología',
        'Hematología',
        'Hematología Pediátrica',
        'Medicina Familiar',
        'Medicina General',
        'Medicina Intensiva',
        'Medicina Interna',
        'Nefrología',
        'Nefrología Pediátrica',
        'Neumología',
        'Nutrición',
        'Nutriología',
        'Ortopedia',
        'Pediatría',
        'Psicología',
        'Psiquiatría',
        'Químico farmacéutico',
        'Residente',
        'Reumatología',
        'Otro',
    ];

    // Nombre de la tabla
    $tableSpeciality = $wpdb->prefix . 'speciality';

    // Verificar si la función se debe ejecutar
    $makeImport = false;

    // Comprobar si la tabla está vacía
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $tableSpeciality");
    if ($count == 0) {
        $makeImport = true;
    } else {
        // Comprobar si alguna de las instituciones ya existe
        foreach ($specialities as $speciality) {
            $exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM $tableSpeciality WHERE name_speciality = %s",
                $speciality
            ));
            if ($exists == 0) {
                $makeImport = true;
                break;
            }
        }
    }

    // Insertar datos si es necesario
    if ($makeImport) {
        foreach ($specialities as $speciality) {
            $wpdb->insert(
                $tableSpeciality,
                [
                    'name_speciality' => sanitize_text_field($speciality),
                    'profile_type' => sanitize_text_field($speciality),
                    'created' => current_time('mysql')
                ],
                [
                    '%s',
                    '%s',
                    '%s'
                ]
            );
        }
    }
}

// Llamar a la función para importar instituciones
add_action('init', 'importSpecialities');








function importPosInstitution()
{
    global $wpdb;


    $positionInstitution = [
        'Auxiliar de enfermeria',
        'Auditor',
        'Director científico',
        'Coordinador médico',
        'Coordinador IPS',
        'Gerente médico',
        'Coordinador nacional',
        'Coordinador regional',
        'Coordinador administrativo',
        'Coordinador/Líder PYP',
        'Líder/Jefe de programas',
        'Gerente',
        'Químico Farmacéutico',
        'Dirección de calidad',
        'Gerente de medicamentos',
        'Gerente regional',
        'Gerente nacional',
        'Líder de medicamentos',
        'Auxiliar administrativo',
        'Analista de datos',
        'Nutricionista',
        'Enfermeria',
        'Psicólogo',
        'Otro',
    ];

    // Nombre de la tabla
    $tablepositionInstitution = $wpdb->prefix . 'position_institution';

    // Verificar si la función se debe ejecutar
    $makeImport = false;

    // Comprobar si la tabla está vacía
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $tablepositionInstitution");
    if ($count == 0) {
        $makeImport = true;
    } else {
        // Comprobar si alguna de las instituciones ya existe
        foreach ($positionInstitution as $positionIns) {
            $exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM $tablepositionInstitution WHERE name_pos_institution = %s",
                $positionIns
            ));
            if ($exists == 0) {
                $makeImport = true;
                break;
            }
        }
    }

    // Insertar datos si es necesario
    if ($makeImport) {
        foreach ($positionInstitution as $positionInsi) {
            $wpdb->insert(
                $tablepositionInstitution,
                [
                    'name_pos_institution' => sanitize_text_field($positionInsi),
                    'created' => current_time('mysql')
                ],
                [
                    '%s',
                    '%s'
                ]
            );
        }
    }
}

// Llamar a la función para importar instituciones
add_action('init', 'importPosInstitution');


function novo_innsider_check_menu_items_with_class()
{
    ob_start();

    function check_menu_items_with_class($items)
    {
        // Crear un array para almacenar los elementos con clase 'd-none'
        $hidden_items = [];

        // Itera sobre los elementos del menú
        foreach ($items as $item) {
            // Verifica si el elemento tiene la clase 'd-none'
            if (in_array('d-none', $item->classes)) {
                $hidden_items[] = $item;
            }
        }

        // Mostrar los elementos con clase 'd-none'
        if (!empty($hidden_items)) {
            foreach ($hidden_items as $item) { ?>
                <?php if ($item->title == 'Herramientas') : ?>
                <?php else : ?>
                    <div class="row d-flex justify-content-center align-align-items-center mb-4">
                        <div class="col-12 d-flex flex-lg-row">
                            <h1 class="title">HERRAMIENTAS INNSIDER</h1>
                            <div class="col-9 mx-1" id="linea">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-12 col-11 banner-category">
                            <div class="d-flex align-items-center justify-content-lg-end justify-content-center h-100">
                                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg';  ?>" alt="Herramientas" class="bg-banner-single-category">
                                <div class="mx-2 px-1 mx-lg-2 px-lg-2 mx-xl-5 px-xl-5 text-center test1">
                                    <h1 class="text-white">Conozca más sobre <br> herramientas</h1>
                                    <h5 class="text-white mb-5">que le permitirán tomar decisiones <br> basadas en datos</h5>
                                    <div class="button-group">
                                        <button class="btn btn-outline-light mx-1 px-3 btn-class">Calculadoras de salud</button>
                                        <button class="btn btn-outline-light mx-1 px-3 btn-class">Simulador de modelo</button>
                                        <button class="btn btn-outline-light mx-1 px-3 btn-class">Simulador de cobertura</button>
                                    </div>
                                    <div class="button-group mt-3">

                                        <?php if (is_page('login') || is_page('registro') || is_user_logged_in()) : ?>
                                        <?php else : ?>
                                            <?php $pageLogin = get_page_by_path('login'); ?>

                                            <?php if ($pageLogin) : ?>
                                                <?php $permalink = get_permalink($pageLogin->ID); ?>
                                                <button class="btn btn-light mx-2 btn-class px-5">
                                                    <a class="btn-login mx-2" id="btn-login" style="text-decoration: none;" href="<?php echo esc_url($permalink); ?>">
                                                        Ingresar
                                                    </a>
                                                </button>
                                            <?php endif ?>

                                            <?php $pageRegister = get_page_by_path('Registro'); ?>

                                            <?php if ($pageRegister) : ?>
                                                <?php $permalink = get_permalink($pageRegister->ID); ?>
                                                <button class="btn btn-light mx-2 btn-class px-5">
                                                    <a class="btn-login mx-2" id="btn-register" style="text-decoration: none;" href="<?php echo esc_url($permalink); ?>">
                                                        Registro
                                                    </a>
                                                </button>
                                            <?php endif ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php
                break;
            }
        }
    }

    // Filtro para añadir clases a los elementos del menú y luego verificar
    add_filter('wp_nav_menu_objects', 'check_menu_items_with_class');

    // Genera el menú
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'navbar-nav',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 3
    ));

    return ob_get_clean();
}




function novo_innsider_check_menu_items()
{
    ob_start();

    function check_menu_items($items)
    {
        // Crear un array para almacenar los elementos con clase 'd-none'
        $hidden_items = [];

        // Itera sobre los elementos del menú
        foreach ($items as $item) {
            // Verifica si el elemento tiene la clase 'd-none'
            if (in_array('d-none', $item->classes)) {
                $hidden_items[] = $item;
            }
        }

        // Mostrar los elementos con clase 'd-none'
        if (!empty($hidden_items)) {
            foreach ($hidden_items as $item) { ?>
                <?php if ($item->title == 'Herramientas') : ?>
                <?php else : ?>
                    <h1 class="title">HERRAMIENTAS INNSIDER</h1>
                    <div class="col-9 mx-1" id="linea">
                        <hr>
                    </div>
                <?php endif; ?>
<?php
                break;
            }
        }
    }

    // Filtro para añadir clases a los elementos del menú y luego verificar
    add_filter('wp_nav_menu_objects', 'check_menu_items');

    // Genera el menú
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'navbar-nav',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 3
    ));

    return ob_get_clean();
}


function novo_innsider_save_logs()
{
    if (is_user_logged_in()) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'log';

        $user_id = wp_get_current_user()->ID;
        $user_name = wp_get_current_user()->first_name;
        $url = 'https://innsider.com.co' . $_SERVER['REQUEST_URI'];
        $actionurl = 'Ingresa a la url';
        $ip = $_SERVER['REMOTE_ADDR'];

        $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'url' => $url,
            'actionurl' => $actionurl,
            'ip' => $ip
        ]);
    } else {

        global $wpdb;

        $table_name = $wpdb->prefix . 'log';

        $user_id = 0;
        $user_name = 'Usuario no registrado';
        $url = 'https://innsider.com.co' . $_SERVER['REQUEST_URI'];
        $actionurl = 'Ingresa a la url';
        $ip = $_SERVER['REMOTE_ADDR'];

        $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'url' => $url,
            'actionurl' => $actionurl,
            'ip' => $ip
        ]);
    }
}

function novo_innsider_save_logs_click()
{

    if (is_user_logged_in()) {

        global $wpdb;

        $table_name = $wpdb->prefix . 'log';

        $user_id = wp_get_current_user()->ID;
        $user_name = wp_get_current_user()->first_name;

        $url = $_POST['url'];
        $actionurl = $_POST['actionurl'];
        $ip = $_SERVER['REMOTE_ADDR'];

        $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'url' => $url,
            'actionurl' => $actionurl,
            'ip' => $ip
        ]);
    } else {

        global $wpdb;

        $table_name = $wpdb->prefix . 'log';

        $user_id = 0;
        $user_name = 'Usuario no registrado';
        $url = $_POST['url'];
        $actionurl = $_POST['actionurl'];
        $ip = $_SERVER['REMOTE_ADDR'];

        $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'url' => $url,
            'actionurl' => $actionurl,
            'ip' => $ip
        ]);
    }
}

add_action('wp_ajax_nopriv_save_logs_click', 'novo_innsider_save_logs_click');
add_action('wp_ajax_save_logs_click', 'novo_innsider_save_logs_click');



?>