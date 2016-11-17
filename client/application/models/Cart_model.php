<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends MY_Model
{

     private $table_order = 'vt_order';
     private $table_seller = 'vt_order_seller';
     private $table_item = 'vt_order_item';
     private $table_ship_only = 'ship_only';
     private $table_carts = 'vt_cart';

     function __construct()
     {
          parent::__construct();
     }
	
	 // Lay thong tin tu bang Cart
	 function getCartData($cid=null)
	 {
		if($cid == null){
			$currentCustomer =  vst_getCurrentCustomer();
			$cid=$currentCustomer['id'];
		}
		$params_where=array('id'=>$cid);
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
		
		$is_check=$this->haveCartData($cid);
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
	 function haveCartData($cid)
	 {
		 $sql="SELECT * FROM ".$this->table_carts." WHERE cid=".$cid;
		 $query = $this->db->query($sql);
		 return $query->result_array();
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
               'table' => $this->table_item,
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
