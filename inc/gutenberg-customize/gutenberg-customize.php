<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'test-block',
			'title'				=> __('Test Block'),
			'description'		=> __('A custom test block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
            'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}

function my_acf_block_render_callback( $block ) {
    global $site;
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

    $data = Array();
    $data['data'] = get_fields();
    $data['site'] = $site;

    if (is_admin()) {
        Timber::render(array($slug .'-admin.twig', $slug .'.twig' ), $data );
    } else {
        Timber::render($slug .'.twig', $data );
    }

}
*/

class GutenbergCustomize {
    private $blocks = array();

    function __construct() {
        add_action('acf/init', array($this, 'ACFInit'));
        add_action( 'enqueue_block_editor_assets', array($this, 'loadCustomAdminStyle') );
        add_filter( 'block_categories', array($this, 'addCustomCategory'), 10, 2);

    }

    function addBlocks($blocks) {
        $newBlocks = array();

        foreach ($blocks as $blockData) {
            $blockData['render_callback'] = array($this, 'renderBlockCallback');
            $blockData['category'] = 'custom-blocks';

            array_push($newBlocks, $blockData);
        }

        $this->blocks = array_merge($this->blocks, $newBlocks); 

    }

    function addBlock($blockData) {
        $blockData['render_callback'] = array($this, 'renderBlockCallback');
        $blockData['category'] = 'custom-blocks';

        $this->blocks[] = $blockData;
    }

    function ACFInit() {
        $post_type_object = get_post_type_object( 'post' );
        $post_type_object->template = array(
            array( 'raa/empty-layout' ),
        );

        if( function_exists('acf_register_block') ) {
            
            foreach ($this->blocks as $block) {
                acf_register_block($block);
            }
            // register a testimonial block
        }
    }

    function renderBlockCallback( $block ) {
        global $site;
        // convert name ("acf/testimonial") into path friendly slug ("testimonial")
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
                    'title' => __( 'Własne bloki', 'rtt' ),
                ),
            )
        );
    }
    
}


return new GutenbergCustomize();

?>