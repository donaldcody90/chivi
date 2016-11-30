<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_model extends MY_Model
{
	private $table_category = 'categories';
    private $table_product = 'products';
	
	
	function v1()
	{
		/* Modify table */
		$this->db->query("ALTER TABLE ".$this->db->dbprefix.$this->table_product." ADD `is_featured` INT(2) NOT NULL DEFAULT '0'");
		$this->db->query("ALTER TABLE ".$this->db->dbprefix.$this->table_category." ADD `slug` VARCHAR(255) NULL");
		$name= $this->db->query("SELECT 'id','name' FROM ".$this->db->dbprefix.$this->table_category);
		foreach($name as $data){
			$slug= url_title(cleanVietnamese($data['name']),'-',true);
			$this->db->query("UPDATE ".$this->db->dbprefix.$this->table_category." SET 'slug'= $slug WHERE 'id'= $data['id']");
		}
	} 
}

?>
