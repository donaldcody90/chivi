<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_model extends MY_Model
{
	private $table_category = 'categories';
    private $table_product = 'products';
	
	
	function v1()
	{
		/* Modify table */
		$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' DROP is_featured');
		$this->db->query("ALTER TABLE ".$this->db->dbprefix.$this->table_product." ADD `is_featured` INT(1) NULL DEFAULT '0'");
		
	} 
	function v2()
	{
		$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_category.' DROP slug');
		$this->db->query("ALTER TABLE ".$this->db->dbprefix.$this->table_category." ADD `slug` VARCHAR(255) NULL");
		$data_resuts= $this->db->query("SELECT * FROM ".$this->db->dbprefix.$this->table_category);
		foreach($data_resuts->result() as $data){
			$slug= url_title(cleanVietnamese($data->name),'-',true);
			$this->db->query("UPDATE ".$this->db->dbprefix.$this->table_category." SET slug='$slug' WHERE id= $data->id");
		}
	}
}

?>
