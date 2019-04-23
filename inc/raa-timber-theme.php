<?php
/**
 * AWT Class: The main class of theme
 * 
 * @author   Mateusz Szmytko
 * @since    1.0.0
 * @package  AWT
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



class RaaTimberTheme {
	function __construct() {
		add_action( 'after_setup_theme',          array( $this, 'setup' ) );
		add_filter( 'body_class',                 array( $this, 'body_classes' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
        
        $this->custom_blocks();
	}

	public function setup() {
        
		load_theme_textdomain( 'AWT', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats' );
		
		add_theme_support( 'custom-logo', array() );
		

		register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'AWT' ),
            'footer'    => __( 'Footer menu', 'AWT')
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

        add_theme_support( 'customize-selective-refresh-widgets' );	
        
        global $site;

        $site->init();

    }
    
    function custom_blocks() {
        global $gutenberg_customize;
        $gutenberg_customize->addBlocks(
            array(
                array(
                    'name'				=> 'section-header',
                    'title'				=> __('Sekcja - header'),
                    'icon'				=> 'admin-home', // http://calebserna.com/dashicons-cheatsheet/
				),
                array(
                    'name'				=> 'test-block',
                    'title'				=> __('Test block'),
                    'icon'				=> 'format-status', // http://calebserna.com/dashicons-cheatsheet/
				),
				
                /*array(
                    'name'				=> 'block-name',
                    'title'				=> __('Block name'),
                    'description'		=> __('Block description.'),
                    'icon'				=> 'admin-comments', // http://calebserna.com/dashicons-cheatsheet/
                    'keywords'			=> array( 'random', 'keywords' ),
                )*/
            )
        );
    }

	function add_to_context( $context ) {
        global $site;

        $context['options'] = get_fields('options');
		$context['site'] = $site;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );


		$twig->addFilter(new Twig_SimpleFilter('t', array($this, 'translate')));
		$twig->addFilter(new Twig_SimpleFilter('image_url', array($this, 'image_url')));
		$twig->addFilter(new Twig_SimpleFilter('static_url', array($this, 'static_url')));
		
		return $twig;
	}

	public function translate($text) {
		return $text;
	}

	public function image_url($text) {
		$directory = get_template_directory_uri() .'/static/images/'. $text;

		return $directory;
	}

	public function static_url($text) {
		$directory = get_template_directory_uri() .'/static/'. $text;

		return $directory;
	}


	public function body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		$classes[] = 'AWT';

		return $classes;
	}
}


return new RaaTimberTheme();
?>