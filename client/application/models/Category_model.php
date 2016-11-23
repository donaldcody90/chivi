<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{

    private $table_category = 'vt_category';
    private $table_product = 'vt_product';
    private $table_shop = 'vt_shop';
	
	function getShopProductTotal($shop_id){
		$this->db->select('*');
		$this->db->from($this->table_product);
		$this->db->join($this->table_shop, $this->table_product.'.sid = '.$this->table_shop.'.id');
		$this->db->where($this->table_shop.'.id ='.$shop_id);
		$query= $this->db->get();
		return $query->num_rows();
	}
	
	function getAllProduct($param=null, $cat_id_array=null){
		$this->db->select( $this->table_product.'.id,'.$this->table_product.'.title,'.$this->table_product.'.image,'.$this->table_product.'.vn_price,'.$this->table_category.'.id as cat_id,'.$this->table_category.'.parent_id,'.$this->table_shop.'.id as shop_id,'.$this->table_shop.'.name as shop_name,'.$this->table_shop.'.address,'.$this->table_shop.'.count_rate,'.$this->table_shop.'.total_rate' );
		$this->db->from($this->table_product);
		$this->db->join($this->table_shop, $this->table_product.'.sid = '.$this->table_shop.'.id');
		$this->db->join($this->table_category, $this->table_product.'.cat_id = '.$this->table_category.'.id');
		if($param){
			$this->db->where($param);
		}
		if($cat_id_array){
			$this->db->or_where_in($this->table_product.'.cat_id', $cat_id_array);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getCategory($param=null, $is_list= false){
		return $this->_getwhere(array(
				'table'			=>	$this->table_category,
				'param_where'	=>	$param,
				'list'			=>	$is_list
			));
	}
	
	public function getCategoryTreeForParentId($parent_id = 0) {
	  $categories = array();
	  $this->db->from($this->table_category);
	  $this->db->where('parent_id', $parent_id);
	  $result = $this->db->get()->result();
	  foreach ($result as $mainCategory) {
		$category = array();
		$category['id'] = $mainCategory->id;
		
		$category['name'] = $mainCategory->name;
		$category['parent_id'] = $mainCategory->parent_id;
		$category['sub_categories'] = $this->getCategoryTreeForParentId($category['id']);
		$categories[$mainCategory->id] = $category;
	  }
	  return $categories;
	}
}	