<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("upgrade_model");
	}

	public function v1(){
		$this->upgrade_model->v1();
		die("DONE");
	}
	
 
}
