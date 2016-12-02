<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shop_model');
		$this->load->model('category_model');
	}
	
	public function index()
	{
		$subCategoryIds=array();
		$this->category_model->getSubCategories(0,$subCategoryIds);
		
		
		/*----------Danh sách sản phẩm---------*/
		
		$param_in=array();
		$filter= array(
			'sortType'		=>	$this->input->get('sortType'),
			'sort'			=>	$this->input->get('sort'),
			'priceFrom'		=>	$this->input->get('priceFrom'),
			'priceTo'		=>	$this->input->get('priceTo'),
			'keyword'		=>	$this->input->get('keyword')
		);
		$per_page= 4;
		$limit= $per_page;
		$start= $this->input->get('page');
		$params= array(
			'filter' => $filter,
			'limit' => $limit,
			'start' => $start
		);
		$params2= array(
			'filter' => $filter
		);
		$extra_params= array(
			'getPriceRange'=>true,
			'getImages'=>true,
		);
		
		$list_product_total= count( $this->category_model->getAllProduct($params2, $extra_params) );
		$config= vst_Pagination($list_product_total, $per_page);
		$this->pagination->initialize($config);
		
		$list_product= $this->category_model->getAllProduct($params, $extra_params);
		
		
		/*-----------Danh mục----------*/
		
		$listSubCat=array();
		if( $subCategoryIds!=array() ){
			foreach($subCategoryIds as $subCategoryId){
				$subCategoryIds2=array($subCategoryId);
				$this->category_model->getSubCategories($subCategoryId,$subCategoryIds2);
				$param_in['cat_id']= $subCategoryIds2;
				$params3= array(
					'param_in' => $param_in,
					'filter' => $filter
				);
				$subCatTotalProduct= count( $this->category_model->getAllProduct($params3, $extra_params) );
				$subCategoryDetail= $this->category_model->findCategory(array('id'=>$subCategoryId));
				if($subCatTotalProduct>0){
					$subCategoryDetail['product_total']= $subCatTotalProduct;
					$listSubCat[]= $subCategoryDetail;
				}
			}
		}
		
		$data['list_product']['data']= $list_product;
		$data['list_product']['total']= $list_product_total;
		$data['list_subcat'] = $listSubCat;
		$data['template'] = 'search/view';
		//print_r($data);
		$this->load->view('layout/home', $data);
	}
	
}
?>	