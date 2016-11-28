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
	public function detail($slug, $shop_id){
		$shop_detail= $this->shop_model->findShop(array('id'=>$shop_id));
		if($shop_detail['id']== $shop_id){
			if($shop_detail['slug']!=$slug){
				redirect(site_url($shop_detail['slug'].'-s'.$shop_detail['id']));
			}
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
			$data['list_product'] = $list_product;
			$data['shop_detail'] = $shop_detail;
			$data['shop_detail']['top_sales']= $top_sales;
			$data['template'] = 'shop/view';
			print_r($data['shop_detail']);
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