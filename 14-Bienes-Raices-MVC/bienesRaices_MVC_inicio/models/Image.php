<?php
namespace Model;

use Intervention\Image\ImageManagerStatic as ImageManager;

class Image{
	public $imageName;
	public $imageFile;
	public $imageFolder;

	public function __construct($file, $newImageFolder = '')
	{
		if(!empty($newImageFolder)){
			$this->imageFolder = $newImageFolder;
		}else{
			$this->imageFolder = \Config::CARPETA_IMAGENES;
		}
		
		// Crear carpeta
		if(!is_dir($this->imageFolder)){
			mkdir($this->imageFolder);
		}
		
		$this->imageName = $this->getImageName($file['name']['imagen']);
		$this->imageFile = ImageManager::make($file['tmp_name']['imagen'])->fit(800,600);
	}

	public function guardar(){
		$this->imageFile->save($this->imageFolder.$this->imageName);
	}

	/**
	 * Devuelve un nombre único para una imagen
	 */
	public function getImageName(string $nombreAntiguo): string {
		$nombreImagen = md5(uniqid( rand(), true)).".". $this->getImageExtension($nombreAntiguo);
		return $nombreImagen;
	}

	/**
	 * Devuelve la extensión de una imagen dada como parámetro
	 */
	public function getImageExtension(string $imageName): string {
		$imgParts = explode('.', $imageName);
		$extension = $imgParts[count($imgParts) - 1];
		return $extension;
	}
}