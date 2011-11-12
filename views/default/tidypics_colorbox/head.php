<?php
$transition = get_plugin_setting('transition', 'tidypics_colorbox');
if (!isset($transition)) {
	$transition = 'elastic';
}

$slideshowInterval = get_plugin_setting('slideshowInterval', 'tidypics_colorbox');			
if (!isset($slideshowInterval) || !is_numeric($slideshowInterval) || $slideshowInterval < 0) {
	$slideshowInterval = 3000; //3 seconds
}
else {
	$slideshowInterval = $slideshowInterval * 1000; //Convert to miliseconds
}

$colorboxStyle = get_plugin_setting('colorboxStyle', 'tidypics_colorbox');			
if (!isset($colorboxStyle)){
	$colorboxStyle = 1;
}
?>

<script type="text/javascript" src="<?php echo $CONFIG->wwwroot . 'mod/tidypics_colorbox/vendors/colorbox/jquery.colorbox-min.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo $CONFIG->wwwroot . 'mod/tidypics_colorbox/views/default/colorbox_styles/' . $colorboxStyle . '/colorbox.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $CONFIG->wwwroot . 'mod/tidypics_colorbox/views/default/tidypics_colorbox/tidypics_colorbox.css'; ?>" type="text/css" />

<script>
	$(document).ready(function(){
		$("a[rel='lyteshow[album]']").colorbox({
			photo: true
			, transition: "<?php echo $transition?>"
			, slideshow: true
			, slideshowAuto: false
			, slideshowSpeed: "<?php echo $slideshowInterval?>"
			, slideshowStart: "<?php echo elgg_echo('tidypics_colorbox:slideShowStart'); ?>"
			, slideshowStop: "<?php echo elgg_echo('tidypics_colorbox:slideShowStop'); ?>"
			, current: "<?php echo elgg_echo('tidypics_colorbox:currentimage'); ?>"
			, previous: "<?php echo elgg_echo('tidypics_colorbox:previous'); ?>"
			, next: "<?php echo elgg_echo('tidypics_colorbox:next'); ?>"
			, close: "<?php echo elgg_echo('tidypics_colorbox:close'); ?>"
			, maxWidth: 800
			, title: function(){
				  var url = $(this).attr('id');
				  if (url != "")
					return '<a href="'+url+'">' + $(this).attr('short_title') + '</a>';
				}
			}
		);
	})
</script>
