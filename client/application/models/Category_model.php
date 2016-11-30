<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{
	
    private $table_category = 'categories';
    private $table_product = 'products';
    private $table_shop = 'shops';
    private $table_price_range = 'priceranges';
    private $table_product_images = 'product_images';
	
	
	function getProductList($param=null, $filter=null, $sort_field='is_featured', $sort_type='desc', $limit=0, $start=0){
		$result = $this->db->query("SHOW COLUMNS FROM `".$this->db->dbprefix.$this->table_product."` LIKE '".$sort_field."'");
		$sortField = ($result->num_rows())?$sort_field:'is_featured';
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
	
	/*
		Hàm lấy các khoảng giá
	*/
	function getPriceRange($params_where,$is_list=false)
	{
		$properties = $this->_getwhere(array(
			'table'        => $this->db->dbprefix.$this->table_price_range,
			'param_where'  => $params_where,
			'list'	=>$is_list
        ));
        return $properties;
	}
	/*
		Hàm lấy ảnh
	*/
	function getProductImages($param_where, $is_list= true){
		$this->_getwhere(array(
			'table'			=>	$this->db->dbprefix.$this->table_product_images,
			'param_where'	=>	$param_where,
			'list'			=>	$is_list
		));
	}
	
	/*
		function getProductInfo
		Params:
			$params : 
					array( 
						param => $param, 
						filter => $filter, 
						sort_field => $sort_field, 
						sort_type => $sort_type, 
						limit => $limit, 
						start => $start
						);
			$extra_params : 
					array(
						getPriceRange=>false,
						getImages=>false
					);
	*/
	function getAllProduct($params, $extra_params){
		$product_list= $this->getProductList(isset($params['param'])?$params['param']:null, isset($params['filter'])?$params['filter']:null, isset($params['sort_field'])?$params['sort_field']:'is_featured', isset($params['sort_type'])?$params['sort_type']:'desc', isset($params['limit'])?$params['limit']:0, isset($params['start'])?$params['start']:0);
		if(isset($extra_params) && $extra_params!= array()){
			if(isset($extra_params['getPriceRange']) && $extra_params['getPriceRange']){
				foreach($product_list as $product_list_id=>$product_list_data){
					$product_list[$product_list_id]['price_range']= $this->getPriceRange(array('pid'=>$product_list_data['id']),true);
				}
			}
			if(isset($extra_params['getImages']) && $extra_params['getImages']){
				foreach($product_list as $product_list_id=>$product_list_data){
					$product_list[$product_list_id]['images']= $this->getProductImages(array('pid'=>$product_list_data['id']),true);
				}
			}
		}else{
			$product_list= array();
		}
		return $product_list;
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