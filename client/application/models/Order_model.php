<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends MY_Model
{

     private $table_orders = 'vt_order';
     private $table_customers = 'vt_customer';
     private $table_order_items = 'vt_order_item';
	 private $table_products='vt_product';
	 private $table_shops='vt_shop';

     function __construct()
     {
          parent::__construct();
     }

	 // List Order
     function listOrder($filter=array(),$total=0,$start=0, $param){
          vst_buildFilter($filter);
          $query = $this->db->select 
			($this->table_orders.'.*,'
			.$this->table_shops.'.name as shop_name,'.$this->table_shops.'.id as shop_id,'
			.$this->table_order_items.'.*,'
			.$this->table_products.'.*,'
			.$this->table_customers.'.*');
          $query = $this->db->from($this->table_orders);
          $query = $this->db->join ($this->table_customers, $this->table_customers.'.id = '.$this->table_orders.'.cid');
          $query = $this->db->join ($this->table_order_items, $this->table_order_items.'.oid = '.$this->table_orders.'.id');
          
          $query = $this->db->join ($this->table_products, $this->table_products.'.id = '.$this->table_order_items.'.pid');
		  $query = $this->db->join ($this->table_shops, $this->table_shops.'.id = '.$this->table_products.'.sid');
          $query = $this->db->where($param);
          $query = $this->db->order_by($this->table_orders.'.id', 'desc'); 
          $query = $this->db->group_by($this->table_shops.'.id', 'desc'); 
          
          $query = $this->db->limit($total, $start);
          $query = $this->db->get();

          $records = $query->num_rows();
          $list = $query->result_array();
          /*
		  if($list)
          {
               foreach($list as $key=>$order){
                 $items=$this->getItems($order['id']);
                 $sellers=$this->getSellers($order['id']);
                 $list[$key]['order_summary']=$this->get_Order_Seller_Summary($order,$items,$sellers);
               }
          }
		  */	
          $results = array( 'list'=> $list,'records'=> $records );
          return $results;
     }

    function totalOrder($filter){
        vst_buildFilter($filter);
        $query = $this->db->select ($this->table_orders.'.*,'.$this->table_customers.'.*');
        $query = $this->db->from($this->table_orders);
        $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
        $query = $this->db->get();
		return $query->num_rows();
    }
	
	/*chi tiết đơn hàng
	
	function orderDetail($param){
		$this->db->select('*');
		$this->db->from($this->table_orders);
		$this->db->join($this->table_customers, $this->table_orders.'.cid = '.$this->table_customers'.cid');
		$this->db->join($this->table_items, $this->table_orders.'.id = '.$this->table_items.'.oid');
		$this->db->join($this->table_order_seller, $this->table_orders.'.id = '.$this->table_items.'.oid');
	}
	*/
	/*
    lấy danh sách sản phẩm trong một đơn hàng hoặc người bán
   */
   function getItems($oid,$sid=0)
   {
    $this->db->select ( '*' );
    $this->db->from($this->table_items);
    $this->db->where(array('oid'=>$oid));
    if($sid){
      $this->db->where(array('sid'=>$sid)); 
    }
    $query = $this->db->get();
    $res = $query->result_array();
    return $res;
   }

  
}

?>