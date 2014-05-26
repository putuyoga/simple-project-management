<?php

class Project {
	
	public $id;
	public $nama;
	public $tanggal_mulai;
	public $tanggal_selesai;
	public $anggota_tim;
	public $list_task;
	public $order;
	
	public function __construct($dataArray) {
		$id = $dataArray["id"];
		$nama = $dataArray["nama"];
		$list_task = array();
		$anggota_tim = array();
	}
	
}

//....