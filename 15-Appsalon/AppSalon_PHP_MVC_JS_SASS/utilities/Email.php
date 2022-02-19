<?php
namespace MVC\Utilities;

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
			$contenido .= "<p>Presiona aquí: <a href='https://".Config::DOMAIN_PROJECT."/confirmar-cuenta?token=". $this->token ."' title='Conecta con AppSalon para confirmar tu cuenta'>Confirma tu cuenta</a> </p>";
			$contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
			$contenido .= "</html>";
			$phpmailer->Body = $contenido;

			// Enviar el email
			$phpmailer->send();
		}catch(Exception $e){
			echo 'Se ha producido un error: ', $e;
		}
	}

	/**
	 * Envía un email con instrucciones para recuperar el password
	 */
	public function enviarInstruccionesRecuperacion() {
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
			$phpmailer->Subject = 'Restablece tu Password';
			// Set HTML
			$phpmailer->isHTML(true);
			$phpmailer->CharSet = 'UTF-8';
			$contenido = "<html>";
			$contenido .= "<p><strong>Hola ". $this->nombre . "</strong> Has solicitado restablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
			$contenido .= "<p>Presiona aquí: <a href='https://".Config::DOMAIN_PROJECT."/recuperar?token=". $this->token ."' title='Conecta con AppSalon para restablecer tu password'>Restablecer Password</a> </p>";
			$contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
			$contenido .= "</html>";
			$phpmailer->Body = $contenido;

			// Enviar el email
			$phpmailer->send();
		}catch(Exception $e){
			echo 'Se ha producido un error: ', $e;
		}
	}
}