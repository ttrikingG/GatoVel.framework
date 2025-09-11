<?php

namespace app\nucleo\neutrons\services;

use app\nucleo\neutrons\models\admin\Upload;
use app\nucleo\protons\gears\mylibs\ImageUpload;

class BaseService
{
  /**
   * Faz upload de um arquivo e retorna o caminho, ou null se falhar
   */
  protected function handleUpload(array $file, int $width = 300, string $folder = 'uploads'): ?string
  {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK || empty($file['tmp_name']) || !file_exists($file['tmp_name'])) {
      return null;
    }

    $upload = new ImageUpload(['file' => $file]);
    return $upload->upload($width, $folder);
  }

  /**
   * Deleta arquivos do servidor e registros no banco
   */
  protected function deleteFiles(array $uploads): void
  {
    $uploadModel = new Upload();

    foreach ($uploads as $upload) {
      if (file_exists($upload->path)) {
        unlink($upload->path);
      }
      $uploadModel->delete('id', $upload->id);
    }
  }

  /**
   * Inserir registro de imagem no banco (genérico)
   */
  protected function insertImage(int $itemId, string $type, string $path): bool
  {
    $uploadModel = new Upload();
    return $uploadModel->insert([
      'image_id'   => $itemId,
      'image_type' => $type,
      'path'       => $path
    ]);
  }
}
