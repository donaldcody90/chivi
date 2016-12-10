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
					  <a href="#"  title="Về chúng tôi"><?php $menu = get_menu_info(2); if($menu) echo $menu['name'];?></a>
					</div>
					
					<ul>
					<?php 
						$list_items = get_menu_items(2);
						if($list_items){
							foreach($list_items as $item){
					  ?>
						<li>
						  <a href="<?php  echo build_menu_link($item['id']); ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a>
					   <?php
							}
						}
					   ?>
					</ul>
				  </div>
				  <div class="menu-footer-list col-md-4">
					<div class="menu-parent">
					  <a href="#" title="ĐIỀU KHOẢN SỬ DỤNG"><?php $menu = get_menu_info(3); if($menu) echo $menu['name'];?></a>
					</div>
					<ul>
					  <?php 
						$list_items = get_menu_items(3);
						if($list_items){
							foreach($list_items as $item){
					  ?>
						<li>
						  <a href="<?php  echo build_menu_link($item['id']); ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a>
					   <?php
							}
						}
					   ?>
					</ul>
				  </div>
				  <div class="menu-footer-list col-md-4">
					<div class="menu-parent">
					  <a href="#" title="HƯỚNG DẪN SỬ DỤNG"> <?php $menu = get_menu_info(4); if($menu) echo $menu['name'];?> </a>
					</div>
					<ul>
					 <?php 
						$list_items = get_menu_items(4);
						if($list_items){
							foreach($list_items as $item){
					  ?>
						<li>
						  <a href="<?php  echo build_menu_link($item['id']); ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a>
					   <?php
							}
						}
					   ?>
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

