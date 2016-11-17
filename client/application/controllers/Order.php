<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("order_model");
	}

	public function index(){
		$this->load->view('layout/home', $data);
		
	}
	
	// Detail Order
	public function detail($order_id){
		$param= array('vt_order.id'=>$order_id);
		$info= $this->order_model->listOrder(array(), 0, 0, $param);
		print_r($info);
		$data['template'] = 'order/detail';
		$data['data']['info'] = 'order/detail';
		$this->load->view('layout/home', $data);
	}
	
	// Detail Order
	public function lists(){
		$currentCustomer =  vst_getCurrentCustomer();
		$cid= $currentCustomer['cid'];
		$param=array('vt_order.cid'=>$cid);
		$list_order = $this->order_model->listOrder(array(), 0, 0, $param);
		$list_order_new= array();
		print_r($list_order);
		foreach($list_order['list'] as $row){
			$newkey= $row['id'];
			$list_order_new[$newkey]['invoiceid']=$row['invoiceid'];
			$list_order_new[$newkey]['create_date']=$row['create_date'];
			$list_order_new[$newkey]['seller_name']=$row['seller_name'];
			$list_order_new[$newkey]['seller_link']=$row['seller_link'];
			$list_order_new[$newkey]['status']=$row['status'];
			$list_order_new[$newkey]['data'][]=$row;
		}
		print_r($list_order_new);
		$data['data']['list_order']=$list_order_new;
		$data['template'] = 'order/list';
		$this->load->view('layout/home', $data);
	}
	
}
