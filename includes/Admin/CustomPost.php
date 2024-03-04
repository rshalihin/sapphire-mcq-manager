<?php
/**
 * Add Custom post type for MCQ.
 *
 * @package mcqtext.
 */

namespace Sapphire\Mcq\Admin;

/**
 * Add a MCQ Custom post type.
 */
class CustomPost {

	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	// Initialize the init callback.
	/**
	 * Method smcq_defualt_init_callback
	 *
	 * @return void
	 */
	public function register_post_type() {
		
		$smcq_capability = apply_filters( 'smcq_capability', 'manage_options' );
		$show_ui         = current_user_can( $smcq_capability ) ? true : false;

		// Register MCQ Post Type.
		register_post_type(
			'sphr-mcq-test',
			array(
				'labels'    => array(
					'name'         => __( 'MCQ Test', 'sapphire-mcq-manager' ),
					'add_new'      => __( 'Add New MCQ', 'sapphire-mcq-manager' ),
					'add_new_item' => __( 'Add New MCQ Question', 'sapphire-mcq-manager' ),
					'edit_item'    => __( 'Edit MCQ Question', 'sapphire-mcq-manager' ),
					'view_item'    => __( 'View MCQ', 'sapphire-mcq-manager' ),
					'all_items'    => __( 'All MCQs', 'sapphire-mcq-manager' ),
				),
				'public'    => false,
				'show_ui'   => $show_ui,
				'menu_icon' => 'dashicons-yes-alt',
				'supports'  => array( 'title' ),
			),
		);

		// Register Taxonomy in MCQ Test Custom post.
		$label = array(
			'name'              => _x( 'Category', 'taxonomy general name', 'sapphire-mcq-manager' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'sapphire-mcq-manager' ),
			'search_items'      => __( 'SearchCategory', 'sapphire-mcq-manager' ),
			'all_items'         => __( 'AllCategory', 'sapphire-mcq-manager' ),
			'parent_item'       => __( 'Parent Category', 'sapphire-mcq-manager' ),
			'parent_item_colon' => __( 'Parent Category:', 'sapphire-mcq-manager' ),
			'edit_item'         => __( 'Edit Category', 'sapphire-mcq-manager' ),
			'update_item'       => __( 'Update Category', 'sapphire-mcq-manager' ),
			'add_new_item'      => __( 'Add New Category', 'sapphire-mcq-manager' ),
			'new_item_name'     => __( 'New Category Name', 'sapphire-mcq-manager' ),
			'menu_name'         => __( 'Category', 'sapphire-mcq-manager' ),
		);

		$argument = array(
			'hierarchical'      => true,
			'labels'            => $label,
			'public'            => false,
			'show_ui'           => $show_ui,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'category', 'sphr-mcq-test', $argument );
	}
}
