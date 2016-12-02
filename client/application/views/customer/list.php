<div class="profile-title">Danh sách đơn đặt hàng</div>
<div>
  <div class="my-account-orders">
    <div>
      <div class="clearfix">
        <div class="box-search-order">
          <form id="w0" class="order-search" action="/my-order/index" method="get">
            <div class="clearfix">
              <div class="form-group field-searchorderform-order_id">
                <label class="control-label" for="searchorderform-order_id">Mã đơn hàng</label>
                <input type="text" id="searchorderform-order_id" class="form-control" name="SearchOrderForm[order_id]" maxlength="99" placeholder="Mã đơn hàng">
                <div class="help-block"></div>
              </div>
              <div class="form-group field-searchorderform-order_status">
                <label class="control-label" for="searchorderform-order_status">Trạng thái</label>
                <select id="searchorderform-order_status" class="form-control" name="SearchOrderForm[order_status]">
                  <option value="">--Tất cả--</option>
                  <option value="1">Chờ thanh toán</option>
                  <option value="2">Đã thanh toán</option>
                  <option value="3">Người mua hủy</option>
                  <option value="4">Hệ thống hủy</option>
                </select>
                <div class="help-block"></div>
              </div>
              <div class="form-group field-searchorderform-order_type">
                <label class="control-label" for="searchorderform-order_type">Loại thanh toán</label>
                <select id="searchorderform-order_type" class="form-control" name="SearchOrderForm[order_type]">
                  <option value="0">Thanh toán ngay</option>
                  <option value="1">Thanh toán khi nhận hàng</option>
                  <option value="" selected>Tất cả</option>
                </select>
                <div class="help-block"></div>
              </div>
              <div class="form-group">
                <label class="control-label">Thời gian đặt hàng</label>
                <div class="filter-date">
                  <div class="form-group field-searchorderform-begin_date">
                    <div><input type="text" id="searchorderform-begin_date" class="form-control" name="SearchOrderForm[begin_date]" placeholder="Từ ngày"></div>
                  </div>
                  <div class="form-group field-searchorderform-end_date">
                    <div><input type="text" id="searchorderform-end_date" class="form-control" name="SearchOrderForm[end_date]" placeholder="đến ngày"></div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <input type="hidden" name="SearchOrderForm[show_order_drop]" value="0"><input type="checkbox" id="searchorderform-show_order_drop" name="SearchOrderForm[show_order_drop]" value="1" style="height: auto;">
              <label for="searchorderform-show_order_drop" style="margin-left: 10px; cursor: pointer;">Đơn hàng đã hủy</label>
            </div>
            <button type="submit" class="btn btn-primary searching">Lọc đơn hàng</button>                    
          </form>
        </div>
      </div>
      <div class="alert alert-info">
        Sau 7 ngày kể từ khi thanh toán, nếu quý khách chưa nhận được hàng hãy liên hệ với Chivi.vn để được hỗ trợ: 0972.964.468
      </div>
      <div id="w1" class="list-view-orders list-view">
        <div class="item-view" data-key="1004979">
          <div class="order-item">
            <div class="order-item-middle item-middle">
              <table class="order-detail full-width">
                <thead>
                  <tr class="bg-order-item">
                    <th class="text-center" style="width: 8%;">STT</th>
                    <th class="text-center" style="width: 15%;">Mã đơn</th>
                    <th class="text-center" style="width: 15%;">Ngày đặt</th>
                    <th class="text-center" style="width: 5%;">Số SP</th>
                    <th class="text-center" style="width: 15%;">Thành tiền</th>
                    <th class="text-center" style="width: 15%;"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($list_orders){
                    $stt = 1;
                    foreach($list_orders['lists'] as $key=>$order){
                    
                    ?> 
                  <tr class="">
                    <td class="order-detail-image">
                      <?php echo $stt;?>                         
                    </td>
                    <td class="oder-detail-product-info">
                      <?php echo $order['invoiceid'];?>
                    </td>
                    <td class="order-detail-price text-price text-bold">
                      <?php echo $order['create_date'];?>
                    </td>
                    <td class="order-detail-quantity">
                      <?php echo $order['total_item'];?>
                    </td>
                    <td class="order-detail-total text-price">
                      <?php echo $order['total_amount'];?>
                    </td>
                    <td class="order-detail-total text-price">
                      <div class="text-right button-checkout">
                        <a class=" " href="#" >Hủy đơn</a><br/>
                        <a class=" " href="<?php echo site_url(''.$order['invoiceid'].'-o'.$order['id']);?>" data-method="post">Chi tiết</a> 
                        <a data-toggle="tab" href="#detail" onclick="loadAjax('<?php echo site_url(''.$order['invoiceid'].'-o'.$order['id']);?>','detail')">chi tiết</a>		
                      </div>
                    </td>
                  </tr>
                  <?php 
                    $stt++;
                    }
                    }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document" style="width: 400px;">
      <div class="modal-content">
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>