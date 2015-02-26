<?php

App::uses('AppHelper', 'View/Helper');

class SocialShareHelper extends AppHelper {

	public $helpers = array('Html');

	protected $_urls = array(
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
		'gplus' => 'https://plus.google.com/share?url={url}'
	);

	public function shareUrl($service, $url) {

		$title = '';

		if (!empty($this->_urls[$service])) {
			return preg_replace(
				array(
					'/{url}/',
					'/{title}/'
				),
				array(
					urlencode($url),
					$title
				),
				$this->_urls[$service]
			);
		}

		return;

	}

	public function link($service, $text, $url, $options = array()) {

		return $this->Html->link(
			$text,
			$this->shareUrl($service, $url),
			$options
		);

	}

}