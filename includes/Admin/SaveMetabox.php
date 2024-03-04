<?php
/**
 * Save Meta box to MCQ Custom post type.
 *
 * @package mcqtext.
 */

namespace Sapphire\Mcq\Admin;

/**
 * Save Meta box to MCQ Custom post type.
 */
class SaveMetabox {
	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'save_post', array( $this, 'save_mcq_metabox' ) );
	}


	/**
	 * Method save_mcq_metabox
	 *
	 * @param int $post_id post id.
	 *
	 * @return void
	 */
	public function save_mcq_metabox( $post_id ) {
		$smcq_capability = apply_filters( 'smcq_capability', 'manage_options' );
		// if our current user can't edit this post, bail.
		if ( ! current_user_can( $smcq_capability ) ) {
			return;
		}

		$smcq_metabox_nonce = isset( $_POST['smcq_metabox_nonce'] ) ? sanitize_key( $_POST['smcq_metabox_nonce'] ) : '';
		// if our nonce isn't there, or we can't verify it, bail.
		if ( ! wp_verify_nonce( $smcq_metabox_nonce, 'smcq_metabox_nonce' ) ) {
			return;
		}

		if ( isset( $_POST['first_choice'] ) ) {
			update_post_meta( $post_id, 'mcq_first_choice', sanitize_text_field( wp_unslash( $_POST['first_choice'] ) ) );
		}

		if ( isset( $_POST['second_choice'] ) ) {
			update_post_meta( $post_id, 'mcq_second_choice', sanitize_text_field( wp_unslash( $_POST['second_choice'] ) ) );
		}

		if ( isset( $_POST['third_choice'] ) ) {
			update_post_meta( $post_id, 'mcq_third_choice', sanitize_text_field( wp_unslash( $_POST['third_choice'] ) ) );
		}

		if ( isset( $_POST['fourth_choice'] ) ) {
			update_post_meta( $post_id, 'mcq_fourth_choice', sanitize_text_field( wp_unslash( $_POST['fourth_choice'] ) ) );
		}

		if ( isset( $_POST['correct_ans'] ) ) {
			update_post_meta( $post_id, 'mcq_correct_ans', sanitize_text_field( wp_unslash( $_POST['correct_ans'] ) ) );
		}

		if ( isset( $_POST['short_note'] ) ) {
			update_post_meta( $post_id, 'mcq_short_note', sanitize_text_field( wp_unslash( $_POST['short_note'] ) ) );
		}
	}
}
