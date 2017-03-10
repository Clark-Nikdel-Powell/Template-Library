<?php
namespace CNP\TemplateLibrary;

class ACFBlurblistTest extends \PHPUnit_Framework_TestCase {

	public function testBlurblist() {

		// Arrange
		$blurblist_data = [
			'acf_fc_layout'   => 'layout_blurb_list',
			'list_pretitle'   => 'Solutions',
			'list_title'      => 'Simple, Secure, Compliant',
			'list_intro'      => 'Protected Trust takes the complexity out of technology to make it work for your business.',
			'blurbs'          => [
				[
					'label'            => 'Cloud',
					'foreground_image' => '',
					'title'            => '',
					'subtitle'         => '',
					'text'             => '',
					'link'             => '',
					'page_link'        => 'http://pt.dev/solutions/cloud/',
					'link_text'        => 'Cloud',
					'background_image' => '',
					'background_color' => '',
					'class'            => '',
					'id'               => '',
					'hide'             => false,
				],
				[
					'label'            => 'Office 365',
					'foreground_image' => '',
					'title'            => '',
					'subtitle'         => '',
					'text'             => '',
					'link'             => '',
					'page_link'        => 'http://pt.dev/solutions/office-365/',
					'link_text'        => 'Office 365',
					'background_image' => '',
					'background_color' => '',
					'class'            => '',
					'id'               => '',
					'hide'             => false,
				],
				[
					'label'            => 'Encrypted Email',
					'foreground_image' => '',
					'title'            => '',
					'subtitle'         => '',
					'text'             => '',
					'link'             => '',
					'page_link'        => 'http://pt.dev/solutions/encrypted-email/',
					'link_text'        => 'Encrypted Email',
					'background_image' => '',
					'background_color' => '',
					'class'            => 'these,are,some, classes',
					'id'               => '',
					'hide'             => false,
				],
			],
			'list_link'       => '',
			'list_link_text'  => '',
			'label'           => 'Solutions Button List',
			'label_color'     => '',
			'name'            => 'buttonlist',
			'class'           => 'buttonlist--solutions',
			'id'              => '',
			'indent'          => '1',
			'hide'            => false,
			'elements'        => [
				'List Title',
				'List Intro',
				'Blurb Link',
				'List Pretitle',
			],
			'background_type' => 'None',
			'link_type'       => 'Button',
			'link_location'   => 'Internal',
			'blurb_classes'   => '',
		];

		$acf_blurblist = new ACFBlurbList( $blurblist_data );

		// Act

		// Assert
		$this->assertEquals( '<div class="buttonlist--solutions buttonlist"><div class="buttonlist__list-header"><div class="buttonlist__list-title">Simple, Secure, Compliant</div><div class="buttonlist__list-intro">Protected Trust takes the complexity out of technology to make it work for your business.</div></div><div class="buttonlist__list-loop"><div class="buttonlist__blurb"><div class="buttonlist__blurb-inside"><a href="http://pt.dev/solutions/cloud/" class="buttonlist__blurb-link">Cloud</a></div></div><div class="buttonlist__blurb"><div class="buttonlist__blurb-inside"><a href="http://pt.dev/solutions/office-365/" class="buttonlist__blurb-link">Office 365</a></div></div><div class="these are some classes buttonlist__blurb"><div class="buttonlist__blurb-inside"><a href="http://pt.dev/solutions/encrypted-email/" class="buttonlist__blurb-link">Encrypted Email</a></div></div></div></div>', $acf_blurblist->get_markup() );

	}
}
