<div class="container p-full">
	  <div class="container-profile">
		<nav class="navbar navbar-default profile-menu-top">
		  <div class="row">
			<div class="col-md-12">
			  <ul class="nav navbar-nav">
				<li class=" default "><a href="#">Quản lý tài khoản</a></li>
				<li class=" active "><a href="#">Quản lý mua hàng</a></li>
				<li class=" default "><a href="#">Tài khoản trả trước</a></li>
			
			  </ul>
			</div>
		  </div>
		</nav>
		<div class="profile clearfix">
		  <div class="col-xs-3">
			<ul class="profile-menu-left">
			  <li class="user"><i class="glyphicon glyphicon-user"></i>Xin chào,<br><?php $currentCustomer=vst_getCurrentCustomer(); echo $currentCustomer['username'];?> </li>
			  <li class="active"><a href="list.html">Danh sách đơn hàng</a></li>
			  <li ><a href="list.html">Danh sách khiếu nại</a></li>
			  <li ><a href="list.html">Danh sách hoàn tiền</a></li>
			  <li><a href="<?php echo site_url('customer/logout'); ?>" data-method="post">Thoát</a></li>
			</ul>
		  </div>
		  <div class="col-xs-9 profile-content">
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
					Sau 7 ngày kể từ khi thanh toán, nếu quý khách chưa nhận được hàng hãy liên hệ với Luuthong.vn để được hỗ trợ: 04.7303 1999
				  </div>
				  
				  <div id="w1" class="list-view-orders list-view">
					<div class="item-view" data-key="1004979">
					<?php foreach($list_order as $key => $row){ ?>
					  <div class="order-item">
						<div class="order-item-header item-header">
						  ĐH: <a href="<?php echo site_url('order/detail').'/'.$key;?>"><span class="order-id"><?php echo $row['invoiceid'];?></span></a> <span class="order-time-created"><?php echo $row['create_date'];?></span>
						  Gian hàng: <a class="shop-name" href="<?php echo $row['seller_link'];?>" target="_blank"><?php echo $row['seller_name'];?></a>                    
						  <div class="pull-right"><?php echo order_status($row['status']);?></div>
						</div>
						<div class="order-item-middle item-middle">
						  <table class="order-detail full-width">
							<thead>
							  <tr class="bg-order-item">
								<th class="text-center" style="width: 8%;">STT</th>
								<th class="text-center" style="width: 15%;">Sản phẩm</th>
								<th class="text-center" style="width: 15%;">Giá</th>
								<th class="text-center" style="width: 5%;">Số lượng</th>
								<th class="text-center" style="width: 15%;">Thành tiền</th>
							  </tr>
							</thead>
							<tbody>
							<?php $total_price= 0; 
								foreach($row['data'] as $row_data){ ?>
							  <tr class="">
								<td class="order-detail-image">
								  <!-- image -->
								  <a class="thumbs-product-image responsive-img" href="<?php echo $row_data['item_link'];?>" target="_blank">
									<img src="<?php echo $row_data['item_image'];?>" alt="">
								  </a>                            
								</td>
								<td class="oder-detail-product-info">
								  <a class="product-name" href="#" target="_blank"><?php echo $row_data['item_title'];?></a>                                                                                
								  <p style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;">
									<label>Size</label>:&nbsp;<label>--unknown--</label>
								  </p>
								  <p style="margin-top: 5px; margin-bottom: 5px; font-weight: bold;">
									<label>Màu sắc</label>&nbsp;:<label>--unknown--</label>
								  </p>
								</td>
								<td class="order-detail-price text-price text-bold">
								  <span><?php echo number_format($row_data['item_price']);?>đ</span>
								</td>
								<td class="order-detail-quantity">
								  <span><?php echo $row_data['item_quantity'];?></span>
								</td>
								<td class="order-detail-total text-price">
								  <span><?php echo number_format($row_data['item_price']*$row_data['item_quantity']);?>đ</span>
								</td>
							  </tr>
							<?php $total_price+=($row_data['item_price']*$row_data['item_quantity']); 
								} ?>
							</tbody>
						  </table>
						</div>
						<div class="order-item-footer clearfix">
						  <ul class="pull-right">
							<li class="label-title">Tiền hàng:</li>
							<li class="value">
							  <span
								class="total-money text-bold text-price"><?php echo number_format($total_price);?>đ</span>
							</li>
							<li class="label-title">Phí vận chuyển:</li>
							<li class="value">
							  <span
								class="total-transporting">--unknown--</span>
							</li>
							<li class="label-title">Thành tiền:</li>
							<li class="value">
							  <span
								class="final-money text-bold text-price">--unknown--</span>
							</li>
						  </ul>
						</div>
						<div class="text-right button-checkout">
						  <a class="btn btn-danger" href="#" style="margin-right: 5px;">Hủy đơn hàng</a>
						  <a class="btn btn-primary" href="/my-order/payment?id=1004979" data-method="post">Thanh toán đơn hàng</a>                                            
						</div>
					  </div>
					<?php } ?>
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
		  </div>
		</div>
	  </div>
	</div>