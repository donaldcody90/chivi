<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_model extends MY_Model
{
	 function v1()
	 {
		/* Modify table */
		echo "<pre>";
		echo "Alter table categories<br/>";
	 } 
}

?>
