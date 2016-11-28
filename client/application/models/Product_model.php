<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends MY_Model
{

    private $table_product = 'products';
    private $table_shop = 'shops';
    private $table_attributes = 'attributes';
    private $table_product_attributes = 'product_attributes';

	function findProduct($params_where){
		$product = $this->_getwhere(array(
			'table'        => $this->table_product,
			'param_where'  => $params_where
        ));
        return $product;
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
}	