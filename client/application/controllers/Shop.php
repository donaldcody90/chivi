<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shop_model');
		$this->load->model('category_model');
	}
	
	public function index(){
		$data['template'] = 'shop/shop';
		$this->load->view('layout/home', $data);
	}
	

	// Show all product in one Category

	public function detail($slug, $shop_id){
		$shop_detail= $this->shop_model->findShop(array('id'=>$shop_id));
		if($shop_detail['id']== $shop_id){
			if($shop_detail['slug']!=$slug){
				redirect(site_url($shop_detail['slug'].'-s'.$shop_detail['id']));
			}
			
			$config= vst_Pagination();
			$start= $this->input->get('page');
			
			$param_in= array();
			$param_in['sid']= array($shop_id);
			$param= array('sid'=> $shop_id);
		 
			$start= $this->input->get('page');
		 
			
			$filter=array(
					'sortType'		=>	$this->input->get('sortType'),
					'sort'			=>	$this->input->get('sort'),
					'priceFrom'		=>	$this->input->get('priceFrom'),
					'priceTo'		=>	$this->input->get('priceTo'),
					'keyword'		=>	$this->input->get('keyword')
				);
			$filter2=array(
					'sort'			=>	'count_sold'
				);
			$params= array(
					'param_in' 	=> $param_in,
					'filter' 	=> $filter,
					'limit' 	=> $config['per_page'],
					'start' 	=> $start
				);
			$params2= array(
					'param_in' 	=> $param_in,
					'filter' 	=> $filter
				);
			$params3= array(
					'param_in' 	=> $param_in,
					'filter' 	=> $filter2,
					'limit' 	=> 5
				);
			$extra_params= array(
					'getPriceRange'	=>true,
					'getImages'		=>true
				);
			
			
			 
			 
			
			$list_product = $this->category_model->getAllProduct($params, $extra_params);
			$top_sales = $this->category_model->getAllProduct($params3, $extra_params);
			
			$config['total_rows'] =  $list_product['records'];
			$this->pagination->initialize($config);
			$data['list_product']['data'] = $list_product['list'];
			$data['list_product']['total'] =  $list_product['records'];
			$data['shop_detail'] = $shop_detail;
			$data['shop_detail']['top_sales']= $top_sales['list'];
			$data['template'] = 'shop/view';
			//print_r($data['shop_detail']);
			$this->load->view('layout/home', $data);
		}else{
			redirect(site_url('404'));
		}
	}
	
	
	//Danh sách cửa hàng
	function lists(){
		$data['template']= 'shop/lists';
		$this->load->view('layout/home', $data);
	}
}
?>	