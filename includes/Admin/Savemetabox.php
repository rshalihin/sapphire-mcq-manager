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
		add_action( 'save_post', array( $this, 'smcq_save_metabox_callback' ) );
	}


	/**
	 * Method smcq_save_metabox_callback
	 *
	 * @param $post_id $post_id [explicite description].
	 *
	 * @return void
	 */
	public function smcq_save_metabox_callback( $post_id ) {

		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
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
