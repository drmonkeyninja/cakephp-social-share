CakePHP Social Share
====================

This plugin provides a CakePHP View helper for creating links to share content on numerous social networks and bookmarking sites.

The aim of the plugin is to keep things simple. It doesn't come packaged with any JavaScript and I leave design decisions up to you. You can choose whether you want to use text, images, sprites or an icon font for your links.

Social Share currently supports Facebook, Google+, LinkedIn and Twitter.

Installation
------------

Copy the plugin to your app/Plugin directory and rename the plugin's directory 'SocialShare'.

Then add the following line to your bootstrap.php to load the plugin.

    CakePlugin::load('SocialShare');

Usage
-----

### SocialShareHelper::link(string $service, string $title, mixed $url = null, array $options = array())

Returns an HTML link to share the current page for the supplied service. For example to create a link for Facebook:-

    echo $this->SocialShare->link(
    	'facebook',
    	__('Share on Facebook')
    );

You can easily produce a list of links to share to different social networks:-

    $services = array(
    	'facebook' => __('Share on Facebook'),
    	'gplus' => __('Share on Google+'),
    	'linkedin' => __('Share on LinkedIn'),
    	'twitter' => __('Share on Twitter')
    );

    echo '<ul>';
    foreach ($services as $service => $linkText) {
    	echo '<li>' . $this->SocialShare->link(
	    	$service,
	    	$linkText
	    ) . '</li>';
    }
    echo '</ul>';

Supported services:-

* facebook
* gplus (Google+)
* linkedin
* twitter

You can pass a URL or a routing array as the third parameter for the URL you want to share.

$options supports the same options as HtmlHelper::link() as well as a 'text' option for a page title you want to include when sharing the URL.

### SocialShareHelper::href(string $service, mixed $url = null, array $options = array())

Returns an URL for sharing to the supplied service.