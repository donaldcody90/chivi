<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('is_logged_in'))
{
	function is_logged_in() {
	
	    $CI =& get_instance();
	    $user = $CI->session->userdata('vkt_clientCustomer');
		if($user){
			return true;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('get_menu_items'))
{
	function get_menu_items($menu_id) {
	
		$CI =& get_instance();
		$table_menu_items = $CI->db->dbprefix('menu_items'); 
		$CI->db->select("*");
		$CI->db->from($table_menu_items);
		$CI->db->where(array('menu_id'=>$menu_id));
		$query=$CI->db->get();
		$rows=$query->result_array();
		if($rows){
			return $rows;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('build_menu_link'))
{
	function build_menu_link($id) {
	
		$CI =& get_instance();
		$table_menu_items = $CI->db->dbprefix('menu_items'); 
		$CI->db->select("*");
		$CI->db->from($table_menu_items);
		$CI->db->where(array('id'=>$id));
		$query=$CI->db->get();
		$row=$query->row_array();
		 
		if($row){
			switch($row['type'])
			{
			case 1:  
				$link = site_url('slug-p').$row['type_id'];
				break;
			case 2:  
				$link = site_url('slug-c').$row['type_id'];
				break;	
			case 3:  
				$link = $row['custom_link'];
				break;
			case 4:  
				$link = $row['custom_link'];
				break;
			default:
				$link= site_url();
			}
			return $link;				
		
		}	
	}
}


if(!function_exists('vst_pagination')){
	function vst_Pagination(){
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; ';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = ' &raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Trang sau &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Trang trước';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
        $config['per_page'] =10;
        $config['page_query_string'] =true;
        $config['query_string_segment'] ="page";
		$config['base_url'] =vst_currentUrl();
		return $config;
	}
}
if(!function_exists('vst_currentUrl')){
	function vst_currentUrl($withoutPage=true)
	{
		$CI =& get_instance();
		$url = $CI->config->site_url($CI->uri->uri_string());
		$params=$CI->input->get();
		if(isset($params['page']) && $withoutPage)
			unset($params['page']);
		$http_query=http_build_query($params, '', "&");
		return $http_query ? $url.'?'.$http_query : $url;
	}
}


if ( ! function_exists('vst_getPropertyValue'))
{
	function vst_getPropertyValue($id) {
		
	    $CI =& get_instance();
		$property_values_table = $CI->db->dbprefix('property_values'); 
		$CI->db->select("*");
		$CI->db->from($property_values_table);
		$CI->db->where(array('property_value_id'=>$id));
		$query=$CI->db->get();
		$row=$query->row_array();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('vst_getProperty'))
{
	function vst_getProperty($id) {
		
	    $CI =& get_instance();
		$properties_table = $CI->db->dbprefix('properties'); 
		$CI->db->select("*");
		$CI->db->from($properties_table);
		$CI->db->where(array('id'=>$id));
		$query=$CI->db->get();
		$row=$query->row_array();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
}



if ( ! function_exists('vst_getShop'))
{
	function vst_getShop($shop_id) {
	    $CI =& get_instance();
		$shop_table="vt_shops";
		$CI->db->select("*");
		$CI->db->from($shop_table);
		$CI->db->where(array('id'=>$shop_id));
		$query=$CI->db->get();
		$row=$query->row_array();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
}


if ( ! function_exists('vkt_checkAuth'))
{
	function vkt_checkAuth() {
	    $CI =& get_instance();
		if($CI->router->method !='addtocart')
		{
			$user = $CI->session->userdata('vkt_clientUser');
			if(!$user){
				$CI->load->helper('url');
				redirect(site_url('login'));
			}else{
				return true;
			}
		}else{
			return true; // Allow addtocart function
		}
	}
}

if ( ! function_exists('vst_textDate'))
{
	function vst_textDate() {
		$currentUser=vst_getCurrentUser();
		$txt = $currentUser['username'].' ['.date("d/m/Y H:i:s").']';
		return $txt;
	}
}



if ( ! function_exists('vst_getCurrentCustomer'))
{
	function vst_getCurrentCustomer() {
	    $CI =& get_instance();
	    $customer = $CI->session->userdata('vkt_clientCustomer');
		return $customer;
	}
}

if(!function_exists('vst_FormatDateTime')){
	function vst_FormatDateTime($date,$formatDate="d-m-Y",$timeFormat="H:i:s",$time=true){
		
		$formatDateTime=$formatDate.' '.$timeFormat;
		$date = $date.' '.$time;
		$valid_date = date($formatDateTime, strtotime($date));
		return $valid_date;
	}
}

if ( ! function_exists('vst_FormatDate'))
{
	function vst_FormatDate($date,$formatDate="d-m-Y",$timeFormat="H:i:s",$time=true) {
		
		if($time)  
		{
			$formatDateTime=$formatDate.' '.$timeFormat;
		}else{
			$formatDateTime=$formatDate;
		}
		$valid_date = date($formatDateTime, strtotime($date));
		return $valid_date;
	}
}
if ( ! function_exists('vst_currentDate'))
{
	function vst_currentDate($time=true,$formatDate="Y-m-d",$formatTime="H:i:s") {
		if($time){
			$dateTime=date($formatDate.' '.$formatTime);
		}else{
			$dateTime=date($formatDate);
		}
		return $dateTime;
	}
}

if ( ! function_exists('starts_with'))
{
	function starts_with($haystack, $needle)
	{
		return substr($haystack, 0, strlen($needle))===$needle;
	}
}

if ( ! function_exists('vst_getIPAddress'))
{
	function vst_getIPAddress() {
		return $_SERVER['REMOTE_ADDR'];;
	}
}


if(!function_exists('message_flash')){
	function message_flash($message = '', $type = 'success'){
		$CI =& get_instance();
		$CI->session->set_flashdata('message_flashdata', array(
			'type' => $type,
			'message' => $message
		));
	}
}

if(!function_exists('vst_password')){
	function vst_password($msg){
		return md5($msg);
	}
}

if(!function_exists('vst_Pagination')){
	function vst_Pagination($total=20, $per_page=10){
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; ';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = ' &raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Trang sau &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Trang trước';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
        $config['per_page'] =$per_page;
        $config['page_query_string'] =true;
        $config['query_string_segment'] ="page";
		$config['base_url'] =vst_currentUrl();
		$config['total_rows']= $total;
		return $config;
	}
}

if(!function_exists('vst_showPrice')){
	function vst_showPrice($price)
	{
		/*$array = explode(".",$price);
		if(isset($array[1])){
			$price = number_format($array[0]).'.'.$array[1];
		}else{
			$price = number_format($array[0]);	
		}*/
		return number_format($price);
	}
}

if ( ! function_exists('getStoreText'))
{
	function getStoreText($store)
	{
		if($store =='1'){
			return "<span class='bold black'>Kho SG</span>";
		}else if($store =="0"){
			return "<span class='bold green'>Kho HN</span>";
		}else{
			return "<span class='bold red'>N/A</span";
		}
	}
}

if(!function_exists('vst_currentUrl')){
	function vst_currentUrl($withoutPage=true)
	{
		$CI =& get_instance();
		$url = $CI->config->site_url($CI->uri->uri_string());
		$params=$CI->input->get();
		if(isset($params['sort']) && isset($params['sortType'])){
			unset($params['sort']);
			unset($params['sortType']);
		}
		if(isset($params['page']) && $withoutPage)
			unset($params['page']);
		$http_query=http_build_query($params, '', "&");
		return $http_query ? $url.'?'.$http_query : $url;
	}
}

if(!function_exists('vst_filterData')){
	function vst_filterData($likeFields=array(),$whereFieldsDate=array(),$tablealias=array())
	{
		$CI =& get_instance();
		$params= $CI->input->get();
		 
		unset($params['page']);
		#unset($params['sortType']);
		#unset($params['sort']);
		$filterData= array();
		if($params){
			foreach($params as $key=>$value){
				if($value!=''){
					$table_alias="";
					if(isset($tablealias[str_replace('filter_','',$key)]))
					{
						$table_alias= $tablealias[str_replace('filter_','',$key)];
					}
					if(in_array($key,$likeFields))
					{	
						$filterData[str_replace('filter_','',$key)]= array('value'=>trim($value),'condition'=>'like','tbalias'=>$table_alias);
					}
					elseif(in_array($key,$whereFieldsDate))
					{
						$filterData[str_replace('filter_','',$key)]= array('value'=>trim($value),'condition'=>'date','tbalias'=>$table_alias);
					}
					else
					{
						$filterData[str_replace('filter_','',$key)]= array('value'=>trim($value),'condition'=>'where','tbalias'=>$table_alias);
					}
				}
			}
		}
		return $filterData;
		
	}
}


if(!function_exists('vst_getData')){
	function vst_postData()
	{
		$CI =& get_instance();
		$params=$CI->input->post();
		$filterData=array();
		if($params){
			foreach($params as $key=>$value){
				if( $key!='save' && $key!='update' && $value!='' && $key!='updatepass'){
					$filterData[$key]  = $value;
				}
			}
		}
		return $filterData;
	}
}

if(!function_exists('vst_buildFilter')){
	function vst_buildFilter($filter)
	{
		$CI =& get_instance();
		if($filter){
			foreach ($filter as $key => $value) {
				if(!empty($value['tbalias']))
					{
						$key=$value['tbalias'].".".$key;
					}
                switch ($value['condition']) {
					
                   case 'like':
                        $query = $CI->db->like(array($key=>$value['value']));
                        break;
                   case 'where':
                       $query = $CI->db->where(array($key=>$value['value']));
                       break;
                   case 'date':
                   		if (strpos($key, 'startdate_') !== false) {
                   			$key=str_replace("startdate_","",$key);
                   			$query = $CI->db->where( $key.' >=',$value['value'] );
                   		}else if (strpos($key, 'enddate_') !== false) {
						  	$key=str_replace("enddate_","",$key);
							$query = $CI->db->where( $key.' <=',$value['value'] );
						}else{
							$query = $CI->db->where( $key.' ==',$value['value'] );
						}
                      
                   	   break;
                   default:
                       # code...
                     break;
               }
            }
		}
	}
}

if(!function_exists('get_setting_meta')){
function get_setting_meta($meta_key,$return_row=false)
	{
		$CI =& get_instance();
		$setting_table="vt_setting";
		$CI->db->select("*");
		$CI->db->from($setting_table);
		$CI->db->where(array('meta_key'=>$meta_key));
		$query=$CI->db->get();
		$row=$query->row_array();
		if($row){
			if($return_row)
				return $row;
			return $row['meta_value'];
		}else{
			return false;
		}
	}
}



if ( ! function_exists('get_cart_number_items'))
{
	function get_cart_number_items($vkt_usercart)
	{
		if(empty($vkt_usercart)){ $value = 0; }
		else{
			$value = 0;
			foreach ($vkt_usercart as $key => $item) {
                foreach ($item['items'] as $k => $v) {
                    $value += ($v['item_quantity']);

                };
            }
		}
		  
		return $value;
	}
}
if ( ! function_exists('getCartData'))
{
	function getCartData($user_id=null)
	{
		$CI = get_instance();
		$CI->load->model('cart_model');
		return $CI->cart_model->getCartData();
	}
}

if(!function_exists('order_status')){
	function order_status($status_id){
		$statusText="<span class='chuaduyet'>Chưa duyệt</span>";
		switch($status_id)
		{
			case -1:
				$statusText="<span class='dahuy'>Đã hủy</span>";
				break;
			case 0:
				$statusText="<span class='chuaduyet'>Chưa duyệt</span>";
				break;
			case 1:
				$statusText="<span class='daduyet'>Đã duyệt</span>";
				break;
			case 2:
				$statusText="<span class='dathanhtoan'>Đã thanh toán - chờ mua hàng</span>";
				break;
			case 3:
				$statusText="<span class='damuahang'>Đã mua hàng</span>";
				break;
			case 4:
				$statusText="<span class='hangdave'>Hàng đã về - chờ giao hàng</span>";
				break;
			case 5:
				$statusText="<span class='daketthuc'>Đã kết thúc</span>";
				break;
			default:
				$statusText="<span class='chuaduyet'>Chưa duyệt</span>";
		}
		return $statusText;
	}
}



if(!function_exists('vst_array_status')){
	function vst_array_status(){
		 $status = array(
			0 => "Chờ xử lý",
			1 => "Đã duyệt",
			2 => "Đã thanh toán",
			3 => "Đã mua hàng",
			4 => "Hàng đã về - Chờ giao",
			5 => "Kết thúc",
			-1 => "Đã hủy",
		 );
		 return $status;
	}
}



if(!function_exists('cleanVietnamese')){
	function cleanVietnamese($str)
	{
		$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|ä|å|æ',
		'd'=>'đ|ð',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ä|Å|Æ',
		'D'=>'Đ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë',
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		' '=>'-'
		);
		foreach($unicode as $nonUnicode=>$uni)
		{
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}
		return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace('','',$str)));

	}
}

if(!function_exists('vst_buildSlug')){
	function vst_buildSlug($title)
	{
		return url_title(cleanVietnamese($title),'-',true);
	}
}

if ( ! function_exists('vst_buildRewriteURL'))
{
 /*
  $id : id of category, id of shop, id of product, id of page
  $title : text title
  $type : category,shop,product,page,menu
 */
	function vst_buildRewriteURL($id,$slug,$type)
	{
		if(empty($id)){
			return site_url('404');
		}
		$rewriteURL=$slug;
		switch($type)
		{
			case 'category':
				$rewriteURL .="-c".$id;
				break;
			case 'shop':
				$rewriteURL .="-s".$id;
				break;
			case 'product':
				$rewriteURL .="-i".$id;
				break;
			case 'page':
				$rewriteURL .="-p".$id;
				break;
			case 'menu':
				$rewriteURL .="-m".$id;
				break;
			default :
				$rewriteURL='404';
				break;
		}
		return site_url($rewriteURL);
 
	}
}
