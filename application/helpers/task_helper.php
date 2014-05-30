<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('get_list_prioritas'))
{
	function get_list_prioritas()
	{
		$prioritas = array('rendah' => 'rendah', 'sedang' => 'sedang', 'tinggi' => 'tinggi', 'mendesak' => 'mendesak');
		return $prioritas;
	}
}