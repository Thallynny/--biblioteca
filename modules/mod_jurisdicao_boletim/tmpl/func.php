<?php
function array_sort_by2(&$arrIni, $col, $order = SORT_ASC){
	$arrAux = array();
	foreach ($arrIni as $key=> $row)
	{
		$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
		$arrAux[$key] = strtolower($arrAux[$key]);
	}
	array_multisort($arrAux, $order, $arrIni);
}

function getDataAtualizacaoBoletim($array){
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
				if ($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function retiraBarras($string)
{
	$string = str_replace("/", "&#47;", $string);
	return $string;
}

function getMes($numero)
{
	if ($numero == 1) {
		return "JAN";
	} elseif ($numero == 2) {
		return "FEV";
	} elseif ($numero == 3) {
		return "MAR";
	} elseif ($numero == 4) {
		return "ABR";
	} elseif ($numero == 5) {
		return "MAI";
	} elseif ($numero == 6) {
		return "JUN";
	} elseif ($numero == 7) {
		return "JUL";
	} elseif ($numero == 8) {
		return "AGO";
	} elseif ($numero == 9) {
		return "SET";
	} elseif ($numero == 10) {
		return "OUT";
	} elseif ($numero == 11) {
		return "NOV";
	} elseif ($numero == 12) {
		return "DEZ";
	}
}

function detalhamentoRelatorio($id, $botoes)
{
	return
	"<div class='row botoes2' style='display: none' id='" . $id . "'> 
		<ul>
			$botoes
		</ul>    
		<div class='clearfix'></div>                         
	</div>";
}
?>