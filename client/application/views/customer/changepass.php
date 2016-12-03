<div class="container p-full">
	  <div class="container-profile">
		<div class="profile clearfix">
		  <div class="col-xs-3 profile_left">
				 <ul class="profile-menu-left nav nav-tabs horizontal-tab">
					<li class="user"><i class="glyphicon glyphicon-user"></i>Xin chào,<br><?php $currentCustomer=vst_getCurrentCustomer(); echo $currentCustomer['username'];?></li>
					<li ><a href="<?php echo site_url('customer/profile'); ?>"> Thông tin tài khoản</a></li>
					<li class="active"><a  href="<?php echo site_url('customer/changepass'); ?>" >Đổi mật khẩu</a></li>
					<li ><a href="<?php echo site_url('order/lists'); ?>">Danh sách đơn hàng</a></li>
					<li ><a href="<?php echo site_url('customer/logout');?>">Thoát</a></li>
				  </ul>
		  </div>
		  <div class="col-xs-9 profile-content profile_right">
			<div class="profile-title">Đổi mật khẩu</div>
				<div>
				  <div class="site-signup">
					<div class="row">
					  <div class="col-xs-12 profile-form">
						<?php
						  $error = validation_errors();
						  if(isset($error) && !empty($error)){ 
						  ?>
						<div class="alert dismissable alert-error">
						  <?php echo $error; ?>
						</div>
						<?php 
						  }
						  
						  ?>
						<?php $this->load->view('_base/message'); ?>
						
						<form id="form-change-password" action="<?php echo site_url('customer/changepass');?>" method="post" role="form">
						  <div class="form-group field-changepasswordform-currentpassword required">
							<label class="control-label" for="currentpassword">Mật khẩu hiện tại</label>
							<input type="password" id="currentpassword" class="form-control" name="currentpassword" value="">
						  </div>
						  <div class="form-group field-changepasswordform-newpassword required">
							<label class="control-label" for="newpassword">Mật khẩu mới</label>
							<input type="password" id="newpassword" class="form-control" name="newpassword">
						  </div>
						  <div class="form-group field-changepasswordform-newpasswordconfirmation required">
							<label class="control-label" for="passconfirm">Xác nhận mật khẩu</label>
							<input type="password" id="passconfirm" class="form-control" name="passconfirm">
						  </div>
						  <div class="form-group">
							<label class="control-label"></label>
							<input type="submit" class="btn btn-primary" name="updatepass" value="Đổi mật khẩu" />            
						  </div>
						</form>
					  </div>
					</div>
				  </div>
				</div>


		</div>
	  </div>
	</div>