<?php

App::uses('AppHelper', 'View/Helper');

class SocialShareHelper extends AppHelper {

	public $helpers = array('Html');

	protected $_urls = array(
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
		'gplus' => 'https://plus.google.com/share?url={url}',
		'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url={url}&amp;title={title}',
		'twitter' => 'http://twitter.com/home?status={title}+{url}'
	);

	public function href($service, $url = null, $options = array()) {

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
			$this->href($service, $url, $options),
			$attributes
		);

	}


}