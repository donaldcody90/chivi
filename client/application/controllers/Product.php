<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
		$this->load->model("product_model");
		$this->load->model('category_model');

	}
	
	public function index(){
		$extra_params=array(
			'getPriceRange'=>true,
			'getImages'=>true,
			);
		
		$config = vst_pagination();
		$start= $this->input->get('page');
		$config['per_page'] = 20; 
		$filter=array(
					'sortType'		=>	$this->input->get('sortType'),
					'sort'			=>	$this->input->get('sort'),
					'priceFrom'		=>	$this->input->get('priceFrom'),
					'priceTo'		=>	$this->input->get('priceTo'),
					'keyword'		=>	$this->input->get('keyword')
				);	
		$params= array(
					'filter' 	=> $filter,
					'limit' 	=> $config['per_page'],
					'start' 	=> $start
				);		
		$list_product= $this->category_model->getAllProduct($params,$extra_params);	
		$config['total_rows'] =  $list_product['records'];
		//var_dump($list_product['list']);
		$data['products']= $list_product['list'];
		$this->pagination->initialize($config);
		$data['template'] = 'product/index';
		$this->load->view('layout/home', $data);
	}	

	public function detail($slug,$pid){
		$extra_params=array(
			'getPriceRange'=>true,
			'getShop'=>true,
			'getProperties'=>true,
			'getSkus'=>true,
			'getImages'=>true,
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
		$param2= array('sid' => $product_info['sid'], 'vt_products.id !=' => $product_info['id']);
		/*
		$extra_params= array(
					'getPriceRange'=>true,
					'getImages'=>true
				);
		*/		
		$product_total= $this->product_model->getAllProduct($param );
		$data['data']['same_shop_products']= $this->product_model->getAllProduct($param2, $limit=5);
		$data['data']['newProducts']=$this->product_model->getNewProductList($limit=5);
		
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
