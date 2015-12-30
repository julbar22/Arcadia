<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Conexionbd_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function verUsuario($data){
	$conn = oci_connect('system', '123', 'localhost/XE');
    if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
 }



	}
}



?>