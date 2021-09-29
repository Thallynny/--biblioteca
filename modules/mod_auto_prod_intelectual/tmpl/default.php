<?php defined('_JEXEC') or die;

include_once 'func.php';

function getDataAtualizacao($array)
{
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

$dados['responseProducao'] =  array_sort($dados['responseProducao'], 'nomeDesembargador', SORT_ASC);
?>
<div class="row">
	<div class="titulo">Produção Intelectual dos Desembargadores</div>
</div>
<div class="row">
	<small>Última atualização: <?php echo getDataAtualizacao($dados['responseProducao']); ?></small>
</div>
<div style="display:none;">
	<input type="text" id="idMesOcultar" value="vazio" />
</div>

<?php $ano = 0;
$prodTipo = "";
function comparar_palavras($name1, $name2)
{
	$patterns = array(
		'a' => '(á|à|â|ä|ã|Á|À|Â|Ä|Ã)',
		'e' => '(é|è|ê|ë|É|È|Ê|Ë)',
		'i' => '(í|ì|î|ï|Í|Ì|Î|Ï)',
		'o' => '(ó|ò|ô|ö|õ|Ó|Ò|Ô|Ö|Õ)',
		'u' => '(ú|ù|û|ü|Ú|Ù|Û|Ü)'
	);
	$name1 = preg_replace(array_values($patterns), array_keys($patterns), $name1);
	$name2 = preg_replace(array_values($patterns), array_keys($patterns), $name2);
	return strcasecmp($name1, $name2);
}

$palavras = [];
foreach ($dados['responseProducao'] as $prod_test) {
	$palavras[] = $prod_test['nomeDesembargador'];
}
uasort($palavras, "comparar_palavras");

//foreach($dados['responseProducao'] as $prod){
foreach ($palavras as $nomeDesemb) {
	if ($prodTipo != $nomeDesemb) {
		$prodTipo = $nomeDesemb;
?>
		<div class="row report">
			<ul>
				<li class="titulo"><?php echo $nomeDesemb; ?></li>
				<li class="arrow-down"><a href="#conteudo" role="button" onClick="javascript:fecharNosFilhos()"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
			</ul>
		</div>
		<div class="row botoes w100">
			<ul>
				<li class='inline'></li>
				<?php
				$listaTipo = getTipos($dados['responseProducao'], $nomeDesemb);
				$liBox = "";
				$tabelaRow = "";
				foreach ($listaTipo as $tipo) {
					$liBox .= "<li class='box' role='button' onClick=javascript:exibirBotaoRelatorio('" . urlencode($nomeDesemb) . "-" . urlencode($tipo) . "');>" . $tipo . "</li>";
					$tabelaRow .= montarTabela($dados['responseProducao'], $nomeDesemb, $tipo);
				}
				echo $liBox;
				?>
			</ul>
			<div class="clearfix"></div>
		</div>
		<?= $tabelaRow ?>
<?php }
} ?>
<div id="div_arquivo"></div>