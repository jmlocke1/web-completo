<?php
namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use Model\Notification;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaginasController {
	public static function index( Router $router ){
		
		$router->render('paginas/index', [
			'propiedades' => Propiedad::get(3),
			'inicio' => ' inicio'
		]);
	}

	public static function nosotros( Router $router ){
		$router->render('paginas/nosotros');
	}

	public static function propiedades( Router $router ){
		if(isset($_GET['error'])){
			$mensajeError = s(Notification::errorNotification($_GET['error']));
		}else{
			$mensajeError = '';
		}
        
		$router->render('paginas/propiedades', [
			'propiedades' => Propiedad::all(),
			'mensajeError' => $mensajeError
		]);
	}

	public static function propiedad( Router $router ){
		$propiedad = Propiedad::existsById($_GET['id'], '/propiedades');

		$router->render('paginas/propiedad', [
			'propiedad' => $propiedad
		]);
	}

	public static function blog( Router $router ){
		$router->render('paginas/blog');
	}

	public static function entrada( Router $router ){
		$router->render('paginas/entrada');
	}

	public static function contactoGet( Router $router ){
		$router->render('paginas/contacto', [

		]);
	}

	public static function contactoPost( Router $router ){
		// Correo creado en Mailtrap para testeo de envío
		
		// Crear una nueva instancia de PHPMailer
		$phpmailer = new PHPMailer(true);
		try{
			// Configurar SMTP
			$phpmailer->isSMTP();
			$phpmailer->Host = 'smtp.mailtrap.io';
			$phpmailer->SMTPAuth = true;
			$phpmailer->Port = 2525;
			$phpmailer->Username = '7e616050a54470';
			$phpmailer->Password = '9b8bd746ca9ac6';
			$phpmailer->SMTPSecure = 'tls';
			
			// Configurar el contenido del mail
			$phpmailer->setFrom('josemidaw@gmail.com');
			$phpmailer->addAddress('josemidaw@gmail.com', 'BienesRaices.com');
			$phpmailer->Subject = 'Asunto: Nuevo Mensaje';

			// Habilitar HTML
			$phpmailer->isHTML(true);
			$phpmailer->CharSet = 'UTF-8';

			// Definir el contenido
			$contenido = '<html> <p>Tienes un nuevo mensaje por tercera vez <bold>esto es en negrita</bold></p> </html>';
			$phpmailer->Body = $contenido;
			$phpmailer->AltBody = "Esto es texto alternativo sin HTML";
			// Enviar el email
			if($phpmailer->send()){
				echo "Mensaje enviado correctamente";
			}
		}catch(Exception $e){
			echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
		}
		

		$router->render('paginas/contacto', [

		]);
	}
}