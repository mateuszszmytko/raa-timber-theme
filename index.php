<?php
/**
 *
 * @package RaaTimberTheme
 */

$data = Timber::get_context();

if ( is_singular() ) :
	$data['post'] = new TimberPost();
else : 
	$data['posts'] = new Timber\PostQuery();
endif;


if ( is_single() ) :
	$data['page'] = 'single';	
	$template = array( 'single-' . $post->ID. '.twig', 'single-' . $post->post_type. '.twig', 'single.twig' );
elseif ( is_page() ) :
	$data['page'] = 'page';	
	$template = array( 'page-' . $post->post_name. '.twig', 'page.twig' );
elseif ( is_category() ) :
	$data['term'] = new Timber\Term();
	$data['page'] = 'archive';
    $template = array( 'archive-' . get_query_var('tag_id') . '.twig', 'archive.twig' );
elseif ( is_tag() ) :
    $data['term'] = new Timber\Term();
	$data['page'] = 'archive';
    $template = array( 'archive-' . get_query_var('tag_id') . '.twig', 'archive.twig' );
elseif ( is_author() ) :
	$data['archive_title'] = get_the_author();
	$data['page'] = 'archive';
    $template = array('archive.twig' );	
elseif ( is_search() ):
    $data['page'] = 'archive';
    $template = array('archive.twig' );
elseif ( is_archive() ) :
    $data['page'] = 'archive';
    $template = array( 'archive-' . get_queried_object()->name . '.twig', 'archive.twig' );
else: 
	$data['page'] = '404';
	$template = array('404.twig' );
endif;

Timber::render($template, $data );