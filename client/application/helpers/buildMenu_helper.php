<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('buildTree')){
	function buildTree($elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[$element['id']] = $element;
			}
		}
		return $branch;
	}
}

if(!function_exists('buildBreadcrumb123')){
	function buildBreadcrumb123($elements, $parentId){
		$array= array();
		
			foreach($elements as $element){
				if($element['id']== $parentId){
					return $element;
					$parent= buildBreadcrumb123($elements, $element['parent_id']);
					
					$array[]= $parent;
				}
			}
		
		return $array;
	}
}

if(!function_exists('buildMenu')){
	function buildMenu(){
		$CI =& get_instance();
		
		$CI->db->select ( '*' );
		$CI->db->from('vt_categories');
		$cat_list = $CI->db->get();
		$cat_list1 = $cat_list->result_array();
		
		$cat_list2= buildTree($cat_list1);
		$data['category_lists']= $cat_list2;
		
		$CI->load->view('_base/menu', $data);
		
		//echo '<pre>'; print_r($cat_list2); echo '</pre>';
	}
}

?>	