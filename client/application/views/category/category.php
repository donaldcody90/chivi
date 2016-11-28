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
					<li><a href="/thoi-trang-c1000011" title="Thời trang">Thời trang</a><i class="icon-breadcrumb"></i></li>
					<li><a href="/quan-ao-c1000012" title="Quần áo">Quần áo</a><i class="icon-breadcrumb"></i></li>
					<li><a href="/quan-ao-nu-c1000017" title="Quần áo Nữ">Quần áo Nữ</a><i class="icon-breadcrumb"></i></li>
					<li><a href="/ao-nu-c1000025" title="Áo nữ">Áo nữ</a><i class="icon-breadcrumb"></i></li>
					<li>Áo khoác Nữ</li>
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
				  <a class="" href="/search/index" title="Tất cả danh mục">TẤT CẢ DANH MỤC</a>
				  <?php if( isset($list_subcat) && $list_subcat!=array() ){ 
					foreach($list_subcat as $subcat){ ?>
						<a class="tsf" href="<?php echo site_url($subcat['slug']);?>" title="<?php echo $subcat['name'];?>" ><?php echo $subcat['name'];?> <span>(<?php echo $subcat['total_product'];?>)</span></a>
				  <?php } } ?>
				</div>
			  </td>
			  <td style="width: 1%;">
				<a href="#" class="filter-toggle is-close" data-type="categories">
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
			<a href="<?php echo vst_currentUrl().'?sortType=desc&amp;sort=hot';?>" title="Sản phẩm hot"><i class="glyphicon glyphicon-fire"></i> Sản phẩm hot</a>            
		  </div>
		  <div class="item ">
			<a href="<?php echo vst_currentUrl().'?sortType=asc&sort=vn_price';?>" title="Giá tăng dần"><i class="glyphicon glyphicon-arrow-up"></i> Giá tăng dần</a>            
		  </div>
		  <div class="item ">
			<a href="<?php echo vst_currentUrl().'?sortType=desc&amp;sort=vn_price';?>" title="Giá giảm dần"><i class="glyphicon glyphicon-arrow-down"></i> Giá giảm dần</a>            
		  </div>
		  <div class="item ">
			<a href="<?php echo vst_currentUrl().'?sortType=desc&amp;sort=id';?>" title="Sản phẩm mới nhất"><i class="glyphicon glyphicon-star"></i> Sản phẩm mới nhất</a>            
		  </div>
		  <div class="item">
			<form class="form-filter" action="" method="get">
			  <span>Lọc theo giá:</span>
			  <input type="text" class="top-filter-input" name="filter_startdate_vn_price" placeholder="Từ">
			  <span>-</span>
			  <input type="text" class="top-filter-input" name="filter_enddate_vn_price" placeholder="Đến">                
			  <select class="select-province" name="">
				<option value="">-- Lọc theo tỉnh thành --</option>
				<option value="1">Hà Nội</option>
				<option value="31">Vĩnh Phúc</option>
				<option value="41">Bắc Ninh</option>
				<option value="50">Quảng Ninh</option>
			  </select>
			  <button type="submit" class="filter-btn" title="Lọc">Lọc</button>                
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
					<a target="_blank" href="<?php echo site_url($product['slug']);?>" class="responsive-img img-featured" title=" ">
					  <img id="featured-1053957" src="<?php echo $product['image']?>" alt=" ">                                                                    
					  <div class="price-range">
						<p>
						  <span
							class="pull-left"></span>
						  <span
							class="pull-right"><?php echo number_format($product['vn_price']);?> đ </span>
						</p>
					  </div>
					</a>
					<div class="price">
					  <strong class="pull-left"><?php echo number_format($product['vn_price']);?> đ </strong>
					</div>
					<h4 class="capital">
						<a class="product-title" href="<?php echo site_url($product['slug']);?>" title="<?php echo $product['title'];?>" target="_blank">
							<?php echo $product['title']?>
						</a>
					</h4>
					<div class="shop-info">
					  <div class="shop-title-v2">
						<div class="shop-left">
						  <a class="shop-title" href="<?php echo site_url($product['shop_slug']);?>" title="<?php echo $product['shop_name'];?>" target="_blank"><?php echo $product['shop_name'];?></a>                                        
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
	</div>
</div>