<?php

function array_sort_by3(&$arrIni, $col, $order = SORT_ASC){
    $arrAux = array();
    foreach ($arrIni as $key=> $row)
    {
        $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
        $arrAux[$key] = strtolower($arrAux[$key]);
    }
    array_multisort($arrAux, $order, $arrIni);
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

function retiraBarras($string)
{
    $string = str_replace("/", "&#47;", $string);
    return $string;
}

function retiraEnter($string){
    $string = str_replace("%0D%0A", "+", $string);
    return $string;
}

function montarTabela($lista, $nome, $tipo){
    $listaFiltrada = array_filter($lista, function ($registro) use ($nome, $tipo) {
        return $registro['tipoAquisicao'] == $tipo && $registro['nomeDesembargador'] == $nome;
    });

    $listaFiltrada = ordernarPorData($listaFiltrada);

    $texto = "
    <div class='row botoes w100' style='display: none;' id='" .urlencode($nome) . "-" . urlencode($tipo) . "'>
        <a href='#conteudo' role='button' class='download' onClick=javascript:baixarPDF('".urlencode($nome) . "-" . urlencode($tipo) . "');>
            <div class='icone'><img src='../templates/portalTRF5/images/download.svg'></div>
            PDF
        </a>
        <a href='#conteudo' role='button' class='download' onClick=\"javascript:baixarDocumento('tabela_export_".urlencode($nome) ."-".urlencode($tipo)."' , 'export', 'Produção Intelectual dos Desembargadores', this);\">
            <div class='icone'><img src='../templates/portalTRF5/images/impressora.svg'></div>
            IMPRIMIR
        </a>
        <div class='clearfix'></div>
        <div class='spacer'></div>
        <div class='spacer'></div>
        <table id='tabela_" . urlencode($nome) . "-" . urlencode($tipo) . "'>
            <tr>
                <th>DATA</th>
                <th>DESCRIÇÃO</th>
            </tr>";

    $textoRegistro = "<tbody>";
    foreach ($listaFiltrada as $registro) {
        $textoRegistro .= "<tr>
                        <td>" . $registro['dataAtualizacao'] . "</td>
                        <td>
                            <a href='#conteudo' onclick=\"exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '" . $registro['id'] . "', 'SV49', '" . retiraEnter(urlencode("BIBLIOTECA/PRODUÇÃO INTELECTUAL/". $registro['nomeDesembargador']. "/". $registro['tipoAquisicao']."/".trim(retiraBarras($registro['titulo'])))) . "')\">
                            " . $registro['titulo'] . "</a>
                        </td>
                    </tr>";
    }
    $textoRegistro .= "</tbody>";

    $texto .= $textoRegistro;
    $texto .= "</table>";

    //Aqui conteém o HTML que vai ser trandormado em PDF.
    $htmlPDF = "<h3>Produção Intelectual dos Desembargadores </h3>";
    $htmlPDF .= "<h4>".$nome."</h4>";
    $htmlPDF .= "<h5>".$tipo."</h5>";
    $htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
                    <tr>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>";
    $htmlPDF .= str_replace("<br />", "", $textoRegistro);
    $htmlPDF .= "</table>";	

    $texto .= "
        <div style='display:none;'>
            <input id='table_" . urlencode($nome) . "-" . urlencode($tipo) . "' type='text' value='".urlencode($htmlPDF)."' />
        </div>
        <div style='display:none;' id='tabela_export_" . urlencode($nome) . "-" . urlencode($tipo) . "'>".$htmlPDF."</div>
        <div class='clearfix'></div>
    </div>";

    return $texto;
}

function getTipos($lista, $nome){
    $listaFiltrada = array_filter($lista, function ($registro) use ($nome) {
        return $registro['nomeDesembargador'] == $nome;
    });
    $listaTipos = array();
    foreach ($listaFiltrada as $registro) {
        if(!in_array($registro['tipoAquisicao'], $listaTipos)){
            array_push($listaTipos, $registro['tipoAquisicao']);
        }
    }
    asort($listaTipos);
    return $listaTipos;
}

function ordernarPorData($lista){

    $retorno = array();
    foreach ($lista as $group) {
        $horarioAno2 = explode("/", $group['dataAtualizacao']);
        if (!empty($horarioAno2[2])) {
            $group['dataOrdem'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
            array_push($retorno, $group);
        }
    }

    $retorno = array_sort($retorno, 'dataOrdem', SORT_DESC);
    return $retorno;
}

?>