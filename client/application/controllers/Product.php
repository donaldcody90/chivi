<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
		$this->load->model("product_model");

	}

	public function detail($pid){
		$product_info = $this->product_model->getProductInfo($pid,array('getProperties'=>1,'priceRange'=>1));
		if($product_info)
		{
			
		}else{
			redirect(site_url("404"));
		}
		echo "<pre>";
		print_r($product_info);
		die;
		//$p_info = $this->product_model->findProduct(array('slug' => $slug));
		//$pid = $p_info['id'];
		
		
	
		$product = $this->product_model->getProduct($pid);
		$product_detail = $this->product_model->getProductAttributes(array('pid'=>$pid));
		$shop_detail = $this->shop_model->findShop(array('id'=>$product['sid']));
		$param1= array('sid'=> $product['sid']);
		$param2= array('sid' => $product['sid'], 'id !=' => $product['id']);
		$param3= $this->session->userdata('lastviewed');
		$product_total= count($this->shop_model->getAllProduct($param1));
		$data['data']['same_shop_products']= $this->shop_model->getAllProduct($param2, $limit=10);
		$data['data']['newProducts']= $this->product_model->getNewProductList($limit=10);
		$data['data']['lastviewed']= $this->product_model->getProduct(null, $param3);
		$data['product_detail']= $product_detail;
		$data['shop_detail']= $shop_detail;
		
		$product['shop_product_total']=$product_total;
		$data['data']['product'] = $product;
		$data['template'] = 'product/detail';
		$this->load->view('layout/home', $data);
	}
	
	// Detail Order

	public function detail2(){
		$pid = $this->input->get('pid');
		$product = $this->product_model->getProduct($pid);
		$data['data'] = $product;
	}

	public function updateSlug(){
		$list_product = $this->product_model->getAllProduct();
		foreach($list_product as $key=>$value){
			$slug = cleanVietnamese($value['title']);
			$data = array('slug'=>$slug);
			$this->product_model->updateProduct($data, array('id'=>$value['id']));
		}
	}
	
}
