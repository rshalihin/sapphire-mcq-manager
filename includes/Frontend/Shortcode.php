<?php
/**
 * Save Meta box to MCQ Custom post type.
 *
 * @package mcqtext.
 */

namespace Sapphire\Mcq\Frontend;

/**
 * Create Shortcode for use.
 */
class Shortcode {
	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'sapphire-mcq', array( $this, 'sphr_mcq_shortcode_callback' ) );
	}

	/**
	 * Method sphr_mcq_shortcode_callback
	 *
	 * @param attr $attr [ shortcode attributes ].
	 *
	 * @return $content
	 */
	public function sphr_mcq_shortcode_callback( $attr ) {

		$attributes = extract(
			shortcode_atts(
				array(
					'category'       => '',
					'posts_per_page' => -1,
					'orderby'        => 'date',
					'order'          => 'ASC',
					'btn_color'      => 'light blue',
					'text_color'     => 'white',
				),
				$attr
			)
		);
		$smcq_i     = 0;
		ob_start();

		?>

		<section>
			<?php

			global $paged;
				$smcq_test = new \WP_Query(
					array(
						'post_type'      => 'sphr-mcq-test',
						'posts_per_page' => $posts_per_page,
						'order'          => $order,
						'orderby'        => $orderby,
						'tax_query'      => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => array( $category ),
							),
						),
						'paged'          => $paged,
					)
				);

				echo '<h4>Category: ' . esc_html( ucfirst( $category ) ) . '</h4>';

			while ( $smcq_test->have_posts() ) :
					$smcq_test->the_post();
				?>
				
			
			<div class="question-section">
					<?php
					++$smcq_i;
					$corrent_ans_key = get_post_meta( get_the_ID(), 'mcq_correct_ans', true );
					$corrent_ans     = get_post_meta( get_the_ID(), 'mcq_' . $corrent_ans_key, true );
					?>
				<div class="question">
									
					<h5>
					<span class="mcq-sl"><?php echo esc_attr( $smcq_i ); ?> </span><?php the_title(); ?>
					</h5>
					<p class="smgr-ngt">[A] <?php echo esc_attr( get_post_meta( get_the_ID(), 'mcq_first_choice', true ) ); ?></p>
					<p class="smgr-ngt">[B] <?php echo esc_attr( get_post_meta( get_the_ID(), 'mcq_second_choice', true ) ); ?></p>
					<p class="smgr-ngt">[C] <?php echo esc_attr( get_post_meta( get_the_ID(), 'mcq_third_choice', true ) ); ?></p>
					<p class="smgr-ngt">[D] <?php echo esc_attr( get_post_meta( get_the_ID(), 'mcq_fourth_choice', true ) ); ?></p>
					
				</div>

				<div class="ans-btn">
					<button type="button" class="btn btn-info full-width" style="background-color:
					<?php
					echo esc_html( $btn_color );
					?>
					;color:
					<?php
					echo esc_html( $text_color );
					?>
					" id="btn-toggle-<?php echo esc_attr( get_the_ID() ); ?>" data-toggle="collapse" data-target="#correct-ans-<?php echo esc_attr( get_the_ID() ); ?>">Show Answer</button>
					<div id="correct-ans-<?php echo esc_attr( get_the_ID() ); ?>" class="collapse ans-bdr">
						<p><span>Corect Answer is: </span><?php echo wp_kses_post( $corrent_ans ); ?></p>
						<p><span>Note: </span><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'mcq_short_note', true ) ); ?></p>
					</div>
				</div>
			</div>
				<?php endwhile; ?>
				<div class="paxinador">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => __( 'Back', 'smcq-test' ),
						'next_text' => __( 'Onward', 'smcq-test' ),
					)
				);
				?>
				</div>
		</section>	
		<?php
		return ob_get_clean();
	}
}