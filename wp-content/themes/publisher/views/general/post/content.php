function slady_cta_post() {
	$cta_content = "";

	$cta_content = '<div class="the-contact-form">';


	$cta_content .= do_shortcode('[contact-form-7 id="4404" title="Đăng ký ngay"]');
	$cta_content .= '<h2>Hoặc liên hệ với chúng tôi qua những kênh sau đây</h2>
	<div class="row contact-methods">
	<div class="col-xs-4 col-sm-4"> 
		<a href="tel:18006684" class="btn btn-phone">
			<img src="/wp-content/uploads/2018/09/NUT-02.png" alt="1800.6684">
		</a>
	</div>
	<div class="col-xs-4 col-sm-4"> 
		<a href="https://m.me/592042160958789" class="btn btn-facebook" target="_blank">
			<img src="/wp-content/uploads/2018/09/cta-facebook.png" alt="Facebook">
		</a>
	</div>
	<div class="col-xs-4 col-sm-4">
		<a href="http://zalo.me/1779760147394024182" class="btn btn-zalo" target="_blank">
			<img src="/wp-content/uploads/2018/09/cta-zalo.png" alt="Zalo">
		</a>
	</div>
	</div>'
	$cta_content .= '</div>';
	return $cta_content;
}
add_shortcode('blockctapost', 'slady_cta_post');

function block_lydo_post() {
	$cta_content = "";
	$cta_content .= '<div id="text_ads_content_tkk">
	<h2 class="tieude_box_why">Slady-Xúc cảm xuân thì</h2>
	<div class="col-md-6 col-sx-12 why_img"> 
	<a href="https://slady.com.vn/san-pham-slady/">
	<img src="https://slady.com.vn/wp-content/uploads/2018/09/san-pham.png" alt="Slady-Xúc cảm xuân thì" title="Slady-Xúc cảm xuân thì">
	</a> 
	<span class="giaban_le">Giá bán lẻ tham khảo: 669.000VNĐ</span> 
	<span class="button_why_db">
	<a href="http://slady.com.vn/san-pham-slady/" target="_bank" title="Slady-Xúc cảm xuân thì">Tìm hiểu thêm
	</a>
	</span>
	</div>
	<div class="col-md-6 col-sx-12 why_text">
		<h3 class="title_why_tkk">4 Lý do bạn nên chọn Slady</h3>
		<li class="why_item_tkk">1. Hoạt chất Shatvarins và Isoflavones giúp cân bằng nội tiết tố nữ (Estrogen), cải thiện nhanh chóng và bền vững các triệu chứng khô hạn và tăng cường sinh lý nữ.</li>
		<li class="why_item_tkk">2. Từ 100% thảo dược Việt Nam, an toàn, lành tính, phù hợp với cơ địa người Việt.</li>
		<li class="why_item_tkk">3. Kiểm chứng an toàn bởi Viện kiểm nghiệm thuốc Trung Ương, chứng nhận bởi cục ATTP.</li>
		<li class="why_item_tkk">4. Sản xuất bởi công nghệ hiện đại, quy trình chặt chẽ của LOTUS nhà máy đạt chuẩn GMP.</li>
		<li class="why_item_tkk"><em>*Tác dụng cuả sản phẩm có thể đến sớm hay muộn tùy thuộc vào cơ địa từng người*</em></li>
		
	</div>
	<div class="clearer"></div>
	</div>';

	return $cta_content;
}
add_shortcode('blocklydopost', 'block_lydo_post');

function block_2nut_cta() {
	$cta_content = "";

	$cta_content .= '<div class="row mabio-cta-box">
	<div class="col medium-4 small-12 large-4">
		<div class="col-inner">
		<div class="img has-hover x md-x lg-x y md-y lg-y" id="image_191967705">
			<a href="tel:0962700008" target="_self" class="n2track">
		<div class="img-inner dark"> 
		<img width="360" height="96" src="https://slady.com.vn/wp-content/uploads/2018/09/NUT-02.png" class="attachment-large size-large" alt="Tư vấn miễn phí Slady">
		</div>
		</a>
		</div>
		</div>
		</div>
	<div class="col medium-4 small-12 large-4">
	</div>
	<div class="col medium-4 small-12 large-4">
		<div class="col-inner">
		<div class="img has-hover x md-x lg-x y md-y lg-y" id="image_513182795">
		<a href="https://slady.com.vn/dat-mua/" target="_self" class="">
		<div class="img-inner dark"> 
			<img width="360" height="96" src="https://slady.com.vn/wp-content/uploads/2018/09/NUT-01.png" class="attachment-large size-large" alt="">
		</div> 
		</a>
		</div>
		</div>
		</div>
	</div>'

	return $cta_content;
}

add_shortcode('blockl2nutcta', 'block_2nut_cta');