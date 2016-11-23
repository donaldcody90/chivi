<?php
	if(isset($list_product) && (count($list_product) > 0)){
			$listproducts = $list_product;
	}
	if(isset($shop_detail) && (count($shop_detail) > 0)){
			$shop = $shop_detail;
	}
?>
<div class="container p-full">
  <div class="container page-site-width">
    <div class="row">
      <div class="col-fix-right product-shop no-padding pull-left">
        <div class="widget-shop-info-v2">
          <div class="content">
            <h5 class="brand-name">
              <a class="url-shop" href="#" target="_blank"><?php echo $shop['name'];?></a>            
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
                <span>Đang bán: </span> <?php echo count($listproducts);?> mặt hàng
              </div>
              <div class="desc">
                <span>Loại hình:</span> Shop                
              </div>
              <div class="desc">
                <span>Địa chỉ:</span> <?php echo $shop['address'];?>               
              </div>
            </div>
            <div class="btn-shop">
              <a class="btn btn-info hz-favorite" href="/" title="Thêm vào danh sách yêu thích" data-id="1000991" data-type="shop">Yêu thích</a>            
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
			<?php foreach($listproducts as $key=>$product){?>
              <div class="product-list-vertical">
                <a target="_blank" href="<?php echo site_url().url_title(cleanVietnamese($product['title']),'-',true).'-i'.$product['id'];?>" title="<?php echo $product['title']; ?>">
                <span class="responsive-img">
                <img class="media-object lazy"
                  src="<?php echo $product['image']; ?>"
                  alt=<?php echo $product['title']; ?>/>
                </span>
                </a>
                <div class="media-body m-product-info">
                  <strong class="price">
                  <?php echo $product['vn_price']; ?> đ </strong>
                  <a class="capital" href="<?php echo site_url().url_title(cleanVietnamese($product['title']),'-',true).'-i'.$product['id'];?>" title=" <?php echo $product['title']; ?>" target="_blank"><?php echo $product['title']; ?></a>        
                </div>
              </div>
			<?php } ?>  
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
                  <?php echo $shop['name'];?>            
                </div>
                <div class="shop-total-product">
                  Có <strong><?php echo count($list_product);?></strong> kết quả được tìm thấy
                </div>
              </div>
              <form action="" method="get">
                <div class="search-text-box pull-left">
                  <input type="text" class="form-control" name="keyword" value="" placeholder="Tìm kiếm danh mục, sản phẩm thuộc Shop...">        
                </div>
                <div class="item">
                  <div class="form-filter">
                    <span>Lọc theo giá:</span>
                    <input type="text" class="form-control" name="priceFrom" value="" placeholder="Từ"> <span>-</span>
                    <input type="text" class="form-control" name="priceTo" value="" placeholder="Đến"> <button type="submit" class="btn btn-danger">Lọc</button>            
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div id="w0" class="list-view clearfix">
		<?php foreach($listproducts as $key=>$product){?>
          <div class="col-xs-3" data-key="0">
            <div class="product-items product-shop-detail">
              <a target="_blank" href="<?php echo site_url().url_title(cleanVietnamese($product['title']),'-',true).'-i'.$product['id'];?>" class="responsive-img img-featured">
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
			  <a class="product-title" href="<?php echo site_url().url_title(cleanVietnamese($product['title']),'-',true).'-i'.$product['id'];?>" title="<?php echo $product['title']; ?>" target="_blank">
				<?php echo $product['title']; ?>
			  </a>
			  </h4>
            </div>
          </div>
		<?php } ?>  
        </div>
      </div>
    </div>
  </div>
</div>