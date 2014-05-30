<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('get_job_title'))
{
	function get_job_title($id)
	{
		$title;
		switch($id)
		{
			case 255 : $title = 'administrator'; break;
			case 1 : $title = 'karyawan'; break;
			case 2 : $title = 'project manager'; break;
			case 3 : $title = 'hr manager'; break;
			case 4 : $title = 'sales manager'; break;
			case 5 : $title = 'sales officer'; break;
		}
		return $title;
	}
}

if( ! function_exists('get_list_job_title'))
{	
	function get_list_job_title()
	{
		return array(
			255 => 'administrator',
			1 => 'karyawan',
			2 => $title = 'project manager',
			3 => $title = 'hr manager',
			4 => $title = 'sales manager',
			5 => $title = 'sales officer'
		);
	}
}