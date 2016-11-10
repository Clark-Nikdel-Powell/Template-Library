<?php
namespace CNP;

class PostTitleLink extends Organism {

	public $data;

	public function __construct() {
	}

	public function get_markup() {

		ob_start();
		?>

		<?php
		$out = ob_get_clean();

		return $out;
	}
}
