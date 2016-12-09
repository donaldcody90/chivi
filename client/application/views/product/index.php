<?php 
//echo "<pre>";
//print_r($products);
?>
<div class="container p-full">
  <div class="container page-site-width">
    <div class="row">
	<div class="shop-title-filter">
          <div class="col-md-12 filter-product-sho">
            <div class="shop-filter clearfix well">
              <form action="" method="get">
                <div class="search-text-box pull-left">
                  <input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'' ;?>" placeholder="Nhập tên sản phẩm để tìm kiếm ... ">        
                </div>
                <div class="item">
                  <div class="form-filter">
                    <span>Lọc theo giá:</span>
                    <input type="text" class="form-control" name="priceFrom" value="<?php echo isset($_GET['priceFrom'])?$_GET['priceFrom']:''; ?>" placeholder="Từ">
					<span>-</span>
                    <input type="text" class="form-control" name="priceTo" value="<?php echo isset($_GET['priceTo'])?$_GET['priceTo']:''; ?>" placeholder="Đến">
					<button type="submit" class="btn btn-danger">Lọc</button>
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
								<a href="<?php echo current_url().'?sortType=desc&amp;sort=date';?>">Sản phẩm mới nhất</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?sortType=desc&amp;sort=count_sold';?>">Sản phẩm bán chạy</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?sortType=desc&amp;sort=price';?>">Giá giảm dần</a>
							</li>
							<li>
								<a href="<?php echo current_url().'?sortType=asc&amp;sort=price';?>">Giá tăng dần</a>
							</li>
						</ul>
					</div>
				</div>
              </form>
            </div>
          </div>
        </div>
	<div id="w0" class="list-view clearfix">
		<?php if(isset($products) && count($products)>0 ){
		foreach($products as $key=>$product){?>
          <div class="col-xs-3" style="width: 20%">
            <div class="product-items product-shop-detail">
              <a title="" href="<?php echo vst_buildRewriteURL($product['id'],$product['slug'],'product');?>" class="responsive-img img-featured">
                <img id="featured-1062862" src="<?php if($product['images']) echo $product['images'][0]['image_src']; ?>" alt="<?php echo $product['title']; ?>">                    
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
			 
              <div class="price">
                <strong><?php echo number_format($product['vn_price']); ?> đ</strong>
              </div>
              <h4 class="capital">
			  <a class="product-title" href="<?php echo vst_buildRewriteURL($product['id'],$product['slug'],'product');?>" title="<?php echo $product['title']; ?>">
				<?php echo $product['title']; ?>
			  </a>
			  </h4>
			  <div class="shop-info" style="margin-bottom:0">
					  <div class="shop-title-v2">
						<div class="shop-left">
						  <a class="shop-title" href="<?php echo vst_buildRewriteURL($product['shop_id'],$product['shop_slug'],'shop');?>" title="<?php echo $product['shop_name'];?>"><?php echo $product['shop_name'];?></a>                                        
						  <div class="shop-info-pop">
							<strong class="capital"><?php echo $product['shop_name']; ?></strong>
							<div class="line">
							  <span class="plh pull-left">Loại hình:</span>
							  <span>Thời trang</span>
							</div>
							<div class="line">
							  <span class="plh pull-left">Đang bán:</span>
							  <span>140</span>
							</div>
							<div class="line">
							  <span class="plh pull-left">Địa chỉ:</span>
							  <span><?php echo $product['address'];?></span>
							</div>
						  </div>
						  <span class="shop-icon-vip"></span>
						</div>
						<div class="hz-star-rating">
							<?php 
								if($product['total_rate']>0 && $product['count_rate']>0){
									for($i=0; $i<($product['total_rate']/$product['count_rate']);$i++){ ?>
										<img src="<?php echo site_url('static/images/icon_shop.png');?>"/>
							<?php } } ?>	
						</div>
						<div class="shop-line-icon">
						  <div class="tooltips">
							<i class="hz-icon icon-protection-small"></i>
							<span class="tooltip-text">Bảo hộ người mua</span>
						  </div>
						</div>
					  </div>
					</div>
            </div>
          </div>
		<?php } } ?>
		
    </div>
	<div class="pag">	
			<?php echo  $this->pagination->create_links() ; ?>
		</div>
    </div>
  </div>
</div>		