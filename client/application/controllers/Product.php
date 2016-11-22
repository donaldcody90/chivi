<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("product_model");
		$this->load->model("shop_model");
	}

	public function detail($pid){
		@session_start();
		if(!isset($_SESSION["lastviewed"])) {
		  $_SESSION["lastviewed"] = array();
		}
		$maxelements = 5;
		if (isset($pid) && $pid <> "") {// if we have url parameter
			if (in_array($pid, $_SESSION["lastviewed"])) { // if product id is already in the array
				$_SESSION["lastviewed"] = array_diff($_SESSION["lastviewed"],array($pid)) ; // remove it
				$_SESSION["lastviewed"] = array_values($_SESSION["lastviewed"]); //optionally, re-index the array
			}
			if (count($_SESSION["lastviewed"]) >= $maxelements) {//check the number of array elements
			$_SESSION["lastviewed"] = array_slice($_SESSION["lastviewed"],1); // remove the first element if we have 5 already
			array_push($_SESSION["lastviewed"],$pid);//add the current itemid to the array
			} else {
			array_push($_SESSION["lastviewed"],$pid);//add the current itemid to the array
			}
		}

		$product = $this->product_model->getProduct($pid);
		$param1= array('sid'=> $product['sid']);
		$param2= array('sid' => $product['sid'], 'id !=' => $product['id']);
		$param3= $this->session->userdata('lastviewed');
		$product_total= count($this->shop_model->getAllProduct($param1));
		$data['data']['same_shop_products']= $this->shop_model->getAllProduct($param2, $limit=10);
		$data['data']['newProducts']= $this->product_model->getNewProductList($limit=10);
		$data['data']['lastviewed']= $this->product_model->getProduct(null, $param3);
		print_r($data['data']['lastviewed']);
		$product['shop_product_total']=$product_total;
		$data['data']['product'] = $product;
		$data['template'] = 'product/detail';
		$this->load->view('layout/home', $data);

	}
	
	// Detail Order
	public function detail2(){
		$pid = $this->input->get('pid');
		$product = $this->product_model->getProduct($pid);
		$data['data'] = $product;
		$data['template'] = 'product/detail';
		$this->load->view('layout/home', $data);
	}
	
	
}
