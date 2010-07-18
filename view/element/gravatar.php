<?php

/**
 * Display a gravatar avatar squar image from gravatar.com
 * see config for parameters
 *
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-06-03
 */

// default parameters
if (isset($User) && $User->hasField('email')) {
	$email = $User->get('email');
}
if (empty($default)) {
	$default = '';
}
if (empty($size)) {
	$size = 16;
}
// image attributes
if (empty($attributes)) {
	$attributes = array('class' => 'gravatar gravatar'.$size);
}
if (empty($attributes['alt'])) {
	$attributes['alt'] = '';
}


// build gravatar URL
$gravatarImgUrl = 'http://www.gravatar.com/avatar/'.md5(strtolower(@$email)).'?s='.$size.'&amp;d=identicon';

// output gravatar image
echo $HTML->image($gravatarImgUrl, $attributes);