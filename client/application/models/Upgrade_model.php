<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_model extends MY_Model
{
	private $table_category = 'categories';
    private $table_product = 'products';
    private $table_order_items = 'order_items';
    private $table_pages = 'pages';
	
	
	function v1()
	{
		/* Modify table */
		$result = $this->db->query("SHOW COLUMNS FROM `".$this->db->dbprefix.$this->table_product."` LIKE 'is_featured'");
		if($result->num_rows() > 0){
			$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' DROP is_featured');
		}
		$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' ADD `is_featured` INT(1) NOT NULL DEFAULT "0"');
		
	} 
	function v2()
	{
		$result = $this->db->query("SHOW COLUMNS FROM `".$this->db->dbprefix.$this->table_category."` LIKE 'slug'");
		if($result->num_rows() > 0){
			$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_category.' DROP slug');
		}
		$this->db->query("ALTER TABLE ".$this->db->dbprefix.$this->table_category." ADD `slug` VARCHAR(255) NULL");
		$data_resuts= $this->db->query("SELECT * FROM ".$this->db->dbprefix.$this->table_category);
		foreach($data_resuts->result() as $data){
			$slug= url_title(cleanVietnamese($data->name),'-',true);
			$this->db->query("UPDATE ".$this->db->dbprefix.$this->table_category." SET slug='$slug' WHERE id= $data->id");
		}
	}
	function v3()
	{
		$result = $this->db->query("SHOW COLUMNS FROM `".$this->db->dbprefix.$this->table_product."` LIKE 'views'");
		if($result->num_rows() > 0){
			$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' DROP `views`');
		}
		$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' ADD `views` INT NOT NULL DEFAULT "0"');
	}
	function v4()
	{
		$result = $this->db->query("SHOW COLUMNS FROM `".$this->db->dbprefix.$this->table_product."` LIKE 'sales'");
		if($result->num_rows() > 0){
			$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' DROP sales');
		}
		$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' ADD sales INT NOT NULL DEFAULT "0"');
		$order_total= $this->db->query('SELECT pid, SUM(item_quantity) as order_total FROM '.$this->db->dbprefix.$this->table_order_items.' GROUP BY pid');
		if($order_total->num_rows()>0){
			foreach($order_total->result_array() as $data){
				$this->db->query('UPDATE '.$this->db->dbprefix.$this->table_product.' SET sales='.$data['order_total'].' WHERE id='.$data['pid']);
			}
		}
	}
	function v5()
	{
		$result= $this->db->query('SHOW COLUMNS FROM '.$this->db->dbprefix.$this->table_product.' LIKE "image"');
		if($result->num_rows() > 0){
			$this->db->query('ALTER TABLE '.$this->db->dbprefix.$this->table_product.' DROP image');
		}
	}
	function v6()
	{
		$this->db->query('CREATE TABLE vt_pages (
							id INT(11) AUTO_INCREMENT PRIMARY KEY,
							uid INT(11) NOT NULL,
							title VARCHAR(255) NOT NULL,
							content LONGTEXT,
							featured_img VARCHAR(255),
							slug VARCHAR(255) NOT NULL,
							created_date DATETIME NOT NULL
							)');
		$this->db->query('INSERT INTO '.$this->db->dbprefix.$this->table_pages.'(`uid`, `title`, `content`, `featured_img`, `slug`, `created_date`) 
							VALUES(1, "Day la tieu de", "Day la noi dung", "static/images/2b0189262b29b2b9fca736445163efc4.jpg", "day-la-tieu-de", "2016-11-30 04:17:17")');
	}
}

?>
