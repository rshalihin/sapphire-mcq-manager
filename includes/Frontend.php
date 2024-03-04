<?php
/**
 * Create Shortcode.
 *
 * @package mcqtext.
 */

namespace Sapphire\Mcq;

/**
 * Include all frontend class in this class and enqueue some fronted scripte also some style.
 */
class Frontend {

	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {

		new Frontend\Shortcode();
	}
}
