<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends MY_Model
{

    private $table_product = 'vt_product';
	
	function getProduct($params_where){
		$product = $this->_getwhere(array(
                    'table'        => $this->table_product,
                    'param_where'  =>$params_where
        ));
		return $product;
	}
}	