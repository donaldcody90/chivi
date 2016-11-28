<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends MY_Model
{

 
    private $table_shop = 'shops';
    private $table_product = 'products';
    private $table_order_item = 'order_items';

	function findShop($params_where){
        $shop = $this->_getwhere(array(
			'table'        => $this->table_shop,
			'param_where'  => $params_where
        ));
        return $shop;
    }
	
	function getAllProduct($param=null, $filter=array(), $limit=0, $start=0){
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
	
	function getTopSales($param, $limit=0){
		$this->db->select($this->table_product.'.id,'.$this->table_product.'.title,'.$this->table_product.'.image,'.$this->table_product.'.vn_price,'.'sum(vt_order_item.item_quantity) as order_total');
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