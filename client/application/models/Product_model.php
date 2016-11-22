<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends MY_Model
{

    private $table_product = 'vt_product';
    private $table_shop = 'vt_shop';
	
	
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
}	