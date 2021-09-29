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

	function getDataAtualizacaoArtigo2($array){
		$dataAtualizacao = new DateTime();
		if(is_array($array) && !empty($array)){
			for ($i = 0; $i < count($array); $i++) {
				$relatorio = $array[$i];
				if($i==0){
					$dataAtualizacao = new DateTime($relatorio->modified);
				}else{
					$dataTemp = new DateTime($relatorio->modified);
					if($dataTemp > $dataAtualizacao){
						$dataAtualizacao = $dataTemp;
					}
				}
			}
		}

		$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
		return $dataAtualizacao;
	}

	function getOrdenacao($descricao){
		$descTemp = trim(strtoupper($descricao));
		$descTemp = str_replace("T", "", $descTemp);
		$descTemp = str_replace("CRED", "", $descTemp);
		$descTemp = str_replace(".", "", $descTemp);
		$descTemp = str_replace(" ", "", $descTemp);
		$descTemp = trim($descTemp);

		if(!empty($descTemp)){
			$anoNumero = explode("/", $descTemp);
			$ano = $anoNumero[1];
			$numero = intval($anoNumero[0]) < 10 ? '0'.intval($anoNumero[0]) : intval($anoNumero[0]);
	
			return $ano.$numero;
		}
		
		return "";
	}

?>