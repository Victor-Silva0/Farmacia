<?php

namespace App\Lib;

class Upload
{
    /**
     * Nome do arquivo (sem extensão)
     * @var string
     */
    private $name;

    /**
     * Extensão do arquivo (sem ponto)
     * @var string
     */  
    private $extension;

    /**
     * Tipo do arquivo
     * @var string
     */  
    private $type;

    /**
     * Nome temporário/caminho do arquivo
     * @var string
     */  
    private $tmpName;

    /**
     * Código do erro do upload
     * @var integer
     */  
    private $error;

    /**
     * Tamanho do arquivo
     * @var integer
     */  
    private $size;

    /**
     * Contador de duplicação de arquivo
     * @var integer
     */
    private $duplicates = 0;

    /**
     * Construtor da classe
     * @param array $file $_FILES[campo]
     */
    public function __construct($file)  {
        $info               = pathinfo($file['name']);

        $this->name         = $info['filename'];
        $this->extension    = $info['extension'];
        $this->type         = isset($file['type']) ? $file['type'] : '';
        $this->tmpName      = isset($file['tmp_name']) ? $file['tmp_name'] : '';
        $this->error        = isset($file['error']) ? $file['error'] : '';
        $this->size         = isset($file['size']) ? $file['size'] : '';
    }

    /**
     * Método reponsável por alterar o nome do arquivo
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Método reponsável por retornar o código do erro no upload da imagem
     * @return string
     */
    public function getError() {
        return $this->error;
    }

    /**
     * Método reponsável por retornar o nome do arquivo com sua estensão
     * @return string
     */
    public function generateName() {
        $this->name = time().'-'.rand(100000, 999999).'-'.uniqid();
    }

    /**
     * Método reponsável por retornar o nome do arquivo com sua estensão
     * @return string
     */
    public function getBasename() {
        // valida extensão
        $extension = strlen($this->extension) ? '.'.$this->extension : '';

        // valida duplicação
        $duplicates = $this->duplicates > 0 ? '-'.$this->duplicates : '';

        // retorna o nome completo
        return $this->name.$duplicates.$extension;
    }

    /**
     * Método reponsável por obter um nome possível para o arquivo
     * @param string $dir
     * @param boolean $overwrite
     * @param string
     */
    private function getPossibleBasename($dir, $overwrite) {
        
        // é possível sobrescrever arquivo
        if ($overwrite) return $this->getBasename();

        // não é possível sobrescrever o arquivo
        $basename = $this->getBasename();

        // verificar duplicação
        if (!file_exists($dir.'/'.$basename)) {
            return $basename;
        }

        // incrementar duplicações
        $this->duplicates++;

        // retorno do próprio método (método recursivo)
        return $this->getPossibleBasename($dir, $overwrite);
    }

    /**
     * Método responsável por mover o arquivo de upload
     * @param string  $dir
     * @param boolean $overwrite
     * @return boolean
     */
    public function upload($dir, $overwrite = true) {
        // verificar erro
        if ($this->error != 0) return false; 

        // caminho completo de destino
        $path = $dir.'/'.$this->getPossibleBasename($dir, $overwrite);

        // move o arquivo para a pasta de destino
        return move_uploaded_file($this->tmpName, $path);
    }

    /**
     * Método responsável por criar instâncias de upload para múltiplos arquivos
     * @param array $files $_FILES['campo']
     * @return array
     */
    public static function createMultiUpload($files) {
        $uploads = [];

        foreach($files['name'] as $key=>$value){
            // array de arquivo
            $file = [
                'name'      => $files['name'][$key],
                'type'      => $files['type'][$key],
                'tmp_name'  => $files['tmp_name'][$key],
                'error'     => $files['error'][$key],
                'size'      => $files['size'][$key]
            ];

            // nova instância
            $uploads[] = new Upload($file);
        }

        return $uploads;
    }   
}