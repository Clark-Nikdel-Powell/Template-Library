<?php
namespace CNP\TemplateLibrary;


class LinkTest extends \PHPUnit_Framework_TestCase {

	public function testMarkup() {

		// Arrange
		$link = new Link( '/about', 'About Us', 'about-link' );

		// Act
		$link->get_markup();

		// Assert
		$this->assertEquals( '<a href="/about" class="about-link">About Us</a>', $link->markup );
	}

	public function testAttributes() {

		// Arrange
		$link = new Link( '#', 'Menu', 'menu-toggle', [ 'data-toggle-class' => 'open' ] );

		// Act
		$link->get_markup();

		// Assert
		$this->assertEquals( '<a data-toggle-class="open" href="#" class="menu-toggle">Menu</a>', $link->markup );
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testEmptyParameters() {

		// Arrange
		$link = new Link();
	}
}
