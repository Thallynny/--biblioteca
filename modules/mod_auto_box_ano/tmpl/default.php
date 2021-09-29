<?php defined('_JEXEC') or die;
include_once 'func.php';

$ano = "";
if (!empty($dados['params']['ano'])) {
	if (empty($dados['dadosDetalhado'])) {
		echo "Não existe conteúdo.";
		exit;
	} else {
		foreach ($dados['dadosDetalhado'] as $arr) {
			if (is_array($arr)) {
				if ($dados["params"]['nomeServico'] == "Legislacao Sumulas") {
					echo conteudoSumulas($arr, $dados, $dados['params']['mes']);
				} else if (($dados['params']['categoria'] == "Legislacao Portaria CJF")  ||  ($dados['params']['categoria'] == "Legislacao Corregedoria Regimento Int") ||  ($dados['params']['categoria'] == "Legislacao Regimento Interno")) {
					echo portariaCJF($arr, $dados, $dados['params']['mes']);
				} else if ($dados['params']['categoria'] == "Legislacao Conselho Adm Decisoes") {
					echo decisaoConselhoAdm($arr, $dados, $dados['params']['mes']);
				} else {
					echo conteudo($arr, $dados, $dados['params']['mes']);
				}
			}
		}
	}
	exit;
}

if (strpos($_SERVER["REQUEST_URI"], "aba02")) {
	echo "	<script>
		$(document).ready(function(){
			$('.aba01').removeClass('selecionado');
			$('.aba02').addClass('selecionado');
			$('.aba03').removeClass('selecionado');
			$('.legislacaotrf5').removeClass('selecionado');
			$('.legislacaocorregedoria').addClass('selecionado');
			$('.legislacaoatos').removeClass('selecionado');
		});	
		</script>
		";
}else if (strpos($_SERVER["REQUEST_URI"], "aba01")) {
	echo "	<script>
		$(document).ready(function(){
			$('.aba01').addClass('selecionado');
			$('.aba02').removeClass('selecionado');
			$('.aba03').removeClass('selecionado');
			$('.legislacaotrf5').addClass('selecionado');
			$('.legislacaocorregedoria').removeClass('selecionado');
			$('.legislacaoatos').removeClass('selecionado');
		});
		</script>
		";
}else if (strpos($_SERVER["REQUEST_URI"], "aba03")) {
	echo "	<script>
		$(document).ready(function(){
			$('.aba01').removeClass('selecionado');
			$('.aba02').removeClass('selecionado');
			$('.aba03').addClass('selecionado');
			$('.legislacaotrf5').removeClass('selecionado');
			$('.legislacaocorregedoria').removeClass('selecionado');
			$('.legislacaoatos').addClass('selecionado');
		});
		</script>
		";
}

$aba = "aba01";
if ($dados['params']['nomeServico']  ==  "getLegislacaoCorregedoriaInstitucional") {
	$aba = "aba02";
} else if ($dados['params']['nomeServico']  ==  "getAtosConjuntos") {
	$aba = "aba03";
}

if(empty($dados['dados'])){
	$dados['dados']['anos'] = array();
}
if (!empty($dados['dados']['anos'])) {
	if (empty($dados['dados']['anos'][0]['ano'])) {
		$dados['dados']['anos'] = array($dados['dados']['anos']);
	}
}
?>

<div id="1111">
	<div class="row">
		<div class="titulo"><?php echo $dados['params']['titulo_tab_1']; ?> </div>
	</div>

	<div class="row">
		<small>Última atualização: <?php echo getDataAtualizacaoA($dados['dados']['anos']); ?></small>
	</div>

	<div class="clearfix"></div>
	<div class="spacer"></div>

	<div style="display:none;">
		<input type="text" id="idMesOcultar" value="vazio" />
	</div>

	<div style="display:none;">
		<input type="text" value="" id="ultimoID">
	</div>

	<?php
	$boxes = "";
	$selecao = "";
	$munui = 0;
	if ($dados['menu'] != null) {
		foreach ($dados['menu'] as $categoria) {
			if (empty($categoria['categoria'])) {
				$categoria = $dados['menu'];
				$munui++;
			}
			if ($categoria['categoria'] == $dados['params']['categoria']) {
				$selecao = "selecionado";
			} else {
				$selecao = "";
			}
			if ($munui <= 1) {
				$boxes .= "<a href='" . $dados['params']['titulo_tab_2'] . "?/categoria=" . $categoria['categoria'] . "&" . $aba . "#container' class='box aba022 $selecao textoSemSublinhado'>" . $categoria['descricao'] . "</a>";
			}
		}
	}
	?>
	<div class="row boxes">
		<?php echo $boxes; ?>
	</div>
	<div class="clearfix"></div>
	<div class="spacer"></div>

	<?php
	$divs = "";
	if (!empty($dados['dados']['anos'])) { ?>
		<ul>
			<li style="padding: 0; border-right:0px"></li>|
			<?php foreach ($dados['dados']['anos'] as $anos) :
				$divs .= "<div class='row botoes2 w100' style='display: none; ' id='" . $anos['ano'] . "--00'>";
				$divs .= "<div id='" . $anos['ano'] . "--00'>teste</div>";
				$divs .= "<div class='clearfix'></div></div>"; ?>
				<li class="menu_ano">
					<a onClick="exibirConteudoAutoBox('<?php echo $anos['ano'] . "--00--" . $dados['params']['categoria'] . "--" . $dados['params']['titulo_tab_2'] . "--" . $dados['params']['nomeServico']; ?>')">
						<?= $anos['ano']; ?>
					</a>
				</li>|
			<?php endforeach; ?>
		</ul>
	<?php echo $divs;
	}
	?>
</div>
<div id="div_arquivo"></div>