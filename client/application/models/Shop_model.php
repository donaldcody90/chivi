<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends MY_Model
{

    private $table_shop = 'vt_shops';
    private $table_product = 'vt_products';
    private $table_order_item = 'vt_order_items';
    private $table_price_range = 'vt_priceranges';
    private $table_product_images = 'vt_product_images';


	function findShop($params_where){
        $shop = $this->_getwhere(array(
			'table'        => $this->table_shop,
			'param_where'  => $params_where
        ));
        return $shop;
    }
	
	function getProductList($param=null, $filter=array(), $limit=0, $start=0){
		vst_buildFilter($filter);
		$this->db->select ( '*' );
		$this->db->from($this->table_product);
		if($param){
			$this->db->where($param);
		}
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
			'table'        => $this->table_price_range,
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
			'table'			=>	$this->table_product_images,
			'param_where'	=>	$param_where,
			'list'			=>	$is_list
		));
	}
	
	/*
		function getProductInfo
		Params:
			$params : 
					array( param, filter, limit, start )
			$extra_params : 
					array(
						getPriceRange=>false,
						getImages=>false
					)
	*/
	function getAllProduct($params, $extra_params){
		$product_list= $this->getProductList($params['param']?$params['param']:null, $params['filter']?$params['filter']:array(), $params['limit']?$params['limit']:0, $params['start']?$params['start']:0);
		if(isset($product_list) && !empty($product_list)){
			if(isset($extra_params['getPriceRange']) && $extra_params['getPriceRange']){
				foreach($product_list as $product_list_id=>$product_list_data){
					$product_list[$product_list_id]['price_range']= $this->getPriceRange(array('pid'=>$product_list_data['id']),true);
				}
			}
			if(isset($extra_params['getImages']) && $extra_params['getImages']){
				foreach($product_list as $product_list_id=>$product_list_data){
					$product_list[$product_list_id]['image_list']= $this->getProductImages(array('pid'=>$product_list_data['id']),true);
				}
			}
		}else{
			$product_list= array();
		}
		return $product_list;
	}
	
	function getTopSales($param, $limit=0){
		$this->db->select($this->table_product.'.id,'.$this->table_product.'.title,'.$this->table_product.'.image,'.$this->table_product.'.slug,'.$this->table_product.'.vn_price,'.'sum('.$this->table_order_item.'.item_quantity) as order_total');
		$this->db->from($this->table_product);
		$this->db->join($this->table_order_item, $this->table_order_item.'.pid = '.$this->table_product.'.id');
		if($param){
			$this->db->where($param);
		}
		$this->db->group_by($this->table_order_item.'.pid');
		$this->db->order_by('order_total', 'desc');
		$this->db->limit($limit);
		$result= $this->db->get();
		return $result->result_array();
	}
}	