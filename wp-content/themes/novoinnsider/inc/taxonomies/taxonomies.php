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

function novo_mc_taxonomies() {
    /**
     *  Category Speakers
     */
    register_taxonomy(
        'academia', // Nombre de la taxonomía
        'post', // Nombre del post type que se le asignará
        array(
            'label' => __( 'Academia' ),
            'rewrite' => array( 'slug' => 'academia' ),
            'hierarchical' => true,
        )
    );
}

add_action( 'init', 'novo_mc_taxonomies' );