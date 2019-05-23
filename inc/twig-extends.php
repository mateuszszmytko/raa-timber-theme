<?php

/**
 * Twig extends
 * 
 */
add_filter( 'timber/twig', function($twig) {
    $twig->addExtension( new Twig_Extension_StringLoader() );

    $twig->addFilter(new Twig_SimpleFilter('t', function($text) {
        return __( $text, 'RTT' );
    }));

    $twig->addFilter(new Twig_SimpleFilter('image_url', function($text) {
        return get_template_directory_uri() .'/static/images/'. $text;
    }));

    $twig->addFilter(new Twig_SimpleFilter('static_url', function($text) {
        return get_template_directory_uri() .'/static/'. $text;
    }));
    
    return $twig;
});

add_filter( 'timber_context', function($context) {
    global $site;

    $context['options'] = get_fields('options');
    $context['content_before'] = get_fields('page-content-before');
    $context['content_after'] = get_fields('page-content-after');
    $context['fields'] = get_fields();
    $context['site'] = $site;
    // you can add your custom data into context here

    return $context;
});

?>