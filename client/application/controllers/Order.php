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
	public function detail($slug,$oid){
		
		
		$param= array('id' => $oid);
		$order= $this->order_model->orderDetail($param);
		//echo "<pre>";
		//print_r($info);
		$data['order'] = $order;
		$data['template'] = 'order/detail';
		//$this->load->view('layout/home', $data);
		 $this->load->view('layout/home',$data);
		 
	}
	
	// List Order
	public function lists(){
		
		$startdate = $this->input->get('filter_startdate_create_date');
		$enddate = $this->input->get('filter_enddate_create_date');
		$invoiceid = $this->input->get('filter_invoiceid');
		$status = $this->input->get('filter_status');
		
		if( empty($startdate)){
			$startdate = date('Y-m-01');
		}	
		if( empty($enddate)){
			$enddate = date('Y-m-d');
		}
		$startdate = vst_FormatDateTime($startdate,$formatDate="Y-m-d",$timeFormat="H:i:s",$time='00:00:01');
		$enddate =vst_FormatDateTime( $enddate,$formatDate="Y-m-d",$timeFormat="H:i:s",$time='23:59:59');
		
		$filter=vst_filterData(array('filter_invoiceid, filter_status'));
		
		
		$filter['startdate_create_date'] = array(
			'value' => $startdate,
			'condition' => 'date',
			'tbalias' => 'orders',
			);
		$filter['enddate_create_date'] = array(
			'value' => $enddate,
			'condition' => 'date',
			'tbalias' => 'orders',
			);	
		 
		$config = vst_pagination();
		$start = $this->input->get('page');

		$currentCustomer =  vst_getCurrentCustomer();
		$cid= $currentCustomer['id'];
		$param=array('cid'=>$cid);
		$list_order = $this->order_model->listOrder($filter, 2, $start, $param);
		$data['total_rows'] = $config['total_rows'] = $list_order['records'];
		
		$data['list_orders']=$list_order;
		$this->pagination->initialize($config);
		$data['template'] = 'order/list';
		$this->load->view('layout/home', $data);
		 
	}
	
	public function updateOrderStatus(){
		 
		$status = $this->input->post('status');
		$data = array( 'status' =>  $status );
		$param_where = array( 'id' => $this->input->post('oid'));
		$result = $this->order_model->updateOrder( $data,$param_where );
		if($result >= 1){
		  $res=array('Response'=>"Success","Message"=>"Đã thay đổi thành công");
		}else{
		  $res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
		}
		echo json_encode($res);	
	}
	
	
}
