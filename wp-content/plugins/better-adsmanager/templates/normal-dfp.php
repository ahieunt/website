<?php

Better_Ads_Manager()->enqueue_adblocker_detector();

$ad_code = '';
$caption = ! empty( $banner_data['caption'] ) && $args['show-caption'] ? Better_Ads_Manager::get_option( 'caption_position' ) : FALSE;

if ( $caption == 'above' ) {
	$ad_code .= "<p class='bsac-caption bsac-caption-above'>{$banner_data['caption']}</p>";
}

if ( $banner_data['dfp_spot'] === 'custom' ) {
	$ad_code .= $banner_data['custom_dfp_code'];
} else {

	$ad_code .= '<!-- ' . $banner_data['dfp_spot_id'] . ' -->
<div id="' . $banner_data['dfp_spot_tag'] . '" style="width:' . $banner_data['dfp_spot_width'] . 'px; height:' . $banner_data['dfp_spot_height'] . 'px;">
<script>
googletag.cmd.push(function() { googletag.display("' . $banner_data['dfp_spot_tag'] . '"); });
</script>
</div>';

}

if ( $caption === 'below' ) {
	$ad_code .= "<p class='bsac-caption bsac-caption-below'>{$banner_data['caption']}</p>";
}

return $ad_code;
