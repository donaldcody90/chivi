<div class="container p-full">
	  <div class="container-profile">
		<div class="profile clearfix">
		  <div class="col-xs-3">
				 <ul class="profile-menu-left nav nav-tabs horizontal-tab">
					<li class="user"><i class="glyphicon glyphicon-user"></i>Xin chào,<br><?php $currentCustomer=vst_getCurrentCustomer(); echo $currentCustomer['username'];?></li>
					<li ><a href="<?php echo site_url('customer/profile'); ?>"> Thông tin tài khoản</a></li>
					<li ><a  href="<?php echo site_url('customer/changepass'); ?>" >Đổi mật khẩu</a></li>
					<li class="active"><a href="<?php echo site_url('order/lists'); ?>">Danh sách đơn hàng</a></li>
					<li ><a href="<?php echo site_url('customer/logout');?>">Thoát</a></li>
				  </ul>
		  </div>
		  <div class="col-xs-9 profile-content">
			<div class="profile-title">Danh sách đơn đặt hàng</div>
			<div>
			  <div class="my-account-orders">
				<div>
				  <div class="clearfix">
					<div class="box-search-order">
					  <form id="w0" class="order-search" action="<?php echo site_url('order/lists');?>" method="get">
						<div class="clearfix">
						  <?php
							$filter_invoiceid = $this->input->get('filter_invoiceid');
							$filter_status = $this->input->get('filter_status');
							$startdate = $this->input->get('filter_startdate_create_date');
							$enddate = $this->input->get('filter_enddate_create_date');
						  ?>	
						  <div class="form-group field-searchorderform-order_id">
							<label class="control-label" for="searchorderform-order_id">Mã đơn hàng</label>
							<input type="text" value="<?php echo isset($filter_invoiceid )?$filter_invoiceid:''; ?>" id="searchorderform-order_id" class="form-control" name="filter_invoiceid" maxlength="99" placeholder="Mã đơn hàng">
							<div class="help-block"></div>
						  </div>
						  <div class="form-group field-searchorderform-order_status">
							<label class="control-label" for="searchorderform-order_status">Trạng thái</label>
							
							<select id="searchorderform-order_status" class="form-control" name="filter_status" style="width: 200px;">
							<option value="">--Tất cả--</option>
							<?php $status = vst_array_status();
								
								foreach($status as $key_status => $text){
									
								if(isset($filter_status) && ($filter_status == $key_status)){ $select = 'selected'; }else $select ='';	
									
							?>  
							<option value="<?php echo $key_status ?>" <?php echo $select ?> ><?php echo $text; ?></option>
							
							<?php } ?>   
							</select>
							<div class="help-block"></div>
						  </div>
						  
						  <div class="form-group">
							<label class="control-label">Thời gian đặt hàng</label>
							<div class="filter-date">
							  <div class="form-group field-searchorderform-begin_date">
								<div><input type="text" id="datepicker_from"  class="form-control pickdate_from" value="<?php echo isset($startdate )?$startdate:''; ?>" name="filter_startdate_create_date" placeholder="Từ ngày"></div>
							  </div>
							  <div class="form-group field-searchorderform-end_date">
								<div><input type="text" id="datepicker_to" class="form-control pickdate_to" value="<?php echo isset($enddate )?$enddate:''; ?>"  name="filter_enddate_create_date" placeholder="đến ngày"></div>
							  </div>	
							</div>
						  </div>
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
								<th class="text-center" style="width: 30%;">Mã đơn</th>
								<th class="text-center" style="width: 15%;">Ngày đặt</th>
								<th class="text-center" style="width: 5%;">Số SP</th>
								<th class="text-center" style="width: 15%;">Thành tiền</th>
								<th class="text-center" style="width: 10%;">Trạng thái</th>
								<th class="text-center" style="width: 10%;"></th>
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
									<?php echo order_status($order['status']);?>
								</td>
								<td class="order-detail-total text-price text-center">
								<?php if($order['status']!= (-1)){?>
									<div class="text-right button-checkout">
										<form name="upload_complain" action="" class="ajaxFormComplain item_complain_form_<?php echo $order['id']; ?>" method="POST" enctype="multipart/form-data">															
											<input type="hidden" name="oid" value="<?php echo $order['id']; ?>" />
											<input type="hidden" name="controller" value="order" />
											<input type="hidden" name="task" value="updateOrderStatus" />
											<input type="hidden" name="status" value="-1" />
											<input type="hidden" name="is_reload" value="1" />
											<a target="_blank" class=" "  onClick="submitAjax1(this)" title="Hủy đơn hàng">Hủy đơn</a>
											
										</form>
								<?php } ?>
										<a class="btn btn-primary" href="<?php echo site_url(''.$order['invoiceid'].'-o'.$order['id']);?>" data-method="post">Chi tiết </a>                                            
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
		  </div>
		</div>
	  </div>
	</div>