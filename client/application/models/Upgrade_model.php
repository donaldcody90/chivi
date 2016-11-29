<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_model extends MY_Model
{
	private $table_category = 'categories';
    private $table_product = 'products';
	
	
	function v1()
	{
		/* Modify table */
		$sql= "ALTER TABLE `vt_products` ADD `is_featured` INT(2) NOT NULL DEFAULT '0' AFTER `type`;";
		
		$this->db->query($sql);
	} 
}

?>
