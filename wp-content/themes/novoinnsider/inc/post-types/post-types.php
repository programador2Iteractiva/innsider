<?php

/**
 * Include a new post-type Banner for New_MasterClass
 */

function novo_inssider_post_type() {

    /**
     * Post Type Banner
     */

    $labels = array(
        'name'               => _x( 'Banners', 'post type general name' ),
        'singular_name'      => _x( 'Banner', 'post type singular name' ),
        'menu_name'          => _x( 'Banner', 'admin menu' ),
        'name_admin_bar'     => _x( 'Banner', 'add new on admin bar' ),
        'add_new'            => _x( 'Agregar Banner', 'Slide' ),
        'add_new_item'       => __( 'Name' ),
        'new_item'           => __( 'New Slide' ),
        'edit_item'          => __( 'Editar Banner' ),
        'view_item'          => __( 'Ver Banner' ),
        'all_items'          => __( 'Todos los banner' ),
        'featured_image'     => __( 'Imagen destacada', 'text_domain' ),
        'search_items'       => __( 'Buscar banner' ),
        'parent_item_colon'  => __( 'Parent Slide:' ),
        'not_found'          => __( 'No se han encontrado banners.' ),
        'not_found_in_trash' => __( 'No se han encontrado banners en la papelera..' ),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-images-alt2',
        'description'        => __( 'Description.' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'Banner', $args );

    /**
     * -- End Post Type Banner
     */


    /**
     * Post Type Tendencias
    */

    $labels = array(
        'name'               => _x( 'Tendencias', 'post type general name' ),
        'singular_name'      => _x( 'Tendencia', 'post type singular name' ),
        'menu_name'          => _x( 'Tendencias', 'admin menu' ),
        'name_admin_bar'     => _x( 'Tendencia', 'add new on admin bar' ),
        'add_new'            => _x( 'Agregar tendencia', 'Slide' ),
        'add_new_item'       => __( 'Agregar nueva tendencia' ),
        'new_item'           => __( 'Nueva tendencia' ),
        'edit_item'          => __( 'Editar tendencia' ),
        'view_item'          => __( 'Ver tendencia' ),
        'all_items'          => __( 'Todas las tendencias' ),
        'featured_image'     => __( 'Imagen destacada' ),
        'search_items'       => __( 'Buscar tendencia' ),
        'parent_item_colon'  => __( 'Tendencia padre:' ),
        'not_found'          => __( 'No se han encontrado tendencias.' ),
        'not_found_in_trash' => __( 'No se han encontrado tendencias en la papelera.' ),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-cover-image',
        'description'        => __( 'Descripción de Tendencias.' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'tendencias' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 6,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'tendencia', $args );

    /**
     * -- End Post Type Tendencias
    */

    /**
     * Post Type Vision iNNsider
    */

    $labels = array(
        'name'               => _x( 'Vision iNNsiders', 'post type general name' ),
        'singular_name'      => _x( 'Vision iNNsider', 'post type singular name' ),
        'menu_name'          => _x( 'Vision iNNsiders', 'admin menu' ),
        'name_admin_bar'     => _x( 'Vision iNNsider', 'add new on admin bar' ),
        'add_new'            => _x( 'Agregar Vision iNNsider', 'Slide' ),
        'add_new_item'       => __( 'Agregar nuevo Vision iNNsiders' ),
        'new_item'           => __( 'Nueva Vision iNNsider' ),
        'edit_item'          => __( 'Editar Vision iNNsider' ),
        'view_item'          => __( 'Ver Vision iNNsider' ),
        'all_items'          => __( 'Todas las Vision iNNsiders' ),
        'featured_image'     => __( 'Imagen Vision iNNsider' ),
        'search_items'       => __( 'Buscar Vision iNNsider' ),
        'parent_item_colon'  => __( 'Vision iNNsider padre:' ),
        'not_found'          => __( 'No se han encontrado Vision iNNsider.' ),
        'not_found_in_trash' => __( 'No se han encontrado Vision iNNsider en la papelera.' ),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-cover-image',
        'description'        => __( 'Descripción de Vision iNNsiders.' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'vision-innsiders' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 6,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'vision-innsiders', $args );

    /**
     * -- End Post Type Vision iNNsider
    */

    /**
    * Post Type Experiencias
    */

    $labels = array(
        'name'               => _x( 'Experiencias', 'post type general name' ),
        'singular_name'      => _x( 'Experiencia', 'post type singular name' ),
        'menu_name'          => _x( 'Experiencias', 'admin menu' ),
        'name_admin_bar'     => _x( 'Experiencia', 'add new on admin bar' ),
        'add_new'            => _x( 'Agregar experiencia', 'Slide' ),
        'add_new_item'       => __( 'Agregar nueva experiencia' ),
        'new_item'           => __( 'Nueva experiencia' ),
        'edit_item'          => __( 'Editar experiencia' ),
        'view_item'          => __( 'Ver experiencia' ),
        'all_items'          => __( 'Todas las experiencia' ),
        'featured_image'     => __( 'Imagen destacada' ),
        'search_items'       => __( 'Buscar experiencia' ),
        'parent_item_colon'  => __( 'experiencia padre:' ),
        'not_found'          => __( 'No se han encontrado experiencia' ),
        'not_found_in_trash' => __( 'No se han encontrado experiencia en la papelera.' ),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-cover-image',
        'description'        => __( 'Descripción de Experiencia.' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'experiencia' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 6,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'experiencia', $args );

    /**
     * -- End Post Type Tendencias
    */
}

add_action( 'init', 'novo_inssider_post_type' );


