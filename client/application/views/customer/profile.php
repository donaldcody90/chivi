

<div class="container p-full">
	  <div class="container-profile">
		<div class="profile clearfix">
		  <div class="col-xs-3">
				 <ul class="profile-menu-left nav nav-tabs horizontal-tab">
					<li class="user"><i class="glyphicon glyphicon-user"></i>Xin chào,<br><?php $currentCustomer=vst_getCurrentCustomer(); echo $currentCustomer['username'];?></li>
					<li class="active"><a href="<?php echo site_url('customer/profile'); ?>"> Thông tin tài khoản</a></li>
					<li ><a  href="<?php echo site_url('customer/changepass'); ?>" >Đổi mật khẩu</a></li>
					<li ><a href="<?php echo site_url('order/lists'); ?>">Danh sách đơn hàng</a></li>
					<li ><a href="<?php echo site_url('customer/logout');?>">Thoát</a></li>
				  </ul>
		  </div>
		  <div class="col-xs-9 profile-content">
			<div class="profile-title">Thông tin tài khoản</div>
				<div>
				  <table id="w0" class="table table-striped table-bordered detail-view">
					<tr>
					  <th>Tên đăng nhập</th>
					  <td><?php echo $customer['username']?></td>
					</tr>
					<tr>
					  <th>Email</th>
					  <td><?php echo $customer['email']?></td>
					</tr>
					<tr>
					  <th>Số điện thoại</th>
					  <td><?php echo $customer['phone']?></td>
					</tr>
					<tr>
					  <th>Ngày đăng ký</th>
					  <td><?php echo $customer['create_date']?></td>
					</tr>
				  </table>
				   
				</div>
				</div>

		</div>
	  </div>
	</div>