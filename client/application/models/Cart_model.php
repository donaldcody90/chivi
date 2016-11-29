<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends MY_Model
{

     private $table_order = 'orders';
     private $table_seller = 'order_sellers';
     private $table_order_item = 'order_items';
     private $table_carts = 'carts';
 
	 // Lay thong tin tu bang Cart
	 function getCartData($params_where)
	 {
		$cartData = $this->_getwhere(array(
                    'table'        => $this->table_carts,
                    'param_where'  =>$params_where
        ));
		
		if($cartData)
		{
			$cartDataDecode=unserialize(stripslashes($cartData['cartdata']));
			return $cartDataDecode;
		}else{
			$cartDataDecode=array();
			return $cartDataDecode;
		}
	 }
	 
	 // Update san pham vao bang Cart
	 function updateCartData($cartData,$cid=null){
		if($cid == null){
			$currentCustomer =  vst_getCurrentCustomer();
			$cid=$currentCustomer['id'];
		}
		
		$is_check=$this->haveCartData(array('cid'=>$cid));
		
		if($is_check)
		{
			$data=array('cartdata'=>serialize($cartData));
			$params_where=array('cid'=>$cid);
			$is_save = $this->_save(array(
						'table'        => $this->table_carts,
						'data'         => $data,
						'param_where'  => $params_where
			));
		}else{
			$data=array('cartdata'=>serialize($cartData),'cid'=>$cid);
			$params_where=array('cid'=>$cid);
			$is_save = $this->_save(array(
						'table'        => $this->table_carts,
						'data'         => $data
			));
		}
		if($is_save){
			return true;
		}else{
			return false;
		}
	 }
	 
	 // Lấy thông tin trường cartdata
	 function haveCartData($params_where)
	 {
		$cartData = $this->_getwhere(array(
                    'table'        => $this->table_carts,
                    'param_where'  =>$params_where
        ));
		return $cartData;
	 }
	 
	 // Tạo order
	 function createOrder($data)
	 {
		 return $this->_save(array(
               'table' => $this->table_order,
               'data' => $data
          ));
	 }

	 
	 // Insert Item vào đơn hàng
	 function insertItem($data)
	 {
		 return $this->_save(array(
               'table' => $this->table_order_item,
               'data' => $data
          ));
	 }
	 
	 // Check invoiced id đã tồn tại
	 function checkInvoice($params_where){
      $result = $this->_getwhere(array(
                     'table'        => $this->table_order,
                     'param_where'  => $params_where,
                     'list'=>true
      ));
      return $result;
	}
	
	function delete_cart_data($param_where){
		return $this->_del(array(
					'table'		=>	$this->table_carts,
					'param_where'	=>	$param_where
		));
	}
	 
}

?>
