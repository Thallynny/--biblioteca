<?php defined('_JEXEC') or die;

require_once 'func.php';

$WService = $list['dados']['url_webservice'];
$list = $list['dados']['dados'];

$dataHoje = date("d/m/Y");
$ordernar = false;
$i = 0;
foreach ($list as $group) {
	$horarioAno2 = explode("/", $group['dataPublicacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list[$i]['anorevista'] = $horarioAno2[2];
		$mes = intval($horarioAno2[1]);
		$list[$i]['numeroMes'] = $mes;
		$list[$i]['descExibicao'] = getMes($mes);
		$i++;
	}
}

$listAux = $list;
if ($ordernar) {
	array_sort_by2($list, 'anorevista', $order = SORT_ASC);
	array_sort_by2($listAux, 'numeroMes', $order = SORT_DESC);
}
?>

<div class="row">
	<div class="titulo">Boletins de Jurisprudência</div>
</div>
<div class="row">
	<small>Última atualização: <?php echo getDataAtualizacaoBoletim($list); ?></small>
</div>
<div class="row">
	<div class="titulo">PERÍODOS</div>
</div>
<div class="row boxes">
	<a href="#container" class="box textoSemSublinhado selecionado" onclick="exibirBoletins('0','<?php echo $WService; ?>')">De 2019 - Atualidade</a>
	<a href="#container" class="box textoSemSublinhado" onclick="exibirBoletins('1','<?php echo $WService; ?>')">De 2007 a 2018</a>
	<a href="#container" class="box textoSemSublinhado" onclick="exibirBoletins('2','<?php echo $WService; ?>')">De 1989 a 2006</a>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="spacer"></div>
<div style="display:none;">
	<input type="text" id="WService" value="<?php echo $WService; ?>" />
	<input type="text" id="idMesOcultar" value="vazio" />
</div>

<div id="resultado">
<?php
$ano = 0;

for ($i = count($list) - 1; $i >= 0; $i--) {
	$atas = $list[$i];
	$horarioAno = explode("/", $atas['dataPublicacao']);
	if ($ano != $horarioAno[2]) {
		$ano = $horarioAno[2]; ?>
		<div class="row report">
			<ul>
				<li><?php echo $horarioAno[2]; ?></li>
				<table id="tabela_<?= $ano; ?>">
					<thead>
						<tr>
							<?php
							$texto = "";
							$textoAux = "";
							$mes = "";
							$botao = "";
							$textoBotoes = "";
							foreach ($listAux as $listDados) {
								$horarioAno2 = explode("/", $listDados['dataPublicacao']);
								if ($horarioAno2[2] == $ano) {
									if ($mes != $listDados['descExibicao']) {
										if ($mes != "") {
											$textoBotoes .= detalhamentoRelatorio($ano . $mes, $botao);
											$botao = "";
										}
										$mes = $listDados['descExibicao'];
										$textoAux .= "<li>
											<a role='button' href='#conteudo' onClick=\"javascript:exibirBotaoRelatorio('" . $ano . $listDados['descExibicao'] . "', this)\">
											" . $listDados['descExibicao'] . "</a></li>";
									}
									$botao .= "<li><a href='#conteudo' role='button' class='box' onClick=\"exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '".$listDados['id']."', 'SV30', '".urlencode("INSTITUCIONAL/GABINETE REVISTA/Boletins de Jurisprudência/" . $ano . "/" . $listDados['descExibicao'] . "/" . retiraBarras($listDados['descricao']))."')\">
											" . $listDados['descricao'] . "</a></li>";
								}
							}
							echo $textoAux;
							?>
						</tr>
					</thead>
				</TABLE>
			</ul>
		</div>
		<?php
			$textoBotoes .= detalhamentoRelatorio($ano.$mes, $botao);
			echo $textoBotoes;
		?>
<?php }
}
?>
</div>
<div id="div_arquivo"></div>	
<script>
	(function() {
		var WService = document.getElementById("WService");
		var codigo = "0";
		var p_codigo = document.getElementById("p_codigo");
		if (p_codigo) {
			codigo = p_codigo.value;
		}
		if (WService && codigo) {
			exibirBoletins(codigo, WService.value);
		}
	})();
</script>