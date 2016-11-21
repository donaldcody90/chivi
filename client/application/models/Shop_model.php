<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends MY_Model
{

    private $table_shop = 'vt_shop';
    private $table_product = 'vt_product';
	
	function getShop($shop_id=0){
		$this->db->select ( '*' );
		$this->db->from($this->table_shop);
		if($shop_id){
			$this->db->where(array('id'=>$shop_id));
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getAllProduct($param=null, $limit=0){
		$this->db->select ( '*' );
		$this->db->from($this->table_product);
		$this->db->where($param);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}
}	