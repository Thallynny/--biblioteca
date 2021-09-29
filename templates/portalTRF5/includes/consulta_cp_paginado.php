<?php

require('functions.php');

$termo    = $_POST['termo'];
$criterio = $_POST['criterio'];
$ordenar = $_POST['ordenar'];
$estado   = isset($_POST['estado']) ? $_POST['estado'] : "";
$ordenar = isset($_POST['ordenar']) ? $_POST['ordenar'] : "true";
$paginadorPJE = isset($_POST['paginadorPJE']) ? $_POST['paginadorPJE'] : "1";
$paginadorESPARTA = isset($_POST['paginadorESPARTA']) ? $_POST['paginadorESPARTA'] : "1";

function tiraAcento( $str ) { 
	$str = strtr(utf8_decode($str),utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'#@$%&!*()_+{?}><,.;:/][=-\|"),"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy                            ");
	$str = preg_replace('/( )+/', ' ', $str);   // remove espaço duplos
	return trim($str) ;
}

$termo =  tiraAcento( $termo );

if (!empty($estado)) {
  $termoOab = $estado.$termo;
  $retorno = consultaProcessoPaginado($criterio, $termoOab, $ordenar, $paginadorPJE);
} else {
  $retorno = consultaProcessoPaginado($criterio, $termo, $ordenar, $paginadorPJE );
}

//-------------- MOK PARA TESTE DO DOCKER
/*
$retorno = '[ {  "orgao" : "TRF5",  "sistemaProcessual" : {    "id" : "PJE",    "descricao" : "Processo Judicial Eletronico"  },  "resultado" : {    "codigo" : 200,    "mensagem" : "consulta realizada com sucesso"  },  "processos" : [ {    "id" : 0,    "numero" : "0800680-47.2019.4.05.8103",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0802215-79.2017.4.05.8200",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0804189-11.2020.4.05.0000",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0825747-05.2019.4.05.8300",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0801047-53.2019.4.05.8303",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0800280-95.2017.4.05.8202",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0804057-51.2020.4.05.0000",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0804071-35.2020.4.05.0000",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0800290-42.2017.4.05.8202",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  }, {    "id" : 0,    "numero" : "0807334-80.2015.4.05.8300",    "nomeMagistrado" : null,    "classeJudicial" : null,    "instancia" : null,    "orgao" : null,    "sistema" : null,    "orgaoJulgador" : null,    "orgaoJulgadorColegiado" : null,    "dataDistribuicao" : null,    "cumprimentoDiligencia" : null,    "segredoJustica" : false,    "url" : null,    "partes" : [ ],    "assuntos" : [ ],    "processosAssociados" : [ ],    "movimentacoes" : [ ],    "localizacoes" : [ ],    "temas" : [ ],    "documentos" : [ ],    "dataUltimaMovimentacao" : null,    "identificador" : "null:null:null:0"  } ],  "totalProcessos" : 3647} ]===[ {  "orgao" : "TRF5",  "sistemaProcessual" : {    "id" : "ESPARTA",    "descricao" : null  },  "resultado" : {    "codigo" : 200,    "mensagem" : "consulta realizada com sucesso"  },  "processos" : [ ],  "totalProcessos" : 0} ]';
*/



$retorno = str_replace('\n', '', $retorno);
$retorno = str_replace('\"', '"', $retorno);
$retorno = str_replace('"[', '[', $retorno);
$retorno = str_replace(']"', ']', $retorno);

$retorno = str_replace('[ [', '[', $retorno);
$retorno = str_replace('] ]', ']', $retorno);

$retorno = str_replace('<![CDATA[', '', $retorno);
$retorno = str_replace(']]>', '', $retorno);

$retorno = str_replace(', [ {', '===[ {', $retorno);
$retorno = str_replace('} ][ {', '} ]===[ {', $retorno);

echo $retorno;