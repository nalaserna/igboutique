<?php

require_once( 'wilypost.php' );

/*
 * custom post : logos
 */
$client_args = array(
    'custom_post_name'          => 'logos',
    'post_title'				=> 'Logos',
    'taxonomy_name'             => 'logos-category',
    'custom_post_fields'        => array(
        'supports'              => array( 'title', 'author', 'thumbnail' ),
        'menu_icon'          => 'dashicons-businessman'
    ),
    'custom_taxonomy_fields'    => array()
);
$client = new Wilypost( $client_args );
$client->execute();

/*
 * custom post : album
 */
$album_args = array(
    'custom_post_name'          => 'mk-album',
	'post_title'				=> 'Album',
    'taxonomy_name'             => 'mk-album-category',
    'custom_post_fields'        => array(
        'supports'              	=> array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ),
        'menu_icon'          		=> 'dashicons-album'
    ),
    'custom_taxonomy_fields'    => array(),
	'exiting_post'				=> '',
	'existing_tax_slug'			=> '',
);
$album = new Wilypost( $album_args );
$album->execute();

flush_rewrite_rules();