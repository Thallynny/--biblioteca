<?php

class ModJurisdicaoBoletins{

  public function getDadosWebService($params) {
	$dados["dados"] = [
	  'url_webservice' => $params->get('url_webservice'),
	  'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3')
    ];
	
	ini_set("soap.wsdl_cache_enabled", "0");
	try {
		$client   = new SoapClient($params->get('url_webservice'));
		$arguments = array('getGabineteBoletins' => array('arg0' => 0));
		$boletins = $client->__soapCall("getGabineteBoletins", $arguments); 
		$response = json_decode(json_encode($boletins), True);
		
		$dados["dados"]['dados'] = $response['return'];

		return $dados;
	} catch (Exception $e) {
		echo "Erro ao consumir WebService!";
	}

	return $dados;
  }    

}