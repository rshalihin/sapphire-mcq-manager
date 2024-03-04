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

		$attr = shortcode_atts(
			array(
				'category'   => '',
				'offset'     => -1,
				'orderby'    => 'date',
				'order'      => 'ASC',
				'btn_color'  => 'light blue',
				'text_color' => 'white',
			),
			$attr
		);

		$category   = $attr['category'];
		$offset     = $attr['offset'];
		$orderby    = $attr['orderby'];
		$order      = $attr['order'];
		$btn_color  = $attr['btn_color'];
		$text_color = $attr['text_color'];
		$smcq_i     = 0;

		ob_start();
		?>
		<section>
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : intval( 1 );
			if ( ! empty( $category ) ) {
				$smcq_test = new \WP_Query(
					array(
						'post_type'      => 'sphr-mcq-test',
						'posts_per_page' => intval( $offset ),
						'order'          => $order,
						'orderby'        => $orderby,
						'tax_query'      => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => array( $category ),
							),
						),
						'offset'         => ( $paged - 1 ) * intval( $offset ),
						'paged'          => $paged,
					)
				);
				echo '<h4>Category: ' . esc_html( ucfirst( $category ) ) . '</h4>';
			} else {
				$smcq_test = new \WP_Query(
					array(
						'post_type'      => 'sphr-mcq-test',
						'posts_per_page' => intval( $offset ),
						'order'          => $order,
						'orderby'        => $orderby,
						'paged'          => $paged,
						'offset'         => ( $paged - 1 ) * intval( $offset ),
					)
				);
			}

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
					<button type="button" class="btn btn-info full-width" style="background-color: <?php echo esc_attr( $btn_color ); ?>
					;color:
					<?php
					echo esc_attr( $text_color );
					?>
					" id="btn-toggle-<?php echo esc_attr( get_the_ID() ); ?>" data-toggle="collapse" data-target="#correct-ans-<?php echo esc_attr( get_the_ID() ); ?>">Show Answer</button>
					<div id="correct-ans-<?php echo esc_attr( get_the_ID() ); ?>" class="collapse ans-bdr">
						<p><span>Corect Answer is: </span><?php echo wp_kses_post( $corrent_ans ); ?></p>
						<p><span>Note: </span><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'mcq_short_note', true ) ); ?></p>
					</div>
				</div>
			</div>
				<?php endwhile; ?>
				<div class="smcq-pagination">
					<?php
						echo wp_kses_post(
							paginate_links(
								array(
									'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
									'total'        => $smcq_test->max_num_pages,
									'current'      => max( 1, get_query_var( 'paged' ) ),
									'format'       => '?paged=%#%',
									'show_all'     => false,
									'type'         => 'plain',
									'end_size'     => 2,
									'mid_size'     => 1,
									'prev_next'    => true,
									'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer MCQs', 'sapphire-mcq-manager' ) ),
									'next_text'    => sprintf( '%1$s <i></i>', __( 'Older MCQs', 'sapphire-mcq-manager' ) ),
									'add_args'     => false,
									'add_fragment' => '',
								)
							)
						);
					?>
				</div>
		</section>	
		<?php
		wp_reset_postdata();
		return ob_get_clean();
	}
}