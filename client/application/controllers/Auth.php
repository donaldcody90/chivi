<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("customers_model");
	}

	public function index(){
		if(is_logged_in()){
			redirect(site_url('customer'));
		}else{
			redirect(site_url('auth/login'));
		}
		$data['template'] = 'auth/login';
		$this->load->view('layout/home', $data);
	}
	
	public function login()
	{
		if(is_logged_in()){
			redirect(site_url('customer'));
		}else{
		
		if($this->input->post('login')){
			$param_where = array(
					'username'=>trim( $this->input->post('username') ),
					'password'=>vst_password( $this->input->post('password') ),
				);
			
			$result = $this->customers_model->findCustomer($param_where);
			
			if( count($result)>0 ){
				unset($result['password']);
				$this->session->set_userdata('vkt_clientCustomer',$result);
				redirect(site_url('customer'));
				die();
			}else{
				message_flash('Tên đăng nhập hoặc mật khẩu không đúng. Xin vui lòng nhập lại','error');
				redirect(site_url('auth/login'));
			}
		}
		}
        $data['template'] = 'auth/login';
		$this->load->view('layout/home', $data);
	}
	
	public function register(){ 
	
		if(is_logged_in()){
			redirect(site_url('customer/profile'));
		}else{

		if ($this->input->post('save')){

			$this->form_validation->set_rules('username', 'Tên đăng nhập', 'trim|required|callback__username');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__email');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|is_natural');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[6]|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Nhập lại mật khẩu', 'trim');
			
			if ($this->form_validation->run()){
				$data = array(
					'username' => trim($this->input->post("username")),
					'fullname' => trim($this->input->post("fullname")),
					'phone'    => trim($this->input->post("phone")),
					'email'    => trim($this->input->post("email")),
					'password' => vst_password($this->input->post("password")),
					'create_date'	=> vst_currentDate($time=true,$formatDate="Y-m-d",$formatTime="H:i:s"),
				);
				 
				$result = $this->customers_model->insertCustomer($data);
				if($result >= 1){
					message_flash('Thêm tài khoản '.$this->input->post('username').' thành công');
				}
				redirect(site_url('customer/profile'));
			}
		}
		}
       	$data['template'] = 'auth/register';
		$this->load->view('layout/home', $data);
	}

	// Forgot password
	public function forgotpass121(){
		
		
		
		$data['template'] = 'auth/forgotpass';
		$this->load->view('layout/home', $data);
	}
	
	public function forgotpass()
	{
		if(is_logged_in()){
			redirect(site_url('customer/profile'));
		}else{

			if ($this->input->post('save')){
				$this->form_validation->set_rules('username', 'Username hoặc email ...', 'trim|required');
				
				if ($this->form_validation->run()){
					
					$username = trim($this->input->post("username"));
					$newPassword=$this->randomPassword();
					
					$data = array(
						'password' => vst_password($newPassword)
					);
					
					$param_where = array(
						'username' => $username
					);
					
					$user = $this->customers_model->findCustomer($param_where);
					if(!$user)
					{
						$param_where = array(
							'email' => $username
						);
						$user = $this->customers_model->findCustomer($param_where);
					}
					if(!$user)
					{
						$param_where = array(
							'phone' => $username
						);
						$user = $this->customers_model->findCustomer($param_where);
					}
					if(!$user)
					{
						message_flash('Xin lỗi, tài khoản bạn vừa nhập không tồn tại. Vui lòng thử lại!');	
					}else{
						// Cấp đặt lại mật khẩu
						$result = $this->customers_model->updateCustomer($data,$param_where);
						if($result){
							$is_sent=  $this->send_mail($user['email'],$user['fullname'],$user['username'],$newPassword);
							if(!$is_sent)
							{
								message_flash('Không thể gửi email, vui lòng liên hệ hỗ trợ');	
							}else{
								
								message_flash('Thông tin tài khoản đã được gửi qua email '.$user['email']);
							}
							
						}else{
							message_flash('Không thể cấp lại mật khẩu, vui lòng liên hệ hỗ trợ');	
						}
					}
						
				}
			}
		}
        $data['template'] = 'auth/forgotpass';
		$this->load->view('layout/home', $data);
	}

	public function send_mail($CustomerEmail,$CustomerName,$UserName,$NewPassword) { 

		require_once APPPATH.'third_party/PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;                              // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->CharSet = 'UTF-8';
		$mail->Host = 'smtp.zoho.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'quantri.chivi@gmail.com';                 // SMTP username
		$mail->Password = 'kenhmuabanchivi';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
							
		$mail->setFrom('admin@hangquangchau.com.vn', 'Hàng Quảng Châu');
		$mail->addAddress($CustomerEmail,$CustomerName);     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Khôi phục tài khoản';
		$mail->Body    = '<p>Hi, <b>'.$CustomerName."</b></p>";
		$mail->Body    .= '<p>Tài khoản : <b>'.$UserName."</b></p>";
		$mail->Body    .= '<p>Mật khẩu : <b>'.$NewPassword."</b></p>";
		$mail->Body    .= '<p>Nhấn vào đây để đăng nhập vào hệ thống : <a target="_blank" href="//chivi.vn/auth/login">Đăng nhập</a></p>';
		//echo "<pre>";
		if(!$mail->send()) {
			//echo 'Message could not be sent.';
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		} else {
			return true;
		}
    } 
	
	
	
	
	
	
	
	// Callback email
	public function _email($email = ''){
		$count = $this->customers_model->findCustomer(array('email'=>$email));
		if($count >= 1){
			$this->form_validation->set_message('_email', 'Email '.$email.' đã tồn tại');
			return FALSE;
		}
		return TRUE;
	}

	// Callback username
	public function _username($username = ''){
		$count = $this->customers_model->findCustomer(array('username'=>$username));
		if($count >= 1){
			$this->form_validation->set_message('_username', 'Tên đăng nhập '.$username.' đã tồn tại');
			return FALSE;
		}
		return TRUE;
	}

}
