<div class="container p-full">
  <div class="shopping-cart-index">
    <div class="row">
      <div class="col-md-1 col-lg-1 col-sm-1"></div>
      <div class="cart-content">
        <div class="alert alert-success"><strong>Lưu ý: </strong>
          Người bán cam kết và sẽ chịu trách nhiệm về chất lượng sản phẩm.
        </div>
        <div class="product-shop-cart">
          <h3 style="font-weight: bold">Giỏ hàng của bạn</h3>
          <h4>(<?php echo count($array_product); ?> sản phẩm)</h4>
        </div>
        <div class="boder-shop-cart">
		  <?php $this->load->view('_base/message'); ?>
		  <form id="frm-checkout" action="<?php echo site_url('cart/checkout');?>" method="post">
          <table class="table table-shopping-cart" id="item-shop-cart-1001907" data-shop-id="1001907">
            <thead>
              <tr class="bg-warning">
                <th><input type="checkbox" class="cart_check_all" value="all"></th>
                <th>Thông tin sản phẩm</th>
                <th style="width: 22%;" class="">Giá bán</th>
                <th style="width: 20%;" class="">Số lượng</th>
                <th style="width: 10%;" class=""></th>
              </tr>
            </thead>
			
            <tbody>
			<?php foreach($array_product as $key=>$value){ ?>
			  <tr class="tr_seller">
				<td colspan="5">
					<span>Người Bán:</span>
					<?php echo $value['shop_name']; ?>
				</td>
			  </tr>
			  <?php foreach($value['items'] as $k=>$v){?>
			  
              <tr class="sku-items">
				<td>
					<input class="product_checkbox" type="checkbox" class="check_box" name="checkbox[]" value="<?php echo $value['sid'].'{:::}'.$v['id'];?>">
				</td>
                <td>
                  <div class="media">
                    <div class="media-left">
                      <div class="cart-product-img">
                        <a href="<?php echo $v['link']; ?>" class="responsive-img"
                          target="_blank">
                        <img src="<?php echo $v['image']; ?>" width="100" height="100" alt="">
						</a>
                      </div>
                    </div>
                    <div class="media-body">
                      <strong class="media-heading clearfix">
                      <a href="<?php echo $v['link']; ?>" target="_blank"><?php echo $v['title']; ?></a>
					  </strong>
                      <div class="p-info clearfix">
                        <div class="property-list">
                          <div class="f">
                            <span class="pfl">màu sắc:</span>
                            <strong
                              class="pfv">đen</strong>
                          </div>
                          <div class="f">
                            <span class="pfl">size:</span>
                            <strong
                              class="pfv">35</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
				  <div class="losers">
                    <input type="text" class="form-losers" placeholder="Nhập mã giảm giá">
                    <button type="button" class="btn btn-danger btn-losers">Xác nhận</button>
                    <div class="text-losers">
                      <p style="color: #00aa00">MÃ GIÁM GIÁ ĐƯỢC ÁP DỤNG.</p>
                      Giảm: <samp style="color: #C40000;font-weight: bold">-10.000đ</samp>
                    </div>
                  </div>
                </td>
                <td class="sku-price">
                  <div class="price-range p-info price-range-select-1055999">
                    <div class="f">
                      <span class="pfv">
						<?php echo number_format($v['price']); ?>đ
                      </span>
                    </div>
                  </div>
                </td>
                <td >
					<span class="ui-spinner ui-widget ui-widget-content ui-corner-all" style="height: 28px;">
						<input type="text" name="quantity" class="num-range ui-spinner-input txtQuantity" value="<?php echo $v['qty']?>">
						<a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only btnIncrease" role="button">
							<span class="ui-button-text">
								<span class="ui-icon ui-icon-triangle-1-n">+</span>
							</span>
						</a>
						<a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only btnDecrease" role="button">
							<span class="ui-button-text">
								<span class="ui-icon ui-icon-triangle-1-s">-</span>
							</span>
						</a>
					</span>
                </td>
                <td class="text-right">
                  <a class="cart-remove btn-remove" href="<?php echo site_url('cart/removeProduct').'/'.$v['id'];?>">Xóa sản phẩm</a>                    
                </td>
              </tr>
			  <?php } ?>
			<?php } ?>
            </tbody>
			
            <tfoot>
              <tr>
                <td colspan="3">
					<a class="cart-remove btn-remove" href="<?php echo site_url('cart/removeProduct'); ?>">
						<i class="glyphicon glyphicon-remove"></i> Xóa tất cả
					</a>                
					<a class="btn-summary" href="#" target="_blank">
						<i class="glyphicon glyphicon-folder-close"></i> Chọn thêm sản phẩm khác
					</a>                                
                  <div class="protection pull-right">
                    <div class="hz-icon icon-protection protection-img">
                    </div>
                    <div class="protection-text">
                      <p style="font-size: 25px;font-weight: bold; color: #558b2f">Bảo hộ người  mua</p>
                      <p><i class="glyphicon glyphicon-check"></i> Hoàn tiền nếu không nhận được hàng hoặc thiếu hàng</p>
                      <p><i class="glyphicon glyphicon-check"></i> Bồi thường nếu sản phẩm không đúng theo mô tả</p>
                      <p><i class="glyphicon glyphicon-check"></i> Trả lại hàng khi sản phẩm không đúng theo mô tả</p>
                    </div>
                  </div>
                </td>
                <td colspan="2" class="text-right">
                  <div class="shopping-total">
                    <div class="shopping-total-cart">
                      <div class="order-amount" style="background: none;">
                        <ul>
                          <li class="text-plain ">Giảm:</li>
                          <li class="value"><span class="final-total-price">đ</span></li>
                          <li class="text-plain ">Phí vận chuyển:</li>
                          <li class="value"><span class="final-total-transport">0</li>
                          <li class="text-plain ">Tổng tiền:</li>
                          <li class="value"><span class="price"><?php echo $bill_total;?></span><span class="price">đ</span></li>
                        </ul>
                      </div>
                    </div>
					
                    <div class="shopping-button-right">
                      <button type="button" class="btn-update-cart btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Cập nhật giỏ hàng</button>                                                    
					  <input type="submit" name="confirm_order" class="btn btn-danger btn-update" value=" Đặt hàng">                                          
                    </div>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>