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
	
}	