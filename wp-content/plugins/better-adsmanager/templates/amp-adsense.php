<?php

$attrs = array(
	'type' => 'adsense',
);

$_attrs = array(
	'ad-client',
	'ad-slot',
	//'ad-format', ad format not needed for AMP
	'ad-layout',
	// 'ad-layout-key', this type of ads does not supported in amp currently!
	// https://github.com/ampproject/amphtml/issues/10957
);

$caption = ! empty( $banner_data['caption'] ) && $args['show-caption'] ? Better_Ads_Manager::get_option( 'caption_position' ) : FALSE;

$ad_attrs = '';

foreach ( $_attrs as $_attr ) {

	if ( empty( $ad_data[ $_attr ] ) ) {
		continue;
	}

	$attrs[ 'data-' . $_attr ] = $ad_data[ $_attr ];
}


if ( ! empty( $banner_data['size']['width'] ) && ! empty( $banner_data['size']['height'] ) ) {
	$attrs['width']  = $banner_data['size']['width'];
	$attrs['height'] = $banner_data['size']['height'];
} elseif ( empty( $banner_data['size']['width'] ) && ! empty( $banner_data['size']['height'] ) ) {
	$attrs['height'] = $banner_data['size']['height'];
	$attrs['layout'] = 'fixed-height';
} else {
	$attrs['width']  = '300';
	$attrs['height'] = '250';
}

better_amp_enqueue_ad( 'adsense' );

ob_start();

if ( $caption == 'above' ) {
	echo "<p class='bsac-caption bsac-caption-above'>{$banner_data['caption']}</p>";
}

?>
<amp-ad <?php

foreach ( $attrs as $k => $v ) {
	echo $k, '=', $v, ' ';
}

?>></amp-ad><?php

if ( $caption === 'below' ) {
	echo "<p class='bsac-caption bsac-caption-below'>{$banner_data['caption']}</p>";
}

return ob_get_clean();
