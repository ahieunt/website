<?php

Better_Ads_Manager()->enqueue_adblocker_detector();

$caption = ! empty( $banner_data['caption'] ) && $args['show-caption'] ? Better_Ads_Manager::get_option( 'caption_position' ) : FALSE;
$ad_code = '<span id="' . $banner_data['element_id'] . '-place"></span>';

if ( $caption == 'above' ) {
	$ad_code .= "<p class='bsac-caption bsac-caption-above'>{$banner_data['caption']}</p>";
}

if ( ! $this->is_google_adsence_printed ) {
	$ad_code                         .= '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
	$this->is_google_adsence_printed = TRUE;
}


//
// Ad Attrs
//
{
	$_attrs = array(
		'ad-client',
		'ad-slot',
		'ad-layout',
		'ad-layout-key',
	);

	$ad_attrs = '';

	foreach ( $_attrs as $_attr ) {

		if ( empty( $ad_data[ $_attr ] ) ) {
			continue;
		}

		$ad_attrs .= " data-{$_attr}=\"{$ad_data[ $_attr ]}\" ";
	}
}


$ad_code .= '<script type="text/javascript">';
$ad_code .= 'var betterads_screen_width = document.body.clientWidth;';
$ad_code .= $this->_fix_new_lines( 'betterads_el = document.getElementById(\'' . $banner_data['element_id'] . '\');
								
			if (betterads_el.getBoundingClientRect().width) {
				betterads_el_width_raw = betterads_el_width = betterads_el.getBoundingClientRect().width;
			} else {
				betterads_el_width_raw = betterads_el_width = betterads_el.offsetWidth;
			}
			
			var size = ["125", "125"];
			if ( betterads_el_width >= 728 ) 
				betterads_el_width = ["728", "90"];
			else if ( betterads_el_width >= 468 )
				betterads_el_width = ["468", "60"];
			else if ( betterads_el_width >= 336 )
				betterads_el_width = ["336", "280"];
			else if ( betterads_el_width >= 300 )
				betterads_el_width = ["300", "250"];
			else if ( betterads_el_width >= 250 )
				betterads_el_width = ["250", "250"];
			else if ( betterads_el_width >= 200 )
				betterads_el_width = ["200", "200"];
			else if ( betterads_el_width >= 180 )
				betterads_el_width = ["180", "150"];
' );

$ifs = array();

if ( $ad_data['ad-format'] !== 'auto' ) {
	$normal_ad = 'document.getElementById(\'' . $banner_data['element_id'] . '-place\').innerHTML = \'<ins class="adsbygoogle" style="display:inline-block;width:\' + betterads_el_width_raw + \'px" ' . $ad_attrs . ' data-ad-format="' . $ad_data['ad-format'] . '"></ins>\';
								(adsbygoogle = window.adsbygoogle || []).push({});';
} else {
	$normal_ad = 'document.getElementById(\'' . $banner_data['element_id'] . '-place\').innerHTML = \'<ins class="adsbygoogle" style="display:inline-block;width:\' + betterads_el_width[0] + \'px;height:\' + betterads_el_width[1] + \'px" ' . $ad_attrs . '></ins>\';
								(adsbygoogle = window.adsbygoogle || []).push({});';
}

$_size_check = array(
	'vertical'   => '',
	'horizontal' => '',
	'rectangle'  => '',
);

// Customize to show in tinyMCE view always
if ( bf_is_user_logged_in() && bf_is_doing_ajax( 'fetch-mce-view-shortcode' ) ) {
	$banner_data['show_desktop']          = TRUE;
	$banner_data['show_tablet_landscape'] = TRUE;
	$banner_data['show_tablet_portrait']  = TRUE;
	$banner_data['show_phone']            = TRUE;
}

$_size_fields = array(
	array(
		'show'      => 'show_desktop',
		'size'      => 'size_desktop',
		'condition' => 'betterads_screen_width >= 1140',
	),
	array(
		'show'      => 'show_tablet_landscape',
		'size'      => 'size_tablet_landscape',
		'condition' => 'betterads_screen_width >= 1019  && betterads_screen_width < 1140',
	),
	array(
		'show'      => 'show_tablet_portrait',
		'size'      => 'size_tablet_portrait',
		'condition' => 'betterads_screen_width >= 768  && betterads_screen_width < 1019',
	),
	array(
		'show'      => 'show_phone',
		'size'      => 'size_phone',
		'condition' => 'betterads_screen_width < 768',
	),
);

foreach ( $_size_fields as $_size_ad ) {

	if ( empty( $banner_data[ $_size_ad['show'] ] ) ) {
		continue;
	}

	// vertical and horizontal
	if ( is_string( $banner_data[ $_size_ad['size'] ] ) && isset( $_size_check[ $banner_data[ $_size_ad['size'] ] ] ) ) {

		$ifs[] = $this->_fix_new_lines( 'if ( ' . $_size_ad['condition'] . ' ) {
									document.getElementById(\'' . $banner_data['element_id'] . '-place\').innerHTML = \'<ins class="adsbygoogle" style="display:inline-block;width:\' + betterads_el_width_raw + \'px" ' . $ad_attrs . ' data-ad-format="' . $banner_data[ $_size_ad['size'] ] . '"></ins>\';
									(adsbygoogle = window.adsbygoogle || []).push({});
								}' );

	} // with and height in pixel
	elseif ( is_array( $banner_data[ $_size_ad['size'] ] ) ) {

		$ifs[] = $this->_fix_new_lines( 'if ( ' . $_size_ad['condition'] . ' ) {
									document.getElementById(\'' . $banner_data['element_id'] . '-place\').innerHTML = \'<ins class="adsbygoogle" style="display:inline-block;width:' . $banner_data[ $_size_ad['size'] ][0] . 'px;height:' . $banner_data[ $_size_ad['size'] ][1] . 'px" ' . $ad_attrs . '></ins>\';
									(adsbygoogle = window.adsbygoogle || []).push({});
								}' );

	} // auto
	else {
		$ifs[] = $this->_fix_new_lines( 'if ( ' . $_size_ad['condition'] . ' ) { ' . $normal_ad . '}' );
	}
}

$ad_code .= implode( 'else ', $ifs );

$ad_code .= '</script>';

if ( $caption === 'below' ) {
	$ad_code .= "<p class='bsac-caption bsac-caption-below'>{$banner_data['caption']}</p>";
}

return $ad_code;
