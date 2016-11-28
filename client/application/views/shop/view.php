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
                <a target="_blank" href="<?php echo site_url($top_sale['slug']);?>" title="<?php echo $top_sale['title']; ?>">
					<span class="responsive-img">
						<img class="media-object lazy" src="<?php echo $top_sale['image']; ?>" alt=<?php echo $top_sale['title']; ?> />
					</span>
                </a>
                <div class="media-body m-product-info">
                  <strong class="price"><?php echo number_format($top_sale['vn_price']); ?> đ </strong>
                  <a class="capital" href="<?php echo site_url($top_sale['slug']);?>" title=" <?php echo $top_sale['title']; ?>" target="_blank"><?php echo $top_sale['title']; ?></a>        
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
                  Có <strong><?php echo isset($list_product)?count($list_product):'';?></strong> kết quả được tìm thấy
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
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle form-sort-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sản phẩm mới nhất
							<i class="fa fa-sort-desc"></i>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo current_url().'?name=xuongquanaochuyensi&amp;sortType=desc&amp;sort=product_id';?>">Sản phẩm mới nhất</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?name=xuongquanaochuyensi&amp;sortType=desc&amp;sort=count_sold';?>">Sản phẩm bán chạy</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?name=xuongquanaochuyensi&amp;sortType=desc&amp;sort=price';?>">Giá giảm dần</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?name=xuongquanaochuyensi&amp;sortType=asc&amp;sort=price';?>">Giá tăng dần</a>
							</li>
						</ul>
					</div>
				</div>
              </form>
            </div>
          </div>
        </div>
        <div id="w0" class="list-view clearfix">
		<?php if(isset($list_product) && count($list_product)>0 ){
		foreach($list_product as $key=>$product){?>
          <div class="col-xs-3" data-key="0">
            <div class="product-items product-shop-detail">
              <a target="_blank" href="<?php echo site_url($product['slug']);?>" class="responsive-img img-featured">
                <img id="featured-1062862" src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">                    
                <div class="price-range">
                  <p>
                    <span class="pull-left">1</span>
                    <span class="pull-right"><?php echo number_format($product['vn_price']); ?> đ</span>
                  </p>
                </div>
              </a>
			  <!--
              <div class="slide responsive">
                <div class="img-wrap item-slide">
                  <div class="responsive-img"><img u="image" src="#" data-view="#" alt="Quần nữ, dáng dài ôm phối da, chất vải da cao cấp-0"/></div>
                </div>
                <div class="img-wrap item-slide">
                  <div class="responsive-img"><img u="image" src="#" data-view="#" alt="Quần nữ, dáng dài ôm phối da, chất vải da cao cấp-1"/></div>
                </div>
              </div>
			  -->
              <div class="price">
                <strong><?php echo number_format($product['vn_price']); ?> đ</strong>
              </div>
              <h4 class="capital">
			  <a class="product-title" href="<?php echo site_url($product['slug']);?>" title="<?php echo $product['title']; ?>" target="_blank">
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