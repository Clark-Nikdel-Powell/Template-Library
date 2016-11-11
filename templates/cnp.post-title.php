<?php
namespace CNP;

class PostTitle extends Organism {

	public $data;

	public function __construct( $name, $data, $tag = 'h2' ) {

		parent::__construct( $name, $tag, [], get_the_title( $data ), null, '', '', '', '' );
	}

	public function get_markup() {

		ob_start();
		?>
		<<?php echo $this->tag ?> class="<?php $this->name ?>__title"><?php echo $this->get_content() ?></<?php echo $this->tag ?>>
		<?php
		$out = ob_get_clean();

		return $out;
	}
}
