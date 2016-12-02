<div class="container p-full">
	<div class="search-index">
		<div class="filter">
		  <h1>Bán buôn bán sỉ Áo khoác Nữ giá rẻ</h1>
		  (<span style='color: #C40000'><?php echo $list_product['total'];?></span> sản phẩm)
		  <table class="table">
			<tr>
			  <td colspan="3">
				<div class="pull-left">
				  <ol class="box-breadcrumb clearfix">
					<li>
					  <a href="/" title="Trang chủ">Trang chủ</a> <i class="icon-breadcrumb"></i>
					</li>
					<?php if(isset($links['breadcrumbs']['parent_cats']) && !empty($links['breadcrumbs']['parent_cats'])){
						foreach($links['breadcrumbs']['parent_cats'] as $breadcrumb){ ?>
							<li><a href="<?php echo site_url($breadcrumb['slug'].'-c'.$breadcrumb['id']);?>" title="<?php echo $breadcrumb['name'];?>"><?php echo $breadcrumb['name'];?></a><i class="icon-breadcrumb"></i></li>
					<?php } } ?>
					<li><?php echo $links['breadcrumbs']['current_cat']?$links['breadcrumbs']['current_cat']['name']:'';?></li>
				  </ol>
				</div>
				<div class="pull-right">
				</div>
			  </td>
			</tr>
			<tr>
			  <th class="bg-warning filter-head">Danh mục: </th>
			  <td class="filter-content">
				<div class="filter-items content-collapse" id="filter-categories">
				  <a class="" href="<?php echo current_url();?>" title="Tất cả danh mục">TẤT CẢ DANH MỤC</a>
				  <?php if( isset($links['list_subcat']) && $links['list_subcat']!=array() ){ 
					foreach($links['list_subcat'] as $subcat){ ?>
						<a class="tsf" href="<?php echo site_url($subcat['slug'].'-c'.$subcat['id']);?>" title="<?php echo $subcat['name'];?>" ><?php echo $subcat['name'];?> <span>(<?php echo $subcat['product_total'];?>)</span></a>
				  <?php } } ?>
				</div>
			  </td>
			  <td style="width: 1%;">
				<a href="#" class="filter-toggle is-close">
				<i class="glyphicon glyphicon-collapse-down"></i>
				</a>
			  </td>
			</tr>
		  </table>
		</div>
	</div>
	<div class="widget-product-list">
		<div class="product-filter">
		  <div class="item ">
			<a href="<?php echo current_url().'?sortType=desc&amp;sort=hot';?>" title="Sản phẩm hot"><i class="glyphicon glyphicon-fire"></i> Sản phẩm hot</a>            
		  </div>
		  <div class="item ">
			<a href="<?php echo current_url().'?sortType=asc&sort=price';?>" title="Giá tăng dần"><i class="glyphicon glyphicon-arrow-up"></i> Giá tăng dần</a>            
		  </div>
		  <div class="item ">
			<a href="<?php echo current_url().'?sortType=desc&amp;sort=price';?>" title="Giá giảm dần"><i class="glyphicon glyphicon-arrow-down"></i> Giá giảm dần</a>            
		  </div>
		  <div class="item ">
			<a href="<?php echo current_url().'?sortType=desc&amp;sort=date';?>" title="Sản phẩm mới nhất"><i class="glyphicon glyphicon-star"></i> Sản phẩm mới nhất</a>            
		  </div>
		  <div class="item">
			<form class="form-filter" action="" method="get">
			  <span>Lọc theo giá:</span>
			  <input type="text" class="top-filter-input" name="priceFrom" value="<?php echo isset($_GET['priceFrom'])?$_GET['priceFrom']:''; ?>" placeholder="Từ">
			  <span>-</span>
			  <input type="text" class="top-filter-input" name="priceTo" value="<?php echo isset($_GET['priceTo'])?$_GET['priceTo']:''; ?>" placeholder="Đến">
			  <button type="submit" class="filter-btn" title="Lọc">Lọc</button>                
			  <a href="<?php echo current_url();?>" class="filter-btn" title="Xóa">Xóa</a>
			</form>
		  </div>
		</div>
		<div class="row">
			<div class="inside">
			<?php if(isset($list_product['data']) && !empty($list_product['data'])){
				foreach($list_product['data'] as $key => $product){
				?>
				<div class="col-lg-15 col-sm-4 col-md-3 col-xs-6 col-vxs-12">
				  <div class="product-items">
					<a target="_blank" href="<?php echo site_url($product['slug'].'-i'.$product['id']);?>" class="responsive-img img-featured" title=" ">
					  <?php if(isset($product['images']) && !empty($product['images'])){
						foreach($product['images'] as $image){ 
							if($image['is_default']==1){ ?>
								<img id="featured-1053957" src="<?php echo $image['image_src']; ?>" alt="<?php echo $image['alt']; ?>">
					  <?php } break;
							} } ?>
					  <div class="price-range">
						<?php if(isset($product['price_range']) && !empty($product['price_range'])){
							foreach($product['price_range'] as $price_range){ ?>
								<p>
								  <span class="pull-left"><?php echo $price_range['quantity'];?></span>
								  <span class="pull-right"><?php echo number_format($price_range['price']);?> đ </span>
								</p>
						<?php } } 
							else{ ?>
								<p>
								  <span class="pull-left">1</span>
								  <span class="pull-right"><?php echo number_format($product['vn_price']);?> đ </span>
								</p>
						<?php } ?>
					  </div>
					</a>
					<div class="price">
					  <strong class="pull-left"><?php echo number_format($product['vn_price']);?> đ </strong>
					</div>
					<h4 class="capital">
						<a class="product-title" href="<?php echo site_url($product['slug'].'-i'.$product['id']);?>" title="<?php echo $product['title'];?>" target="_blank">
							<?php echo $product['title']?>
						</a>
					</h4>
					<div class="shop-info">
					  <div class="shop-title-v2">
						<div class="shop-left">
						  <a class="shop-title" href="<?php echo site_url($product['shop_slug'].'-s'.$product['shop_id']);?>" title="<?php echo $product['shop_name'];?>" target="_blank"><?php echo $product['shop_name'];?></a>                                        
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
									<img src="<?php echo site_url('static/images/icon_shop.png')?>"/>
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
			<?php } } 
				else{ ?>
				<div class="empty">Không tìm thấy kết quả nào.</div>
			<?php } ?>
			</div>
		</div>
		<div class="text-center">
			<?php echo $this->pagination->create_links();?>
		</div>
	</div>
</div>