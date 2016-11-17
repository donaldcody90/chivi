<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('buildTree')){
	function buildTree(array &$elements, $parentId = 0) {
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

function buildMenu(){
	$CI =& get_instance();
	
	$CI->db->select ( '*' );
	$CI->db->from('vt_category');
	$cat_list = $CI->db->get();
	
	$cat_list2= buildTree($cat_list);
	$data['category-list']= $cat_list2;
	
	//$CI->load->view('_base/menu', $data);
	
	echo '<pre>'; print_r($cat_list2); echo '</pre>';
}

?>	