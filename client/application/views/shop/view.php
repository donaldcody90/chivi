<?php /*
	if(isset($list_product) && (count($list_product) > 0)){
			$listproducts = $list_product;
	}
	if(isset($shop_detail) && (count($shop_detail) > 0)){
			$shop = $shop_detail;
	} */
?>
<div class="container p-full">
  <div class="container page-site-width">
    <div class="row">
      <div class="col-fix-right product-shop no-padding pull-left">
        <div class="widget-shop-info-v2">
          <div class="content">
            <h5 class="brand-name">
              <a class="url-shop" href="#" target="_blank"><?php echo isset($shop_detail['name'])?$shop_detail['name']:'';?></a>            
            </h5>
            <div class="shop-status">
              <span class="label label-success">Kinh doanh hộ cá thể</span>
            </div>
            <div class="brand-info">
              <div class="desc">
                <span>Danh hiệu:</span>
                <div class="star-rating">
                  <div class="hz-star-rating">
                    <img src="static/images/icon_shop.png">
                    <img src="static/images/icon_shop.png">
                    <img src="static/images/icon_shop.png">
                  </div>
                </div>
              </div>
              <div class="desc">
                <span>Đang bán: </span> <?php if(isset($listproducts)){echo count($listproducts);} ?> mặt hàng
              </div>
              <div class="desc">
                <span>Loại hình:</span> Shop                
              </div>
              <div class="desc">
                <span>Địa chỉ:</span> <?php echo isset($shop_detail['address'])?$shop_detail['address']:'';?>               
              </div>
            </div>
            <div class="btn-shop">
              <a class="btn btn-info hz-favorite" href="/" title="Thêm vào danh sách yêu thích">Yêu thích</a>            
            </div>
          </div>
        </div>
		<!--
        <div class="widget-product-category">
          <div class="wpc-panel wpc-panel-default">
            <div class="wpc-panel-heading-vs2">
              <div class="title">Danh mục của người bán</div>
            </div>
            <div class="wpc-panel-body">
              <ul class="list-bottom-bordered">
                <li class="lidad default">
                  <span class="span-img"></span>
                  <div class="dad"><a class="tsf default" href="#" title="Áo khoác">Áo khoác</a></div>
                </li>
                <li class="lidad default">
                  <span class="span-img"></span>
                  <div class="dad"><a class="tsf default" href="#" title="áo kiểu nữ">áo kiểu nữ</a></div>
                </li>
              </ul>
            </div>
          </div>
        </div>
		-->
        <div class="widget-shop-product">
          <div class="wpc-panel wpc-panel-primary">
            <div class="wpc-panel-heading-vs2">
              <div class="title">SẢN PHẨM BÁN CHẠY</div>
            </div>
            <div class="wpc-panel-body">
			<?php if(isset($shop_detail['top_sales']) && count($shop_detail['top_sales'])>0 ){
			foreach($shop_detail['top_sales'] as $key=>$top_sale){ ?>
              <div class="product-list-vertical">
                <a target="_blank" href="<?php echo site_url($top_sale['slug'].'-i'.$top_sale['id']);?>" title="<?php echo $top_sale['title']; ?>">
					<span class="responsive-img">
						<img class="media-object lazy" src="<?php echo $top_sale['image']; ?>" alt=<?php echo $top_sale['title']; ?> />
					</span>
                </a>
                <div class="media-body m-product-info">
                  <strong class="price"><?php echo number_format($top_sale['vn_price']); ?> đ </strong>
                  <a class="capital" href="<?php echo site_url($top_sale['slug'].'-i'.$top_sale['id']);?>" title=" <?php echo $top_sale['title']; ?>" target="_blank"><?php echo $top_sale['title']; ?></a>        
                </div>
              </div>
			<?php } } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-fix-shop no-padding pull-right">
        <div class="col-md-12">
        </div>
        <div class="shop-title-filter">
          <div class="col-md-12 filter-product-sho">
            <div class="shop-filter clearfix well">
              <div class="shop-title">
                <div class="shop-category-title">
                  <?php echo isset($shop_detail['name'])?$shop_detail['name']:'';?>            
                </div>
                <div class="shop-total-product">
                  Có <strong><?php echo isset($list_product['total'])?$list_product['total']:'';?></strong> kết quả được tìm thấy
                </div>
              </div>
              <form action="" method="get">
                <div class="search-text-box pull-left">
                  <input type="text" class="form-control" name="filter_title" value="<?php echo isset($_GET['filter_title'])?$_GET['filter_title']:'' ;?>" placeholder="Tìm kiếm danh mục, sản phẩm thuộc Shop...">        
                </div>
                <div class="item">
                  <div class="form-filter">
                    <span>Lọc theo giá:</span>
                    <input type="number" class="form-control" name="filter_startdate_vn_price" value="<?php echo isset($_GET['filter_startdate_vn_price'])?$_GET['filter_startdate_vn_price']:''; ?>" placeholder="Từ">
					<span>-</span>
                    <input type="number" class="form-control" name="filter_enddate_vn_price" value="<?php echo isset($_GET['filter_enddate_vn_price'])?$_GET['filter_enddate_vn_price']:''; ?>" placeholder="Đến">
					<button type="submit" class="btn btn-danger">Lọc</button>
					<!--<a href="#" class="btn btn-danger" <?php// if((!isset($_GET['filter_title']) or $_GET['filter_title']=='') && (!isset($_GET['filter_startdate_vn_price']) or $_GET['filter_startdate_vn_price']=='') && (!isset($_GET['filter_enddate_vn_price']) or $_GET['filter_enddate_vn_price']=='') ){ echo 'style="display:none;"'; }?> >Xóa</a>-->
                  </div>
                </div>
				<div class="item" style="float: right;">
					<div class="shop-order dropdown">
						<button class="btn btn-default dropdown-toggle form-sort-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span>Sản phẩm mới nhất</span>
							<i class="fa fa-sort-desc"></i>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo current_url().'?sortType=desc&amp;sort=id';?>">Sản phẩm mới nhất</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?sortType=desc&amp;sort=is_featured';?>">Sản phẩm hot</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?sortType=desc&amp;sort=vn_price';?>">Giá giảm dần</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?sortType=asc&amp;sort=vn_price';?>">Giá tăng dần</a>
							</li>
						</ul>
					</div>
				</div>
              </form>
            </div>
          </div>
        </div>
        <div id="w0" class="list-view clearfix">
		<?php if(isset($list_product['data']) && count($list_product['data'])>0 ){
		foreach($list_product['data'] as $key=>$product){?>
          <div class="col-xs-3" data-key="0">
            <div class="product-items product-shop-detail">
              <a target="_blank" href="<?php echo site_url($product['slug'].'-i'.$product['id']);?>" class="responsive-img img-featured">
                <img id="featured-1062862" src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">                    
                <div class="price-range">
					<?php if(isset($product['price_range']) && !empty($product['price_range'])){ 
						foreach($product['price_range'] as $price_range){   ?>
						<p>
							<span class="pull-left"><?php echo $price_range['quantity']?$price_range['quantity']:'' ;?></span>
							<span class="pull-right"><?php echo $price_range['price']?number_format($price_range['price']):'' ;?> đ</span>
						</p>
					<?php } } else{ ?>
						<p>
							<span class="pull-left">1</span>
							<span class="pull-right"><?php echo number_format($product['vn_price']);?> đ</span>
						</p>
					<?php } ?>
                </div>
              </a>
			  <div class="slide responsive slick-initialized slick-slider">
                <div aria-live="polite" class="slick-list draggable">
					<div class="slick-track" style="opacity: 1; width: 215px; transform: translate3d(0px, 0px, 0px);" role="listbox">
						<div class="img-wrap item-slide slick-slide slick-current slick-active" data-id="1074408" data-slick-index="0" aria-hidden="false" style="width: 43px;" tabindex="0" role="option" aria-describedby="slick-slide10">
							<div class="responsive-img">
								<img u="image" src="http://luuthong.vn/uploads/media/20161128/3e45597fac9313555e1c44b9dfd0a022.60x60.jpg" data-view="http://luuthong.vn/uploads/media/20161128/3e45597fac9313555e1c44b9dfd0a022.220x220.jpg" alt="Đầm ren tay dài cổ ngọc trai-0">
							</div>
						</div>
						<div class="img-wrap item-slide slick-slide slick-active" data-id="1074408" data-slick-index="1" aria-hidden="false" style="width: 43px;" tabindex="0" role="option" aria-describedby="slick-slide11">
							<div class="responsive-img">
								<img u="image" src="http://luuthong.vn/uploads/media/20161128/ae18dbad6b228167fb151de72444af80.60x60.jpg" data-view="http://luuthong.vn/uploads/media/20161128/ae18dbad6b228167fb151de72444af80.220x220.jpg" alt="Đầm ren tay dài cổ ngọc trai-1">
							</div>
						</div>
						<div class="img-wrap item-slide slick-slide slick-active" data-id="1074408" data-slick-index="2" aria-hidden="false" style="width: 43px;" tabindex="0" role="option" aria-describedby="slick-slide12">
							<div class="responsive-img">
								<img u="image" src="http://luuthong.vn/uploads/media/20161128/213ca470f42ed5e828617d41512c6700.60x60.jpg" data-view="http://luuthong.vn/uploads/media/20161128/213ca470f42ed5e828617d41512c6700.220x220.jpg" alt="Đầm ren tay dài cổ ngọc trai-2">
							</div>
						</div>
						<div class="img-wrap item-slide slick-slide slick-active" data-id="1074408" data-slick-index="3" aria-hidden="false" style="width: 43px;" tabindex="0" role="option" aria-describedby="slick-slide13">
							<div class="responsive-img">
								<img u="image" src="http://luuthong.vn/uploads/media/20161128/3cd52d5a68adef38389101f5b8eaed2e.60x60.jpg" data-view="http://luuthong.vn/uploads/media/20161128/3cd52d5a68adef38389101f5b8eaed2e.220x220.jpg" alt="Đầm ren tay dài cổ ngọc trai-3">
							</div>
						</div>
						<div class="img-wrap item-slide slick-slide slick-active" data-id="1074408" data-slick-index="4" aria-hidden="false" style="width: 43px;" tabindex="0" role="option" aria-describedby="slick-slide14">
							<div class="responsive-img">
								<img u="image" src="http://luuthong.vn/uploads/media/20161128/4d1a5c8f0ae6f316475bbab5a873536c.60x60.jpg" data-view="http://luuthong.vn/uploads/media/20161128/4d1a5c8f0ae6f316475bbab5a873536c.220x220.jpg" alt="Đầm ren tay dài cổ ngọc trai-4">
							</div>
						</div>
					</div>
				</div>        
              </div>
              <div class="price">
                <strong><?php echo number_format($product['vn_price']); ?> đ</strong>
              </div>
              <h4 class="capital">
			  <a class="product-title" href="<?php echo site_url($product['slug'].'-i'.$product['id']);?>" title="<?php echo $product['title']; ?>" target="_blank">
				<?php echo $product['title']; ?>
			  </a>
			  </h4>
            </div>
          </div>
		<?php } } else{ ?>
		  <div class="empty">Không tìm thấy kết quả nào.</div>
		<?php } ?>
        </div>
		<div class="text-center">
			<?php echo $this->pagination->create_links();?>
		</div>
      </div>
    </div>
  </div>
</div>