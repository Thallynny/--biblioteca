<?php

require_once("../../../includes/configuracao.php");

function getNoticiasPaginada($dataInicio, $dataFim, $texto, $limite, $pagina, $banner) {
  try {
    ini_set("soap.wsdl_cache_enabled", "0");
    ini_set('soap.wsdl_cache_ttl', 900);
    ini_set('default_socket_timeout', 15);

    $url = getURLServico();
    $client = new SoapClient($url);

    $parametros = array('getNoticiasPaginadas' => array(
      'dataInicio' => $dataInicio,
      'dataFim' => $dataFim,
      'texto' => $texto, 
      'limiteNoticiasPagina' => $limite,
      'pagina' => $pagina,
      'banner' => $banner
    ));
    $method = $client->__soapCall('getNoticiasPaginadas', $parametros);

    $response = json_decode(json_encode($method), True);
    $noticias = $response['return'];
    $i = 0;
    foreach($noticias['listaNoticias'] as $lista){
      if(isset($lista['texto'])){
        $texto = str_replace($lista['texto'], '"', '');
        $noticias['listaNoticias'][$i]['texto'] =  strip_tags(html_entity_decode($lista['texto']));
        $noticias['listaNoticias'][$i]['totalRegistro'] =  $noticias['totalRegistros'];
      $i++;
		}

	}
//	var_dump($noticias);
    return $noticias;
  } catch (Exception $e) {
    echo "Erro ao consumir WebService!";
  }
}