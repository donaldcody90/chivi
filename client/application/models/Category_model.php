<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{
	
    private $table_category = 'categories';
    private $table_product = 'products';
    private $table_shop = 'shops';
	
	// function getShopProductTotal($shop_id){
		// $this->db->select('*');
		// $this->db->from($this->db->dbprefix.$this->table_product);
		// $this->db->join($this->db->dbprefix.$this->table_shop, $this->db->dbprefix.$this->table_product.'.sid = '.$this->db->dbprefix.$this->table_shop.'.id');
		// $this->db->where($this->db->dbprefix.$this->table_shop.'.id ='.$shop_id);
		// $query= $this->db->get();
		// return $query->num_rows();
	// }
	
	function getAllProduct($param=null, $filter=null, $sort_field='id', $sort_type='desc', $limit=0, $start=0){
		$result = $this->db->query("SHOW COLUMNS FROM `".$this->db->dbprefix.$this->table_product."` LIKE '".$sort_field."'");
		$sortField = ($result->num_rows())?$sort_field:'id';
		$this->db->select( $this->db->dbprefix.$this->table_product.'.id,'.$this->db->dbprefix.$this->table_product.'.title,'.$this->db->dbprefix.$this->table_product.'.image,'.$this->db->dbprefix.$this->table_product.'.vn_price,'.$this->db->dbprefix.$this->table_product.'.slug,'.$this->db->dbprefix.$this->table_category.'.id as cat_id,'.$this->db->dbprefix.$this->table_category.'.parent_id,'.$this->db->dbprefix.$this->table_shop.'.id as shop_id,'.$this->db->dbprefix.$this->table_shop.'.name as shop_name,'.$this->db->dbprefix.$this->table_shop.'.address,'.$this->db->dbprefix.$this->table_shop.'.count_rate,'.$this->db->dbprefix.$this->table_shop.'.total_rate,'.$this->db->dbprefix.$this->table_shop.'.slug as shop_slug' );
		$this->db->from($this->db->dbprefix.$this->table_product);
		$this->db->join($this->db->dbprefix.$this->table_shop, $this->db->dbprefix.$this->table_product.'.sid = '.$this->db->dbprefix.$this->table_shop.'.id');
		$this->db->join($this->db->dbprefix.$this->table_category, $this->db->dbprefix.$this->table_product.'.cat_id = '.$this->db->dbprefix.$this->table_category.'.id');
		if($param){
			$this->db->or_where_in($this->db->dbprefix.$this->table_product.'.cat_id', $param);
		}
		vst_buildFilter($filter);
		$this->db->order_by($sortField, $sort_type);
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getCategory($param=null, $is_list= false){
		return $this->_getwhere(array(
				'table'			=>	$this->db->dbprefix.$this->table_category,
				'param_where'	=>	$param,
				'list'			=>	$is_list
			));
	}
	
	function getSubCategories($param_where_in){
		$this->db->select($this->db->dbprefix.$this->table_category.'.id,'.$this->db->dbprefix.$this->table_category.'.name,'.$this->db->dbprefix.$this->table_category.'.slug, count(*) as total_product');//tiếp tục ở đây
		$this->db->from($this->db->dbprefix.$this->table_category);
		$this->db->join($this->db->dbprefix.$this->table_product, $this->db->dbprefix.$this->table_product.'.cat_id = '.$this->db->dbprefix.$this->table_category.'.id');
		$this->db->where_in($this->db->dbprefix.$this->table_category.'.id',$param_where_in);
		$this->db->group_by($this->db->dbprefix.$this->table_category.'.id');
		$this->db->order_by('total_product');
		$query= $this->db->get();
		return $query->result_array();
	}
	
	public function getCategoryTreeForParentId($parent_id = 0) {
	  $categories = array();
	  $this->db->from($this->db->dbprefix.$this->table_category);
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