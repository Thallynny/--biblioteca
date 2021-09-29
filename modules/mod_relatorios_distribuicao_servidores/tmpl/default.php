<?php defined('_JEXEC') or die;

include_once 'func.php';

function retiraBarras($string)
{
	$string = str_replace("/", "&#47;", $string);
	return $string;
}

array_sort_by($list['distribuicaoServidoresCargosComissao']['anos'], 'ano', $order = SORT_DESC);

$lista = getDados($list['distribuicaoServidoresCargosComissao']['anos']);

$count = 0;
foreach($lista as $dado){
	$arrayMeses = array();
	foreach ($dado['meses'] as $meses) {
		$mesTemp = mesParaNumero($meses[0]['descricaoMes']);
		array_push($arrayMeses, array("mes" => $mesTemp, "dados" => $meses[0]));
	}
	array_sort_by($arrayMeses, 'mes', $order = SORT_DESC);
	$lista[$count]['meses'] = $arrayMeses;
	$count++;
}

$tituloNiveis = "PORTAL DA TRANSPARÊNCIA/GESTÃO DE PESSOAS/DISTRIBUIÇÃO FORÇA DE TRABALHO - 219&#47;2016/TABELA DE LOTAÇÃO DE PESSOAL";
?>

<div style="display:none;">
	<input type="text" id="idMesOcultar" value="vazio" />
</div>
<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Tabelas de Lotação de Pessoal (TLPS) - Resolução 219/2016</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['distribuicaoServidoresCargosComissao']) ?></small>
			</div>
			<?php
			foreach ($lista as $dado) :
				$liAno = "";
				$liMes = "";
				$tabelasRow = "";
				$liAno .= "<li>" . $dado['ano'] . "</li>";
				$mesTemp = "";
				foreach ($dado['meses'] as $mes) :
					if($mesTemp != $mes['dados']['descricaoMes']){
						if($mesTemp != ""){
							$tabelasRow .= "<div class='clearfix'></div></div>";
						}
						$mesTemp = $mes['dados']['descricaoMes'];
						$liMes .= "<a title='Abrir ".$mesTemp."' href='#conteudo' style=' padding-right: 1.0em; color:#5776b0' onClick=javascript:exibirBotaoRelatorio('" . $dado['ano'] . "-" . $mes['dados']['descricaoMes'] . "');>" . $mes['dados']['descricaoMes'] . "</a>";
						$tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=" . $dado['ano'] . "-" . $mes['dados']['descricaoMes'] . ">";
					}
					$anexo = $mes['dados']['anexo'];
					$tabelasRow .= "<a title='Link para: ". $anexo['descricao']."' style='width: 60%;text-align: center;text-decoration: none;' class='box box-col-3' href='#conteudo' onclick=\"exibirArquivo('../../gestao-orcamentaria/resultado-pdf', '".$anexo['id']."', 'SV21', '".urlencode("GESTÃO ORÇAMENTÁRIA/" . retiraBarras("LIMITAÇÃO DE EMPENHO - 317/2014") . "/" . $dado['ano'] . "/" . $mes['dados']['descricaoMes'] . "/" . retiraBarras($anexo['descricao']))."')\">";
					$tabelasRow .= $anexo['descricao'] . "</a>";
					//$tabelasRow .= "<div class='clearfix'></div></div>";
				endforeach;
				$tabelasRow .= "<div class='clearfix'></div></div>";?>
				<div class="row report">
					<ul>
						<?= $liAno ?>
						<?= $liMes ?>
					</ul>
				</div>
			<?php echo $tabelasRow;
			endforeach;?>
		</div>
		<div id="div_arquivo"></div>
	</div>
</div>