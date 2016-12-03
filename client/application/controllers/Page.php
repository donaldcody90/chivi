<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}

	public function detail($slug,$page_id){
		$param= array('id'=>$page_id);
		$page_info= $this->page_model->findPage($param);
		if($page_info['id']== $page_id){
			if($page_info['slug']!= $slug){
				redirect(site_url($page_info['slug'].'-p'.$page_info['id']));
			}
			$date= new DateTime($page_info['created_date']);
			$day= $date->format('j/n/Y');
			$time= $date->format('H:i');
			unset($page_info['created_date']);
			$page_info['created_day']= $day;
			$page_info['created_time']= $time;
			
			$page_content= $page_info;
			
			
		}else{
			redirect(site_url('404'));
		}
		
		// $time = new DateTime("2011-08-04 15:00:01");
		// $date = $time->format('j/n/Y');
		// $time = $time->format('H:i');
		// echo 'Date ='.$date;
		// echo 'Time ='.$time;
		
		$data['page_content']= $page_content;
		$data['template'] = 'page/view';
		$this->load->view('layout/home', $data);
	}
	
	
}
