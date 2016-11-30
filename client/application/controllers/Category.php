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
		// Get category detail
		// Validate slug ,redirect 
		// Function get Category, Subcategory
		$categories=array();
		$categoriesRevert=array();
		$this->category_model->getSubCategories1($cat_id,$categories);
		$this->category_model->getCategoryRevert(9,$categoriesRevert);
		///echo "<pre>";
		//print_r($categoriesRevert);
		
		//die;
		$listCategory= $this->category_model->getCategory($param);
		if($listCategory['id']== $cat_id){
			if($listCategory['slug'] != $slug){
				redirect(site_url($listCategory['slug'].'-c'.$listCategory['id']));
			}
			
			$listCategory0= $this->category_model->getCategory(null, $is_list= true);
			$breadcrumb= buildBreadcrumb123($listCategory0, 8);
			
			$listCategory1= buildTree($listCategory0, $cat_id);
			
			$listCatId= array();
			if(isset($listCategory1) && $listCategory1!= array('')){
				foreach($listCategory1 as $cat){
					array_push($listCatId,$cat['id']);
					if(isset($cat['children']) && $cat['children']!= array('')){
						foreach($cat['children'] as $cat1){
							array_push($listCatId,$cat1['id']);
							if(isset($cat1['children']) && $cat1['children']!= array('')){
								foreach($cat1['children'] as $cat2){
									array_push($listCatId,$cat2['id']);
								}
							}
						}
					}
				}
			}
			
			$listSubCat=array();
			if( $listCatId!=array() ){
				$listSubCat= $this->category_model->getSubCategories($listCatId);
			}
			
			array_push($listCatId, $cat_id);
			
			$sort_field= $this->input->get('sort');
			$sort_type= $this->input->get('sortType');
			/* $filter= vst_filterData(
					array(),
					array('filter_startdate_vn_price', 'filter_enddate_vn_price'),
					array('enddate_vn_price'=>'vt_products', 'startdate_vn_price'=>'vt_products')
				); */
			
			
			$filter=array(
				'sortType'=>$this->input->get('sortType'),
				'sort'=>$this->input->get('sort'),
				'priceFrom'=>$this->input->get('priceFrom'),
				'priceTo'=>$this->input->get('priceTo')
			);
			
			$products=$this->category_model->getProductFilter($filter);
			echo "<pre>";
			print_r($products); 
			$per_page= 4;
			$limit= $per_page;
			$start= $this->input->get('page');
			$params= array(
						'listCatId' => $listCatId,
						'filter' => $filter,
						'sort_field' => $sort_field,
						'sort_type' => $sort_type,
						'limit' => $limit,
						'start' => $start
					);
			$params2= array(
						'listCatId' => $listCatId,
						'filter' => $filter
					);
			$extra_params= array(
						'getPriceRange'=>true
					);
				
			$list_product_total=count( $this->category_model->getAllProduct($params2, $extra_params) );
			$config= vst_Pagination($list_product_total, $per_page);
			$this->pagination->initialize($config);
			
			$list_product = $this->category_model->getAllProduct($params, $extra_params);
			//print_r($listSubCat);
			$data['list_product']['data'] = $list_product;
			$data['list_product']['total'] = $list_product_total;
			$data['list_subcat'] = $listSubCat;
			$data['template'] = 'category/category';
			print_r($list_product);
			$this->load->view('layout/home', $data);
		}else{
			redirect(site_url('404'));
		}
	}
	
	// function catList(){
		// $cat_list= $this->category_model->getCategoryTree();
		// $cat_list2= buildTree($cat_list);
		// $data['category-list']= $cat_list2;
		
		// echo '<pre>'; print_r($cat_list2); echo '</pre>';
	// }
}
?>	