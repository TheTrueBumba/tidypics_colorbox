<?php
$transition = $vars['entity']->transition;
if (!$transition) $transition = 'elastic';

$colorboxStyle = $vars['entity']->colorboxStyle;
if (!$colorboxStyle) $colorboxStyle = '1';

//Transition
echo '<p>';
echo elgg_echo('tidypics_colorbox:transition'); 
echo elgg_view('input/pulldown', array(
		'internalname' => 'params[transition]',
		'options_values' => array(
			'elastic' => elgg_echo('tidypics_colorbox:elastic'),
			'fade' => elgg_echo('tidypics_colorbox:fade'),
			'none' => elgg_echo('tidypics_colorbox:none')
		),
		'value' => $transition
));
echo '</p>';

//Colorbox Style
echo '<p>';
echo elgg_echo('tidypics_colorbox:colorboxStyle'); 
echo elgg_view('input/pulldown', array(
		'internalname' => 'params[colorboxStyle]',
		'options_values' => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5'
		),
		'value' => $colorboxStyle
));
echo '</p>';

//Slideshow Interval
echo '<p>';
echo elgg_echo('tidypics_colorbox:slideshowInterval');
echo elgg_view('input/text', array('internalname' => "params[slideshowInterval]", 'value' => $vars['entity']->slideshowInterval, 'class' => ' '));
echo '</p>';
?>