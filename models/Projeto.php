<?php
namespace Domain\Model\Entity;

class Projeto {

	protected $id;
	protected $projNome;
	protected $projLocal;
	protected $dnum;
	
	public function __construct(){
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getProjNome(){
		return $this->projNome;
	}
	
	public function setProjNome($projNome){
		$this->projNome = $projNome;
	}
	
	public function getProjLocal(){
		return $this->projLocal;
	}
	
	public function setProjLocal($projLocal){
		$this->projLocal = $projLocal;
	}
	
	public function getDnum(){
		return $this->dnum;
	}
	
	public function setDnum(Departamento $dnum){
		$this->dnum = $dnum;
	}
}
