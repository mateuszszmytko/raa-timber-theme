<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class GutenbergBlocks {

    function __construct() {
        add_action('acf/init', array($this, 'ACFInit'));
        add_action( 'enqueue_block_editor_assets', array($this, 'loadCustomAdminStyle') );
        add_filter( 'block_categories', array($this, 'addCustomCategory'), 10, 2);
    }

    function parseBlocks($blocks) {
        $parsedBlocks = array();

        foreach ($blocks as $blockData) {
            $blockData['render_callback'] = array($this, 'renderBlockCallback');
            $blockData['category'] = 'custom-blocks';

            array_push($parsedBlocks, $blockData);
        }

        return $parsedBlocks; 
    }

    function ACFInit() {
        if( function_exists('acf_register_block') ) {
            $blocks = $this->parseBlocks(apply_filters('raa/acfBlocks', array()));

            foreach ($blocks as $block) {
                acf_register_block($block);
            }
        }
    }

    function renderBlockCallback( $block ) {
        global $site;

        $slug = str_replace('acf/', '', $block['name']);
    
        $data = Array();
        $data['data'] = get_fields();
        $data['options'] = get_fields('options');

        $data['site'] = $site;
    
        if (is_admin()) {
            Timber::render(array($slug .'-admin.twig', $slug .'.twig' ), $data );
        } else {
            Timber::render($slug .'.twig', $data );
        }
    }

    function loadCustomAdminStyle() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/static/block-editor.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
    
        wp_enqueue_script(
            'myguten-script',
            get_template_directory_uri() . '/static/block-editor.js',
            array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
        );
    }

    function addCustomCategory( $categories, $post ) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'custom-blocks',
                    'title' => __( 'Custom blocks', 'RTT' ),
                ),
            )
        );
    }
    
}


?>