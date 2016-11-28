<?php 
   if(isset($shop_detail)){
    $shop = $shop_detail;
   }

   ?>
<div class="container p-full">
   <div class="product-item clearfix">
      <div class="product-detail-col-left">
         <div class="product-featured">
            <div class="product-detail-gallery">
               <div class="product-images">
                  <div class="image-featured responsive-img">
                     <img src="<?php echo $product['image']; ?>" alt="Áo khoác caridigan nữ dáng ngắn"> 
                  </div>
				  <!--
                  <div class="image-slide hz-slider">
                     <div class="item item-selected">
                        <span class="responsive-img">
                        <img src="static/images/46884be5471326a10058d31a3acc784b.100x100.jpg" alt=""  data-view="static/images/46884be5471326a10058d31a3acc784b.500x400.jpg"> </span>
                     </div>
                     <div class="item item-selected">
                        <span class="responsive-img">
                        <img src="static/images/35aaeb69d4048d4dc6542b0f4437cd30.100x100.jpg" alt=" " data-view="static/images/35aaeb69d4048d4dc6542b0f4437cd30.500x400.jpg"> </span>
                     </div>
                     <div class="item item-selected">
                        <span class="responsive-img">
                        <img src="static/images/5ca103de53314acd71454c132415f111.100x100.jpg" alt=" " data-view="static/images/5ca103de53314acd71454c132415f111.500x400.jpg"> </span>
                     </div>
                     <div class="item item-selected">
                        <span class="responsive-img">
                        <img src="static/images/6a135280b26591d85394f1040b5bb938.100x100.jpg" alt=" " data-view="static/images/6a135280b26591d85394f1040b5bb938.500x400.jpg"> </span>
                     </div>
                  </div>
				  -->
                  <div class="product-detail-like">
                     <a class="hz-favorite" href="#" title="Thêm vào danh sách sản phẩm yêu thích" data-id="1052825" data-type="product" data-label="Sản phẩm"><i class="fa fa-heart"></i> Thêm danh sách yêu thích</a>                        
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
                     <?php if(isset($product_detail) && !empty($product_detail)){
						 print_r($product_detail);
                        foreach($product_detail as $d_key => $detail){
                        if(isset($detail['attr_type']) && $detail['attr_type'] == 'color'){
                        ?>
                     <div class="item-select-property-list">
                        <table class="table first-property-items" style="margin-bottom: 0;">
                           <tbody>
                              <tr>
                                 <td style="width: 15%; border: none; white-space: nowrap;">
                                    <strong>
                                       <p class="tsf"><?php echo $detail['attr_name']; ?></p>
                                    </strong>
                                 </td>
								 
                                 <td style="border: none;">
								 <?php 
								 if(isset($detail['list_attr'])){
								 foreach($detail['list_attr'] as $k=>$v) {?>
                                    <a class="pf-item pf-cs item-selected tsf item-tooltip detail_attr" 
									  title="<?php echo $v['attr_value']; ?>" id="<?php echo $v['pattr_id'];  ?>" data-attr-id="<?php echo $v['pattr_id'];  ?>" >
                                       <span class="tsf1 item-wrap">
                                          <p class="tsf tsf1"><?php echo $v['attr_value']; ?></p>
                                       </span>
                                    </a>
									<?php } }?>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <?php }else if(isset($detail['attr_type']) && $detail['attr_type'] == 'size'){ ?>
                     <div class="item-select-property-table">
                        <table class="table property-items" style="margin-bottom: 0;">
                           <thead>
                              <tr>
                                 <th class="tsf"><?php echo $detail['attr_name']; ?> </th>
                                 <th style="width: 150px;" class="text-right">Giá</th>
                                 
                                 <th style="width: 200px;" class="text-center">Số lượng</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
							  if(isset($detail['list_attr'])){
							  foreach($detail['list_attr'] as $k1=>$v1) { ?>
                              <tr class="ps-item" data-sku-id="1284709" data-property-id="<?php echo $v1['pattr_id']; ?>">
                                 <td>
                                    <p class="tsf"><?php echo $v1['attr_value']; ?></p>
                                 </td>
                                 <td class="item-price text-right">
                                    <?php echo number_format($product['vn_price']); ?>
                                 </td>
                                
                                 <td class="text-center">
                                    <span class="ui-spinner ui-widget ui-widget-content ui-corner-all" style="height: 28px;">
                                    <input type="text" class="num-range ui-spinner-input txtQuantity" value="0" aria-valuemin="0" aria-valuenow="0" autocomplete="off" role="spinbutton" data-valuemax="5" aria-valuemax="5">
                                    <a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only btnIncrease" tabindex="-1" role="button">
                                    <span class="ui-button-text">
                                    <span class="ui-icon ui-icon-triangle-1-n">+</span></span></a>
                                    <a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only btnDecrease" tabindex="-1" role="button"><span class="ui-button-text">
                                    <span class="ui-icon ui-icon-triangle-1-s">-</span></span></a>
                                    </span>
                                 </td>
                              </tr>
                              <?php }} ?>	
                           </tbody>
                        </table>
                     </div>
                  
                  <?php }
					} 
				  }
				  ?>
				  </div>
				  <script>
					 $(function() {
							$('#item-order-form').itemOrderForm(
								{product:
									{"id":1073716,
									"type":2,
									"weight":0.3,
									"price_min":145000,
									"price_max":145000,
									"quantity_min":1,
									"ws_rule_number":1,
									"is_selected":0},
									properties:[
										{  "id":"b4aca97983db90a346429bacf1a6b816",
										   "name":"Màu sắc",
										   "values":[
												{
												"id":"b4aca97983db90a346429bacf1a6b816",
												"property_value_id":"1270375",
												"value":"Màu đen",
												"type":"0",
												"type_value":null
												},
												{
												"id":"b4aca97983db90a346429bacf1a6b816",
												"property_value_id":"1270376",
												"value":"Màu hồng",
												"type":"0",
												"type_value":null
												}
											]
										},
										{
											"id":"ae8ab37856a6fed9400b1257d6f2da4b",
											"name":"Size ",
											"values":[
											{
												"id":"ae8ab37856a6fed9400b1257d6f2da4b",
												"property_value_id":"1270377",
												"value":"Freesize",
												"type":"0",
												"type_value":null
											}
											]
										}
									],
									priceRanges:[
										{
											"quantity":1,
											"price":145000
										}
									],
									skus: [
										{
											"id":1292783,
											"name":"Màu đen&gt;Freesize",
											"price":0,
											"quantity":500,
											"quantity_min":0,
											"quantity_max":0,
											"selected":0,
											"properties":[
													{
													"id":"b4aca97983db90a346429bacf1a6b816",
													"value_id":1270375
													},
													{
													"id":"ae8ab37856a6fed9400b1257d6f2da4b",
													"value_id":1270377
													}
												]
										},
										{
											"id":1292784,
											"name":"Màu hồng&gt;Freesize",
											"price":0,
											"quantity":500,
											"quantity_min":0,
											"quantity_max":0,
											"selected":0,
											"properties":[
												{
													"id":"b4aca97983db90a346429bacf1a6b816",
													"value_id":1270376
												},
												{
													"id":"ae8ab37856a6fed9400b1257d6f2da4b",
													"value_id":1270377}
												]
										}
									]
								}
						)
					 });
				  </script>
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
                        <input type="hidden" name="name" value="<?php echo $product['title']; ?>">
                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                        <input type="hidden" name="link" value="<?php echo $product['link']; ?>">
                        <input type="hidden" name="price" value="<?php echo number_format($product['vn_price']); ?>">
                        <input type="hidden" name="title" value="<?php echo $product['title']; ?>">
                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                        <input type="hidden" name="link" value="<?php echo $product['link']; ?>">
                        <input type="hidden" name="price" value="<?php echo $product['vn_price']; ?>">
                        <input type="hidden" name="sid" value="<?php echo $product['sid']; ?>">
                        <input type="hidden" name="qty" class="total_qty" value="">
                        <input type="submit" class="hz-btn hz-btn-red hz-btn-block hz-btn-uppercase hz-btn-bold btn-add-cart" value="Thêm vào giỏ hàng" />                            
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- END Form đặt mua -->
         <div class="product-content-big clearfix">
            <div class="product-content-left">
               
               <div class="widget-shop-product">
                  <div class="wpc-panel wpc-panel-default">
                     <div class="wpc-panel-heading-vs2">
                        <div class="title">Sản phẩm cùng Shop</div>
                     </div>
                     <div class="wpc-panel-body">
                        <?php foreach($same_shop_products as $same_shop_product){ ?>
                        <div class="product-list-vertical">
                           <a target="_blank" href="<?php echo site_url('product/detail/'.$same_shop_product['slug']); ?>" title=" ">
                           <span class="responsive-img">
                           <img class="media-object lazy"
                              src="<?php echo $same_shop_product['image']; ?>"
                              alt="<?php echo $same_shop_product['title']; ?>" />
                           </span>
                           </a>
                           <div class="media-body m-product-info">
                              <strong class="price"> <?php echo number_format($same_shop_product['vn_price']);?> đ </strong>
                              <a class="capital" href="<?php echo site_url('product/detail').'/'.$same_shop_product['slug'];?>" title="#" target="_blank"><?php echo $same_shop_product['title']; ?></a>        
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                     <a class="btn btn-danger btn-shop-product-view-all" href="<?php echo site_url('shop/detail/'.$shop['slug']);?>" target="_blank">Xem tất cả</a>        
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
                              <img src="<?php echo $product['image']; ?>" />
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
                  <a class="url-shop" href="<?php echo site_url('shop/view/'.$shop['slug']);?>" target="_blank"><?php echo $shop['name'];?></a>                 
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
                     <span>Đang bán: </span> <?php echo $product['shop_product_total'];?> mặt hàng
                  </div>
                  <div class="desc">
                     <span>Loại hình:</span> Cửa hàng bán lẻ                
                  </div>
                  <div class="desc">
                     <span>Địa chỉ:</span> <?php echo $shop['address'];?>                
                  </div>
                  <div class="desc">
                     <span>Mở shop:</span> 10-04-2016      
                     <span>Loại hình:</span> Cửa hàng bán lẻ                
                  </div>
               </div>
               <div class="contact-shop text-center">
                  <a class="btn btn-default" href="#" target="_blank"><i class="glyphicon glyphicon-envelope"></i> Liên hệ với chúng tôi</a>            
               </div>
               <div class="btn-shop">
                  <a class="btn btn-warning" href="<?php echo site_url('shop/view/'.$shop['slug']);?>" target="_blank">Xem shop</a> 
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
                  <?php foreach($newProducts as $newProduct){ ?>
                  <div class="product-list-vertical">
                     <a target="_blank" href="<?php echo site_url('product').'/detail/'.$newProduct['slug'];?>" title="">
                     <span class="responsive-img">
                     <img class="media-object lazy"
                        src="<?php echo $newProduct['image']; ?>"
                        alt='Áo thun nam tay ngắn thời trang, họa tiết nổi bật'/>
                     </span>
                     </a>
                     <div class="media-body m-product-info">
                        <strong class="price">
                        35.000 đ            </strong>
                        <a class="capital" href="<?php echo site_url('product').'/detail/'.$newProduct['slug'];?>" title="" target="_blank"><?php echo $newProduct['title'];?></a>        
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>