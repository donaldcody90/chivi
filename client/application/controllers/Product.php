<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
		$this->load->model("product_model");

	}

	public function detail($slug,$pid){
		$extra_params=array(
			'getPriceRange'=>true,
			'getShop'=>true,
			'getProperties'=>true,
			'getSkus'=>true,
			);
		$product_info = $this->product_model->getProductInfo($pid,$extra_params);
		if($product_info)
		{
			
		}else{
			redirect(site_url("404"));
		}
	
		$param1= array('id'=> $product_info['sid']);
		$param= array('sid'=> $product_info['sid']);
		$shop_detail = $this->shop_model->findShop($param1);
		$param2= array('sid' => $product_info['sid'], 'id !=' => $product_info['id']);
		
		$product_total= $this->shop_model->getAllProduct($param);
		$data['data']['same_shop_products']= $this->shop_model->getAllProduct($param2,null,$limit=10);
		$data['data']['newProducts']=$this->product_model->getNewProductList($limit=10);
		
		$data['shop_detail']= $shop_detail;
		$data['shop_product_total']=count($product_total);
		$data['data']['product'] = $product_info;
		$data['template'] = 'product/detail';
		$this->load->view('layout/home', $data);
	}
	
	// Detail Order


	public function updateSlug(){
		$list_product = $this->product_model->getAllProduct();
		foreach($list_product as $key=>$value){
			$slug = cleanVietnamese($value['title']);
			$data = array('slug'=>$slug);
			$this->product_model->updateProduct($data, array('id'=>$value['id']));
		}
	}
	
}
