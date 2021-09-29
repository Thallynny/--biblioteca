<?php

class ModAutoGestaoPessoas{

  public function getDadosWebService($params) {
	  $dados["dados"] = [
      'url_webservice' => $params->get('url_webservice'),
      'id_categoria' => $params->get('id_categoria'),
      'titulo' => $params->get('titulo')
    ];
    
    ini_set("soap.wsdl_cache_enabled", "0");
    ini_set('soap.wsdl_cache_ttl', 900);
    ini_set('default_socket_timeout', 15);
    //$client = new SoapClient($params->get('url_webservice'));
    //$response = json_decode(json_encode($client->getRelatorioDemonstrativoGestaoOrcamentaria()), True);

  	//$dados["distribuicaoOrcamentaria"] = $response['return'];			
				
	  return $dados;
  }

}