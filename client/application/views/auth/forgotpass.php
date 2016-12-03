<div class="container p-full">
<div class="row">
  <div class="col-xs-1"></div>
  <div class="col-xs-10">
    <!-- BEGIN: .steps -->
    <!-- END: .steps -->
    <h2 class="text-center page-title text-success"><i class="glyphicon glyphicon-edit"></i> Gửi yêu cầu lấy lại mật khẩu</h2>
	 <?php $this->load->view('_base/message'); ?>
    <div class="content_signup">
      <div class="site-signup">
        <form id="form-request-password-reset" action="<?php echo site_url('auth/forgotpass'); ?>" method="post" role="form">
      
          <div class="sign-up-form-control field-requestpasswordresetform-username required">
            <div class="row">
              <div class="col-xs-12 text-center"><label class="control-label" for="username">Vui lòng nhâp tên đăng nhập, email hoặc số điện thoại</label></div>
              <br>
			  <div class="col-xs-4"> </div>
			  <div class="col-xs-4"><input type="text" id="requestpasswordresetform-username" class="form-control" name="username"></div>
              <div class="col-xs-4">
                <p class="help-block help-block-error"></p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-5 col-xs-offset-4">
              <input type="submit" class="btn btn-red" name="submit" value="Tiếp tục" />        
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-xs-1"></div>
</div>
</div>