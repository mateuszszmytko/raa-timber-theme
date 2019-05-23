<?php
/**
 * RTT Class: The main class of theme
 * 
 * @author   Mateusz Szmytko
 * @since    1.0.0
 * @package  RTT
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RaaTimberTheme {
    public $gutenbergBlocks;

	function __construct() {
		add_action( 'after_setup_theme',          array( $this, 'setup' ) );
        add_filter( 'body_class',                 array( $this, 'bodyClasses' ) );

        $this->gutenbergBlocks = new GutenbergBlocks();
	}

	public function setup() {
		load_theme_textdomain( 'RTT', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats' );
		
		add_theme_support( 'custom-logo', array() );
		

		register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'RTT'),
            'footer'    => __( 'Footer menu', 'RTT')
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

        add_theme_support( 'customize-selective-refresh-widgets' );	


        /**
         * Uncomment this if you want to use woocommerce
         */
        // add_theme_support('woocommerce');
        
        global $site;

        $site->initSite();

    }

	public function bodyClasses( $classes ) {
		$classes[] = 'RTT';

		return $classes;
    }

}


return new RaaTimberTheme();
?>