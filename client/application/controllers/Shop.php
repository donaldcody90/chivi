<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shop_model');
	}
	
	public function index(){
		$data['template'] = 'shop/shop';
		$this->load->view('layout/home', $data);
	}
	

	// Show all product in one Category
 
	public function view($slug){
		$data['shop_detail'] = $this->shop_model->findShop(array('slug'=>$slug));
		if(isset($id)){$shop_id = $id;}
		$param= array('sid'=> $data['shop_detail']['id']);
		$list_product = $this->shop_model->getAllProduct($param);
		
		$data['list_product'] = $list_product;
		
		$data['template'] = 'shop/view';
		$this->load->view('layout/home', $data);
	}
	
	//Danh sách cửa hàng
	function lists(){
		$data['template']= 'shop/lists';
		$this->load->view('layout/home', $data);
	}
}
?>	