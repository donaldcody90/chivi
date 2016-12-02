<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("category_model");
	}
	
	// Show all product in one Category
	public function detail($slug, $cat_id){
		$param=array('id'=>$cat_id);
		$category_info= $this->category_model->findCategory($param);
		if($category_info['id']== $cat_id){
			if($category_info['slug'] != $slug){
				redirect(site_url($category_info['slug'].'-c'.$category_info['id']));
			}
			
			$subCategoryIds=array();
			$this->category_model->getSubCategories($cat_id,$subCategoryIds);
			
			/*-----------Danh mục----------*/
			
			$listSubCat=array();
			if( $subCategoryIds!=array() ){
				foreach($subCategoryIds as $subCategoryId){
					$subCategoryIds2=array($subCategoryId);
					$this->category_model->getSubCategories($subCategoryId,$subCategoryIds2);
					$subCatTotalProduct= $this->category_model->getSubCatTotalProduct($subCategoryIds2);
					$subCategoryDetail= $this->category_model->findCategory(array('id'=>$subCategoryId));
					if($subCatTotalProduct['product_total']>0){
						$subCategoryDetail['product_total']= $subCatTotalProduct['product_total'];
						$listSubCat[]= $subCategoryDetail;
					}
				}
			}
			
			/*-----------Breadcrumb--------*/
			
			$categoriesRevert=array();
			$this->category_model->getCategoryRevert($cat_id, $categoriesRevert);
			unset($categoriesRevert[$cat_id]);
			
			/*-------Danh sách sản phẩm---------*/
			
			array_push($subCategoryIds, $cat_id);
			$param_in= array();
			$param_in['cat_id']= $subCategoryIds;
			
			$filter=array(
				'sortType'=>$this->input->get('sortType'),
				'sort'=>$this->input->get('sort'),
				'priceFrom'=>$this->input->get('priceFrom'),
				'priceTo'=>$this->input->get('priceTo')
			);
			
			$per_page= 40;
			$limit= $per_page;
			$start= $this->input->get('page');
			$params= array(
					'param_in' => $param_in,
					'filter' => $filter,
					'limit' => $limit,
					'start' => $start
				);
			$params2= array(
						'param_in' => $param_in,
						'filter' => $filter
					);
			$extra_params= array(
						'getPriceRange'=>true,
						'getImages'=>true,
					);
				
			$list_product_total=count( $this->category_model->getAllProduct($params2, $extra_params) );
			$config= vst_Pagination($list_product_total, $per_page);
			$this->pagination->initialize($config);
			
			$list_product = $this->category_model->getAllProduct($params, $extra_params);
			
			$data['list_product']['data'] = $list_product;
			$data['list_product']['total'] = $list_product_total;
			$data['links']['breadcrumbs']['parent_cats'] = $categoriesRevert;
			$data['links']['breadcrumbs']['current_cat'] = $category_info;
			$data['links']['list_subcat'] = $listSubCat;
			$data['template'] = 'category/category';
			//print_r($listSubCat);
			$this->load->view('layout/home', $data);
		}else{
			redirect(site_url('404'));
		}
	}
	
}
?>	