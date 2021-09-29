<?php
include_once 'func.php';

if(empty($_GET['sv'])){
	$url_webservice = "http://feeder.trf5.gov.br/feeder2/FeedService?wsdl";
}else{
	$url_webservice = $_GET['sv'];
}

if(empty($_GET['codigo'])){
	$codigo = "0";
}else{
	$codigo = $_GET['codigo'];
}

if(empty($_GET['sv_pdf'])){
	$sv_pdf = "SV30";
}else{
	$sv_pdf = $_GET['sv_pdf'];
}

ini_set("soap.wsdl_cache_enabled", "0");
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);

$client = new SoapClient($url_webservice);
$arguments = array('getGabineteBoletins' => array('arg0' => $codigo));
$boletins = $client->__soapCall("getGabineteBoletins", $arguments );
$response = json_decode(json_encode($boletins), True);
$list = $response['return'];

$ordernar = false;
$i = 0;
foreach ($list as $group) {
	$horarioAno2 = explode("/", $group['dataPublicacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list[$i]['anorevista'] = $horarioAno2[2];
		
		if ($group['tipo'] == 2) {
			$descricao = str_replace("/".$horarioAno2[2], "", $group['descricao']);
			$list[$i]['descExibicao'] = str_pad($descricao, 5, '0', STR_PAD_LEFT);
		}else{
			$mes = intval($horarioAno2[1]);
			$list[$i]['numeroMes'] = $mes;
			$list[$i]['descExibicao'] = getMes($mes);
		}
		$i++;
	}
}

$listAux = $list;
if ($ordernar) {
	array_sort_by2($list, 'anorevista', $order = SORT_ASC);
}

if($codigo == 2){
	array_sort_by2($listAux, 'descExibicao', $order = SORT_DESC);
}else{
	array_sort_by2($listAux, 'numeroMes', $order = SORT_DESC);
}

$ano = 0;
$texto = "";
for ($i = count($list) - 1; $i >= 0; $i--) {
	$atas = $list[$i];
	$horarioAno = explode("/", $atas['dataPublicacao']);
	if ($ano != $horarioAno[2]) {
		$ano = $horarioAno[2]; 
		$texto .= "<div class='row report'>
			<ul>
				<li>".$horarioAno[2]."</li>
				<table id='tabela_".$ano."'>
					<thead>
						<tr>";
		$textoAux = "";
		$mes = "";
		$botao = "";
		$textoBotoes = "";
		foreach ($listAux as $listDados) {
			$horarioAno2 = explode("/", $listDados['dataPublicacao']);
			if ($horarioAno2[2] == $ano) {
				if($listDados['tipo'] == 0){
					if($mes != $listDados['descExibicao']){
						if($mes != ""){
							$textoBotoes .= detalhamentoRelatorio($ano.$mes, $botao);
							$botao = "";
						}
						$mes = $listDados['descExibicao'];
						$textoAux .= "<li>
							<a role='button' href='#conteudo' onClick=\"javascript:exibirBotaoRelatorio('" . $ano . $listDados['descExibicao'] . "', this)\">
							" . $listDados['descExibicao'] . "</a></li>";
					}
					$botao .= "<li><a href='#conteudo' role='button' class='box' onClick=\"exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '".$listDados['id']."', 'SV30', '".urlencode("INSTITUCIONAL/GABINETE REVISTA/Boletins de Jurisprudência/" . $ano . "/" . $listDados['descExibicao'] . "/" . retiraBarras($listDados['descricao']))."')\" >
							" . $listDados['descricao'] . "</a></li>";
				}else if ($listDados['tipo'] == 1) {
					$textoAux .= "<li>
						<a role='button' href='#conteudo' onclick=\"exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '".$listDados['id']."', 'SV30', '".urlencode("INSTITUCIONAL/GABINETE REVISTA/Boletins de Jurisprudência/" . $ano . "/") . $listDados['descExibicao'] ."')\" >
						" . $listDados['descExibicao'] . "</a></li>";
				}else if ($listDados['tipo'] == 2) {
					$textoAux .= "<li>
						<a role='button' href='#conteudo' onclick=\"exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '".$listDados['id']."', 'SV30', '".urlencode("INSTITUCIONAL/GABINETE REVISTA/Boletins de Jurisprudência/". $ano. "/") . $listDados['descExibicao'] ."')\"  >
						" . $listDados['descExibicao'] . "</a></li>";
				}
			}
		}

		$texto .= $textoAux;
		$texto .= "
						</tr>
					</thead>
				</table>
			</ul>
		</div>";
		if($codigo == 0){
			$textoBotoes .= detalhamentoRelatorio($ano.$mes, $botao);
			$texto .= $textoBotoes;
		}
	}
}
echo  $texto;
?>