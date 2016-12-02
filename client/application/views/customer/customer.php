	<div class="container p-full">
        <div class="container-profile">
		<!-- Start Tab Content -->
          <div class="navbar navbar-default profile-menu-top">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <li><a data-toggle="tab" href="#acc">Quản lý tài khoản</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="profile clearfix">
            <div id="#acc" class="tab-pane active"> 
				<div class="col-xs-3">
				 <ul class="profile-menu-left nav nav-tabs horizontal-tab">
					<li class="user"><i class="glyphicon glyphicon-user"></i>Xin chào,<br><?php $currentCustomer=vst_getCurrentCustomer(); echo $currentCustomer['username'];?></li>
					<li class="active"><a data-toggle="tab" href="#profile" onclick="loadAjax('<?php echo site_url('customer/profile'); ?>','profile')" >Thông tin tài khoản</a></li>
					<li ><a data-toggle="tab" href="#changepass" onclick="loadAjax('<?php echo site_url('customer/changepass'); ?>','changepass')">Đổi mật khẩu</a></li>
					<li ><a data-toggle="tab" href="#list" onclick="loadAjax('<?php echo site_url('order/lists'); ?>','list')">Danh sách đơn hàng</a></li>
					<li ><a href="<?php echo site_url('customer/logout');?>">Thoát</a></li>
				  </ul>
				</div>
				<div class="col-xs-9 profile-content" id="customer">
				  <div id="profile"  class="tab-pane active customer_div">
				  </div>
				</div>
			</div>
		 </div>
	   </div>
    </div>