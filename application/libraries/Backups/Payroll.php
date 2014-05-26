<?php

class Payroll {
	
	public $id;
	public $bulan;
	public $user;
	public $jumlah;
	
	public function __construct($dataArray) {
		$id = $dataArray["id"];
		$bulan = $dataArray["bulan"];
	}
	
}

//....