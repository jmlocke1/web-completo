<?php
namespace App;

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
		
		$this->imageName = getImageName($file['name']['imagen']);
		$this->imageFile = ImageManager::make($file['tmp_name']['imagen'])->fit(800,600);
	}

	public function guardar(){
		$this->imageFile->save($this->imageFolder.$this->imageName);
	}
}