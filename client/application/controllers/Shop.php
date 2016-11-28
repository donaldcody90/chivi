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
		$filterData= vst_filterData(
				array('filter_title'),
				array('filter_startdate_vn_price', 'filter_enddate_vn_price')
			);
		$param= array('sid'=> $shop_id);
		$list_product_total= count( $this->shop_model->getAllProduct($param, $filterData) );
		$per_page= 4;
		$config= vst_Pagination($list_product_total, $per_page);
		$this->pagination->initialize($config);
		$start= $this->input->get('page');
		$limit= $per_page;
		
		$list_product = $this->shop_model->getAllProduct($param, $filterData, $limit, $start);
		$top_sales = $this->shop_model->getTopSales($param, 10);
		print_r($list_product_total);
		$data['list_product'] = $list_product;
		$data['shop_detail'] = $this->shop_model->findShop(array('id'=>$shop_id));
		$data['shop_detail']['top_sales']= $top_sales;
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