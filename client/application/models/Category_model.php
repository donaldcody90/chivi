<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{

    private $table_category = 'vt_category';
    private $table_product = 'vt_product';
	
	function getCategoryTree(){
		$this->db->select ( '*' );
		$this->db->from($this->table_category);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getAllProduct($param=null){
		$this->db->select ( '*' );
		$this->db->from($this->table_product);
		$this->db->where($param);
		$query = $this->db->get();
		return $query->result_array();
	}
}	