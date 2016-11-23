<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends MY_Model
{

    private $table_shop = 'vt_shop';
    private $table_product = 'vt_product';

	function findShop($params_where){
        $shop = $this->_getwhere(array(
			'table'        => $this->table_shop,
			'param_where'  => $params_where
        ));
        return $shop;
    }
	
	function getAllProduct($param=null, $limit=0){

		$this->db->select ( '*' );
		$this->db->from($this->table_product);
		if($param){
			$this->db->where($param);
		}
		$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();
	}
}	