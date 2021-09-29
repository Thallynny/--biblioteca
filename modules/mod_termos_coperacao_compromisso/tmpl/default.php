<?php defined('_JEXEC') or die;

//echo "<pre>";
//var_dump($dados['listaParceria']);
//echo "<pre>";

function getOrdenacao($descricao){

	$descTemp = trim(strtoupper($descricao));
	$descTemp = str_replace("ACORDO", "", $descTemp);
	$descTemp = str_replace("TERMO", "", $descTemp);
	$descTemp = str_replace("PROTOCOLO", "", $descTemp);
	$descTemp = str_replace("DE", "", $descTemp);
	$descTemp = str_replace("COOPERAÇÃO", "", $descTemp);
	$descTemp = str_replace("COOPERAçãO", "", $descTemp);
	$descTemp = str_replace("COMPROMISSO", "", $descTemp);
	$descTemp = str_replace("PARCERIA", "", $descTemp);
	$descTemp = str_replace("N", "", $descTemp);
	$descTemp = str_replace("T", "", $descTemp);
	$descTemp = str_replace("PARC", "", $descTemp);
	$descTemp = str_replace("º", "", $descTemp);
	$descTemp = str_replace("°", "", $descTemp);
	$descTemp = str_replace(".", "", $descTemp);
	$descTemp = str_replace(" ", "", $descTemp);
	$descTemp = trim($descTemp);

	if (!empty($descTemp)) {

		if(strpos($descTemp, '/20') !== false){
			if(strpos($descTemp, '-') !== false){
				$anoNumero = explode("-", $descTemp);
				foreach ($anoNumero as $temp) {
					if(strpos($temp, '/20') !== false){
						$descTemp = $temp;
						break;	
					}
				}
			}
			$anoNumero = explode("/", $descTemp);
		}else{
			$anoNumero = explode("-", $descTemp);
		}
		
		$ano = intval($anoNumero[1]);
		$numero = intval($anoNumero[0]) < 10 ? '0' . intval($anoNumero[0]) : intval($anoNumero[0]);
		
		return $ano.$numero;
	}
	return "";
}

function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();
		foreach($array['return'] as $datas){
			if(empty($datas['dataFimVigencia'])){
				$datas = $array['return'];
			}
				$relatorio = $array['return'];
				$dataTemp = DateTime::createFromFormat('d/m/Y', $datas['dataFimVigencia']);
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
		}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function array_sort_by2(&$arrIni, $col, $order = SORT_ASC)
{
	$arrAux = array();
	foreach ($arrIni as $key => $row) {
		$arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
		$arrAux[$key] = strtolower($arrAux[$key]);
	}
	array_multisort($arrAux, $order, $arrIni);
}



