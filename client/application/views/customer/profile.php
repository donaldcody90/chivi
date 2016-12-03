

<div class="container p-full">
	  <div class="container-profile">
		<div class="profile clearfix">
		  <div class="col-xs-3 profile_left">
				 <ul class="profile-menu-left nav nav-tabs horizontal-tab">
					<li class="user"><i class="glyphicon glyphicon-user"></i>Xin chào,<br><?php $currentCustomer=vst_getCurrentCustomer(); echo $currentCustomer['username'];?></li>
					<li class="active"><a href="<?php echo site_url('customer/profile'); ?>"> Thông tin tài khoản</a></li>
					<li ><a  href="<?php echo site_url('customer/changepass'); ?>" >Đổi mật khẩu</a></li>
					<li ><a href="<?php echo site_url('order/lists'); ?>">Danh sách đơn hàng</a></li>
					<li ><a href="<?php echo site_url('customer/logout');?>">Thoát</a></li>
				  </ul>
		  </div>
		  <div class="col-xs-9 profile-content profile_right">
		  <?php $this->load->view('_base/message'); ?>
		  <?php if($edit && ($edit == "false")){ ?>
			<div class="profile-title">Thông tin tài khoản</div>
				<div>
				  <table id="w0" class="table table-striped table-bordered detail-view">
					<tr>
					  <th>Tên đăng nhập</th>
					  <td><?php echo $customer['username']?></td>
					</tr>
					<tr>
					  <th>Tên đầy đủ</th>
					  <td><?php echo $customer['fullname']?></td>
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
					  <th>Địa chỉ</th>
					  <td><?php echo $customer['address']?></td>
					</tr>
					<tr>
					  <th>Ngày đăng ký</th>
					  <td><?php echo $customer['create_date']?></td>
					</tr>
				  </table>
				  </br>
				   <a class="btn btn-primary" href="<?php  echo site_url('customer/editProfile');?>">Sửa thông tin</a>
				</div>
			</div>	
			<?php }else{ ?>
			<div class="profile-title">Sửa thông tin tài khoản</div>
				<form action="<?php echo site_url('customer/editProfile'); ?>" method="post">
				  <table id="w0" class="table table-striped table-bordered detail-view">
					<tr>
					  <th>Tên đăng nhập</th>
					  <td>
						<?php echo $customer['username']; ?>
					  </td>
					</tr>
					<tr>
					  <th>Tên đầy đủ</th>
					  <td>
						<input type="text" name="fullname" value="<?php echo $customer['fullname']; ?>"   >
					  </td>
					</tr>
					<tr>
					  <th>Email</th>
					  <td>
						<input type="text" name="email" value="<?php echo $customer['email']; ?>"   >
					  </td>
					</tr>
					<tr>
					  <th>Số điện thoại</th>
					  <td><input type="text" name="phone" value="<?php echo $customer['phone']; ?>"   ></td>
					</tr>
					<tr>
					  <th>Địa chỉ</th>
					  <td>
						<textarea cols="50" name="address" rows="2"><?php echo $customer['address']; ?></textarea>
					  </td>
					</tr>
					<tr>
					  <th>Ngày đăng ký</th>
					  <td><?php echo $customer['create_date']?></td>
					</tr>
				  </table>
				  </br>
				   <input class="btn btn-primary" type="submit" name="save" value="Lưu thay đổi"> 
				</form>
			</div>

			<?php }?>	
			

		</div>
	  </div>
	</div>