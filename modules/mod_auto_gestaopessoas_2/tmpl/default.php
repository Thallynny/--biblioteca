<?php defined('_JEXEC') or die;
$WService = $dados['dados']['url_webservice'];
$idCategoria = $dados['dados']['id_categoria'];
$titulo = $dados['dados']['titulo'];

function getDataAtualizacao($array)
{
	$dataAtualizacao = new DateTime();

	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}

	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function getAnos($array)
{
	$anos = array();
	foreach ($array as $registro) {
		$ano = $registro['ano'];
		if (!in_array($ano, $anos)) {
			array_push($anos, $ano);
		}
	}
	rsort($anos);
	return $anos;
}

function getAnosDescricao($list, $ano)
{
	$listDesc = array();
	foreach ($list as $registro) {
		if ($registro['ano'] == $ano) {
			$desc = explode("-", $registro['descricao']);
			$descricao = trim($desc[1]);
			if (!in_array($ano . "-" . $descricao, $listDesc)) {
				array_push($listDesc, $ano . "-" . $descricao);
			}
		}
	}
	sort($listDesc);
	return $listDesc;
}

function getDadosAnoDesc($list, $desc)
{
	$listAnoDesc = array();
	$anoDesc = explode("-", $desc);
	$ano = $anoDesc[0]; //ano
	$descricao = $anoDesc[1]; //descricao
	foreach ($list as $registro) {
		if ($registro['ano'] == $ano) {
			$regDesc = explode("-", $registro['descricao']);
			$regDescricao = trim($regDesc[1]);
			if ($descricao == $regDescricao) {
				array_push($listAnoDesc, $registro);
			}
		}
	}
	return $listAnoDesc;
}

?>
<!-- 
<div class="spacer"></div>
<div class="spacer"></div>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-6 aba selecionado" data-aba="1">
            <div><a class="textoSemSublinhado" href="#container">Demonstrativos</a></div>
        </div>
        <div class="col-md-6 aba" data-aba="2">
            <div><a class="textoSemSublinhado" href="#container">Relatórios</a></div>
        </div>
    </div>
</div> -->

<div class="container demonstrativo bg_azul_fundo">

	<div class="row conteudo selecionado" data-aba-id="1">

		<div id="posiciona2" style="display:none;">
			<div id="fechar" style="display: flex; justify-content: space-between;">
				<div align=left>
					<h5>Identificação necessária</h5>
				</div>
				<div align=rigth>
					<a href="javascript:fechar();">FECHAR</a>
				</div>
			</div>

			<input type="hidden" id="idDocumento">
			<input type="hidden" id="externo" value="true">
			<div style="padding:10px; color: #5776B0;">

				Nome:<input class="form-control" placeholder="" type="text" id="nomeConsulta" maxlength="50">

				<br />Tipo de Documento:
				<select name="tipoDocumento" id="tipoDocumentoConsulta" class="form-control" placeholder="">
					<option value=""></option>
					<option value="CPF">Cadastro de Pessoas Físicas (CPF)</option>
					<option value="CNH">Carteira Nacional de Habilitação (CNH)</option>
					<option value="RG">Registro Geral de Identidade Civil (RG)</option>
					<option value="TITULO_ELEITOR">Título de Eleitor</option>
				</select>

				<br />Número Documento:<input class="form-control numeroDocumento" placeholder="" type="text" id="numeroDocumentoConsulta" maxlength="14">
				<div id="resultadoConsulta"></div>

				<br /><input class="form-control" value="Acessar" placeholder="Consultar por" type="submit" onClick="javascript:salvarDadosConsultaOrcamentaria()">

			</div>
		</div>

		<div class="col-12">
			<div class="row boxes">
				<a href="#container" class="box textoSemSublinhado selecionado" onclick="exibirSecaoDemostrativoOrcamentario('trf5','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">TRF5</a>
				<a href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfal','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">Alagoas</a>
				<a href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfce','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">Ceará</a>
				<a href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfpb','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">Paraíba</a>
				<a href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfpe','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">Pernambuco</a>
				<a href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfrn','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">Rio Grande do Norte</a>
				<a href="#container" class="box textoSemSublinhado" onclick="exibirSecaoDemostrativoOrcamentario('jfse','<?php echo $WService; ?>', '<?php echo $idCategoria; ?>')">Sergipe</a>
				<div class="clearfix"></div>
			</div>
			<div style="display:none;">
				<input type="text" id="WService" value="<?php echo $WService; ?>" />
				<input type="text" id="idMesOcultar" value="vazio" />
				<input type="text" id="idCategoria" value="<?php echo $idCategoria; ?>" />
			</div>
			<div class='row'>
				<div class='titulo'><?php echo $titulo; ?></div>
			</div>
			<div id="resultado"></div>
			<div id="div_arquivo"></div>
		</div>
	</div>
</div>
<script>
	(function() {
		var WService = document.getElementById("WService");
		var idCategoria = document.getElementById("idCategoria");
		var secao = "trf5";
		var p_secao = document.getElementById("p_secao");
		if (p_secao) {
			secao = p_secao.value;
		}
		if (WService && idCategoria) {
			exibirSecaoDemostrativoOrcamentario(secao, WService.value, idCategoria.value);
		}
	})();
</script>