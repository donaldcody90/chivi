<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends MY_Model
{

    private $table_shop = 'shops';
    private $table_product = 'products';
    private $table_order_item = 'order_items';
    private $table_price_range = 'priceranges';
    private $table_product_images = 'product_images';


	function findShop($params_where){
        $shop = $this->_getwhere(array(
			'table'        => $this->table_shop,
			'param_where'  => $params_where
        ));
        return $shop;
    }
	
}	