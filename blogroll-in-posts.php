<?php
/*
Plugin Name: Blogroll In Posts
Plugin URI: http://www.coolryan.com/plugins/blogroll-in-posts
Description: Put your favorite links easily into your posts
Version: 1.1
Author: Cool Ryan
Author URI: http://www.coolryan.com/
*/

function bip_shortcode($atts) {
	extract(shortcode_atts(array(
    'orderby'        => 'name', 
    'order'          => 'ASC',
    'limit'          => -1, 
    'category'       => null,
    'category_name'  => null, 
    'hide_invisible' => 1,
    'show_updated'   => 0, 
    'include'        => null,
    'exclude'        => null,
    'search'         =>  null,
	'show_category'  => 0,
	'title'          => null,		// The title of the blogroll, if empty, none is shown
	'show_in_list'   => 1,			// whether or not to show in list format or <p> format.
	'show_description' => 1,		// Whether or not to show the description
	'show_rating'    => 0			// Wether or not to show the rating
	),$atts));

	$args = array(
    'orderby'        => $orderby, 
    'order'          => $order,
    'limit'          => $limit, 
    'category'       => $category,
    'category_name'  => $category_name, 
    'hide_invisible' => $hide_invisible,
    'show_updated'   => $show_updated, 
    'include'        => $include,
    'exclude'        => $exclude,
    'search'         =>  $search);
	
	$bookmarks = get_bookmarks($args);
	$blogroll = '';
	
	/** Show title */
	if(!empty($title)) {
		$blogroll .= '<h2>'.$title.'</h2>';
	}
	
	if($show_in_list == 1) {
		$before_link = '<li>';
		$after_link = '</li>';
		$before_list = '<ul>';
		$after_list = '</ul>';
		$between = ' - ';
	}
	else {
		$before_link = '<p>';
		$after_link = '</p>';
		$before_list = '';
		$after_list = '';
		$between = '<br />';
	}

	$blogroll .= $before_list;
	
	foreach($bookmarks as $b) {
		$blogroll .= $before_link.'<a id="'.$b->link_id.'" href="'.$b->link_url.'" target="'.$b->link_target.'">'.$b->link_name.'</a>';
		
		/** Show description */
		if($show_description == 1) {
			$blogroll .= $between.$b->link_description;
		}
		
		/** Show rating */
		if($show_rating == 1) {
			$blogroll .= $between.'Rating: '.$b->link_rating.'/10';
		}
		$blogroll .= $after_link;
	}
	
	$blogroll .= $after_list;
	return $blogroll;
}



add_shortcode('blogroll', 'bip_shortcode');
?>