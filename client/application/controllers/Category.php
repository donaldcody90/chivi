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
		$listCategory= $this->category_model->getCategory($param);
		if($listCategory['id']== $cat_id){
			if($listCategory['slug']!= $slug){
				redirect(site_url($listCategory['slug'].'-c'.$listCategory['id']));
			}
			
			$listCategory0= $this->category_model->getCategory(null, $is_list= true);
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
			$filter= vst_filterData(
					array(),
					array('filter_startdate_vn_price', 'filter_enddate_vn_price'),
					array('enddate_vn_price'=>'vt_product', 'startdate_vn_price'=>'vt_product')
				);
			$list_product_total=count( $this->category_model->getAllProduct($listCatId, $filter) );
			$per_page= 40;
			$limit= $per_page;
			$start= $this->input->get('page');
			$config= vst_Pagination($list_product_total, $per_page);
			$this->pagination->initialize($config);
			
			$list_product = $this->category_model->getAllProduct($listCatId, $filter, $sort_field, $sort_type, $limit, $start);
			//print_r($listSubCat);
			$data['list_product']['data'] = $list_product;
			$data['list_product']['total'] = $list_product_total;
			$data['list_subcat'] = $listSubCat;
			$data['template'] = 'category/category';
			print_r($listSubCat);
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