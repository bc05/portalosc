<?php

namespace App\Http\Services\User;

use App\Http\Services\Service;
use App\Http\Util\CheckRequestUtil;
use App\Http\Dao\User\SetUserOscDao;

class SetUserOscService extends Service
{
	private function check($object)
	{
		$checkRequestUtil = new CheckRequestUtil();
		
		$requiredData = ['id_usuario', 'tx_email_usuario', 'tx_nome_usuario', 'tx_senha_usuario', 'representacao'];
		$msgCheckData = $checkRequestUtil->checkRequiredData($requiredData, $object);
		
		if($msgCheckData){
			$content['msg'] = $msgCheckData;
			$this->response->setResponse($content, 400);
		}else{
			$msgCheckData = $checkRequestUtil->checkData($object);
			
			if($msgCheckData){
				$content['msg'] = $msgCheckData;
				$this->response->setResponse($content, 400);
			}
		}
	}
	
	private function execute($object)
	{
		$dao = new SetUserOscDao();
		
		$resultDao = $dao->run($object);
		
		if($resultDao->status){
			if($resultDao->nova_representacao){
				foreach($resultDao->nova_representacao as $value) {
					$params_osc = [$value['id_osc']];
					
					$osc_email = $this->dao->getOscEmail($params_osc);
					$nomeOsc = $osc_email->tx_razao_social_osc;
					$emailOsc = $osc_email->tx_email;
					
					$osc = ["nomeOsc"=>$nomeOsc, "emailOsc"=>$emailOsc];
					$user = ["nome"=>$nome, "email"=>$email, "cpf"=>$cpf];
					$emailIpea = "mapaosc@ipea.gov.br";
					
					if($emailOsc == null){
						$emailOsc = "Esta organização não possui email para contato.";
						$message = $this->email->informationIpea($user, $osc);
						#$this->email->send($emailIpea, "Notificação de cadastro de representante no Mapa das Organizações da Sociedade Civil", $message);
					}else{
						$message = $this->email->informationOSC($user, $nomeOsc);
						#$this->email->send($emailOsc, "Notificação de cadastro no Mapa das Organizações da Sociedade Civil", $message);
						
						$message = $this->email->informationIpea($user, $osc);
						#$this->email->send($emailIpea, "Notificação de cadastro de representante no Mapa das Organizações da Sociedade Civil", $message);
					}
				}
			}
		}else{
			$content['msg'] = $resultDao->mensagem;
			$this->response->setResponse($content, 400);
		}
	}
	
	public function run($object = [])
	{
		$content['msg'] = 'Usuário atualizado com sucesso.';
		$this->response->setResponse($content, 200);
		
		$this->check($object);
		if($this->response->getFlag()){
			$this->execute($object);
		}
		
		return $this->response;
	}
}