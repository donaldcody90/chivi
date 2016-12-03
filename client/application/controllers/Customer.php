<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("customers_model");
	}

	public function index(){
		redirect(site_url('customer/profile'));

	}
	
	// Profile Customer
	public function profile(){
		$customer = $this->session->userdata('vkt_clientCustomer');
		$data['customer'] = $this->customers_model->findCustomer(array('id'=>$customer['id']));
		$data['template'] = 'customer/profile';
		$data['edit'] = 'false';
	    $this->load->view('layout/home',$data );
 
	}
	public function editProfile(){
		$customer = vst_getCurrentCustomer();
		$customer = $this->customers_model->findCustomer(array('id'=>$customer['id']));
		
		if ($this->input->post('save')){
 
			$params_where = array('id'=>$customer['id']);
			
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__email');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|is_natural');
			 if ($this->form_validation->run()){					 
			 
				$data = array(
					 
					'fullname' => trim($this->input->post("fullname")),
					'phone'    => trim($this->input->post("phone")),
					'email'    => trim($this->input->post("email")),
					'address' =>  trim($this->input->post("address")),
				);
				 
				$result = $this->customers_model->updateCustomer($data,$params_where);
				
				if($result >= 1){
					message_flash('Lưu thành công');
					redirect(site_url('customer/profile'));
				} else{
					message_flash('Lưu không thành công. Vui lòng thử lại!');
				}
			 }
				
			 
		}
		$data['customer'] = $customer;
		$data['template'] = 'customer/profile';
		$data['edit'] = 'true';
	    $this->load->view('layout/home',$data );
		
	}
	
	
	// Change password
	
	public function changepass(){
		if (is_logged_in()) { 
			$customer = vst_getCurrentCustomer();
			$cusername  = $customer['username'];
		}
		$param_where = array('username'=>$cusername);
		if( $this->input->post('updatepass')){
			
			$this->form_validation->set_rules('currentpassword', 'Mật khẩu hiện tại', 'trim|required');
			$this->form_validation->set_rules('newpassword', 'Mật khẩu mới', 'trim|required|min_length[6]|matches[passconfirm]');
			$this->form_validation->set_rules('passconfirm', 'Nhập lại mật khẩu', 'trim');
			if ($this->form_validation->run()){
				
				$old_pass = vst_password($this->input->post('currentpassword'));
				$currentCustomer = $this->customers_model->findCustomer($param_where);
				if($old_pass == $currentCustomer['password']){
					$password  = vst_password($this->input->post('newpassword'));
					$data = array('password'=>$password);
					$result  =$this->customers_model->updateCustomer($data,$param_where);
					if($result >= 1){
					message_flash('Cập nhật mật khẩu thành công','success');
					}
					redirect(site_url('customer'));
				}else{
					message_flash('Mật khẩu hiện tại chưa đúng','errors');
					redirect(site_url('customer'));
				}
			}
		}
		$data['result']  = $this->customers_model->findCustomer($param_where);
        $data['template'] = 'customer/changepass';
		 $this->load->view('layout/home',$data);
		 
	}
	
	// Sổ địa chỉ
	public function address_book(){
		$data['template'] = 'customer/address_book';
		$content=$this->load->view('layout/ajax',$data,true);

		$res=array('Response'=>"Success","Message"=>$content);
		echo json_encode($res); 
	}
	
	// Sản phẩm yêu thích
	public function favousrite_product(){
		$data['template'] = 'customer/favousrite_product';
		$content=$this->load->view('layout/ajax',$data,true);

		$res=array('Response'=>"Success","Message"=>$content);
		echo json_encode($res); 
	}
	
	
	
	//Shop yêu thích
	public function favousrite_shop(){
		$data['template'] = 'customer/favousrite_shop';
		$content=$this->load->view('layout/ajax',$data,true);

		$res=array('Response'=>"Success","Message"=>$content);
		echo json_encode($res); 
	}
	
	// Khiếu nại 
	public function complain(){
		$data['template'] = 'customer/complain';
		$content=$this->load->view('layout/ajax',$data,true);

		$res=array('Response'=>"Success","Message"=>$content);
		echo json_encode($res); 
	}
	
	// Thông báo
	public function notification(){
		$data['template'] = 'customer/notification';
		$content=$this->load->view('layout/ajax',$data,true);

		$res=array('Response'=>"Success","Message"=>$content);
		echo json_encode($res); 
	}
	
	public function logout(){
		if($this->session->userdata('vkt_clientCustomer')){
			  $this->session->unset_userdata('vkt_clientCustomer');
		  }
		  $this->session->sess_destroy();
         redirect(site_url('auth'));
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

}
