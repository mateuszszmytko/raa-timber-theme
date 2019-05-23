<?php

/**
 * ACF option pages to manage content after and before actually page content.
 * 
 */
add_action('acf/init', function() {
    if( function_exists('acf_add_options_sub_page') ) {
        $option_page = acf_add_options_sub_page(array(
			'page_title' 	=> __('Content above', 'RTT'),
			'menu_title' 	=> __('Content above', 'RTT'),
            'menu_slug' 	=> 'page-content-before',
            'parent_slug' 	=> 'edit.php?post_type=page',
            'post_id' => 'page-content-before'
        ));
        
        $option_page = acf_add_options_sub_page(array(
			'page_title' 	=> __('Content below', 'RTT'),
			'menu_title' 	=> __('Content below', 'RTT'),
            'menu_slug' 	=> 'page-content-after',
            'parent_slug' 	=> 'edit.php?post_type=page',
            'post_id' => 'page-content-after'
		));
	}
});


/**
 * Example usage of custom blocks in ACF.
 * 
 */
add_filter('raa/acfBlocks', function($blocks) {
    $blocks[] = array(
        'name' => 'test-block',
        'title'	=> __('Test block'),
        'icon' => 'format-status', // http://calebserna.com/dashicons-cheatsheet/
    );

    $blocks[] = array(
        'name' => 'test-block-2',
        'title'	=> __('Test block 2'),
        'icon' => 'format-status', // http://calebserna.com/dashicons-cheatsheet/
    );

    return $blocks;
});

/**
 * Example usage of custom blocks in ACF.
 * 
 */
add_filter('raa/acfBlocks', function($blocks) {
    $blocks[] = array(
        'name' => 'test-block',
        'title'	=> __('Test block'),
        'icon' => 'format-status', // http://calebserna.com/dashicons-cheatsheet/
    );

    $blocks[] = array(
        'name' => 'test-block-2',
        'title'	=> __('Test block 2'),
        'icon' => 'format-status', // http://calebserna.com/dashicons-cheatsheet/
    );

    return $blocks;
});

/**
 * Disable gutenberg blocks on page post type.
 * 
 */
add_filter('allowed_block_types', function($allowed_blocks, $post) {
    if( $post->post_type === 'page' ) {
        return array();
    }

    return $allowed_blocks;
}, 10, 2);

?>