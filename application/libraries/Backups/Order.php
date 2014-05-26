<?php

class Project {
	
	public $id;
	public $nama;
	public $tanggal;
	public $project;
	public $pelanggan;
	public $status;
	public $harga;
	
	public function __construct($dataArray) {
		$id = $dataArray["id"];
		$nama = $dataArray["nama"];
	}
	
}

//....