<?php

class User {
	
	public $id;
	public $nama;
	public $email;
	
	public function __construct($dataArray) {
		$id = $dataArray["id"];
		$nama = $dataArray["nama"];
		$email = $dataArray["email"];
	}
	
}

//....