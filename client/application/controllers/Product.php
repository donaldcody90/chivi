<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
		$this->load->model("product_model");
	}

	public function index(){
		$this->load->view('layout/home', $data);

	}
	
	// Detail Order
	public function detail(){
		$pid = $this->input->get('id');
		
		$product = $this->product_model->getProduct(array('id'=>$pid));
		$data['shop_detail'] = $this->shop_model->findShop(array('id'=>$product['sid']));
		$data['product'] = $product;
		$data['template'] = 'product/detail';
		$this->load->view('layout/home', $data);
	}
	
	
}
