<?php
namespace MVC\Utilities;

use COM;
use Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {
	public $email;
	public $nombre;
	public $token;

	public function __construct($nombre, $email, $token) {
		$this->email = $email;
		$this->nombre = $nombre;
		$this->token = $token;
	}

	public function enviarConfirmacion(){
		// Crear el objeto  de email
		$phpmailer = new PHPMailer(true);
		try{
			// Configurar SMTP
			$phpmailer->isSMTP();
			$phpmailer->Host = Config::MAILTRAP_HOST;
			$phpmailer->SMTPAuth = true;
			$phpmailer->Port = Config::MAILTRAP_PORT;
			$phpmailer->Username = Config::MAILTRAP_USERNAME;
			$phpmailer->Password = Config::MAILTRAP_PASSWORD;
			$phpmailer->SMTPSecure = 'tls';
			$phpmailer->setFrom(Config::MAIL_ORIGIN);
			$phpmailer->addAddress(Config::MAIL_ORIGIN, Config::DOMAIN_PROJECT);
			$phpmailer->Subject = 'Confirma tu cuenta';
			// Set HTML
			$phpmailer->isHTML(true);
			$phpmailer->CharSet = 'UTF-8';
			$contenido = "<html>";
			$contenido .= "<p><strong>Hola ". $this->nombre . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
			$contenido .= "<p>Presiona aquí: <a href='https://".Config::DOMAIN_PROJECT."/confirma-cuenta?token=". $this->token ."'>Confirma tu cuenta</a> </p>";
			$contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
			$contenido .= "</html>";
			$phpmailer->Body = $contenido;

			// Enviar el email
			$phpmailer->send();
		}catch(Exception $e){

		}
	}
}