<?php
namespace CNP;

class PostHeaderArchive extends Organism {

	public $data;

	public function __construct( $name, $data ) {

		$this->name = $name;
		$this->data = $data;
	}

	public function get_markup() {

		ob_start();
		?>
		<div <?php echo $this->get_attributes() ?>>
			<h3 class="<?php echo $this->name?>__title"></h3>
		</div>
		<?php
		$out = ob_get_clean();

		return $out;
	}
}
