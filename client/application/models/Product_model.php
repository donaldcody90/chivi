<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends MY_Model
{

    private $table_products = 'products';
    private $table_shop = 'shops';
    private $table_property = 'properties';
    private $table_property_values = 'property_values';
    private $table_price_range = 'priceranges';
    private $table_products_skus = 'product_skus';
    private $table_sku_properties = 'product_sku_properties';
    private $table_products_images = 'product_images';

	function findProduct($params_where,$is_list=false){
		$product = $this->_getwhere(array(
			'table'        => $this->table_products,
			'param_where'  => $params_where,
			'list'	=>$is_list
        ));
        return $product;
	}
	/*
		Hàm lấy các thuộc tính của sản phẩm
	*/
	function getProductProperties($params_where,$is_list=false)
	{
		$properties = $this->_getwhere(array(
			'table'        => $this->table_property,
			'param_where'  => $params_where,
			'list'	=>$is_list
        ));
        return $properties;
	}
	/*
		Hàm lấy các giá trị của thộc tính
	*/
	function getPropertyValues($params_where,$is_list=false)
	{
		$properties = $this->_getwhere(array(
			'table'        => $this->table_property_values,
			'param_where'  => $params_where,
			'list'	=>$is_list
        ));
        return $properties;
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
		Hàm lấy các biến thể SKUS của product
	*/
	function getProductSKUS($params_where,$is_list=false)
	{
		$properties = $this->_getwhere(array(
			'table'        => $this->table_products_skus,
			'param_where'  => $params_where,
			'list'	=>$is_list
        ));
        return $properties;
	}
	
	/*
		Hàm lấy thuộc tính của sku
	*/
	function getSKUProperties($params_where,$is_list=false)
	{
		$properties = $this->_getwhere(array(
			'table'        => $this->table_sku_properties,
			'param_where'  => $params_where,
			'list'	=>$is_list
        ));
        return $properties;
	}
	
	/*
		Hàm lấy ảnh của sản phẩm
	*/
	function getProductImages($param_where, $is_list= true){
		$images = $this->_getwhere(array(
			'table'			=>	$this->table_products_images,
			'param_where'	=>	$param_where,
			'list'			=>	$is_list
		));
		return $images;
	}
	
	function getAllProduct($params_where=array(),$limit = 0){
		$this->db->select ('*');
		$this->db->from($this->table_products);
		$this->db->where($params_where);
		$query = $this->db->limit($limit);
		$query = $this->db->get();
		$lists = $query->result_array();
		if($lists){
			foreach($lists as $key=>$product){
				$image =  $this->getProductImages(array('pid' => $product['id']));
				$lists[$key]['images']=$image;
				$priceRanges = $this->getPriceRange(array('pid'=>$product['id']),true);
				$lists[$key]['priceRanges'] = $priceRanges;
			}
		}
		return $lists;
	}
	
	function updateProduct($data,$params_where){
		$product = $this->_save(array(
			'table'        	=> $this->table_products,
			'data'  		=> $data,
			'param_where'  	=> $params_where,
        ));
        return $product;
	}
	/*
		function getProductInfo
		Params:
			$pid : Product ID
			$extra_params : 
					array(
						getPriceRange=>false,
						getShop=>false,
						getProperties=>false,
						getSkus=>false,
					)
	*/
	function getProductInfo($pid,$extra_params)
	{
		
		$productInfo=$this->findProduct(array('id'=>$pid));
		if($productInfo)
		{
			$productInfo['ws_rule_number']=1;
			$productInfo['product']=$productInfo;
			if(isset($extra_params['getPriceRange']) && $extra_params['getPriceRange'])
			{
				$productInfo['priceRanges']=$this->getPriceRange(array('pid'=>$pid),true);
			}	
			
			if(isset($extra_params['getImages']) && $extra_params['getImages'])
			{
				$productInfo['Images']=$this->getProductImages(array('pid'=>$pid),true);
			}
			
			if(isset($extra_params['getShop']) && $extra_params['getShop'])
			{
				$productInfo['shop_info']=$this->shop_model->findShop(array('id'=>$productInfo['sid']));
			}	
			if(isset($extra_params['getProperties']) && $extra_params['getProperties'])
			{
				$properties=$this->getProductProperties(array('pid'=>$pid),true);
				if($properties)
				{
					foreach($properties as $property_key=>$property)
					{
						$property_values=$this->getPropertyValues(array('id'=>$property['id']),true);
						$properties[$property_key]['values']=$property_values;
					}
				}
				$productInfo['properties']=$properties;
			}	
			if(isset($extra_params['getSkus']) && $extra_params['getSkus'])
			{
				$product_skus=$this->getProductSKUS(array('pid'=>$pid),true);
				if($product_skus)
				{
					foreach($product_skus as $p_sku_key=>$p_sku)
					{
						$SKU_Properties=$this->getSKUProperties(array('product_sku_id'=>$p_sku['id']),true);
						$product_skus[$p_sku_key]['properties']=$SKU_Properties;
					}
				}
				$productInfo['skus']=$product_skus;
			}
						
			return $productInfo;
		}else{
			return null;
		}
	}
	
	
	
	function getProduct($pid=null, $where_in= null){
		$this->db->select ('*');
		$this->db->from($this->table_shop);
		$this->db->join($this->table_products, $this->table_shop.'.id = '.$this->table_products.'.sid');
		if($pid){
			$this->db->where(array($this->table_products.'.id'=>$pid));
		}
		$this->db->where_in($this->table_products.'.id', $where_in);
		$query = $this->db->get();
		return $query->row_array();
	}

	
	function getNewProductList($limit=null){
		$this->db->select('*');
		$this->db->from($this->table_products);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$query= $this->db->get();
		$lists =  $query->result_array();
		if($lists){
			foreach($lists as $key=>$product){
				$image =  $this->getProductImages(array('id' => $product['id']));
				$lists[$key]['images']=$image;
			}
		}
		return $lists;
	}
	
	function getProductAttributes($params_where){
		
		$list_attr = $this->getAllAttributes();

		$this->db->select ($this->table_products_attributes.'.*');
		$this->db->from($this->table_products_attributes);
		$this->db->join($this->table_products, $this->table_products.'.id = '.$this->table_products_attributes.'.pid');
		$this->db->where($params_where);
		$query = $this->db->get();

		$product_attr = $query->result_array();
		foreach($list_attr as $key=>$value){
			foreach($product_attr as $key1 => $value1){
				if($value1['attr_id'] == $value['attr_id']){
					$list_attr[$key]['list_attr'][$key1] = $value1;
				}	
			}
		}
		return $list_attr;
	}
	
	function getAllAttributes(){
		$this->db->select('*');
		$this->db->from($this->table_attributes);
		$query= $this->db->get();
		return $query->result_array();
	}
	
	
}	