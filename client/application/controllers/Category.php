<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("category_model");
	}
	
	// Show all product in one Category
	public function index($cat_id){
		//$cat_id = $this->input->get('cat_id'); 
		$listCategory= $this->category_model->getCategory(null, $is_list= true);
		$listCategory1= buildTree($listCategory, 8);
		$listCategory3= $this->category_model->getCategoryTreeForParentId($cat_id);
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
		
		$param= array('cat_id'=>$cat_id);
		$list_product = $this->category_model->getAllProduct($param,$listCatId);
		$abc= $this->category_model->getShopProductTotal(1);
		print_r($list_product);
		//print_r($listCategory1);
		$data['data']['list_product'] = $list_product;
		$data['template'] = 'category/category';
		$this->load->view('layout/home', $data);
	}
	
	
	
	function catList(){
		$cat_list= $this->category_model->getCategoryTree();
		$cat_list2= buildTree($cat_list);
		$data['category-list']= $cat_list2;
		
		echo '<pre>'; print_r($cat_list2); echo '</pre>';
	}
}
?>	