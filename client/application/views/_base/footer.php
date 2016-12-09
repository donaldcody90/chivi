<div class="overlay"></div>
    <footer class="footer">
		<div class="footer-top">
		  <div class="container">
			<h2 class="text-center footer-title">CHIVI - KÊNH BÁN BUÔN CỦA NGƯỜI VIỆT</h2>
			<div class="footer-social text-center">
			  <a class="social  social-button" href="#" title="Liên kết tới trang facebook của chivi.vn" target="_blank"><span class="fa fa-facebook-square"></span>&nbsp;&nbsp;Facebook</a>
			  <a class=" social social-button" href="#" title="Liên kết tới trang gplus của chivi.vn" target="_blank"><span class="fa fa-google-plus-square"></span>&nbsp;&nbsp;Google +</a>
			  <a class=" social social-button" href="#" title="Liên kết tới kênh youtube của chivi.vn" target="_blank"><span class="fa fa-youtube-square"></span>&nbsp;&nbsp;Youtube</a>                
			  <a class="none-hover" href="#">
			  <img alt="" title="" src="static/images/tzqOld5W4HzZuPVvmNYCfA==.jpgx">
			  </a>
			</div>
		  </div>
		</div>
		<div class="footer-main">
		  <div class="container">
			<div class="row">
			  <div class="col-xs-4">
				<h4 class="title-company-auth">
				  Chủ sở hữu: Chivi.
				</h4>
				<img class="img-contact" src="static/images//address.png" alt="Thông tin liên hệ.">                    
			  </div>
			  <div class="footer-menu col-xs-8">
				<div>
				  <div class="menu-footer-list col-md-4">
					<div class="menu-parent">
					  <a href="#"  title="Về chúng tôi"> Về chúng tôi </a>
					</div>
					<ul>
					  <li>
						<a href="#"  title="Giới thiệu chivi.vn">Giới thiệu Chivi.vn</a>
					  </li>
					  <li>
						<a href="#"  title="Thoả thuận người dùng">Thoả thuận người dùng</a>
					  </li>
					  <li>
						<a href="#"   title="Những câu hỏi thường gặp">Những câu hỏi thường gặp</a>
					  </li>
					  <li>
						<a href="#"   title="Tuyển dụng">Tuyển dụng</a>
					  </li>
					  <li>
						<a href="#" target="_blank"  title="Sitemap">Sitemap</a>
					  </li>
					</ul>
				  </div>
				  <div class="menu-footer-list col-md-4">
					<div class="menu-parent">
					  <a href="#" title="ĐIỀU KHOẢN SỬ DỤNG"> ĐIỀU KHOẢN SỬ DỤNG</a>
					</div>
					<ul>
					  <li>
						<a href="#" title="Quy chế hoạt động">Quy chế hoạt động</a>
					  </li>
					  <li>
						<a href="#" title="Chính sách bảo mật">Chính sách bảo mật</a>
					  </li>
					  <li>
						<a href="#" title="Giải quyết khiếu nại">Giải quyết khiếu nại</a>
					  </li>
					  <li>
						<a href="#" title="Bán hàng cùng Lưu Thông">Bán hàng cùng Chivi</a>
					  </li>
					  <li>
						<a href="#" title="Quy định mua hàng">Quy định mua hàng</a>
					  </li>
					  <li>
						<a href="#" title="Quy định đối với người mua hàng">Quy định đối với người mua hàng</a>
					  </li>
					  <li>
						<a href="#" title="Quy định đối với người bán hàng">Quy định đối với người bán hàng</a>
					  </li>
					</ul>
				  </div>
				  <div class="menu-footer-list col-md-4">
					<div class="menu-parent">
					  <a href="#" title="HƯỚNG DẪN SỬ DỤNG"> HƯỚNG DẪN SỬ DỤNG </a>
					</div>
					<ul>
					  <li>
						<a href="#" title="Hướng dẫn đăng ký tài khoản">Hướng dẫn đăng ký tài khoản</a>
					  </li>
					  <li>
						<a href="#" title="Hướng dẫn đăng nhập">Hướng dẫn đăng nhập</a>
					  </li>
					  <li>
						<a href="#" title="Hướng dẫn mở Shop">Hướng dẫn mở Shop</a>
					  </li>
					  <li>
						<a href="#" title="Hướng dẫn đăng sản phẩm">Hướng dẫn đăng sản phẩm</a>
					  </li>
					  <li>
						<a href="#" title="Hướng dẫn đặt hàng">Hướng dẫn đặt hàng</a>
					  </li>
					  <li>
						<a href="#" title="Hướng dẫn nạp tiền Vào tài khoản">Hướng dẫn nạp tiền Vào tài khoản</a>
					  </li>
					  <li>
						<a href="#"  title="Hướng dẫn gửi Liên hệ, Góp ý">Hướng dẫn gửi Liên hệ, Góp ý</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		 
    </footer>
	<script>
		var baseURL="<?php echo base_url() ?>";
	</script>
	<?php
		$siteSconfig = $this->config->item('site');
		if( isset($siteSconfig['scripts']['foot']) ){
		foreach ($siteSconfig['scripts']['foot'] as $file)
			{
				$url = starts_with($file, 'http') ? $file : base_url($file);
				echo "<script src='$url'></script>".PHP_EOL;
			}
		}
	?>
	
    <div id="fb-root"></div>
  </body>
</html>

