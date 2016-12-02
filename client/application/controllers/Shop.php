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
			
			$param_in= array();
			$param_in['sid']= array($shop_id);
			$param= array('sid'=> $shop_id);
			$per_page= 4;
			$start= $this->input->get('page');
			$limit= $per_page;
			
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
					'limit' 	=> $limit,
					'start' 	=> $start
				);
			$params2= array(
					'param_in' 	=> $param_in,
					'filter' 	=> $filter
				);
			$params3= array(
					'param_in' 	=> $param_in,
					'filter' 	=> $filter2,
					'limit' 	=> 10
				);
			$extra_params= array(
					'getPriceRange'	=>true,
					'getImages'		=>true
				);
			
			
			$list_product_total= count( $this->category_model->getAllProduct($params2, $extra_params) );
			$config= vst_Pagination($list_product_total, $per_page);
			$this->pagination->initialize($config);
			$list_product = $this->category_model->getAllProduct($params, $extra_params);
			$top_sales = $this->category_model->getAllProduct($params3, $extra_params);
			
			
			$data['list_product']['data'] = $list_product;
			$data['list_product']['total'] = $list_product_total;
			$data['shop_detail'] = $shop_detail;
			$data['shop_detail']['top_sales']= $top_sales;
			$data['template'] = 'shop/view';
			//print_r($data['list_product']);
			$this->load->view('layout/home', $data);
		}else{
			redirect(site_url('404'));
		}
	}
		
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