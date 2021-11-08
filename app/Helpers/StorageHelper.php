<?php
namespace App\Helpers;

use Google\Cloud\Storage\StorageClient;

class StorageHelper
{
    //https://cloud.google.com/storage/docs/reference/libraries#client-libraries-install-php

    /**
     * Nome do bucket (pasta raiz do projeto).
     *
     * @var string
     */
    private $bucketName = "projetoescolar-9f90e.appspot.com";

    /**
     * Configurações para acessar o Storage.
     *
     * @var array
     */
    private $configStorageClient = [
        'projectId' => "projetoescolar-9f90e",
        'keyFilePath' => '../project.json'
    ];

    /**
     * Faz upload do arquivo para o Google Cloud.
     *
     * @param string $source caminho do arquivo que sera feito o upload.
     * @return void
     */
    function uploadObject($source)
    {
        $storage = new StorageClient($this->configStorageClient);
        $file = fopen($source, 'r');
        $fileName = $this->getFileName($source);
        $bucket = $storage->bucket($this->bucketName);
        $object = $bucket->upload($file, [
            'name' => $fileName
        ]);
    }

    /**
     * Faz download do arquivo do Google Cloud.
     *
     * @param string $fileName nome do arquivo que sera feito o download.
     * @param string $destination local para o download do arquivo.
     * @return void
     */
    function download_object($fileName, $destination)
    {
        $storage = new StorageClient($this->configStorageClient);
        $bucket = $storage->bucket($this->bucketName);
        $object = $bucket->object($fileName);
        $object->downloadToFile($destination);
    }

    /**
     * Retorna o nome do arquivo de uma caminho
     *
     * @param string $fileName the path to the file to upload.
     * @param string $destination local para o download do arquivo.
     * @return void
     */
    private function getFileName($source)
    {
        return basename($source);
    }
}
