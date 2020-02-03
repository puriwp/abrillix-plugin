<?php

if ( !function_exists('abrillix_register_slides') ) {
    /**
     *  Register Slide Post Type 
     * */

    function abrillix_register_slides() {

        $abrillix_labels = array(
            'name'					=> __( 'Slides', 'abrillix' ),
            'singular_name'      	=> __( 'Slide', 'abrillix' ),
            'add_new'            	=> __( 'Add New', 'abrillix' ),
            'add_new_item'       	=> __( 'Add New Slide', 'abrillix' ),
            'edit_item'          	=> __( 'Edit Slide', 'abrillix' ),
            'new_item'           	=> __( 'New Slide', 'abrillix' ),
            'view_item'          	=> __( 'View Slide', 'abrillix' ),
            'search_items'       	=> __( 'Search Slides', 'abrillix' ),
            'not_found'          	=> __( 'No slides found', 'abrillix' ),
            'not_found_in_trash' 	=> __( 'No slides found in Trash', 'abrillix' ),
            'parent_item_colon'  	=> '',
            'menu_name'          	=> __( 'Slides', 'abrillix' )
        );

        $args = array(
            'labels'              => $abrillix_labels,
            'public'              => true,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_icon'           => 'dashicons-slides',
            'hierarchical'        => false,
            'supports'            => array( 'title' ),
            'has_archive'         => false,
            'rewrite'             => false,
            'query_var'           => true,
            'can_export'          => true,
            'show_in_nav_menus'   => false
        );

        register_post_type( 'slide', $args );
    }

    add_action( 'init', 'abrillix_register_slides', 0 );
}

// Add the custom columns to slide post type
add_filter( 'manage_slide_posts_columns', 'set_slide_columns' );
function set_slide_columns($columns) {
	$columns['shortcode'] = __( 'Shortcode', 'abrillix' );

	return $columns;
}

// Shortcode echo to achive slider admin
add_action( 'manage_slide_posts_custom_column', 'custom_slide_column', 10, 2 );
function custom_slide_column( $column, $post_id) {
	
	switch ( $column ) {
		case 'shortcode' :
			echo '[abrillix_slider id="'.$post_id.'"]';
		break;
	}
}

// Item slider, use in shortcode
function abrillix_slider_homepage($id) {
	$prefix = 'abr_';
	$sliders = get_post_meta( $id, $prefix . 'slider_images', true );

	if ( $sliders ) {
		foreach ( $sliders as $slider ) {
			?>
			<div class="item">
				<img src="<?php echo esc_url($slider);?>" alt="" class="img-responsive">
			</div>
	<?php
		}
	}
}

/**
 * Slider Fields
 */
add_action( 'cmb2_admin_init', 'add_metabox_slides' );
function add_metabox_slides() {

	$prefix = 'abr_';
	/**
	 * Initiate the metabox
	 */
	$slide = new_cmb2_box( array(
		'id'            => $prefix . 'slider',
		'title'         => __( 'Abrillix Slider', 'abrillix' ),
		'object_types'  => array( 'slide', ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
		'cmb_styles' => true,
	) );

	$slide->add_field( array(
		'name'       => __( 'Slider Style', 'abrillix' ),
		'id'         => $prefix . 'slider_style',
		'type'       => 'select',
		'default'		=> '1',
		'options'	=> array(
			'1'	=> __( 'Style One', 'abrillix' ),
			'2'	=> __( 'Style Two', 'abrillix' ),
			'3'	=> __( 'Style Three', 'abrillix' ),
		),
	) );

	$slide->add_field( array(
		'name'	=> __( 'Images', 'abrillix' ),
		'desc'	=> __( 'Add one or more image to slider', 'abrillix' ),
		'id'	=> $prefix . 'slider_images',
		'type'	=> 'file_list',
		'attributes' => array(
			'data-conditional-id'     => $prefix . 'slider_style',
			'data-conditional-value'  => wp_json_encode(array('1', '2', 3)),
		)
	) );

	$slide->add_field( array(
		'name'	=> __( 'Title' , 'abrillix' ),
		'desc'	=> __( 'Slider heading title', 'abrillix' ),
		'id'	=> $prefix . 'title',
		'type'	=> 'text',
		'attributes' => array(
			'data-conditional-id'     => $prefix . 'slider_style',
			'data-conditional-value'  => wp_json_encode(array('1', '2')),
		)
	) );

	$slide->add_field( array(
		'name'	=> __( 'Sub Title' , 'abrillix' ),
		'desc'	=> __( 'Slider heading sub title', 'abrillix' ),
		'id'	=> $prefix . 'subtitle',
		'type'	=> 'text',
		'attributes' => array(
			'data-conditional-id'     => $prefix . 'slider_style',
			'data-conditional-value'  => wp_json_encode(array('1', '2')),
		)
	 ) );

	$slide->add_field( array(
		'name'	=> __( 'Content Excerpt', 'abrillix' ),
		'desc'	=> __( 'Add content excerpt', 'abrillix' ),
		'id'	=> $prefix . 'content_excerpt',
		'type'	=> 'textarea_small',
		'attributes' => array(
			'data-conditional-id'     => $prefix . 'slider_style',
			'data-conditional-value'  => '2',
		)
	) );

	$slide->add_field( array(
	'name'	=> __( 'Button Link', 'abrillix' ),
	'desc'	=> __( 'Add url to related content or else.', 'abrillix' ),
	'id'	=> $prefix . 'url',
	'type'	=> 'text_url',
	'attributes' => array(
		'data-conditional-id'     => $prefix . 'slider_style',
		'data-conditional-value'  => '2',
	)
	) );

	$slide->add_field( array(
		'name'             => 'Select Featured Post',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'featured_slider_select',
		'type'             => 'pw_select',
		'options'			=> get_myposttype_options('post'),
		'attributes'    => array(
            'data-conditional-id'     => $prefix . 'slider_style',
			'data-conditional-value'  => '3',
        ),
	) );

}

// Helper for field
function get_myposttype_options($argument) {

    $get_post_args = array(
		'post_type' => $argument,
		'posts_per_page' => -1,
	);
	$options = [];
	foreach ( get_posts( $get_post_args ) as $post ) {

		$options[$post->ID] = get_the_title( $post->ID );
		
	}

	return $options;
    
}