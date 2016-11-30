<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends MY_Model
{

     private $table_orders = 'orders';
     private $table_customers = 'customers';
     private $table_order_items = 'order_items';
	 private $table_products='products';
	 private $table_shops='shops';

     function __construct()
     {
          parent::__construct();
     }

	// List Order
    function listOrder($filter=array(),$total=0,$start=0, $param){
          vst_buildFilter($filter);
          $query = $this->db->select($this->table_orders.'.*,');
          $query = $this->db->from($this->table_orders);
          $query = $this->db->where($param);
          $query = $this->db->order_by($this->table_orders.'.id', 'desc');          
          $query = $this->db->limit($total, $start);
          $query = $this->db->get();
          $records = $query->num_rows();
          $list = $query->result_array();
          
		  if($list)
          {
               foreach($list as $key=>$order){
                 $items=$this->getItems(array('oid' => $order['id']));
				 $total_amount = 0;
				 foreach($items as $k => $item){
					 $item_amount = $item['item_price'] * $item['item_quantity'];
					 $total_amount = $total_amount + $item_amount;
				 }
				 $list[$key]['total_amount'] = $total_amount;
				 $list[$key]['total_item'] = count($items);
               }
          }
		  
          $results = array( 'lists'=> $list,'records'=> $records );
           
          return $results;
     }
	 
	// Tìm khách hàng
	function findCustomer($params_where){
           $customer = $this->_getwhere(array(
                    'table'        => $this->table_customers,
                    'param_where'  => $params_where
        ));
          return $customer;
       }
	
	// Tìm sản phẩm
	function findProduct($params_where){
		$query = $this->db->select($this->table_products.'.title,'.$this->table_products.'.link,'.$this->table_products.'.sid,');
		$query = $this->db->from($this->table_products);
		$query = $this->db->where($params_where);
		$query = $this->db->get();
		return $query->row_array() ;
    }

	
	function orderDetail($param,$filter=null){
		  vst_buildFilter($filter);
          $query = $this->db->select($this->table_orders.'.*,');
          $query = $this->db->from($this->table_orders);
          $query = $this->db->where($param);
          $query = $this->db->get();
        
          $order = $query->row_array();
          
		  if($order)
			{
                
                 $items=$this->getItems(array('oid' => $order['id']));
				 $total_amount = 0;
				 
				 foreach($items as $k => $item){
					 $item_amount = $item['item_price'] * $item['item_quantity'];
					 $total_amount = $total_amount + $item_amount;
					 $product = $this->findProduct(array('id' => $item['pid']));
					 $items[$k]['title'] =  $product['title'];
					 $items[$k]['link'] =  $product['link'];
					 $items[$k]['sid'] =  $product['sid'];
					 $sids[$product['sid']] = array(
							'sid' => $product['sid'],
							'items' => array(),
					 );
				 }
				 $order['total_amount'] = $total_amount;
				 $order['total_item'] = count($items);
				  
				  
				 $order['customer'] = $this->findCustomer($order['cid']);
				 if($sids){
					foreach($sids as $k => $sid){
						foreach($items as $k1 => $item){
							if( $item['sid'] == $sid['sid'] ){
								$sids[$k]['items'][$k1] = $item;
							}
						}
					}
				 }
				 $order['shops'] = $sids;
				 
			}
           
          return $order;
}
	/*
    lấy danh sách sản phẩm trong một đơn hàng hoặc người bán
   */
   function getItems($params_where)
   {
    $this->db->select ( '*' );
    $this->db->from($this->table_order_items);
    $this->db->where($params_where);
    $query = $this->db->get();
    $res = $query->result_array();
    return $res;
   }

  
}

?>