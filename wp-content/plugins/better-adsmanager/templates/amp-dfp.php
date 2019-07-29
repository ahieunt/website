<?php

better_amp_enqueue_ad( 'dfp' );

$caption = ! empty( $banner_data['caption'] ) && $args['show-caption'] ? Better_Ads_Manager::get_option( 'caption_position' ) : FALSE;
$ad_code = '';

if ( $caption == 'above' ) {
	$ad_code .= "<p class='bsac-caption bsac-caption-above'>{$banner_data['caption']}</p>";
}

if ( $banner_data['dfp_spot'] === 'custom' ) {
	$ad_code .= $banner_data['custom_dfp_code'];
} else {

	$ad_code .= '<amp-ad width=' . $banner_data['dfp_spot_width'] . ' height=' . $banner_data['dfp_spot_height'] . '
    type="doubleclick"
    data-slot="' . $banner_data['dfp_spot_id'] . '">
</amp-ad>';

}

if ( $caption === 'below' ) {
	$ad_code .= "<p class='bsac-caption bsac-caption-below'>{$banner_data['caption']}</p>";
}

return $ad_code;
