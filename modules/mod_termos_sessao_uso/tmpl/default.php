<?php defined('_JEXEC') or die;
include_once 'func.php';

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


$ordernar = false;
$i1 = 0;
foreach ($dados['listaTermoCessaoUso']['return'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
        $dados['listaTermoCessaoUso']['return'][$i1]['anoPublicacao'] = $horarioAno2[2];
        $dados['listaTermoCessaoUso']['return'][$i1]['ordemDescricao'] = getOrdenacao($group['termos'][0]['descricaoArquivo']);
	}
	$i1++;
}

if ($ordernar) {
	array_sort_by2($dados['listaTermoCessaoUso']['return'], 'anoPublicacao', $order = SORT_ASC);
}

$listaAuxiliar = $dados['listaTermoCessaoUso']['return'];
array_sort_by2($listaAuxiliar, 'ordemDescricao', $order = SORT_DESC);

?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">Termos de Cessão de Uso</div>
            </div>
            <div class="row">
                <small>Última atualização:
                    <?php if (is_array($dados['listaTermoCessaoUso']) && !empty($dados['listaTermoCessaoUso'])) {
                        echo getDataAtualizacao($dados['listaTermoCessaoUso']['return']);
                    } ?>
                </small>
            </div>
            <?php
            $ano = 0;
            if (is_array($dados['listaTermoCessaoUso']) && !empty($dados['listaTermoCessaoUso'])) {
                for ($i = count($dados['listaTermoCessaoUso']['return']) - 1; $i >= 0; $i--) {
                    $list = $dados['listaTermoCessaoUso']['return'][$i];
                    if (!empty($list['dataFimVigencia'])) :
                        $horarioAno = explode("/", $list['dataAtualizacao']);
                        if ($ano != $horarioAno[2]) :
                            $ano = $horarioAno[2];
                            ?>
            <div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[2]; ?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button" title="Expandir ano de <?php echo $horarioAno[2]; ?>"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo"  title="Baixar em PDF" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo"  title="Baixar em XML" role="button" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    XML
                </a>
                <a href="#conteudo"  title="Baixar em CSV" role="button" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    CSV
                </a>
                <a href="#conteudo" title="Imprimir" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_<?= $ano; ?>">
                    <thead>
                        <tr>
                            <th>Termo de Cessão de Uso </th>
                            <th>Instituto</th>
                            <th>Vigência (até)</th>
                            <th>Aditivos</th>
                        </tr>
                    </thead>
                    <?php
                    $texto = "";
                    foreach ($listaAuxiliar as $listDados) :
                    //foreach ($dados['listaTermoCessaoUso']['return'] as $listDados) :
                        if (!empty($listDados['dataAtualizacao'])) :
                            $horarioAno2 = explode("/", $listDados['dataAtualizacao']);
                            if ($horarioAno2[2] == $horarioAno[2]) :
                                $texto .= '<tr><td>';
                                ?>
                    <tr>
                        <td>
                            <?php foreach ($listDados['termos'] as $listaPdf) :
                                $texto .= "<br>";
                                ?>
                            <br>
                            <?php if (!empty($listaPdf['exibe'])) :
                                $texto .= "<a title='Link para: ". $listaPdf['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listaPdf['codigo']."', 'SV1', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cessão de Uso/" . $horarioAno2[2] . "/" . $listDados['instituicao'] . "/" . $listaPdf['descricaoArquivo'])."')\">";
                                $texto .= $listaPdf['descricaoArquivo'] . "</a>";
                                ?>
                            <a title="Link para: <?php echo $listaPdf['descricaoArquivo']; ?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listaPdf['codigo']; ?>', 'SV1', '<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Cessão de Uso/' . $horarioAno2[2] . '/' . $listDados['instituicao'] . '/' . $listaPdf['descricaoArquivo']);  ?>')">
                                <?php echo $listaPdf['descricaoArquivo']; ?>
                            </a>
                            <?php endif;    ?>
                            <?php endforeach;
                        $texto .= "</td>"
                        ?>
                        </td>
                        <td>
                            <?php echo $listDados['instituicao'];
                            $texto .= "<td>" . $listDados['instituicao'] . "</td>";
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $listDados['dataFimVigencia'];
                            $texto .= "<td>" . $listDados['dataFimVigencia'] . "</td><td>";
                            ?>
                        </td>
                        <td>
                            <?php foreach ($listDados['aditivos'] as $listAditivo) :
                                $texto .= "<br>";
                                $texto .= "<a  title='Link para: ". $listAditivo['descricaoArquivo'] ."' href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listAditivo['codigo']."', 'SV12', '".urlencode("CONVÊNIOS E ACORDOS/Termos de Cessão de Uso/" . $horarioAno2[2] . "/" . $listDados['instituicao'] . "/" . $listAditivo['descricaoArquivo'])."')\">";
                                $texto .= $listAditivo['descricaoArquivo'] . "</a>";
                                ?>
                            <br><a title="Link para: <?php echo $listAditivo['descricaoArquivo']; ?>" href="#conteudo" onclick="exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $listAditivo['codigo']; ?>', 'SV12', '<?php urlencode('CONVÊNIOS E ACORDOS/Termos de Cessão de Uso/' . $horarioAno2[2] . '/' . $listDados['instituicao'] . '/' . $listAditivo['descricaoArquivo']);  ?>')"><?php echo $listAditivo['descricaoArquivo']; ?></a>
                            <?php endforeach;
                        $texto .= "</td>"
                        ?>
                        </td>
                    </tr>
                    <?php	endif;
            endif;
        endforeach; ?>
                </table>
                <?php 
                //Aqui conteém o HTML que vai ser trandormado em PDF.
                $htmlPDF = "<h3>Termos de Cessão de Uso</h3>";
                $htmlPDF .= "<h4>" . $ano . "</h4>";
                $htmlPDF .= "<table border=1 id='tabela_" . $ano . "' cellspacing=0 cellpadding=5 >
							<tr>
								<th>Convênio</th>
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
    endif;
}
} ?>
        </div>
    </div>
</div> 

<div id="div_arquivo"></div>	