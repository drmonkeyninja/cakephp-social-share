<?php

App::uses('AppHelper', 'View/Helper');

class SocialShareHelper extends AppHelper {

	public $helpers = array('Html');


/**
 * An array of services and their corresponding share/bookmarking URLs.
 *
 * @var array
 */
	protected $_urls = array(
		'delicious' => 'http://delicious.com/post?url={url}&amp;title={text}',
		'digg' => 'http://digg.com/submit?url={url}&amp;title={text}',
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
		'google' => 'http://www.google.com/bookmarks/mark?op=edit&amp;bkmk={url}&amp;title={text}',
		'gplus' => 'https://plus.google.com/share?url={url}',
		'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url={url}&amp;title={text}',
		'reddit' => 'http://www.reddit.com/submit?url={url}&amp;title={text}',
		'twitter' => 'http://twitter.com/home?status={text}+{url}'
	);


/**
 * Creates a share URL.
 *
 * ### Options
 *
 * - `text` Text to be passed to service relating to the shared content(e.g. page title).
 * 
 * For other options see HtmlHelper::link().
 *
 * @param string $service Social Media service to create share link for.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of options.
 * @return string An URL.
 */
	public function href($service, $url = null, $options = array()) {

		// Get the URL, get the current full path if a URL hasn't been specified.
		$url = Router::url($url, true);

		$text = !empty($options['text']) ? $options['text'] : '';

		if (!empty($this->_urls[$service])) {
			return preg_replace(
				array(
					'/{url}/',
					'/{text}/'
				),
				array(
					urlencode($url),
					urlencode($text)
				),
				$this->_urls[$service]
			);
		}

		return;

	}


/**
 * Creates an HTML link to share a URL.
 *
 * @param string $service Social Media service to create share link for.
 * @param string $text The content to be wrapped by <a> tags.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $attributes Array of options and HTML attributes.
 * @return string An `<a />` element.
 */
	public function link($service, $text, $url = null, $attributes = array()) {

		$options = array();

		if (!empty($attributes['text'])) {
			$options['text'] = $attributes['text'];
			unset($attributes['text']);
		}

		return $this->Html->link(
			$text,
			$this->href($service, $url, $options),
			$attributes
		);

	}


}