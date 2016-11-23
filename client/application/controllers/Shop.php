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
	public function detail($shop_id){
		$param= array('sid'=> $shop_id);
		$list_product = $this->shop_model->getAllProduct($param);
		print_r($list_product);
		$data['list_product'] = $list_product;
		$data['shop_detail'] = $this->shop_model->findShop(array('id'=>$shop_id));
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