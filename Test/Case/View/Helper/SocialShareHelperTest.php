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

/**
 * @return void
 */
	public function testServices() {
		$result = $this->SocialShare->services();
		$this->assertNotEmpty($result);
	}

	public function testHref() {
		$urls = array(
			'delicious' => 'http://delicious.com/post?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'digg' => 'http://digg.com/submit?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'email' => 'mailto:?subject=Foo+bar&body=http%3A%2F%2Fexample.com',
			'evernote' => 'http://www.evernote.com/clip.action?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com',
			'friendfeed' => 'http://www.friendfeed.com/share?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'google' => 'http://www.google.com/bookmarks/mark?op=edit&bkmk=http%3A%2F%2Fexample.com&title=Foo+bar',
			'gplus' => 'https://plus.google.com/share?url=http%3A%2F%2Fexample.com',
			'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'newsvine' => 'http://www.newsvine.com/_tools/seed&save?u=http%3A%2F%2Fexample.com&h=Foo+bar',
			'pinterest' => 'http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fexample.com&media=http%3A%2F%2Fexample.com%2Ftest.jpg&description=Foo+bar',
			'pocket' => 'https://getpocket.com/save?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'reddit' => 'http://www.reddit.com/submit?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'slashdot' => 'http://slashdot.org/bookmark.pl?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'stumbleupon' => 'http://www.stumbleupon.com/submit?url=http%3A%2F%2Fexample.com&title=Foo+bar',
			'technorati' => 'http://technorati.com/faves?add=http%3A%2F%2Fexample.com&title=Foo+bar',
			'tumblr' => 'http://www.tumblr.com/share?v=3&u=http%3A%2F%2Fexample.com&t=Foo+bar',
			'twitter' => 'https://twitter.com/intent/tweet?text=Foo+bar&url=http%3A%2F%2Fexample.com',
			'whatsapp' => 'whatsapp://send?text=Foo+bar%20http%3A%2F%2Fexample.com'
		);

		$options = array(
			'text' => 'Foo bar',
			'image' => 'http://example.com/test.jpg'
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

		// Font Awesome icon class test
		$expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com" target="_blank"><i class="fa fa-facebook-square"></i></a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->fa(
				'facebook',
				'http://example.com',
				array(
					'icon_class' => 'fa fa-facebook-square'
				)
			)
		);

		// Custom Text test
		$expected = '<a href="whatsapp://send?text=Demo+Text+test%20http%3A%2F%2Fexample.com" target="_blank"><i class="fa fa-whatsapp"></i></a>';
		$this->assertEquals(
			$expected,
			$this->SocialShare->fa(
				'whatsapp',
				'http://example.com',
				array(
					'text' => 'Demo Text test'
				)
			)
		);
	}

}
