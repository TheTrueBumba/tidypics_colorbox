<?php

/**
 * Tidypics Colorbox Plugin
 * Author: RayJ - Based on Cash´s Tidypics Lightbox
 * License: GPL 2
 */


/**
 * Colorbox plugin initialization
 */
function tidypics_colorbox_init() {
	
	// register for hook thrown for each image in album view
	register_plugin_hook('tp_thumbnail_link', 'album', 'tidypics_colorbox_album_wrapper');

	// register for hook thrown for image in individual view
	register_plugin_hook('tp_thumbnail_link', 'image', 'tidypics_colorbox_image_wrapper');
	
	// register for hook thrown on page with slideshow
	register_plugin_hook('tp_slideshow', 'album', 'tidypics_colorbox_slideshow');
}

/**
 * Create HTML for image in album view
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params array with image entity
 * @return string
 */
function tidypics_colorbox_album_wrapper($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;
	
	if (!isset($params['image'])) {
		return $returnvalue;
	}
	
	$image = $params['image'];
	$ititle = $image->title; //Image title

	if (strlen($ititle) > 40)
	{
		$ishorttitle = substr($ititle, 0, 40).'...';
	}
	else
	{
		$ishorttitle = $ititle;
	}
    if (empty($ititle))
	{
        $ishorttitle = '...';
		$ititle = '...';
	}
	
	// change lyteshow to lytebox for manual slideshow
	$html = <<<END
<div class="tidypics_colorbox_wrapper">
	<div class="tidypics_album_images">
		<a href="{$CONFIG->url}pg/photos/thumbnail/{$image->guid}/large/" id="{$image->getURL()}" rel="lyteshow[album]" short_title="{$ishorttitle}" title="{$ititle}" >
			<img src="{$CONFIG->url}pg/photos/thumbnail/{$image->guid}/small/" alt="{$ititle}" />
		</a>
	</div>
	<div class="tidypics_colorbox_title">
		<a href="{$image->getURL()}">{$ititle}</a>
	</div>
</div>
END;
	
	return $html;
}


/**
 * Create HTML for image in individual image view
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params array with image entity
 * @return string
 */
function tidypics_colorbox_image_wrapper($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;
	
	if (!isset($params['image'])) {
		return $returnvalue;
	}
	
	// add lytebox js and css
	extend_view('metatags', 'tidypics_colorbox/head');
		
	$image = $params['image'];	
	$ititle = $image->title;
	
	if (strlen($ititle) > 40)
	{
		$ititle = substr($ititle, 0, 40).'...';
	}
	
    if ( empty($ititle) )
        $ititle = '...';
		
	$html = <<<END
<a href="{$CONFIG->url}pg/photos/download/{$image->guid}/inline/" rel="lyteshow[album]" title="{$ititle}" >
	<img id ="tidypics_image" src="{$CONFIG->url}pg/photos/thumbnail/{$image->guid}/large/" alt="{$ititle}" />
</a>
END;
	
	return $html;
}


/**
 * Handler for page with a slideshow
 * 
 * Removes default slideshow and adds js and css for lytebox
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params
 * @return bool
 */
function tidypics_colorbox_slideshow($hook, $entity_type, $returnvalue, $params) {
	
	// add lytebox js and css
	extend_view('metatags', 'tidypics_colorbox/head');
	
	// returning false to turn off default slideshow
	return false;
}


register_elgg_event_handler('init', 'system', 'tidypics_colorbox_init');
