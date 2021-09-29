<script src="templates/portalTransparencia/javascript/jquery-3.3.1.min.js"></script>
<?php defined('_JEXEC') or die;

$resultado = "";
if (!empty($dados['lista']->return->caminho)) {
	$resultado =   $dados['lista']->return->caminho;
}

$arquivoXLS = "";
$arquivoCSV = "";
$arquivoXML = "";
if (is_array($dados['lista']->return)) {
	foreach ($dados['lista']->return as $arquivos) {
		if (strpos(strtoupper($arquivos->caminho), 'XLS')) {
			$arquivoXLS = $arquivos->caminho;
		}
		if (strpos(strtoupper($arquivos->caminho), 'CSV')) {
			$arquivoCSV = $arquivos->caminho;
		}
		if (strpos(strtoupper($arquivos->caminho), 'PDF')) {
			$resultado = $arquivos->caminho;
		}
		if (strpos(strtoupper($arquivos->caminho), 'XML')) {
			$arquivoXML = $arquivos->caminho;
		}
	}
}

$listaTitulos = explode("/", $dados['niveis']);
$exibirListaNiveis = "";
if ($listaTitulos[0] == "PROCESSOS E CONSULTAS") {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../templates/portalTransparencia/images/lupa_2.svg'>PROCESSSOS<br>E CONSULTAS</div>";
} else if ($listaTitulos[0] == "IMPRENSA") {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../templates/portalTransparencia/images/lupa_2.svg'>IMPRENSA</div>";
} else if ($listaTitulos[0] == "JURISPRUDÊNCIA") {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../templates/portalTransparencia/images/lupa_2.svg'>JURISPRUDÊNCIA</div>";
} else if ($listaTitulos[0] == "CORREGEDORIA") {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../../templates/portalTransparencia/images/lupa_2.svg'>CORREGEDORIA</div>";
} else if ($listaTitulos[0] == "GABINETE REVISTA") {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../templates/portalTransparencia/images/lupa_2.svg'>GABINETE REVISTA</div>";
} else if ($listaTitulos[0] == "PJE") {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../../templates/portalTransparencia/images/lupa_2.svg'>PROCESSO<br>JUDICIÁRIO E<BR>ELETRÔNICO</div>";
} else {
	$exibirListaNiveis .= "<div class='searchlbox'><img src='../../templates/portalTransparencia/images/lupa_2.svg'>Portal do TRF5</div>";
}

foreach ($listaTitulos as $titulos) {
	if ($titulos != "PROCESSOS E CONSULTAS" && $titulos != "IMPRENSA" && $titulos != "JURISPRUDÊNCIA" && $titulos != "CORREGEDORIA" && $titulos != "GABINETE REVISTA") {
		$exibirListaNiveis .= "<div class='searchlbox'>" . $titulos . "</div>";
	}
}
$exibirListaNiveis .= " <div class='searchlbox'>Resultado</div>";

if ($buscaAberta == "true") {
	$exibirListaNiveis .= "<br><div class='fecha' style='border: 1px solid #5776B0; text-align:left; padding:10px'><a href='javascript:goBack();'>VOLTAR À PESQUISA ABERTA</a></div>";
}

$texto = "";
if (strstr($resultado, '.csv')) {
	$f = fopen($resultado, 'r');
	if ($f) {
		$delimitador = ',';
		$cerca = '"';
		$texto = "<table border=0 bgcolor=#fff cellspacing=0 cellpadding=5 >";
		$cabecalho = fgetcsv($f, 0, $delimitador, $cerca);

		$texto .= "<tr>";
		foreach ($cabecalho as $coluna) {
			$texto .= "<td>" . strtoupper($coluna) . "</td>";
		}
		$texto .= "</tr>";

		while (!feof($f)) {
			$linha = fgetcsv($f, 0, $delimitador, $cerca);
			if (!$linha) {
				continue;
			}
			$registro = array_combine($cabecalho, $linha);
			$texto .= "<tr>";
			foreach ($registro as $linha) {
				$texto .= "<td>" . $linha . "</td>";
			}
			$texto .= "</tr>";
		}
		$texto .= "</table>";
		fclose($f);
	}
}
?>

