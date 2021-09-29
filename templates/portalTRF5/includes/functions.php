<?php

require_once("../../../includes/configuracao.php");

function consultaProcesso($criterio, $termo, $ordenar) {
  try {
    ini_set("soap.wsdl_cache_enabled", "0");
    
    $url = getURLServico();
    $client = new SoapClient($url);

    $parametros = array('consultaProcesso' => array(
      'criterio' => $criterio,
      'termo' => $termo,
	  'ordenar' => $ordenar
    ));

    $method = $client->__soapCall('consultaProcesso', $parametros);

    $response = json_decode(json_encode($method), True);
    $processos = $response['return'];

    if ($processos == 'error') {
      $processos = [];
    }

    return $processos;
    
  } catch(Exception $e) {
    //echo "Erro ao pesquisar processos!"
  }
}

function consultaDadosProcesso($orgao, $sistema, $numero) {
  try {
    ini_set("soap.wsdl_cache_enabled", "0");

    $url = getURLServico();
    $client = new SoapClient($url);

    $parametros = array('consultaDadosProcesso' => array(
      'orgao' => $orgao,
      'sistema' => $sistema,
      'numero' => $numero
    ));

    $method = $client->__soapCall('consultaDadosProcesso', $parametros);

    $response = json_decode(json_encode($method), True);
    $dados = $response['return'];

	
	//var_dump($dados);
	
    if ($dados == 'error') {
      $dados = [];
    }

    return $dados;
    
  } catch(Exception $e) {
    //echo "Erro ao pesquisar processos!"
  }
}

function consultaProcessoPaginado($criterio, $termo, $ordenar, $paginador)  {
  try {
    ini_set("soap.wsdl_cache_enabled", "0");
    
    $url = getURLServico();
    $client = new SoapClient($url);

    $parametros = array('consultaProcessoPaginado' => array(
      'criterio' => $criterio,
      'termo' => $termo,
	  'ordenar' => $ordenar,
      'paginador' => $paginador
    ));

    $method = $client->__soapCall('consultaProcessoPaginado', $parametros);

    $response = json_decode(json_encode($method), True);
    $processos = $response['return'];

    if ($processos == 'error') {
      $processos = [];
    }

    return $processos;
    
  } catch(Exception $e) {
    //echo "Erro ao pesquisar processos!"
  }
}

function buscaGeral($termo, $linhas = 10, $order) {
  try {
    ini_set("soap.wsdl_cache_enabled", "0");

    $url = getURLServico();
    $client = new SoapClient($url);
	  $termo = urlencode($termo);

    $parametros = array('buscaElastica' => array(
      'termo' => $termo,
      'linhas' => $linhas,
	  'ordenador' => $order
    ));

    $method = $client->__soapCall('buscaElastica', $parametros);

    $response = json_decode(json_encode($method), True);
    $noticias = $response['return'];

    if ($noticias == 'error') {
      $noticias = [];
    }

    return $noticias;
    
  } catch(Exception $e) {
    //echo "Erro ao pesquisar noticias!"
  }
}

function buscaGeralJoomla($termo, $linhas = 10) {
  try {
    ini_set("soap.wsdl_cache_enabled", "0");

    $url = getURLServico();
    $client = new SoapClient($url);

    $termo = urlencode($termo);

    $parametros = array('buscaElasticaPortal' => array(
      'termo' => $termo,
      'linhas' => $linhas,
	  'ordenador' => 'true'
    ));

    $method = $client->__soapCall('buscaElasticaPortal', $parametros);

    $response = json_decode(json_encode($method), True);
    $noticias = $response['return'];

    if ($noticias == 'error') {
      $noticias = [];
    }

    return $noticias;
    
  } catch(Exception $e) {
    //echo "Erro ao pesquisar noticias!";
  }
}