function getDataAtualizacao4($array){
	
	$dataAtualizacao = new DateTime();
	if(is_array($array) && !empty($array)){
		for ($i = 0; $i < count($array); $i++) {
			
			
			if(empty($array[$i])){
				$relatorio =  $array;
			}else{
				$relatorio = $array[$i];
			}
			
			if($i == 0){
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $relatorio['dataFimVigencia']);
			}else{
				$dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataFimVigencia']);
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function getDataAtualizacao3($array){
	$dataAtualizacao = new DateTime();
	if(is_array($array) && !empty($array)){
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if($i==0){
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
			}else{
				$dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function retiraBarras($string){
    $string = str_replace("/", "&#47;", $string);
    return $string;
}

function getLista($lista){

	//Se 'termos' estiver na lista, então deve-se criar um array e colocar a lista dentro;
	if(array_key_exists('termos', $lista)){
		$lista = array($lista);
	}

	$i1 = 0;
	foreach ($lista as  $group) {
		$lista[$i1]['ordemDescricao'] = getOrdenacao($group['termos'][0]['descricaoArquivo']);
		$i1++;
	}
	
	$listaAux = $lista;
	array_sort_by2($listaAux, 'ordemDescricao', $order = SORT_DESC);

	return $listaAux;
}



function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}


$dados['listaCoperacao']['return'] = getLista($dados['listaCoperacao']['return'], 'dataFimVigencia', $order = SORT_DESC);
$dados['listaParceria']['return'] = getLista($dados['listaParceria']['return'], 'dataFimVigencia', $order = SORT_DESC);
?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-4 aba selecionado" data-aba="1">
            <div><a title="<?= $dados['dados']['titulo_tab_1'] ?>" class="textoSemSublinhado" href="#container"><?= $dados['dados']['titulo_tab_1'] ?></a></div>
        </div>
        <div class="col-md-4 aba" data-aba="2">
            <div><a  title="<?= $dados['dados']['titulo_tab_2'] ?>" class="textoSemSublinhado" href="#container"><?= $dados['dados']['titulo_tab_2'] ?></a></div>
        </div>
		<div class="col-md-4 aba" data-aba="3">
            <div><a  title="<?= $dados['dados']['titulo_tab_3'] ?>" class="textoSemSublinhado" href="#container"><?= $dados['dados']['titulo_tab_3'] ?></a></div>
        </div>
    </div>
</div>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_1'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao3($dados['listaCoperacao']['return']); ?></small>
            </div>

		<?php
        $ano = 0;
        foreach ($dados['listaCoperacao'] as $list2) {
			foreach ($list2 as $list) {
				$horarioAno = explode("/",$list['dataFimVigencia']);
				$anoOrdem = substr($list['ordemDescricao'], 0, 4);
				if(intval($horarioAno[2]) != intval($anoOrdem) && intval($anoOrdem) > 0){
					$horarioAno[2] = intval($anoOrdem);
				}
				if($ano != $horarioAno[2]):
					$ano = $horarioAno[2];
				?>
				<div class="row report">
					<ul>
						<li class="titulo"><?php echo $horarioAno[2];?></li>
						<li class="arrow-down"><a href="#conteudo"  title="Expandir ano de <?php echo $horarioAno[2];?>" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
					</ul>
				</div>
				<div class="row botoes w100">
					<a href="#conteudo" title="Baixar em PDF"  role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						PDF
					</a>
					<a href="#conteudo" title="Baixar em XML"  role="button"  class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						XML
					</a>
					<a href="#conteudo" title="Baixar em CSV"  role="button"  class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						CSV
					</a>
					<a href="#conteudo" role="button"  title="Imprimir"  class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
						<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
						IMPRIMIR
					</a>
					<div class="clearfix"></div>
					<div class="spacer"></div>
					<div class="spacer"></div>
					<table id="tabela_<?= $ano; ?>">
						<thead>
							<tr>
								<th>Termo de Cooperação</th>
								<th>Instituto</th>
								<th>Vigência (até)</th>
								<th>Aditivos</th>
							</tr>
						</thead>
			<?php	
			$texto = "";
			foreach($dados['listaCoperacao'] as $listDados2){
				//foreach($listDados2 as $listDados){
				foreach (getLista($listDados2) as $listDados) {
					$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
					$anoOrdemTemp = substr($listDados['ordemDescricao'], 0, 4);
					if (intval($horarioAno2[2]) != intval($anoOrdemTemp) && intval($anoOrdemTemp) > 0) {
						$horarioAno2[2] = intval($anoOrdemTemp);
					}
					if($horarioAno2[2] == $horarioAno[2]):
						$texto .= '<tr><td>';
					?>
					<tr>
						<td>
						<?php foreach($listDados['termos'] as $listaPdf):
							$texto .= "<br>";
						?>
							<br>
							<?php if(!empty($listaPdf['exibe'])):	
								$texto .= "<a title='Link para: ". $listaPdf['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listaPdf['codigo']."', 'SV2', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/" .$dados['dados']['titulo_box_1']."/". $horarioAno2[2] . "/" . retiraBarras($listDados['instituicao']) . "/" . retiraBarras($listaPdf['descricaoArquivo']))."')\"  >";
                                $texto .= $listaPdf['descricaoArquivo'] . "</a>";
                                ?>
							<a title="Link para: <?php echo $listaPdf['descricaoArquivo'];?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listaPdf['codigo']; ?>', 'SV2', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/'.$dados['dados']['titulo_box_1'].'/'.$horarioAno2[2].'/'.retiraBarras($listDados['instituicao']).'/'.retiraBarras($listaPdf['descricaoArquivo']));  ?>')" >
									<?php echo $listaPdf['descricaoArquivo'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						$texto .= "</td>"?>	
						</td>
                        <td><?php echo $listDados['instituicao']; $texto .= "<td>" . $listDados['instituicao'] . "</td>";?></td>
                        <td><?php echo $listDados['dataFimVigencia']; $texto .= "<td>" . $listDados['dataFimVigencia'] . "</td><td>";?> </td>
						<td>
						<?php foreach($listDados['aditivos'] as $listAditivo):
							$texto .= "<br>";
							$texto .= "<a title='Link para: ". $listAditivo['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listAditivo['codigo']."', 'SV13', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_1']."/" . $horarioAno2[2] . "/" .retiraBarras($listDados['instituicao']). "/".retiraBarras($listAditivo['descricaoArquivo']))."')\" >";
							$texto .= $listAditivo['descricaoArquivo'] . "</a>";
                        ?>
						<br><a title="Link para: <?php echo $listAditivo['descricaoArquivo'];?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listAditivo['codigo']; ?>', 'SV13', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/'.$dados['dados']['titulo_box_1'].'/'.$horarioAno2[2].'/'.retiraBarras($listDados['instituicao']).'/'.retiraBarras($listAditivo['descricaoArquivo']))  ?>')"><?php echo $listAditivo['descricaoArquivo'];?></a>
						<?php endforeach;
						$texto .= "</td>"?>	
						</td>
                </tr>
				<?php	endif; 
				}
				}
				?>	
				</table>
				<?php 
					//Aqui conteém o HTML que vai ser trandormado em PDF.
					$htmlPDF = "<h3>".$dados['dados']['titulo_box_1']."</h3>";
					$htmlPDF .= "<h4>" . $ano . "</h4>";
					$htmlPDF .= "<table border=1 id='tabela_" . $ano . "' cellspacing=0 cellpadding=5 >
								<tr>
									<th>Termo de Cooperação</th>
									<th>Instituto</th>
									<th>Vigência (até)</th>
									<th>Aditivos</th>
								</tr>";
					$htmlPDF .= str_replace("<br />", "", $texto);
					$htmlPDF .= "</table>";
					?>
                <div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		}
		}
?>	
		
		
		
		
        </div>
    </div>
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_2'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao3($dados['listaParceria']['return']); ?></small>
            </div>

		<?php
        $ano = 0;
        foreach ($dados['listaParceria'] as $list2) {
		foreach ($list2 as $list) {
			if(!empty($list['dataFimVigencia'])){
				$horarioAno = explode("/",$list['dataFimVigencia']);
				$anoOrdem = substr($list['ordemDescricao'], 0, 4);
				if(intval($horarioAno[2]) != intval($anoOrdem) && intval($anoOrdem) > 0){
					$horarioAno[2] = intval($anoOrdem);
				}
				if($ano != $horarioAno[2]):
					$ano = $horarioAno[2];
					?>
				<div class="row report">
					<ul>
						<li class="titulo"><?php echo $horarioAno[2];?></li>
						<li class="arrow-down"><a title="Expandir ano de <?php echo $horarioAno[2];?>" href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
					</ul>
				</div>
				<div class="row botoes w100">
					<a href="#conteudo" title="Baixar em PDF"  role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							PDF
						</a>
						<a href="#conteudo" title="Baixar em XML"  role="button"  class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'xml');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							XML
						</a>
						<a href="#conteudo" title="Baixar em CSV"  role="button"  class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'csv');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							CSV
						</a>
						<a href="#conteudo" title="Imprimir"  role="button"  class="download" onClick="javascript:baixarDocumento('tabela2_export_<?= $ano; ?>', 'export', '', this);">
							<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
							IMPRIMIR
						</a>
					<div class="clearfix"></div>
					<div class="spacer"></div>
					<div class="spacer"></div>
					<table id="tabela_2_<?= $ano; ?>">
					<thead>
					<tr>
							<th>Termo de Parceria</th>
							<th>Instituto</th>
							<th>Vigência (até)</th>
							<th>Aditivos</th>
					</tr>
					</thead>
				<?php	
				$texto = "";
				foreach($dados['listaParceria'] as $listDados2){
					//foreach($listDados2 as $listDados){
					foreach (getLista($listDados2) as $listDados) {
						$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
						$anoOrdemTemp = substr($listDados['ordemDescricao'], 0, 4);
						if (intval($horarioAno2[2]) != intval($anoOrdemTemp) && intval($anoOrdemTemp) > 0) {
							$horarioAno2[2] = intval($anoOrdemTemp);
						}
						if($horarioAno2[2] == $horarioAno[2]):
							$texto .= '<tr><td>';
						?>
						<tr>
							<td>
							<?php foreach($listDados['termos'] as $listaPdf):
								$texto .= "<br>";
							?>
								<br>
								<?php if(!empty($listaPdf['exibe'])):	
									$texto .= "<a title='Link para: ". $listaPdf['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listaPdf['codigo']."', 'SV3', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/" .$dados['dados']['titulo_box_2']."/". $horarioAno2[2] . "/" . retiraBarras($listDados['instituicao']) . "/" . retiraBarras($listaPdf['descricaoArquivo']))."')\">";
									$texto .= $listaPdf['descricaoArquivo'] . "</a>";
								?>
								<a title="Link para: <?php echo $listaPdf['descricaoArquivo'];?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listaPdf['codigo']; ?>', 'SV3', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/'.$dados['dados']['titulo_box_2'].'/'.$horarioAno2[2].'/'.retiraBarras($listDados['instituicao']).'/'.retiraBarras($listaPdf['descricaoArquivo']));  ?>')">
										<?php echo $listaPdf['descricaoArquivo'];?>
								</a>	
								<?php  endif;	?>
							<?php endforeach;
								$texto .= "</td>";?>	
							</td>
							<td><?php echo $listDados['instituicao']; $texto .= "<td>" . $listDados['instituicao'] . "</td>";?></td>
							<td><?php echo $listDados['dataFimVigencia']; $texto .= "<td>" . $listDados['dataAtualizacao'] . "</td><td>";?> </td>
							<td>
							<?php foreach($listDados['aditivos'] as $listAditivo):
								$texto .= "<br>";
								$texto .= "<a title='Link para: ". $listAditivo['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listAditivo['codigo']."', 'SV14', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_2']."/" . $horarioAno2[2] . "/" .retiraBarras($listDados['instituicao']). "/".retiraBarras($listAditivo['descricaoArquivo']))."')\">";
								$texto .= $listAditivo['descricaoArquivo'] . "</a>";
							?>
							<br><a  title="Link para: <?php echo $listAditivo['descricaoArquivo'];?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listaPdf['codigo']; ?>', 'SV14', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/'.$dados['dados']['titulo_box_2'].'/'.$horarioAno2[2].'/'.retiraBarras($listDados['instituicao']).'/'.retiraBarras($listAditivo['descricaoArquivo']))  ?>')"><?php echo $listAditivo['descricaoArquivo'];?></a>
							<?php endforeach;
							$texto .= "</td>";
							?>	
							</td>
					</tr>
					<?php	endif; 
					}
					}?>	
					</table>
					<?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>".$dados['dados']['titulo_box_2']."</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1 id='tabela_2_" . $ano . "' cellspacing=0 cellpadding=5 >
									<tr>
										<th>Termo de Parceria</th>
										<th>Instituto</th>
										<th>Vigência (até)</th>
										<th>Aditivos</th>
									</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
					<div style="display:none;"><input id="table_2_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
					<div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
					<div class="clearfix"></div>
				</div>
			<?php	endif; 
			}else{
			echo "Não há registro.";
			}
		}
		}?>	
		
        </div>
    </div>
	<div class="row conteudo" data-aba-id="3">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_3'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao4($dados['listaCompromisso']['return']); ?></small>
            </div>
		
		<?php
        $ano = 0;
        foreach($dados['listaCompromisso'] as $list){
		    $horarioAno = explode("/",$list['dataFimVigencia']);
			if($ano != $horarioAno[2]):
				$ano = $horarioAno[2];
				?>
			<div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[2];?></li>
                    <li class="arrow-down"><a href="#conteudo" title="Expandir ano de <?php echo $horarioAno[2];?>"  role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo"  title="Baixar em PDF" role="button" class="download" onClick="javascript:baixarPDF('3_<?= $ano; ?>');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						PDF
					</a>
					<a href="#conteudo"  title="Baixar em XML" role="button"  class="download" onClick="javascript:baixarDocumento('3_<?= $ano; ?>', 'xml');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						XML
					</a>
					<a href="#conteudo"  title="Baixar em CSV" role="button"  class="download" onClick="javascript:baixarDocumento('3_<?= $ano; ?>', 'csv');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						CSV
					</a>
					<a href="#conteudo"  title="Imprimir" role="button"  class="download" onClick="javascript:baixarDocumento('tabela3_export_<?= $ano; ?>', 'export', '', this);">
						<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
						IMPRIMIR
					</a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_3_<?= $ano; ?>">
				<thead>
				<tr>
                        <th>Termo de Compromisso</th>
                        <th>Instituto</th>
                        <th>Vigência (até)</th>
                        <th>Aditivos</th>
                </tr>
				</thead>
			<?php	
			$texto = "";
			//$listaAux = getLista($dados['listaCompromisso']['return']);
			//foreach ($listaAux as $listDados) :
			foreach($dados['listaCompromisso'] as $listDados):
				$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
					if($horarioAno2[2] == $horarioAno[2]):
						$texto .= '<tr><td>';
					?>
					<tr>
                        <td>
						<?php foreach($listDados['termos'] as $listaPdf):
							$texto .= "<br>";
						?>
							<br>
							<?php if(!empty($listaPdf['exibe'])):	
								$texto .= "<a title='Link para: ". $listaPdf['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listaPdf['codigo']."', 'SV4', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/" .$dados['dados']['titulo_box_3']."/". $horarioAno2[2] . "/" . retiraBarras($listDados['instituicao']) . "/" . retiraBarras($listaPdf['descricaoArquivo']))."')\">";
								$texto .= $listaPdf['descricaoArquivo'] . "</a>";
							?>
							<a title="Link para: <?php echo $listaPdf['descricaoArquivo'];?>" 
							href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listaPdf['codigo']; ?>', 'SV4', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/'.$dados['dados']['titulo_box_3'].'/'.$horarioAno2[2].'/'.retiraBarras($listDados['instituicao']).'/'.retiraBarras($listaPdf['descricaoArquivo']));  ?>')">
									<?php echo $listaPdf['descricaoArquivo'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						$texto .= "</td>";
						?>	
						</td>
						<td><?php echo $listDados['instituicao'];
							$texto .= "<td>" . $listDados['instituicao'] . "</td>";
							?>
						</td>
						<td><?php echo $listDados['dataAtualizacao'];
						$texto .= "<td>" . $listDados['dataAtualizacao'] . "</td><td>";
						?> </td>
						<td>
						<?php foreach($listDados['aditivos'] as $listAditivo):
							$texto .= "<br>";
							$texto .= "<a  title='Link para: ". $listAditivo['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listAditivo['codigo']."', 'SV15', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_3']."/" . $horarioAno2[2] . "/" .retiraBarras($listDados['instituicao']). "/".retiraBarras($listAditivo['descricaoArquivo']))."')\">";
							$texto .= $listAditivo['descricaoArquivo'] . "</a>";
						?>
						<br><a  title="Link para: <?php echo $listAditivo['descricaoArquivo'];?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listAditivo['codigo']; ?>', 'SV15', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/'.$dados['dados']['titulo_box_3'].'/'.$horarioAno2[2].'/'.retiraBarras($listDados['instituicao']).'/'.retiraBarras($listAditivo['descricaoArquivo']));  ?>')"><?php echo $listAditivo['descricaoArquivo'];?></a>
						<?php endforeach;
							$texto .= "</td>";
						?>	
						</td>
                </tr>
				<?php	endif; 
				endforeach;?>	
				</table>
					<?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>".$dados['dados']['titulo_box_3']."</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1 id='tabela_3_" . $ano . "' cellspacing=0 cellpadding=5 >
									<tr>
										<th>Termo de Compromisso</th>
										<th>Instituto</th>
										<th>Vigência (até)</th>
										<th>Aditivos</th>
									</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
					?>
					<div style="display:none;"><input id="table_3_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
					<div style="display:none;" id="tabela3_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		}?>	
		
			
        </div>
    </div>

</div>
<div id="div_arquivo"></div>	