<script>
	var teste = document.getElementById("posiciona").style.display = 'block';

	var linkDocumento = "<?php echo $resultado; ?>";
	document.getElementById('botaoBaixarCSV').disabled = false;
	document.getElementById('botaoBaixarPDF').disabled = false;
	document.getElementById('botaoBaixarXML').disabled = false;
	document.getElementById('botaoBaixarXLS').disabled = false;
	document.getElementById('botaoBaixarIMPRIMIR').disabled = false;
	document.getElementById('nomeResultado').innerHTML = 'Resultado: <?php echo $titulos; ?>';

	document.write("<style> .consulta .box .box { opacity:0.2; }</style>");
	if (linkDocumento.search(".csv") > 0 || linkDocumento.search(".CSV") > 0) {
		var botaoBaixarCSV = document.getElementById("botaoBaixarCSV");
		document.write("<style> .consulta .box .BotaoCSV { opacity:1 }</style>");
		document.getElementById('botaoBaixarCSV').disabled = true;
		botaoBaixarCSV.onclick = function() {
			window.open("<?php echo $resultado; ?>", 'Download');
		}
		botaoBaixarXLS.onclick = function() {
			window.open("<?php echo $resultado; ?>", 'Download');
		}
		document.getElementById('documentoExibir').innerHTML = '<?php echo $texto; ?>';
		document.getElementById('exibirListaNiveis').innerHTML = "<?php echo $exibirListaNiveis; ?>";
	} else if (linkDocumento.search(".pdf") > 0 || linkDocumento.search(".PDF") > 0) {
		document.write("<style> .consulta .box .BotaoPDF { opacity:1 }</style>");
		document.getElementById('botaoBaixarPDF').disabled = true;
		var botaoBaixarPDF = document.getElementById("botaoBaixarPDF");
		document.write("<style> .consulta .box .BotaoPDF { opacity:1 }</style>");
		botaoBaixarPDF.onclick = function() {
			window.open("<?php echo $resultado; ?>", 'Download');
		}
		document.getElementById('documentoExibir').innerHTML = '<object width="100%" height="500" data="<?php echo $resultado; ?>"></object>';
		document.getElementById('exibirListaNiveis').innerHTML = "<?php echo $exibirListaNiveis; ?>";


	} else {
		window.open("<?php echo $resultado; ?>", 'Download');

		$(document).ready(function() { // exibir mensagem quando o tipo do arquivo for diferente de pdf
			$('.noborder ').hide();
			$(".block").append("<p>O Arquivo será baixado automaticamente!</p>");
		});

	}

	if ('<?php echo $arquivoXLS; ?>') {
		var botaoBaixarXLS = document.getElementById("botaoBaixarXLS");
		document.write("<style> .consulta .box .BotaoXLS { opacity:1 }</style>");
		document.getElementById('botaoBaixarXLS').disabled = true;
		botaoBaixarXLS.onclick = function() {
			window.open("<?php echo $arquivoXLS; ?>", 'Download');
		}
	}

	if ('<?php echo $arquivoCSV; ?>') {
		var botaoBaixarCSV = document.getElementById("botaoBaixarCSV");
		document.write("<style> .consulta .box .BotaoCSV { opacity:1 }</style>");
		document.getElementById('botaoBaixarCSV').disabled = true;
		botaoBaixarCSV.onclick = function() {
			window.open("<?php echo $arquivoCSV; ?>", 'Download');
		}

	}

	if ('<?php echo $arquivoXML; ?>') {
		var botaoBaixarXML = document.getElementById("botaoBaixarXML");
		document.write("<style> .consulta .box .BotaoXML { opacity:1 }</style>");
		document.getElementById('botaoBaixarXML').disabled = true;
		botaoBaixarXML.onclick = function() {
			window.open("<?php echo $arquivoXML; ?>", 'Download');
		}
	}
</script>