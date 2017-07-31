<?php

namespace App\Services;

use App\Util\ValidadorDadosUtil;

class Model
{
    private $contrato;
    private $requisicao;
    private $dadosFantantes;
    private $dadosInvalidos;
    
    private $validadorDados;
    
    public function __construct($contrato, $requisicao)
    {
        $this->contrato = $contrato;
        $this->requisicao = $requisicao;
        $this->validadorDados = new ValidadorDadosUtil();
    }
    
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
    }
    
    public function setRequisicao($requisicao)
    {
        $this->requisicao = $requisicao;
    }
    
    public function getRequisicao()
    {
        return $this->requisicao;
    }
    
    public function getDadosFantantes()
    {
        return $this->dadosFantantes;
    }
    
    public function getDadosInvalidos()
    {
        return $this->dadosInvalidos;
    }
    
    public function ajustarRequisicao()
    {
        foreach($this->contrato as $keyContrato => $valueContrato){
            foreach($this->requisicao as $keyUsuario => $valueUsuario){
                if(in_array($keyUsuario, $valueContrato['apelidos'])){
                    $requisicao[$keyContrato] = $valueUsuario;
                }
            }
        }
        
        $this->requisicao = $requisicao;
    }
    
    public function validarRequisição()
    {
        $this->dadosFantantes = $this->contrato;
        $this->dadosInvalidos = $this->contrato;
        
        foreach($this->contrato as $key => $value){
            if($value['obrigatorio']){    	
                if(in_array($key, array_keys($this->requisicao))){
                    unset($this->dadosFantantes[$key]);
                    if($this->verificarValidadeDado($this->requisicao[$key], $value['tipo'])){
                        unset($this->dadosInvalidos[$key]);
                    }
                }else{
                    unset($this->dadosInvalidos[$key]);
                }
            }else{
                unset($this->dadosFantantes[$key]);
            }
        }
    }
    
    public function criptografarSenha()
    {
        if(in_array('tx_senha_usuario', array_keys($this->requisicao))){
        	$this->requisicao['tx_senha_usuario'] = sha1($this->requisicao['tx_senha_usuario']);
        }
    }
    
    private function verificarValidadeDado($dado, $tipo)
    {
        $result = true;
        
        switch($tipo){
            case 'string':
                $result = true;
                break;
                
            case 'integer':
                $result = is_int($dado);
                break;
                
            case 'boolean':
                $result = $this->validadorDados->validarBooleano($dado);
                break;
                
            case 'array':
                $result = is_array($dado);
                break;
                
            case 'arrayInteger':
                $result = $this->validadorDados->validarArrayInteiro($dado);
                break;
                
            case 'arrayArray':
                $result = $this->validadorDados->validarArrayArray($dado);
                break;
                
            case 'email':
                $result = $this->validadorDados->validarEmail($dado);
                break;
                
            case 'cpf':
                $result = $this->validadorDados->validarCpf($dado);
                break;
        }
        
        return $result;
    }
}
