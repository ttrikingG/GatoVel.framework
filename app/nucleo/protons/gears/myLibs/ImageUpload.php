<?php

namespace app\nucleo\protons\gears\mylibs;

class ImageUpload {
   
    private $fileName;
    private $fileTemp;
    private $extension;
    private $width;
    private $height;
    private $acceptedExtensions = ['jpeg', 'jpg', 'png'];
    private $errors = [];

    public function __construct($image)
    {
        if (!isset($image['file']) || !is_uploaded_file($image['file']['tmp_name'])) {
            $this->errors[] = 'Nenhum arquivo enviado.';
        }

        $this->fileName = $image['file']['name'];
        $this->fileTemp = $image['file']['tmp_name'];
        $this->extension = pathinfo($this->fileName, PATHINFO_EXTENSION);
        list($this->width, $this->height) = getimagesize($this->fileTemp);

        $this->validate();
    }
    
    private function validate()
    {
        if (!in_array($this->extension, $this->acceptedExtensions)) {
            $this->errors[] = 'Extensão não aceita.';
        }

        $maxFileSize = 2 * 1024 * 1024; // 2MB em bytes
        if ($_FILES['file']['size'] > $maxFileSize) {
            $this->errors[] = 'Tamanho do arquivo excede o limite permitido.';
        }
    }

    public function upload($widthToResize, $folder)
    {
        if (!empty($this->errors)) {
            // Exibe as mensagens de erro na tela
            foreach ($this->errors as $error) {
                echo "<div style='color: red;'>$error</div>";
            }
            return false;
        }
        
        $heightToResize = ceil($this->height * ($widthToResize / $this->width));
        $newName = time();
        $filePath = './' . $folder . '/' . $newName . '.' . $this->extension;

        switch ($this->extension) {
            case 'jpeg':
            case 'jpg':
                $fromJpeg = imagecreatefromjpeg($this->fileTemp);
                $imageLayer = imagecreatetruecolor($widthToResize, $heightToResize);
                imagecopyresampled($imageLayer, $fromJpeg, 0, 0, 0, 0, $widthToResize, $heightToResize, $this->width, $this->height);
                imagejpeg($imageLayer, $filePath);
                break;

            case 'png':
                $fromPng = imagecreatefrompng($this->fileTemp);
                $imageLayer = imagecreatetruecolor($widthToResize, $heightToResize);

                // Preserva a transparência do PNG
                imagealphablending($imageLayer, false);
                imagesavealpha($imageLayer, true);

                imagecopyresampled($imageLayer, $fromPng, 0, 0, 0, 0, $widthToResize, $heightToResize, $this->width, $this->height);
                imagepng($imageLayer, $filePath);
                break;

            default:
                echo "<div style='color: red;'>Extensão não aceita.</div>";
                return false;
                break;
        }

        return $filePath;
    }
}