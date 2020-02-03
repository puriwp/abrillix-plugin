<?php
/**
* Plugin Name: Abrillix Plugin
* Plugin URI: https://github.com/puriwp/abrillix-plugin
* Description: Package abrillix plugin.
* Version: 1.0
* Author: PuriWP
* Author URI: http://puriwp.com
* Text Domain: abrillix
**/

foreach ( glob( dirname( __FILE__ ) . '/custom-post-type/*.php' ) as $file ) {
	require_once $file;
}
require_once dirname( __FILE__ ) . '/shortcode.php';