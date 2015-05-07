<?php

App::uses('AppHelper', 'View/Helper');

class SocialShareHelper extends AppHelper {

	public $helpers = array('Html');

/**
 * Helper default settings.
 *
 * @var array
 */
	public $settings = array(
		'target' => '_blank',
		'default_fa' => 'fa-share-alt'
	);

/**
 * An array of services and their corresponding share/bookmarking URLs.
 *
 * @var array
 */
	protected $_urls = array(
		'delicious' => 'http://delicious.com/post?url={url}&amp;title={text}',
		'digg' => 'http://digg.com/submit?url={url}&amp;title={text}',
		'email' => 'mailto:?subject={text}&body={url}',
		'evernote' => 'http://www.evernote.com/clip.action?url={url}&amp;title={text}',
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
		'friendfeed' => 'http://www.friendfeed.com/share?url={url}&amp;title={text}',
		'google' => 'http://www.google.com/bookmarks/mark?op=edit&amp;bkmk={url}&amp;title={text}',
		'gplus' => 'https://plus.google.com/share?url={url}',
		'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url={url}&amp;title={text}',
		'newsvine' => 'http://www.newsvine.com/_tools/seed&save?u={url}&amp;h={text}',
		'pinterest' => 'http://www.pinterest.com/pin/create/button/?url={url}&amp;media={image}&amp;description={text}',
		'pocket' => 'https://getpocket.com/save?url={url}&amp;title={text}',
		'reddit' => 'http://www.reddit.com/submit?url={url}&amp;title={text}',
		'slashdot' => 'http://slashdot.org/bookmark.pl?url={url}&amp;title={text}',
		'stumbleupon' => 'http://www.stumbleupon.com/submit?url={url}&amp;title={text}',
		'technorati' => 'http://technorati.com/faves?add={url}&amp;title={text}',
		'tumblr' => 'http://www.tumblr.com/share?v=3&amp;u={url}&amp;t={text}',
		'twitter' => 'http://twitter.com/home?status={text}+{url}',
		'whatsapp' => 'whatsapp://send?text={text}%20{url}'
	);

/**
 * An array mapping services to their Font Awesome icons.
 *
 * @var array
 */
	protected $_fa = array(
		'delicious' => 'fa-delicious',
		'digg' => 'fa-digg',
		'email' => 'fa-envelope',
		'facebook' => 'fa-facebook',
		'google' => 'fa-google',
		'gplus' => 'fa-google-plus',
		'linkedin' => 'fa-linkedin',
		'pinterest' => 'fa-pinterest',
		'reddit' => 'fa-reddit',
		'stumbleupon' => 'fa-stumbleupon',
		'tumblr' => 'fa-tumblr',
		'twitter' => 'fa-twitter',
		'whatsapp' => 'fa-whatsapp'
	);

/**
 * Returns the list of available services
 *
 * @return array
 */
	public function services() {
		return array_keys($this->_urls);
	}

/**
 * Creates a share URL.
 *
 * ### Options
 *
 * - `text` Text to be passed to service relating to the shared content(e.g. page title).
 * - `image` URL of image for sharing (used by Pinterest).
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
		$image = !empty($options['image']) ? $options['image'] : '';

		if (!empty($this->_urls[$service])) {
			return preg_replace(
				array(
					'/{url}/',
					'/{text}/',
					'/{image}/'
				),
				array(
					urlencode($url),
					urlencode($text),
					urlencode($image)
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
		$defaults = array(
			'target' => $this->settings['target']
		);

		$attributes = array_merge($defaults, $attributes);

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

/**
 * Creates an HTML link to share a URL using a Font Awesome icon.
 *
 * ### Options
 *
 * - `icon_class` Class name of icon for overriding defaults.
 *
 * See HtmlHelper::link().
 *
 * @param string $service Social Media service to create share link for.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of options.
 * @return string An URL.
 */
	public function fa($service, $url = null, $options = array()) {
		$defaults = array(
			'target' => $this->settings['target']
		);

		$options = array_merge($defaults, $options);

		$options['escape'] = false;

		$class = 'fa ' . (!empty($this->_fa[$service]) ? $this->_fa[$service] : $this->settings['default_fa']);

		if (!empty($options['icon_class'])) {
			$class = $options['icon_class'];
		}
		unset($options['icon_class']);

		$attributes = $options;
		unset($attributes['text']);
		unset($attributes['image']);

		return $this->Html->link(
			'<i class="' . $class . '"></i>',
			$this->href($service, $url, $options),
			$attributes
		);
	}

}
