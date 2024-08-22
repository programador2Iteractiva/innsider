<?php
/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 *
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */

function novo_inssider_taxonomies() {
    /**
     *  Category Academia
     */
    register_taxonomy(
        'academia', // Nombre de la taxonomía
        'post', // Nombre del post type que se le asignará
        array(
            'label' => __( 'Academia' ),
            'rewrite' => array( 'slug' => 'academia' ),
            'hierarchical' => true,
            'show_ui' => true, // Muestra en el panel de administración
            'show_admin_column' => true, // Muestra en la columna de la lista de publicaciones
            'query_var' => true, // Permite usar en consultas
            'show_in_nav_menus' => true, // Muestra en menús de navegación
            'show_in_rest' => true, // Asegúrate de que aparezca en el editor de bloques de Gutenberg
        )
    );

    /**
    *  taxonomia Noticias en texto
    */
    register_taxonomy(
        'tendencias', // Nombre de la taxonomía
        'tendencia', // Nombre del post type que se le asignará
        array(
            'label' => __( 'Tendencia' ),
            'rewrite' => array( 'slug' => 'tendencia' ),
            'hierarchical' => true,
            'show_ui' => true, // Muestra en el panel de administración
            'show_admin_column' => true, // Muestra en la columna de la lista de publicaciones
            'query_var' => true, // Permite usar en consultas
            'show_in_nav_menus' => true, // Muestra en menús de navegación
            'show_in_rest' => true, // Asegúrate de que aparezca en el editor de bloques de Gutenberg
        )
    );

    /**
    *  taxonomia vision-innsider
    */
    register_taxonomy(
        'visioninnsider-category', // Nombre de la taxonomía
        'vision-innsiders', // Nombre del post type que se le asignará
        array(
            'label' => __( 'Vision-innsider' ),
            'rewrite' => array( 'slug' => 'visioninnsider-category' ),
            'hierarchical' => true,
            'show_ui' => true, // Muestra en el panel de administración
            'show_admin_column' => true, // Muestra en la columna de la lista de publicaciones
            'query_var' => true, // Permite usar en consultas
            'show_in_nav_menus' => true, // Muestra en menús de navegación
            'show_in_rest' => true, // Asegúrate de que aparezca en el editor de bloques de Gutenberg
        )
    );

}

add_action( 'init', 'novo_inssider_taxonomies' );