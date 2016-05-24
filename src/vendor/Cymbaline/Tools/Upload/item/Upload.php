<?php

namespace Cymbaline\Tools\Upload\item;


class Upload {

	private $file;
	private $dir;
	private $tmp;
	private $tmpDir;
	private $type;
	private $extension;
	private $name;
	private $param;
	private $mimes;
	private $size;
	private $sizeMax;
	
	public $errorMessage;
	public $error;
	public $useParameters;
	
	public function __construct($file) {
	
		$this->file = $_FILES[$file];
		$this->tmp = $_FILES[$file]['tmp_name'];
        $this->name = $_FILES[$file]['name'];
        $this->type =$_FILES[$file]['type'];
        $this->size =$_FILES[$file]['size'];
		$this->errorMessage = null;
		$this->error = false;
		$this->param = cb_param('upload');
		$this->mimes = null;
		$this->dir = '/';
		$this->useParameters = false;
		$this->sizeMax = $this->param->size;
	}
	
	public function upload() {
	
		if(!is_uploaded_file($this->tmp)) {
			$this->error = true;
            $this->errorMessage ='Vous avez rien uploader';
			
			return false;
        } 
		
		if(!$this->validType($this->type)) {
            $this->error = true;
            $this->errorMessage = 'Le fichier n\'est pas d\'un type valide';
			
			return false;
        } 
		
		if($this->size >= $this->sizeMax) {
            $this->error = true;
            $this->errorMessage = 'Le fichier est trop volumineux';
			
			return false;
        } 
		
		if(!move_uploaded_file($this->tmp, $this->dir.$this->name.".".$this->extension)) {
            $this->error = true;
            $this->errorMessage ='Impssible de copier le fichier '.$this->name.".".$this->extension;
			
			return false;
        }
		
		return true;
	}
	
	public function setMimes(array $mimes) {
		$this->mimes = $mimes;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setSizeMax($sizeMax) {
		$this->sizeMax = $sizeMax;
	}
	
	public function setDir($dir) {
		$this->dir = $dir;
	}
	
	private function useParam() {
		$this->param = cb_param('upload');
	}
	
	private function validType() {
	
		$this->valid = false;
		
		if(!$this->useParameters) {
			foreach($this->mimes as $typemime => $mime) {
				if($this->type == $mime) {
					$this->valid = true;
					$this->extension = $typemime;
					break;
				}
			}
		} else {
			$this->useParam();
			$valids = (array) $this->param->valid;
			
			foreach($valids as $mime) {
				$array = (array) $mime;
				if(in_array($this->type,$array)) {
					$this->extension = key($array);
					$this->valid = true;
					break;
				}
			}
		}
		
		return $this->valid;
	}
	
}