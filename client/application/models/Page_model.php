<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends MY_Model
{

    private $table_page = 'pages';


	function findPage($params_where, $is_list= false){
        return $this->_getwhere(array(
					'table'        	=> $this->table_page,
					'param_where'  	=> $params_where,
					'list'			=> $is_list
				));
    }
	
}	