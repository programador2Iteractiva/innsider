<?php

/**
 * Include a new post-type Banner for New_MasterClass
 */

function Masterclass_post_type() {

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
        'menu_position'      => null,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'Banner', $args );

    /**
     * -- End Post Type Banner
     */
}

add_action( 'init', 'Masterclass_post_type' );


