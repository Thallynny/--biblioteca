<?php
include_once 'func.php';

if(empty($_GET['sv'])){
	$url_webservice = "http://feeder.trf5.gov.br/feeder2/FeedService?wsdl";
}else{
	$url_webservice = $_GET['sv'];
}

if(empty($_GET['ano'])){
	$ano = "2020";
}else{
	$ano = $_GET['ano'];
}

if(empty($_GET['sv_pdf'])){
	$sv_pdf = "SV51";
}else{
	$sv_pdf = $_GET['sv_pdf'];
}

ini_set("soap.wsdl_cache_enabled", "0");
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

$client = new SoapClient($url_webservice);
$arguments = array('getLicitacao' => array('arg0' => $ano));
$licitacoes = $client->__soapCall("getLicitacao", $arguments ); 

function retiraBarras($string){
	$string = str_replace("/", "&#47;", $string);
	return $string;
}

$response = json_decode(json_encode($licitacoes), True);
$dados["dados"] = $response;

$i = 0;
foreach ($dados['dados']['return'] as $dadosTratamento) {
	$i++;
	$dados['dadosTratados'][$i] = $dadosTratamento;
}
$dados['dadosTratados'] =  array_sort($dados['dadosTratados'], 'ordenador', SORT_DESC);

echo "
<div class='row botoes w100' style='display: block;'>
	<a href='#conteudo' role='button' class='download' onClick='javascript:baixarPDF(".$ano. ");' title='Baixar PDF'>
		<div class='icone'><img src='../../templates/portalTRF5/images/download.svg' alt='Download em PDF'></div>PDF
	</a>
	<a href='#conteudo' role='button' class='download' onClick='javascript:baixarDocumento(\"".$ano. "\", \"xml\");' title='Baixar XML'>
		<div class='icone'><img src='../../templates/portalTRF5/images/download.svg' alt='Download em XML'></div>XML
	</a>
	<a href='#conteudo' role='button' class='download' onClick='javascript:baixarDocumento(\"".$ano. "\", \"csv\");' title='Baixar CSV'>
		<div class='icone'><img src='../../templates/portalTRF5/images/download.svg' alt='Download em CSV'></div>CSV
	</a>
	<a href='#conteudo' role='button' class='download' onClick='javascript:baixarDocumento(\"tabela_export_".$ano. "\", \"export\", \"\", this);' title='Imprimir'>
		<div class='icone'><img src='../../templates/portalTRF5/images/impressora.svg' alt='Download em IMPRIMIR'></div>	IMPRIMIR
	</a> ";

