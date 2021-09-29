<?php
include_once('serviceBuscaGeral.php');
$buscaAbertaServico = null;
$resultado;
$totalRegistros = 0;
if (!empty($termoBusca)) {
    try {
        ini_set("soap.wsdl_cache_enabled", "0");
        $client = new SoapClient($WService);
        $arguments = array('buscaAberta' => array('arg0' => $arg0, 'origem' => $origem, 'nivel' => $nivel, 'termobusca' => $termoBusca, 'pagina' => $pagina, 'limite' => $limite));
        $buscaAbertaServico = $client->__soapCall("buscaAberta", $arguments);
    } catch (Exception $e) {
        $resultado = "Não foi possível efetuar busca.";
    }
} else {
    $resultado = "Consulta vazia, por favor informe o campo para pesquisa.";
}

function getTamanho($str)
{
    if (strlen($str) > 180) {
        return "max-height";
    }
    return "";
}

function getTitle($title)
{
    if (strlen($title) > 40) {
        $newTitle = substr_replace($title, ' ...', 40);
        return $newTitle;
    }
    return $title;
}

function renomearOrigem($origem)
{
    $newOrigem = str_replace('servicos', 'Serviços', $origem);
    return $newOrigem;
}
?>

<div class="box" id="buscaAberta">
    <div class="titulo-consulta-box resultado">Resultado da Pesquisa</div>
    <?php
    if ($buscaAbertaServico != null) {
        $totalRegistros = $buscaAbertaServico->return[0]->totalRegistros;
        if ($totalRegistros == 0) {
            echo "<div class='mt-2'>Nenhum Registro Encontrado.</div>";
        } else { ?>
            <input id="input_buscaAberta" style="display: none;" value="true">
            <ul class="mt-2">
                <?php
                foreach ($buscaAbertaServico as $retornos) {
                    foreach ($retornos as $retorno) {
                        if (isset($retorno->categoria)) {
                            if (is_object($retorno->categoria)) {
                                $pesquisa = $retorno->categoria;
                                $link = str_replace("servicos/", "", $pesquisa->link); ?>
                                <li class="left w100">
                                    <a class="box noborder <?php echo getTamanho($pesquisa->title); ?>" title="Link para <?php echo $pesquisa->title; ?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
                                        <?php echo getTitle($pesquisa->title); ?>
                                    </a>
                                </li>
                                <?php
                            } else {
                                foreach ($retorno->categoria as $pesquisa) {
                                    if (is_object($pesquisa)) {
                                        $link = str_replace("servicos/", "", $pesquisa->link); ?>
                                        <li class="left w100">
                                            <a class="box noborder <?php echo getTamanho($pesquisa->title); ?>" title="Link para <?php echo $pesquisa->title; ?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
                                                <?php echo getTitle($pesquisa->title); ?>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                }
                            }
                        } else if (isset($retorno->conteudo)) {
                            if (is_object($retorno->conteudo)) {
                                $pesquisa = $retorno->conteudo;
                                if (!empty($pesquisa->sv) && $pesquisa->sv != "") { ?>
                                    <li class="left w100">
                                        <button title="Link para <?php echo $pesquisa->title; ?>" class="box noborder <?php echo getTamanho($pesquisa->title); ?>" onClick="exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $pesquisa->id; ?>', '<?php echo $pesquisa->sv; ?>', '<?php echo renomearOrigem($origem); ?>')">
                                            <?php echo getTitle($pesquisa->title); ?>
                                        </button>
                                    </li>
                                <?php
                                } else if (!empty($pesquisa->link) && $pesquisa->link != "") {
                                    $link = str_replace("servicos/", "", $pesquisa->link); ?>
                                    <li class="left w100">
                                        <a class="box noborder <?php echo getTamanho($pesquisa->title); ?>" title="Link para <?php echo $pesquisa->title; ?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
                                            <?php echo getTitle($pesquisa->title); ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            } else {
                                foreach ($retorno->conteudo as $pesquisa) {
                                    if (is_object($pesquisa)) {
                                        if (!empty($pesquisa->sv) && $pesquisa->sv != "") { ?>
                                            <li class="left w100">
                                                <button title="Link para <?php echo $pesquisa->title; ?>" class="box noborder <?php echo getTamanho($pesquisa->title); ?>" onClick="exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $pesquisa->id; ?>', '<?php echo $pesquisa->sv; ?>', '<?php echo renomearOrigem($origem); ?>')">
                                                    <?php echo getTitle($pesquisa->title); ?>
                                                </button>
                                            </li>
                                        <?php
                                        } else if (!empty($pesquisa->link) && $pesquisa->link != "") {
                                            $link = str_replace("servicos/", "", $pesquisa->link); ?>
                                            <li class="left w100">
                                                <a class="box noborder <?php echo getTamanho($pesquisa->title); ?>" title="Link para <?php echo $pesquisa->title; ?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
                                                    <?php echo getTitle($pesquisa->title); ?>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                    }
                                }
                            }
                        }
                    } ?>
                </ul>
            <?php
            }
        }
    } else {
        echo $resultado;
    }
?>
<div class='clearfix'></div>

<?php
if ($totalRegistros > $limite) {
    $qtdRegistros = $pagina + $limite; ?>
    <div id="paginacao" class="col-sm-12">
        <?php
        if ($pagina == 0) { ?>
            <button class="box botao disabled" title="Não há registros anteriores" disabled>Anterior</button>
        <?php
        } else {
            $paginaBusca = $pagina - $limite;
        ?>
            <button class="box botao" title="Buscar registros anteriores" onclick="resultadoBuscaGeral('<?= $WService ?>', '<?= $arg0 ?>', '<?= $origem ?>','<?= $nivel ?>', '<?= $termoBusca ?>' , <?= $paginaBusca ?>, <?= $limite ?>)">Anterior</button>
        <?php
        }

        if ($qtdRegistros >= $totalRegistros) { ?>
            <button class="box botao disabled space" title="Não há próximos registros" disabled>Próximo</button>
        <?php
        } else {  ?>
            <button class="box botao space" title="Buscar próximos registros" onclick="resultadoBuscaGeral('<?= $WService ?>', '<?= $arg0 ?>', '<?= $origem ?>','<?= $nivel ?>', '<?= $termoBusca ?>' , <?= $qtdRegistros ?>, <?= $limite ?>)">Próxima</button>
        <?php
        }
        ?>
    </div>
    <div class='clearfix'></div>
<?php
}
?>
</div>