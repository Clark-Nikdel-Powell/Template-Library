<?php
namespace CNP;

class Link extends Organism {

	public $href;

	public function __construct( $name, $href, $content ) {

		$this->name = $name;
		$this->href = $href;
	}

	public function get_markup() {

		ob_start();
		?>
		<a href="<?php echo $this->href ?>" <?php echo $this->get_attributes() ?>><?php echo $this->get_content() ?></a>

		<div class="<?php echo $this->name?>__buvebvui">

		</div>
		<?php
		$out = ob_get_clean();

		return $out;
	}
}
