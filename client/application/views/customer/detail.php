<?php if($order){
  $info_order = $order;	
  } 
  ?>
<div class="profile-title">Thông tin đơn hàng <?php if(!empty($info_order['invoiceid'])){ echo $info_order['invoiceid']; }?></div>
<div>
  <table class="table table-bordered table-striped no-margin" style="background-color: #fff; margin-bottom: 0;">
    <tbody>
      <tr>
        <td colspan="2"><strong>Thông tin người nhận</strong></td>
      </tr>
      <tr>
        <td style="width: 90px;">Người nhận:</td>
        <td><?php $customer =  $info_order['customer'];
          if($customer['fullname']) echo $customer['fullname'];
          ?></td>
      </tr>
      <tr>
        <td>Số di động:</td>
        <td><?php if($customer['phone']) echo $customer['phone']; ?></td>
      </tr>
      <tr>
        <td>Địa chỉ:</td>
        <td>
          <p>
            <?php if($customer['address']) echo $customer['address']; ?>               
          </p>
        </td>
      </tr>
      <tr>
        <td>Ghi chú:</td>
        <td> </td>
      </tr>
    </tbody>
  </table>
  <div class="my-account-orders">
    <div class="item-view">
      <div class="order-item">
        <div class="order-item-middle item-middle">
          <table class="order-detail full-width">
            <thead>
              <tr class="bg-order-item">
                <th colspan="2" class="text-center" style="width: 50%;">Thông tin sản phẩm
                </th>
                <th class="text-center" style="width: 20%;">Giá bán</th>
                <th class="text-center" style="width: 10%;">Số lượng</th>
                <th class="text-center" style="width: 20%;">Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if($info_order['shops'])
                foreach($info_order['shops'] as $key=>$shop){
                $shop_info = vst_getShop($shop['sid']);
                 
                ?>
              <tr>
                <td colspan="5">
                  <div class="order-item-header item-header clearfix ">
                    <span class="pull-left">
                    Shop: <a class="shop-name " href="<?php echo $shop_info['link'];?>" target="_blank"><?php echo $shop_info['name'];?></a> 
                    </span>	
                  </div>
                </td>
              </tr>
              <?php										
                if($shop['items']){
                	foreach($shop['items'] as $key_items=> $item) {
                ?>
              <tr class="">
                <td class="order-detail-image">
                  <!-- image -->
                  <a class="thumbs-product-image responsive-img" href="<?php  ?>" target="_blank">
                  <img src="<?php if($item['item_image']) echo $item['item_image']; ?>" alt=""></a>                                        
                </td>
                <td class="oder-detail-product-info">
                  <a class="product-name" href="<?php if($item['link']) echo $item['link']; ?>" target="_blank">
                  <?php if($item['title']) echo $item['title']; ?>
                  </a>
                  <?php if($item['item_attrs']) {$attrs = json_decode($item['item_attrs'],true); }?>
                  <?php
                    foreach($attrs['properties'] as $k2 => $attr){
                    	$property_title = vst_getProperty($attr['id']);
                    	$property_value = vst_getPropertyValue($attr['value_id']);
                    ?>
                  <p style="margin-top: 5px; margin-bottom: 5px; font-weight: normal;">
                    <label><?php echo $property_title['name'];?></label>&nbsp;:<label><?php echo $property_value['value'];?></label>
                  </p>
                  <?php		
                    }
                    ?>
                </td>
                <td class="order-detail-price text-price text-bold">
                  <span><?php if($item['item_price']) echo $item['item_price']; ?></span>
                </td>
                <td class="order-detail-quantity">
                  <span><?php if($item['item_quantity']) echo $item['item_quantity']; ?></span>
                </td>
                <td class="order-detail-total text-price">
                  <span><?php if($item['item_quantity'] && $item['item_price']) echo $item['item_quantity']*$item['item_price']; ?></span>
                </td>
              </tr>
              <?php		
                }
                }
                ?>
              <?php } ?>		
            </tbody>
          </table>
        </div>
        <div class="order-item-footer">
          <ul class="pull-right">
            <li class="label-title">Tiền hàng:</li>
            <li class="value"><span class="total-money text-bold text-price"><?php if($info_order['total_amount']) echo $info_order['total_amount']; ?></span>
            </li>
            <li class="label-title">Phí vận chuyển:</li>
            <li class="value"><span class="total-transporting">107.900đ</span>
            </li>
            <li class="label-title">Phí CoD:</li>
            <li class="value"><span class="total-transporting">0đ</span>
            </li>
            <li class="label-title">Thành tiền:</li>
            <li class="value">
              <span class="final-money text-bold text-price">607.900đ</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <div class=" order-item-footer clearfix" style="border-top:#ccc 1px solid;">
            <ul class="pull-right">
              <li class="label-title">Số dư ví:</li>
              <li class="value">
                <span class="final-money text-bold text-price">0đ</span>
              </li>
            </ul>
          </div>
          <div class="wallet-checkout clearfix" style="border-top:#c00 1px solid;padding-top:15px;">
            <form id="form-checkout" action="/my-order/view?id=1005791" method="post">
              <input type="hidden" name="_csrf" value="dzZhV1BDNnIwAS1kZghHExFiFjIgNHgaAmJVISIZTgU/YAc0BRlRMQ==">
              <p>
                Số dư ví của quý khách không đủ để thực hiện thanh toán. Quý khách vui
                lòng <a href="/wallet/my-account/recharge" target="_blank">nạp thêm tiền vào ví</a>.
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>