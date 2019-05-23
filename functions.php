<?php
/**
 * RTT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package RaaTimberTheme
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
}

/**
 * Define twig files paths
 */
Timber::$dirname = array('views/templates', 'views/sections', 'views/layouts', 'views/partials', 'views/blocks');

$site = require_once 'inc/site.php';

require 'inc/gutenberg-blocks.php';
require 'inc/template-functions.php';
require 'inc/twig-extends.php';

require 'raa-timber-theme.php';



