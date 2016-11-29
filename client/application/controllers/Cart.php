<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("cart_model");
		$this->load->model("customers_model");
		$this->load->model("shop_model");
	}

	public function index(){
		$current_customer = vst_getCurrentCustomer();
		$cid= $current_customer['id'];
		$params_where=array('cid'=>$cid);
		
		$data['array_product'] = $this->cart_model->getCartData($params_where);
		
		$bill_total=null;
		foreach($data['array_product'] as $data2){
			foreach($data2['items'] as $data3){
				$bill_total+= $data3['price']*$data3['qty'];
			}
		}
		$data['bill_total']= number_format($bill_total);
		
		$data['template'] = 'cart/cart';
		$this->load->view('layout/home', $data);
		
	}
	
	// Detail Order
	public function addToCart(){
		//var_dump($this->input->post());
		$rs= array('status'=>'success','message'=>'Sản phẩm quý khách chọn mua đã được thêm vào giỏ hàng thành công.');
		echo json_encode($rs);
		die;
		if (is_logged_in()) { 
		$array_product = array(
			'id' => $this->input->post('pid'),
			'title' => $this->input->post('title'),
			'image' => $this->input->post('image'),
			'link' => $this->input->post('link'),
			'price' => $this->input->post('price'),
			'qty' => $this->input->post('qty'),
			'sid' => $this->input->post('sid'),
			'attrs' => $this->input->post('submitattr[]'),
		);
		
		$current_customer = vst_getCurrentCustomer();
		
		$params_where = array('cid'=>$current_customer['id']);
		$cartdata_arr = $this->cart_model->getCartData($params_where);
		
		if(!empty($cartdata_arr)){
			
			if(isset($cartdata_arr[$array_product['sid']]))
			{
				if(isset($cartdata_arr[$array_product['sid']]['items'][$array_product['id']]))
				{
					$cartdata_arr[$array_product['sid']]['items'][$array_product['id']]['qty'] += $array_product['qty'];
				}else{
					$cartdata_arr[$array_product['sid']]['items'][$array_product['id']]=$array_product;	
				}
			}else{
				$shop = $this->shop_model->findShop(array('id'=>$array_product['sid']));
				$sid = $array_product['sid'];
				$cartdata_arr[$sid] = array(	 
					'sid' => $array_product['sid'],
					'shop_name' => $shop['name'],
					'items' => array(
					$array_product['id'] => $array_product,	
					),
				);
			}
		}
		else
		{
			$shop = $this->shop_model->findShop(array('id'=>$array_product['sid']));
			$sid = $array_product['sid'];
			$cartdata_arr[$sid] = array(	 
				'sid' => $array_product['sid'],
				'shop_name' => $shop['name'],
				'items' => array(
				$array_product['id'] => $array_product,	
				),
			);
		}
		 
		$result = $this->cart_model->updateCartData($cartdata_arr,$current_customer['id']);
		
		if($result){
			message_flash('Bạn đã thêm thành công!','success');
			redirect(site_url('cart'));
		}else{
			message_flash('Bạn chưa thêm thành công!','error');
			redirect(site_url('cart'));
		}
		}else{
			message_flash('Bạn phải đăng nhập để mua hàng!','error');
			redirect(site_url('auth'));
		}
	}
	
	
	// Insert Order vào DB
	public function checkout(){
		
		$arr_id = $this->input->post('checkbox');
		$currentCustomer = vst_getCurrentCustomer();
		$params_where = array('cid'=>$currentCustomer['id']);
		$vkt_cart = $this->cart_model->getCartData($params_where['cid']);
	
		if($this->input->post('confirm_order')){
		$checkbox = $this->input->post('checkbox');
		//print_r($checkbox);die;
			if(count($checkbox)){
				//$vkt_cart = $this->session->userdata('vkt_cart');
				
				if(!count($vkt_cart)){
					message_flash('Giỏ hàng trống!','error');
					//redirect(site_url('cart'));
				}
				
				
				$seller_item_selected=array();
				foreach($checkbox as $checked_items){
					$temp=explode('{:::}',$checked_items);
					$seller_item_selected[$temp[0]]['items'][]=$temp[1];
				}
				
				if(!count($seller_item_selected))
				{
					message_flash('Bạn chưa chọn mua sản phẩm nào!','error');
					//redirect(site_url('cart'));
				}
				var_dump($seller_item_selected);
				//$currentCustomer=vst_getCurrentUser();
				
				$username  = $currentCustomer['username'];				
				$invoiceid = $this->created_invoiceid($username);
				$customers = $this->customers_model->findCustomer(array('id'=> $currentCustomer['id']));
				$order_data=array(
					'cid'=>$currentCustomer['id'],
					'invoiceid'=>$invoiceid,
					'create_date'=> vst_currentDate($time=true,$formatDate="Y-m-d",$formatTime="H:i:s"),
					'status'=> 1,
					'note' => ''
				);
			
				$oid=$this->cart_model->createOrder($order_data);
				if($oid){
					foreach($vkt_cart as $seller_id=>$sellers_info)
					{
						if(isset($seller_item_selected[$seller_id]) && count($seller_item_selected[$seller_id]['items'])){
							// Insert Item Info
								$items_selected=$seller_item_selected[$seller_id]['items'];
								 if(count($sellers_info['items']))
								 {
									 foreach($sellers_info['items'] as $outer_id=>$item)
									 {
										 if(in_array($outer_id,$items_selected))
										 {
											 $item_data=array(
												'oid'=>$oid,
												'pid'=>$outer_id,
												//'item_title'=>$item['name'],
												'item_image'=>$item['image'],
												//'item_link'=>$item['link'],
												//'item_price'=>$item['price'],
												'item_quantity'=>$item['qty'],
												'item_attrs'=>'',
												'item_note'=>'',
												
											);
											$new_item_id=$this->cart_model->insertItem($item_data);
											if($new_item_id){
												// unset when insert success
												unset($vkt_cart[$seller_id]['items'][$outer_id]);
											}
										 }
										 
									 }
								 }
									
							
						}
					}
					foreach($vkt_cart as $seller_id=>$sellers_info)
					{
						if(!count($vkt_cart[$seller_id]['items']))
						{
							unset ($vkt_cart[$seller_id]);
						}
					}
					// Set again cart data
					//$this->session->set_userdata('vkt_cart',$vkt_cart);
					$this->cart_model->updateCartData($vkt_cart);
				}
				message_flash('Bạn vừa tạo thành công đơn hàng: '.$invoiceid,'success');
				redirect(site_url('order/lists'));
			}else{
				message_flash('Bạn chưa chọn mua sản phẩm nào!','error');
				redirect(site_url('cart'));
			}	
		
		}
		$arr['vkt_cart'] = $vkt_cart;
		$arr['user'] = $currentCustomer;
		$this->load->view('layout/home', $arr);
	}
	
	public function created_invoiceid($username)
	{
		$i = 1;
		do {
		    $invoiceid = $username.'-'.vst_currentDate($time=false,$formatDate="Y-m-d",$formatTime="").'-'.$i;
		    $i++;
		} while ( $this->cart_model->checkInvoice( $params_where=array('invoiceid'=>$invoiceid) ) );

		return $invoiceid;
	}
	
	function removeProduct($product_id=null){
		if($product_id != ''){
			$cart_data= $this->cart_model->getCartData();
			//echo '<pre>'; print_r($cart_data); echo '</pre>';
			foreach($cart_data as $cart_data1){
				//echo '<pre>'; print_r($cart_data1); echo '</pre>';
				foreach($cart_data1['item'] as $key => $cart_data2){
					
					if($cart_data2['id']==$product_id){
						unset($cart_data1['item']["$key"]);
					}
					
				//echo '<pre>'; print_r($key); echo '</pre>';
				}
			}
		}else{
			$currentCustomer =  vst_getCurrentCustomer();
			$cid=$currentCustomer['cid'];
			$param_where= array('cid'=>$cid);
			$this->cart_model->delete_cart_data($param_where);
			redirect('cart');
		}
	}
	
	// Clear Cart
	public function clearCart($qty = null){
		if(isset($qty)){
			$outer_id=$this->input->post('outer_id');
			$shop_id=$this->input->post('shop_id');
			
			if(empty($outer_id) || empty($shop_id) ){
				$res_json=array('Response'=>"Error","Message"=>"Cập nhật không thành công." );
				return $res_json;
			}else{
				$current_customer = vst_getCurrentCustomer();
				$cid= $current_customer['id'];
				$params_where=array('cid'=>$cid);
				$vkt_cart = $this->cart_model->getCartData($params_where);
				unset($vkt_cart[$shop_id]['items'][$outer_id]);
				if(!count($vkt_cart[$shop_id]['items']))
				{
					unset ($vkt_cart[$shop_id]);
				}
				$this->cart_model->updateCartData($vkt_cart);
				
				$res_json=array('Response'=>"Success","Message"=>"Đã xóa sản phẩm." );
				return $res_json;
			}
		}else {
			$vkt_cart=array();
			$this->cart_model->updateCartData($vkt_cart);
			#$this->session->set_userdata('vkt_cart',$vkt_cart);
			//$res_json=array('Response'=>"Success","Message"=>"Không có sản phẩm nào trong giỏ hàng." );
			message_flash('Không có sản phẩm nào trong giỏ hàng','error');
			redirect(site_url('cart'));
		}
		
	}
	
	
	//Update Cart
	public function updateCart(){
		
		
		$qty=$this->input->post('qty');
		$item_note=$this->input->post('item_note');

		$outer_id=$this->input->post('outer_id');
		$shop_id=$this->input->post('shop_id');
		
		if(empty($outer_id) || empty($shop_id))
		{
			$res_json=array('Response'=>"Error","Message"=>"Cập nhật không thành công.".$outer_id.'--'.$shop_id );
			
		}else{
			$current_customer = vst_getCurrentCustomer();
			$cid= $current_customer['id'];
			$params_where=array('cid'=>$cid);
			$vkt_cart = $this->cart_model->getCartData($params_where);
				
			if( isset($qty) && ($qty <=0))
			{
				$res_json = $this->clearCart($qty);

			}else if( isset($qty) && ($qty >0)){
				
				$vkt_cart[$shop_id]['items'][$outer_id]['qty']=$qty;
				// update 
				//$this->session->set_userdata('vkt_cart',$vkt_cart);
				$this->cart_model->updateCartData($vkt_cart);
				$res_json=array('Response'=>"Success","Message"=>"Đã cập nhật" );
			}
			if($item_note && $item_note!='')
			{
					$vkt_cart[$shop_id]['items'][$outer_id]['item_note']=$item_note;
					
					// update 
					//$this->session->set_userdata('vkt_cart',$vkt_cart);
					$this->cart_model->updateCartData($vkt_cart);
					$res_json=array('Response'=>"Success","Message"=>"Đã cập ghi chú" );
			}
		}
		
		echo json_encode($res_json);
	}
 
}
