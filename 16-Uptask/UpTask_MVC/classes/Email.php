<?php
namespace Classes;

class Email {
	protected $email;
	protected $nombre;
	protected $token;

	public function __construct($email, $nombre, $token)
	{
		$this->email = $email;
		$this->nombre = $nombre;
		$this->token = $token;
	}

	public function enviarConfirmacion(){
		
	}
}