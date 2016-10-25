<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
	}
	
	public function index(){
		$data['template'] = 'shop/shop';
		$this->load->view('layout/home', $data);
	}
	
	// Show all product in one Category
	public function view(){
		$cat_id = $this->input->get('shop_id'); 
		$list_product = $this->category_model->getAllProduct($shop_id);
		$data['list_product'] = $list_product;
		$data['template'] = 'shop/shop';
		$this->load->view('layout/home', $data);
	}
}
?>	