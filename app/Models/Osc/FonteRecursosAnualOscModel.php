<?php

namespace App\Models\Osc;

use App\Models\Model;

class FonteRecursosAnualOscModel extends Model
{
	private $dt_ano_recursos_osc = array(
			'apelidos'		=> ['ano', 'anoRecursos', 'ano_recursos', 'anoRecursosOsc', 'dt_ano_recursos_osc'],
			'obrigatorio'	=> true,
			'tipo'			=> 'date'
	);
	
	private $naoPossui = array(
			'apelidos'		=> ['naoPossui', 'nao_possui', 'bo_nao_possui'],
			'obrigatorio'	=> false,
			'tipo'			=> 'boolean'
	);
	
	private $naoPossuiRecursosProprios = array(
			'apelidos'		=> ['naoPossuiRecursosProprios', 'nao_possui_recursos_proprios', 'bo_nao_possui_recursos_proprios'],
			'obrigatorio'	=> false,
			'tipo'			=> 'boolean'
	);
	
	private $naoPossuiRecursosPublicos = array(
			'apelidos'		=> ['naoPossuiRecursosPublicos', 'nao_possui_recursos_publicos', 'bo_nao_possui_recursos_publicos'],
			'obrigatorio'	=> false,
			'tipo'			=> 'boolean'
	);
	
	private $naoPossuiRecursosPrivados = array(
			'apelidos'		=> ['naoPossuiRecursosPrivados', 'nao_possui_recursos_privados', 'bo_nao_possui_recursos_privados'],
			'obrigatorio'	=> false,
			'tipo'			=> 'boolean'
	);
	
	private $naoPossuiRecursosNaoFinanceiros = array(
			'apelidos'		=> ['naoPossuiRecursosNaoFinanceiros', 'nao_possui_recursos_nao_financeiros', 'bo_nao_possui_recursos_nao_financeiros'],
			'obrigatorio'	=> false,
			'tipo'			=> 'boolean'
	);
	
	private $recursos = array(
			'apelidos'		=> ['recursos', 'recursosOsc', 'recursos_osc'],
			'obrigatorio'	=> true,
			'tipo'			=> 'arrayObject',
			'modelo'		=> 'recursosOsc'
	);
	
    public function __construct($requisicao = null)
    {
    	$modelo = get_object_vars($this);
    	
    	$this->confiturarModelo($modelo);
    	$this->configurarRequisicao($requisicao);
    	$this->analisarRequisicao();
    }
}