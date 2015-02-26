<?php

App::uses('AppHelper', 'View/Helper');

class SocialShareHelper extends AppHelper {

	public $helpers = array('Html');

	protected $_urls = array(
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
		'gplus' => 'https://plus.google.com/share?url={url}',
		'twitter' => 'http://twitter.com/home?status={title}+{url}'
	);

	public function shareUrl($service, $url = null, $options = array()) {

		// If the URL hasn't been set, get the current full path.
		$url = empty($url) ? Router::url(null, true) : $url;

		$title = !empty($options['title']) ? $options['title'] : '';

		if (!empty($this->_urls[$service])) {
			return preg_replace(
				array(
					'/{url}/',
					'/{title}/'
				),
				array(
					urlencode($url),
					urlencode($title)
				),
				$this->_urls[$service]
			);
		}

		return;

	}


	public function link($service, $text, $url = null, $attributes = array()) {

		$options = array();

		if (!empty($attributes['title'])) {
			$options['title'] = $attributes['title'];
			unset($attributes['title']);
		}

		return $this->Html->link(
			$text,
			$this->shareUrl($service, $url, $options),
			$attributes
		);

	}


/**
 * Returns only array entries listed in a whitelist
 *
 * @param array $array original array to operate on
 * @param array $whitelist keys you want to keep
 * @return array
 */
	protected function _arrayWhitelist($array, $whitelist) {

		return array_intersect_key(
			$array, 
			array_flip($whitelist)
		);

	}

}