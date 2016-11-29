<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends MY_Model
{

    private $table_product = 'products';
    private $table_shop = 'shops';
    private $table_property = 'properties';
    private $table_property_values = 'property_values';
    private $table_price_range = 'priceRanges';
    private $table_product_skus = 'product_skus';
    private $table_sku_properties = 'product_sku_properties';
    private $table_product_images = 'product_images';

	function findProduct($params_where,$is_list=false){
		$product = $this->_getwhere(array(
			'table'        => $this->table_product,
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
			'table'        => $this->table_product_skus,
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
	
	function getAllProduct(){
		$this->db->select ('*');
		$this->db->from($this->table_product);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function updateProduct($data,$params_where){
		$product = $this->_save(array(
			'table'        	=> $this->table_product,
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
		$this->db->join($this->table_product, $this->table_shop.'.id = '.$this->table_product.'.sid');
		if($pid){
			$this->db->where(array($this->table_product.'.id'=>$pid));
		}
		$this->db->where_in($this->table_product.'.id', $where_in);
		$query = $this->db->get();
		return $query->row_array();
	}

	
	function getNewProductList($limit=null){
		$this->db->select('*');
		$this->db->from($this->table_product);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$query= $this->db->get();
		return $query->result_array();
	}
	
	function getProductAttributes($params_where){
		
		$list_attr = $this->getAllAttributes();

		$this->db->select ($this->table_product_attributes.'.*');
		$this->db->from($this->table_product_attributes);
		$this->db->join($this->table_product, $this->table_product.'.id = '.$this->table_product_attributes.'.pid');
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
	
	function getProductImages($param_where, $is_list= true){
		$this->_getwhere(array(
			'table'			=>	$this->table_product_images,
			'param_where'	=>	$param_where,
			'list'			=>	$is_list
		));
	}
}	