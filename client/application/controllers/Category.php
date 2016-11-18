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
		$param= array('cat_id'=>$cat_id);
		$list_product = $this->category_model->getAllProduct($param);
		print_r($list_product);
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