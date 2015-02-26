<?php

App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('SocialShareHelper', 'SocialShare.View/Helper');

class SocialShareHelperTest extends CakeTestCase {

	public function setUp() {
		parent::setUp();
		$Controller = new Controller();
		$View = new View($Controller);
		$this->SocialShare = new SocialShareHelper($View);
	}

	public function testLinks() {

		// Facebook test
		$expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com">Share</a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->link(
				'facebook',
				'Share',
				'http://example.com'
			)
		);

		// Twitter test
		$expected = '<a href="http://twitter.com/home?status=Foo+bar+http%3A%2F%2Fexample.com">Share</a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->link(
				'twitter',
				'Share',
				'http://example.com',
				array('title' => 'Foo bar')
			)
		);

	}

}