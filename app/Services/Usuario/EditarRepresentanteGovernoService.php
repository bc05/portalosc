<?php

namespace App\Services\Usuario;

use App\Enums\NomenclaturaAtributoEnum;
use App\Services\Service;
use App\Services\Model;
use App\Dao\UsuarioDao;

class EditarRepresentanteGovernoService extends Service
{
	public function executar()
	{
	    $contrato = [
	        'id_usuario' => ['apelidos' => NomenclaturaAtributoEnum::ID_USUARIO, 'obrigatorio' => true, 'tipo' => 'numeric'],
	        'tx_email_usuario' => ['apelidos' => NomenclaturaAtributoEnum::EMAIL, 'obrigatorio' => true, 'tipo' => 'email'],
	        'tx_senha_usuario' => ['apelidos' => NomenclaturaAtributoEnum::SENHA, 'obrigatorio' => true, 'tipo' => 'string'],
	        'tx_nome_usuario' => ['apelidos' => NomenclaturaAtributoEnum::NOME_USUARIO, 'obrigatorio' => true, 'tipo' => 'string']
	    ];
	    
	    $model = new Model($contrato, $this->requisicao->getConteudo());
	    $flagModel = $this->analisarModel($model);
	    
	    if($flagModel){
	        $edicaoRepresentanteGoverno = (new UsuarioDao())->editarRepresentanteGoverno($model->getRequisicao());
    		
	        if($edicaoRepresentanteGoverno->flag){
	            $conteudoResposta = $this->configurarConteudoRespota();
	            $conteudoResposta->msg = $edicaoRepresentanteGoverno->mensagem;
	            
	            $this->resposta->prepararResposta($conteudoResposta, 200);
	        }else{
	            $this->resposta->prepararResposta(['msg' => $edicaoRepresentanteOsc->mensagem], 400);
	        }
	    }
	}
	
	public function configurarConteudoRespota() {
	    $requisicao = $this->requisicao->getConteudo();
	    $usuario = $this->requisicao->getUsuario();
	    
	    $tempoExpiracaoToken = strtotime('+15 minutes');
	    
	    $token = $usuario->id_usuario . '_' . $usuario->tipo_usuario . '_' . $usuario->localidade . '_' . $tempoExpiracaoToken;
	    $token = openssl_encrypt($token, 'AES-128-ECB', getenv('KEY_ENCRYPTION'));
	    
	    $conteudo = new \stdClass;
	    $conteudo->id_usuario = $usuario->id_usuario;
	    $conteudo->tx_nome_usuario = $requisicao->tx_nome_usuario;
	    $conteudo->cd_tipo_usuario = $usuario->tipo_usuario;
	    $conteudo->localidade = $usuario->localidade;
	    $conteudo->access_token = $token;
	    $conteudo->token_type = 'Bearer';
	    $conteudo->expires_in = $tempoExpiracaoToken;
	    
	    return $conteudo;
	}
}