$texto = "
	<table id='tabela_".$ano."'>
	<thead>
		<tr>
			<th>Data</th>
			<th>Hora (Brasília)</th>
			<th>Documentos</th>
			<th>Objeto</th>
			<th>Valor Estimado (R$)</th>
			<th>Situação</th>
			<th>Resultado da Licitação</th>
		</tr>
	</thead>";

	foreach ($dados['dadosTratados'] as  $listDados) {
		$situacao = $listDados['situacao'];
		if(empty($listDados['dataAtualizacao'])){
			$listDados = $dadosAno ;
		}
		if(!empty($listDados['documentos'])){
			$listDados['documentos'] = array_sort($listDados['documentos'], 'descricao', $order = SORT_ASC);
		}
		if($listDados['ano'] == $ano){
			$texto .= "<tr>";
			$texto .= "<td>".$listDados['dataAtualizacao']."</td>";
			$texto .= "<td>".$listDados['hora']."</td>";
			$txtDocumentos = "";
			$txtResultado = "";
			$txtEdital = "";
			if (empty($listDados['documentos']) === false) {
				foreach ($listDados['documentos'] as $documento) {
					if(empty($documento['descricao'])){
						$documento = $listDados['documentos'] ;
						$txtDocumentos .= "<a href='#conteudo' onclick=\"exibirArquivo('../../index.php/gestao-orcamentaria/resultado-pdf', '" . $documento['id'] . "', '".$sv_pdf."', '" . urlencode("PORTAL DA TRANSPARÊNCIA/LICITAÇÕES E CONTRATOS/LICITAÇÕES/" . $documento['descricao']) . "')\" title='link para " . $documento['descricao'] . "'>
					" . $documento['descricao'] . "	</a></br></br>";
					break;
					}
					//Se a primeira palavra for 'Edital' case insensiteve
					if(stripos($documento['descricao'],'Edital') === 0) 
					{
						$txtEdital .= "<a href='#conteudo' onclick=\"exibirArquivo('../../index.php/gestao-orcamentaria/resultado-pdf', '" . $documento['id'] . "', '".$sv_pdf."', '" . urlencode("PORTAL DA TRANSPARÊNCIA/LICITAÇÕES E CONTRATOS/LICITAÇÕES/" . $documento['descricao']) . "')\" title='link para " . $documento['descricao'] . "'>
						" . $documento['descricao'] . "	</a></br></br>";
					}
					else
					{
						$txtDocumentos .= "<a href='#conteudo' onclick=\"exibirArquivo('../../index.php/gestao-orcamentaria/resultado-pdf', '" . $documento['id'] . "', '".$sv_pdf."', '" . urlencode("PORTAL DA TRANSPARÊNCIA/LICITAÇÕES E CONTRATOS/LICITAÇÕES/" . $documento['descricao']) . "')\" title='link para " . $documento['descricao'] . "'>
						" . $documento['descricao'] . "	</a></br></br>";
					}
				}
			}
			if(empty($listDados['resultados']) === false)
				foreach ($listDados['resultados'] as  $documento) {
					if(empty($documento['descricao'])){
						$documento = $listDados['resultados'] ;
						if(!empty($documento['situacao'])){
							$situacao = $documento['situacao'];
						}
						$txtResultado .= "</br>".$documento['detalhamento']."</br></br>";
						$txtResultado .= "<a href='#conteudo' onclick=\"exibirArquivo('../../index.php/gestao-orcamentaria/resultado-pdf', '" . $documento['id'] . "', '".$sv_pdf."', '" . urlencode("PORTAL DA TRANSPARÊNCIA/LICITAÇÕES E CONTRATOS/LICITAÇÕES/" . $documento['descricao']) . "')\" title='link para " . $documento['descricao'] . "'>
						" . $documento['descricao'] . "	</a></br></br>";
						break;
					}

					if(!empty($documento['situacao'])){
						$situacao = $documento['situacao'];
					}
					$txtResultado .= "</br>".$documento['detalhamento']."</br></br>";
					$txtResultado .= "<a href='#conteudo' onclick=\"exibirArquivo('../../index.php/gestao-orcamentaria/resultado-pdf', '" . $documento['id'] . "', '".$sv_pdf."', '" . urlencode("PORTAL DA TRANSPARÊNCIA/LICITAÇÕES E CONTRATOS/LICITAÇÕES/" . $documento['descricao']) . "')\" title='link para " . $documento['descricao'] . "'>
					" . $documento['descricao'] . "	</a></br></br>";
				}	

			$texto .= "<td>".$txtEdital.$txtDocumentos."</td>";
			$texto .= "<td>".$listDados['descricaoObjeto']."</td>";
			$texto .= "<td>".$listDados['valor']."</td>";
			$texto .= "<td>".$situacao."</td>";
			$texto .= "<td>".$txtResultado."</td>";
		}
		$texto .= "</tr>";
	}

	$texto .= "</table>";
echo  $texto;

echo "
	<div style='display:none;'><input type='text' id='table_".$ano."' value='".urlencode($texto)."' /></div>
	<div style='display:none;' id='tabela_export_".$ano."'>".$texto."</div>
</div>
<div id='div_arquivo'></div>";
?>