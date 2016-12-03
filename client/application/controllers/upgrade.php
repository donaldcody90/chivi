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
	public function v2(){
		$this->upgrade_model->v2();
		die("DONE");
	}
	public function v3(){
		$this->upgrade_model->v3();
		die("DONE");
	}
	public function v4(){
		$this->upgrade_model->v4();
		die("DONE");
	}
	public function v5(){
		$this->upgrade_model->v5();
		die("DONE");
	}
	public function v6(){
		$this->upgrade_model->v6();
		die("DONE");
	}
	
 
}
