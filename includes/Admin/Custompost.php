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
		add_action( 'init', array( $this, 'smcq_custom_post_callback' ) );
	}

	// Initialize the init callback.
	/**
	 * Method smcq_defualt_init_callback
	 *
	 * @return void
	 */
	public function smcq_custom_post_callback() {
		// Register Custom Post.
		register_post_type(
			'sphr-mcq-test',
			array(
				'labels'    => array(
					'name'         => __( 'MCQ Test', 'smcq-test' ),
					'add_new'      => __( 'Add New MCQ', 'smcq-test' ),
					'add_new_item' => __( 'Add New MCQ Question', 'smcq-test' ),
					'edit_item'    => __( 'Edit MCQ Question', 'smcq-test' ),
					'view_item'    => __( 'View MCQ', 'smcq-test' ),
					'all_items'    => __( 'All MCQ', 'smcq-test' ),
				),
				'public'    => true,
				'menu_icon' => 'dashicons-yes-alt',
				'supports'  => array( 'title' ),

			),
		);

		// Register Taxonomy in MCQ Test Custom post.
		$label = array(
			'name'              => _x( 'Category', 'taxonomy general name', 'smcq-test' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'smcq-test' ),
			'search_items'      => __( 'SearchCategory', 'smcq-test' ),
			'all_items'         => __( 'AllCategory', 'smcq-test' ),
			'parent_item'       => __( 'Parent Category', 'smcq-test' ),
			'parent_item_colon' => __( 'Parent Category:', 'smcq-test' ),
			'edit_item'         => __( 'Edit Category', 'smcq-test' ),
			'update_item'       => __( 'Update Category', 'smcq-test' ),
			'add_new_item'      => __( 'Add New Category', 'smcq-test' ),
			'new_item_name'     => __( 'New Category Name', 'smcq-test' ),
			'menu_name'         => __( 'Category', 'smcq-test' ),
		);

		$argument = array(
			'hierarchical'      => true,
			'labels'            => $label,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'category', 'sphr-mcq-test', $argument );
	}
}
