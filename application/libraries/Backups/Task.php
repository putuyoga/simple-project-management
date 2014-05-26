<?php

class Task {
	
	public $id;
	public $nama;
	public $project;
	public $ditugaskan;
	public $prioritas;
	public $progress;
	public $deskripsi;
	
	public function __construct($dataArray) {
		$id = $dataArray["id"];
		$nama = $dataArray["nama"];
	}
	
}

//....