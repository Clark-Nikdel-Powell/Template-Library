<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 12/29/16
 * Time: 12:35 PM
 */

namespace CNP\TemplateLibrary;


class LoopTest extends \PHPUnit_Framework_TestCase {

	public function testBasicMarkup() {

		// Arrange
		$sub_items_organism_class = 'CNP\\TemplateLibrary\\Link';
		$sub_items_data           = [
			[
				'/about-us',
				'About Us',
				'about-link',
			],
			[
				'/contact',
				'Contact',
			],
			[
				'/blog',
				'Blog',
				'blog-link',
			],
		];

		$loop = new Loop( $sub_items_data, $sub_items_organism_class );

		// Act
		$loop->get_markup();

		// Assert
		$this->assertEquals( '<div class="loop"><a href="/about-us" class="about-link">About Us</a><a href="/contact" class="link">Contact</a><a href="/blog" class="blog-link">Blog</a></div>', $loop->markup );

	}
}
