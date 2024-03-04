<?php
/**
 * Add Meta box to MCQ Custom post type.
 *
 * @package mcqtext.
 */

namespace Sapphire\Mcq\Admin;

/**
 * Add Meta box to MCQ Custom post type.
 */
class AddMetabox {
	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'smcq_metabox_callback' ) );
	}

	/**
	 * Method smcq_metabox_callback
	 *
	 * @return void
	 */
	public function smcq_metabox_callback() {
		add_meta_box( 'smcq-first-mcq', __( 'MCQ First Choice', 'sapphire-mcq-manager' ), array( $this, 'smcq_metabox_field_callback' ), 'sphr-mcq-test' );
	}

	/**
	 * Method smcq_metabox_field_callback
	 *
	 * @return void
	 */
	public function smcq_metabox_field_callback() {

		$first_choice_value  = get_post_meta( get_the_ID(), 'mcq_first_choice', true );
		$second_choice_value = get_post_meta( get_the_ID(), 'mcq_second_choice', true );
		$third_choice_value  = get_post_meta( get_the_ID(), 'mcq_third_choice', true );
		$fourth_choice_value = get_post_meta( get_the_ID(), 'mcq_fourth_choice', true );
		$correct_ans_value   = get_post_meta( get_the_ID(), 'mcq_correct_ans', true );
		$short_note_value    = get_post_meta( get_the_ID(), 'mcq_short_note', true );

		wp_nonce_field( 'smcq_metabox_nonce', 'smcq_metabox_nonce' );
		?>
		
		<div class="sphr-mcq-form">
			<div class="sphr-mcq-field">
			<label for="first_choice" class="col-20">[A] First Chioce: </label>
			<input type="text" id="first_choice" class="col-80" name="first_choice" value="<?php echo esc_attr( $first_choice_value ); ?>">
			</div>

			<div class="sphr-mcq-field">
			<label for="second_choice" class="col-20">[B] Second Chioce: </label>
			<input type="text" id="second_choice" class="col-80" name="second_choice" value="<?php echo esc_attr( $second_choice_value ); ?>">
			</div>

			<div class="sphr-mcq-field">
			<label for="third_choice" class="col-20">[C] Third Chioce: </label>
			<input type="text" id="third_choice" class="col-80" name="third_choice" value="<?php echo esc_attr( $third_choice_value ); ?>">
			</div>

			<div class="sphr-mcq-field">
			<label for="fourth_choice" class="col-20">[D] Fourth Chioce: </label>
			<input type="text" id="fourth_choice" class="col-80" name="fourth_choice" value="<?php echo esc_attr( $fourth_choice_value ); ?>">
			</div>

			<div class="sphr-mcq-field">
			<label class="col-20">Correct Answer: </label>

				<select name="correct_ans" required>
					
					<option value="">Select an answer</option>

					<option value="first_choice" <?php echo 'first_choice' === $correct_ans_value ? 'selected' : ''; ?> > [ A ] </option>

					<option value="second_choice" <?php echo 'second_choice' === $correct_ans_value ? 'selected' : ''; ?> >[ B ]</option>

					<option value="third_choice" <?php echo 'third_choice' === $correct_ans_value ? 'selected' : ''; ?>>[ C ]</option>

					<option value="fourth_choice" <?php echo 'fourth_choice' === $correct_ans_value ? 'selected' : ''; ?> >[ D ]</option>
				</select>
			</div>

			<div class="sphr-mcq-field">
			<label for="short_note" class="col-20 textarea">Short Note: </label>        
			<textarea id="short_note" class="col-80" name="short_note" ><?php echo esc_attr( $short_note_value ); ?></textarea>
			</div>
		</div>
		<?php
	}
}
