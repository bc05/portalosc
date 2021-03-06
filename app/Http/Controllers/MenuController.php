<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Menu\ObterMenuOsc\Service as ObterMenuOsc;
use App\Services\Menu\ObterMenuGeografico\Service as ObterMenuGeografico;

class MenuController extends Controller{
	public function obterMenuOsc(Request $request, $menu, $parametro = '', ObterMenuOsc $service){
	    $extensaoConteudo = ['menu' => $menu, 'parametro' => $parametro];
        $this->executarService($service, $request, $extensaoConteudo);
        
        $accept = $request->header('Accept');
        $response = $this->getResponse($accept);

	    return $this->getResponse();
    }
    
    public function obterMenuGeografico(Request $request, $tipo_regiao, $parametro, $limit = 0, $offset = 0, ObterMenuGeografico $service){
        $extensaoConteudo = ['tipo_regiao' => $tipo_regiao, 'parametro' => $parametro, 'limit' => $limit, 'offset' => $offset];
        $this->executarService($service, $request, $extensaoConteudo);

        $accept = $request->header('Accept');
        $response = $this->getResponse($accept);
        
        return $this->getResponse();
    }
}