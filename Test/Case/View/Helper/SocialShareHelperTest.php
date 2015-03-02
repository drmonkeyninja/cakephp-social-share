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

	public function testHref() {

		$urls = array(
			'delicious' => 'http://delicious.com/post?url=http%3A%2F%2Fexample.com&amp;title=Foo+bar',
			'digg' => 'http://digg.com/submit?url=http%3A%2F%2Fexample.com&amp;title=Foo+bar',
			'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com',
			'google' => 'http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=http%3A%2F%2Fexample.com&amp;title=Foo+bar',
			'gplus' => 'https://plus.google.com/share?url=http%3A%2F%2Fexample.com',
			'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fexample.com&amp;title=Foo+bar',
			'reddit' => 'http://www.reddit.com/submit?url=http%3A%2F%2Fexample.com&amp;title=Foo+bar',
			'twitter' => 'http://twitter.com/home?status=Foo+bar+http%3A%2F%2Fexample.com'
		);

		$options = array(
			'text' => 'Foo bar'
		);

		foreach ($urls as $service => $expected) {
			$this->assertEquals(
				$expected,
				$this->SocialShare->href($service, 'http://example.com', $options)
			);
		}

	}

	public function testLinks() {

		// Facebook test
		$expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com" target="_blank">Share</a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->link(
				'facebook',
				'Share',
				'http://example.com'
			)
		);

		// Twitter test
		$expected = '<a href="http://twitter.com/home?status=Foo+bar+http%3A%2F%2Fexample.com" target="_blank">Share</a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->link(
				'twitter',
				'Share',
				'http://example.com',
				array('text' => 'Foo bar')
			)
		);

		// Facebook test
		$expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com">Share</a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->link(
				'facebook',
				'Share',
				'http://example.com',
				array(
					'target' => null
				)
			)
		);

	}

	public function testFa() {

		// Font Awesome test
		$expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com" target="_blank"><i class="fa fa-facebook"></i></a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->fa(
				'facebook',
				'http://example.com'
			)
		);

	}

}