<?php

namespace App\Dto;

class RequisicaoDto
{
	private $usuario = null;
	private $conteudo = array();
	
	public function obterUsuario()
	{
	    return $this->usuario;
	}
	
	public function obterConteudo()
	{
		return $this->conteudo;
	}
	
	public function prepararRequisicao($conteudo = array(), $usuario = null)
	{
		$this->conteudo = $conteudo;
		$this->usuario = $usuario;
	}
}
