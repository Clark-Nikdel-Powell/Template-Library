<?php
namespace CNP;

class PostLink extends Link {

	public function __construct() {
	}

	public function get_markup() {

		ob_start();
		?>
		<a href=""></a>
		<?php
		$out = ob_get_clean();

		return $out;
	}
}
