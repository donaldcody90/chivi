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
	
	// List Order
	public function lists(){
		$currentCustomer =  vst_getCurrentCustomer();
		$cid= $currentCustomer['id'];
		$param=array('cid'=>$cid);
		$list_order = $this->order_model->listOrder(array(), 0, 0, $param);
		 var_dump($list_order);
		 
		$data['list_orders']=$list_order;
		$data['template'] = 'order/list';
		$this->load->view('layout/home', $data);
	}
	
}
