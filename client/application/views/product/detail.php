<?php 
 //echo "<pre>";
// print_r ($product);
?>
<div class="container p-full">
   <div class="product-item clearfix">
      <div class="product-detail-col-left">
         <div class="product-featured">
            <div class="product-detail-gallery">
               <div class="product-images">
			   
					<div class="image-featured responsive-img" style="width: 385;">
						 <img width="320" height="auto" src="<?php if($product['Images']) echo $product['Images'][0]['image_src']; ?>" alt="<?php echo $product['title']; ?>"> 
					</div>

					<div class="image-slide hz-slider">
					 <?php if($product['Images']){
						foreach($product['Images'] as $image){
					?>
						<div class="item item-selected">
							<span class="responsive-img">
							<img src="<?php echo $image['image_src']; ?>" alt="<?php echo $product['title']; ?>"  data-view="<?php echo $image['image_src']; ?>"> 
							</span>
						</div>
					<?php		
						}
					}?>
				   </div>
               </div>
            </div>
            <div class="product-detail-info">
               <h1 class="product-title tsf"><?php echo $product['title']?></h1>
               <div class="table-info">
                  <table class="table table-responsive">
                     <thead>
                        <tr>
                           <th>Số lượng (chiếc)</th>
                           <th class="text-right">Giá bán</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td class="text-right">
                              <span><?php echo number_format($product['vn_price']); ?> đ</span> / chiếc   
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="product-info-big">
                  <a class="btn btn-default btn-xs btn-review-shipping-cost"><i class="fa fa-truck"></i>Ước tính phí vận chuyển</a>                        
                  <table class="product-info">
                     <tr>
                        <td width="20%">
                           <i class="glyphicon glyphicon-equalizer"></i>
                           <span>Địa chỉ kho:</span>
                        </td>
                        <td>Hà Nội</td>
                     </tr>
                     <tr>
                        <td>
                           <i class="glyphicon glyphicon-tag"></i>
                           <span>Mã sản phẩm:</span>
                        </td>
                        <td><?php echo $product['id'];?></td>
                     </tr>
                     <tr class="tr-hidden-price product-shipping">
                        <td class="ele-relative" colspan="2">
                           <div class="product-shipping-top">
                              <div class="product-shipping-text">
                                 Phí vận chuyển từ
                                 <span >Hà Nội</span>
                                 đến:
                              </div>
                              <div class="product-shipping-button">
                                 <div class="ylpsc statistic">
                                    <u id="label-ward" data-selected="">...</u>
                                    -
                                    <u id="label-district" data-selected="">...</u>
                                    -
                                    <u id="label-province" data-selected="">...</u>
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                 </div>
                                 : <span id="ds-ship-cost">0</span><span class="text-color-red">đ</span>
                              </div>
                           </div>
                           <div class="select-area">
                              <form id="form-preview-shipping-cost" action="" method="post">
                                 <div class="clearfix shipping-address">
                                    <div class="form-group select-province">
                                       <label class="control-label" for="ts-province">Tỉnh/thành phố</label>
                                       <select id="ts-province" class="form-control" name="province_id">
                                       </select>                                            
                                    </div>
                                    <div class="form-group select-district">
                                       <label class="control-label" for="ts-district">Quận/huyện</label>
                                       <select id="ts-district" class="form-control" name="district_id">
                                       </select>                                            
                                    </div>
                                    <div class="form-group select-ward">
                                       <label class="control-label" for="ts-ward">Phường/xã</label>
                                       <select id="ts-ward" class="form-control" name="ward_id">
                                       </select>                                            
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-6 custom-spinner">
                                       <div class="form-group">
                                          <label class="control-label" for="">
                                             <p class="product-shipping-number">Số lượng:</p>
                                             <input type="text" id="ts-quantity" name="quantity" value="1">                                                    
                                          </label>
                                       </div>
                                    </div>
                                    <div class="col-xs-6">
                                       <p><strong>Hãng vận chuyển:</strong></p>
                                       <b><strong id="logistic-company" style="color: #C40000"></strong></b>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                       <p><strong>Phí vận chuyển:</strong></p>
                                       <p class="price-shipping"><strong id="pr-shipping"
                                          class="text-color-red">0</strong>đ</p>
                                    </div>
                                 </div>
                                 <div class="alert alert-warning" role="alert">Phí vận chuyển sẽ càng rẻ hơn khi
                                    đơn hàng của bạn có nhiều sản phẩm hơn.
                                 </div>
                                 <input type="hidden" name="product_id" value="1052825">                                        
                              </form>
                           </div>
                        </td>
                     </tr>
                  </table>
               </div>
               <div class="product-pay clearfix">
                  <div class="label-title">Thanh toán:</div>
                  <div class="content">
                     <span class="hz-icon icon-luuthong"></span>
                     <span class="hz-icon icon-visa"></span>
                  </div>
               </div>
               <div class="product-pay clearfix">
                  <div class="label-title">Chia sẻ:</div>
                  <div class="content">
                     <div class="fb-share-button" data-href="/ao-khoac-caridigan-nu-dang-ngan-i1052825"
                        data-layout="button" data-size="small" data-mobile-iframe="true">
                     </div>
                     <div style="display: inline-block; position: relative; top: 6px;">
                        <!-- Place this tag in your head or just before your close body tag. -->
                        <!-- Place this tag where you want the share button to render. -->
                        <div class="g-plus" data-action="share" data-annotation="none" data-height="22"
                           data-href="/ao-khoac-caridigan-nu-dang-ngan-i1052825"></div>
                     </div>
                  </div>
               </div>
               <div class="product-protection clearfix">
                  <div class="pull-left">
                     <span class="hz-icon icon-protection"></span>
                  </div>
                  <div class="protection-detail">
                     <div class="title">Bảo hộ người mua</div>
                     <ul>
                        <li><i class="fa fa-check-square-o"></i><strong>Hoàn tiền</strong> nếu không nhận được
                           hàng hoặc thiếu hàng
                        </li>
                        <li><i class="fa fa-check-square-o"></i><strong>Bồi thường</strong> nếu sản phẩm không
                           đúng theo mô tả
                        </li>
                        <li><i class="fa fa-check-square-o"></i><strong>Trả lại hàng</strong> khi sản phẩm không
                           đúng theo mô tả
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <!-- Form đặt mua -->
         <div class="row">
            <div class="col-xs-12 col-sm-12" id="item-order-form" data-attr-id="1052825">
            
			   <div class="sku-select">
				
                  <div class="sku-table col-xs-8 col-sm-8 item-select-sku">
				  <div class="item-select-property-list">
					 
				  </div>
				  <div class="item-select-property-table">
				  </div>
				 
				  </div>
				 
				  
                  <div class="sku-summary col-xs-4 col-sm-4">
                     <div class="summary">
                        <ul class="sku-items"></ul>
                        <div class="total">
                           <p>
                              <span class="s-name">Số lượng:</span>
                              <span class="s-quantity">
                              <b class="quantity txtTotalQuantity">0</b> chiếc</span>
                           </p>
                           <p>
                              <span class="s-name">Tổng tiền:</span>
                              <span class="s-quantity">
                              <b class="total-price txtTotalMoney">0</b>đ
                              </span>
                           </p>
                        </div>
                     </div>
                     <form id="frm-add-cart" action="<?php echo site_url('cart/addToCart');?>" method="post">
						<input type="hidden" name="pid" value="<?php echo $product['id']; ?>">
						 
						<input type="hidden" name="image" value="<?php if($product['Images']) echo $product['Images'][0]['image_src']; ?>">
                        <input type="submit" class="hz-btn hz-btn-red hz-btn-block hz-btn-uppercase hz-btn-bold btn-add-cart" value="Thêm vào giỏ hàng" />                            
                     </form>
                  </div>
               </div>
            </div>
         </div>
		 <script>
					 $(function() {
						 var product_info=<?php echo json_encode($product) ?>;
						 console.log("product_info",product_info);
						$('#item-order-form').itemOrderForm(product_info);
					 });
			 </script>
         <!-- END Form đặt mua -->
         <div class="product-content-big clearfix">
            <div class="product-content-left">
               
               <div class="widget-shop-product">
                  <div class="wpc-panel wpc-panel-default">
                     <div class="wpc-panel-heading-vs2">
                        <div class="title">Sản phẩm cùng Shop</div>
                     </div>
                     <div class="wpc-panel-body">
                        <?php 
						if($same_shop_products){
						foreach($same_shop_products as $same_shop_product){
						 
						?>
                        <div class="product-list-vertical">
                           <a target="_blank" href="<?php echo site_url(''.$same_shop_product['slug'].'-i'.$same_shop_product['id']); ?>" title="<?php echo $same_shop_product['title']; ?>">
                           <span class="responsive-img">
                           <img class="media-object lazy"
                              src="<?php if($same_shop_product['images']) echo $same_shop_product['images'][0]['image_src']; ?>"
                              alt="<?php echo $same_shop_product['title']; ?>" />
                           </span>
                           </a>
                           <div class="media-body m-product-info">
                              <strong class="price"> <?php echo number_format($same_shop_product['vn_price']);?> đ </strong>
                              <a class="capital" href="<?php echo site_url(''.$same_shop_product['slug'].'-i'.$same_shop_product['id']); ?>" title="<?php echo $same_shop_product['title']; ?>" target="_blank"><?php echo $same_shop_product['title']; ?></a>        
                           </div>
                        </div>
                        <?php }} ?>
                     </div>
                     <a class="btn btn-danger btn-shop-product-view-all" href="<?php if(isset($shop_detail)){echo site_url(''.$shop_detail['slug'].'-s'.$shop_detail['id']);}?>" target="_blank">Xem tất cả</a>        
                  </div>
               </div>
            </div>
            <div class="product-content-right">
               <div id="product-tabs">
                  <ul class="product-tabs nav-tabs" role="tablist">
                     <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab"
                           title="Chi tiết sản phẩm">Chi tiết sản phẩm</a>
                     </li>
                     <li role="presentation">
                        <a href="#product-feedback" aria-controls="product-feedback" role="tab"
                           data-toggle="tab"
                           id="tab-product-feedback"
                           data-action="/shop-feedback/index?pid=1052825"
                           title="Thông tin phản hồi">Đánh giá</a>
                     </li>
                     <li role="presentation">
                        <a href="#product-comment" aria-controls="product-comment" role="tab"
                           data-toggle="tab"
                           id="tab-product-comment"
                           data-action="/product/list-comment?pid=1052825"
                           title="Chi tiết sản phẩm">Hỏi đáp</a>
                     </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <ul class="product-attribute clearfix">
                           <li class="tsf">
                              Chất liệu:
                              <span>Len</span>
                           </li>
                           <li class="tsf">
                              Size:
                              <span>Freesize</span>
                           </li>
                           <li class="tsf">
                              Thương hiệu:
                              <span>Không</span>
                           </li>
                           <li class="tsf">
                              Kiểu cổ:
                              <span>Không cổ</span>
                           </li>
                           <li class="tsf">
                              Phong cách:
                              <span>Dạo phố,Công sở</span>
                           </li>
                           <li class="tsf">
                              Kiểu tay:
                              <span>Dài tay</span>
                           </li>
                        </ul>
                        <div class="product-content">
                           <div style="text-align:center;">
						   
						   <?php 
						   if($product['Images']){
						   foreach($product['Images'] as $image){ ?>
                              <img style="max-width: 500px; height: auto" src="<?php echo $image['image_src']; ?>" />
                           <?php } 
						   }?>
						   </div>
                        </div>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="product-comment"></div>
                     <div role="tabpanel" class="tab-pane" id="product-feedback"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="product-detail-col-right">
         <div class="widget-shop-info-v2">
            <div class="content">
               <h5 class="brand-name">
                  <a class="url-shop" href="<?php if(isset($shop_detail)){echo site_url(''.$shop_detail['slug'].'-s'.$shop_detail['id']);}?>" target="_blank"><?php if(isset($shop_detail)){echo  $shop_detail['name'] ;}?>  </a>                 
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
                     <span>Đang bán: </span> <?php echo $shop_product_total;?> mặt hàng
                  </div>
                  <div class="desc">
                     <span>Loại hình:</span> Cửa hàng bán lẻ                
                  </div>
                  <div class="desc">
                     <span>Địa chỉ:</span> <?php if(isset($shop_detail)){echo  $shop_detail['address'] ;}?>               
                  </div>
                  <div class="desc">
                     <span>Mở shop:</span> 10-04-2016                  
                  </div>
               </div>
               <div class="contact-shop text-center">
                  <a class="btn btn-default" href="#" target="_blank"><i class="glyphicon glyphicon-envelope"></i> Liên hệ với chúng tôi</a>            
               </div>
               <div class="btn-shop">
                  <a class="btn btn-warning" href="<?php if(isset($shop_detail)){echo site_url(''.$shop_detail['slug'].'-s'.$shop_detail['id']);}?>" target="_blank">Xem shop</a> 
                  <a class="btn btn-info hz-favorite" href="" title="">Yêu thích</a>     
               </div>
            </div>
         </div>
         <div class="widget-product">
            <div class="wp-panel-primary wpc-panel">
               <div class="wpc-panel-heading-vs2">
                  <div class="title">Sản phẩm mới được bán</div>
               </div>
               <div class="wpc-panel-body">
                  <?php  
				  if(isset($newProducts)){
				  foreach($newProducts as $newProduct){
				 
				  ?>
                  <div class="product-list-vertical">
                     <a target="_blank" href="<?php echo site_url(''.$newProduct['slug'].'-i'.$newProduct['id']) ;?>" title="<?php echo $newProduct['title']; ?>">
                     <span class="responsive-img">
                     <img class="media-object lazy"
                        src="<?php if($newProduct['images']) echo $newProduct['images'][0]['image_src']; ?>"
                        alt='<?php echo $newProduct['title']; ?>'/>
                     </span>
                     </a>
                     <div class="media-body m-product-info">
                        <strong class="price">
                        35.000 đ            </strong>
                        <a class="capital" href="<?php echo site_url(''.$newProduct['slug'].'-i'.$newProduct['id']) ;?>" title="<?php echo $newProduct['title']; ?>" target="_blank"><?php echo $newProduct['title']; ?></a>        
                     </div>
                  </div>
                  <?php } }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>