<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{
	
    private $table_category = 'categories';
    private $table_product = 'products';
    private $table_shop = 'shops';
    private $table_price_range = 'priceranges';
    private $table_product_images = 'product_images';
    private $table_order_items = 'order_items';
    private $table_orders = 'orders';
	
	function findCategory($param=null, $is_list= false){
		return $this->_getwhere(array(
				'table'			=>	$this->table_category,
				'param_where'	=>	$param,
				'list'			=>	$is_list
			));
	}
	function getCategoryRevert($cat_id,&$categories=array())
	{
		$category=$this->findCategory(array('id'=>$cat_id));
		if($category)
		{
			
			if($category['parent_id'])
			{
				$this->getCategoryRevert($category['parent_id'],$categories);
			}
			$categories[$category['id']]=$category;
		}
	}
	
	function getSubCategories($parent_id = 0,&$categories=array())
	{
		$subcategories=$this->findCategory(array('parent_id'=>$parent_id),true);
		if($subcategories)
		{
			foreach($subcategories as $cat)
			{
				#$categories[$cat['id']]['subItems']=array();
				#$categories[$cat['id']]=$cat;
				$categories[]=$cat['id'];
				$this->getSubCategories($cat['id'],$categories);
				
			}
		}
		#return $categories;
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
	function getProductImages($param_where, $is_list= false){
		return $this->_general(array(
			'table'			=>	$this->db->dbprefix.$this->table_product_images,
			'param_where'	=>	$param_where,
			'orderby'		=>	'is_default DESC',
			'list'			=>	$is_list
		));
	}
	
	/*
		function getProductFilter
		Params:
			$param: array(
				'field' => array($cat_id1, $cat_id2,...)
			)
			$filter: array(
				'sortType'
				'sort'
				'priceFrom'
				'priceTo'
			)
			
	*/
	function getProductFilter($param=array(), $filter=array(), $limit=0, $start=0)
	{
		$this->db->select($this->db->dbprefix.$this->table_product.'.id,'.$this->db->dbprefix.$this->table_product.'.title,'.$this->db->dbprefix.$this->table_product.'.vn_price,'.$this->db->dbprefix.$this->table_product.'.slug,'.$this->db->dbprefix.$this->table_shop.'.id as shop_id,'.$this->db->dbprefix.$this->table_shop.'.name as shop_name,'.$this->db->dbprefix.$this->table_shop.'.address,'.$this->db->dbprefix.$this->table_shop.'.count_rate,'.$this->db->dbprefix.$this->table_shop.'.total_rate,'.$this->db->dbprefix.$this->table_shop.'.slug as shop_slug');
		$this->db->from($this->db->dbprefix.$this->table_product);
		$this->db->join($this->db->dbprefix.$this->table_shop, $this->db->dbprefix.$this->table_product.'.sid = '.$this->db->dbprefix.$this->table_shop.'.id');
		if($param!=array()){
			foreach($param as $id=>$data){
				$field= $id;
				$param_in= $data;
			}
			$this->db->where_in($field, $param_in);
		}
		/* WHERE */
		if(isset($filter['priceFrom']))
		{
			if(!empty($filter['priceFrom']))
			{
				$this->db->where('vn_price >=',$filter['priceFrom']);
			}
		}
		if(isset($filter['priceTo']))
		{
			if(!empty($filter['priceTo']))
			{
				$this->db->where('vn_price <=',$filter['priceTo']);
			}
		}
		if(isset($filter['keyword']))
		{
			if(!empty($filter['keyword']))
			{
				$this->db->like('title', $filter['keyword']);
			}
		}
		/* ORDER BY */
		if(isset($filter['sort']))
		{
			if(!empty($filter['sort']))
			{
				if(empty($filter['sortType']))
				{
					$filter['sortType']='DESC';
				}
				switch($filter['sort'])
				{
					case 'hot':
						$this->db->order_by('views',$filter['sortType']);
						break;
					case 'count_sold':
						$this->db->order_by('sales',$filter['sortType']);
						break;
					case 'price':
						$this->db->order_by('vn_price',$filter['sortType']);
						break;
					case 'date':
						$this->db->order_by('id',$filter['sortType']);
						break;
					default: 
						#CODE
					;	
				}
			}
		}else if(!isset($filter['sort'])){
			$this->db->order_by('views','DESC');
		}
		$this->db->limit($limit, $start);
		$query= $this->db->get();
		//echo  $this->db->last_query();
		return $query->result_array();
	}
	
	function getAllProduct($params, $extra_params){
		$product_list= $this->getProductFilter(isset($params['param_in'])?$params['param_in']:null, isset($params['filter'])?$params['filter']:null, isset($params['limit'])?$params['limit']:0, isset($params['start'])?$params['start']:0);
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
	
	
	function getSubCatTotalProduct($param_where_in){
		$this->db->select('count(*) as product_total');
		$this->db->from($this->db->dbprefix.$this->table_category);
		$this->db->join($this->db->dbprefix.$this->table_product, $this->db->dbprefix.$this->table_product.'.cat_id = '.$this->db->dbprefix.$this->table_category.'.id');
		$this->db->where_in($this->db->dbprefix.$this->table_category.'.id',$param_where_in);
		$query= $this->db->get();
		return $query->row_array();
	}
	
	
}	