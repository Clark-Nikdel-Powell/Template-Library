<?php
namespace CNP;

class ExcerptForce extends Excerpt {
	public function get_markup() {
		return sprintf( '%s%s%s', $this->before, $this->content, $this->after );
	}
}
