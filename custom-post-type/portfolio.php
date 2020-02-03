<?php
/**
 * Abrillix function to register Portfolio post type.
 * 
 * @package abrillix
 * @since abrillix 0.0.1
 */

if ( !function_exists('portfolio_post_type') ) {
    /**
     * Custom Post Type Portfolio
     */
    
    function portfolio_post_type() {
    
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Portfolio', 'Post Type General Name', 'abrillix' ),
            'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'abrillix' ),
            'menu_name'           => __( 'Portfolios', 'abrillix' ),
            'parent_item_colon'   => __( 'Parent Porfolio', 'abrillix' ),
            'all_items'           => __( 'All Portfolios', 'abrillix' ),
            'view_item'           => __( 'View Porfolio', 'abrillix' ),
            'add_new_item'        => __( 'Add New Porfolio', 'abrillix' ),
            'add_new'             => __( 'Add New', 'abrillix' ),
            'edit_item'           => __( 'Edit Porfolio', 'abrillix' ),
            'update_item'         => __( 'Update Porfolio', 'abrillix' ),
            'search_items'        => __( 'Search Porfolio', 'abrillix' ),
            'not_found'           => __( 'Not Found', 'abrillix' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'abrillix' ),
        );
        
        // Set other options for Custom Post Type
        
        $args = array(
            'label'               => __( 'portfolio', 'abrillix' ),
            'description'         => __( 'Portfolio post type', 'abrillix' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        
        // Registering your Custom Post Type
        register_post_type( 'portfolio', $args );
    
    }
    
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
    
    add_action( 'init', 'portfolio_post_type', 0 );
}