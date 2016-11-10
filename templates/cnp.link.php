<?php
namespace CNP;

class Link extends Organism {

	public $href;

	public function __construct( $href, $name = 'link', $tag = 'a', $attributes = [], $content = '', $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {
		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		$this->href = $href;
	}

	public function get_markup() {
		ob_start();
		?>
		<a href="<?php echo $this->href ?>" <?php echo $this->get_attributes() ?>><?php echo $this->get_content() ?></a>
		<?php
		$out = ob_get_clean();

		return $out;
	}
}
