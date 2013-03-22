<?php
/*
Plugin Name: Blogroll In Posts
Plugin URI: http://www.coolryan.com/plugins/blogroll-in-posts
Description: Put your favorite links easily into your posts
Version: 1.0
Author: Cool Ryan
Author URI: http://www.coolryan.com/
*/

function bip_shortcode($atts) {
	extract(shortcode_atts(array(
	'orderby'          => 'name',
    'order'            => 'ASC',
    'limit'            => -1,
    'category'         => null,
    'exclude_category' => null,
    'category_name'    => null,
    'hide_invisible'   => 1,
    'show_updated'     => 0,
    'categorize'       => 1,
    'title_li'         => __('Bookmarks'),
    'title_before'     => '<h2>',
    'title_after'      => '</h2>',
    'category_orderby' => 'name',
    'category_order'   => 'ASC',
    'class'            => 'linkcat',
    'category_before'  => '<li id=%id class=%class>',
    'category_after'   => '</li>' 
	),$atts));
	
	$args = array(
    'orderby'          => $orderby,
    'order'            => $order,
    'limit'            => $limit,
    'category'         => $category,
    'exclude_category' => $exclude_category,
    'category_name'    => $category_name,
    'hide_invisible'   => $hide_invisible,
    'show_updated'     => $show_updated,
    'echo'             => 0,
    'categorize'       => $categorize,
    'title_li'         => $title_li,
    'title_before'     => html_entity_decode($title_before),
    'title_after'      => html_entity_decode($title_after),
    'category_orderby' => $category_orderby,
    'category_order'   => $category_order,
    'class'            => $class,
    'category_before'  => html_entity_decode($category_before),
    'category_after'   => $category_after );
	
	return wp_list_bookmarks( $args );
}


add_shortcode('blogroll', 'bip_shortcode');
?>