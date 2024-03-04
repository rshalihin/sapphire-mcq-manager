<?php
/**
 * Admin class file.
 *
 * @package mcqtext.
 */

namespace Sapphire\Mcq;

/**
 * Include all frontend class in this class and enqueue some fronted scripte also some style.
 */
class Admin {

	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {

		new Admin\CustomPost();
		new Admin\AddMetabox();
		new Admin\SaveMetabox();
	}
}
