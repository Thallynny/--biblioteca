<?php

/**
 * @package     Portal.Site
 * @subpackage  Templates.portalTRF5
 *
 * @copyright   Copyright (C) 2018 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

$path    = $this->baseurl . "/templates/" . $this->template;
$pathCSS = $path . "/css/";
$pathJS  = $path . "/javascript/";
$pathIMG = $path . "/images/";

// No direct access.
defined('_JEXEC') or die; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Portal TRF5</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= $path; ?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= $path; ?>/favicon.ico" type="image/x-icon" />
    <link href="<?= $pathCSS; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>owl.carousel.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>owl.theme.default.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>datatables.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>style.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>pesquisaGeral.css" rel="stylesheet">
    <style type="text/css">
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        body {
            top: 0px !important;
        }
    </style>
    <script type="text/javascript">
        var comboGoogleTradutor = null;

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'pt',
                includedLanguages: 'en,es,pt',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            }, 'google_translate_element');

            comboGoogleTradutor = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
        }

        function changeEvent(el) {
            if (el.fireEvent) {
                el.fireEvent('onchange');
            } else {
                var evObj = document.createEvent("HTMLEvents");

                evObj.initEvent("change", false, true);
                el.dispatchEvent(evObj);
            }
        }

        function trocarIdioma(sigla) {
            if (comboGoogleTradutor) {
                comboGoogleTradutor.value = sigla;
                changeEvent(comboGoogleTradutor); //Dispara a troca
            }
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body>
    <div class="container hidemobile">
        <div class="row topo">
            <div class="col-6 text-right acessibilidade" style="position: relative;left:50%">
                <a href="#Inicio_Conteudo" accesskey="1" target="_self" tabindex="1"><span class="botao" alt="Acessar o Conteúdo Principal da Página" title="Acessar o Conteúdo Principal da Página">Conteúdo Principal&nbsp;&nbsp;</span></a>
                <button style="background-image: url(<?= $pathIMG; ?>acessibilidade_ap.svg); width:1.2rem;height:1.2rem;border:none;background-repeat:none;" class="btnFontMais" alt="A+" title="Aumentar o tamanho das letras" tabindex="2"></button>
                <button style="background-image: url(<?= $pathIMG; ?>acessibilidade_am.svg); width:1.2rem;height:1.2rem;border:none;background-repeat:none;" class="btnFontMenos" alt="A-" title="Diminuir o tamanhao das letras" tabindex="3"></button>
                <button style="background-image: url(<?= $pathIMG; ?>acessibilidade_c.svg); width:1.2rem;height:1.2rem;border:none;background-repeat:none;" class="btnDaltonismo" alt="Disco com uma metade azul e outra branca" tabindex="4" title="Ativar ou desativar o modo Portal da Justiça Federal da 5ª Região em tons de cinza"></button>
                <button style="background-image: url(<?= $pathIMG; ?>acessibilidade_back.svg); width:1.2rem;height:1.2rem;border:none;background-repeat:none;" class="btnVoltarNormal" alt="Seta para a esquerda" title="Desfazer a configuração que foi escolhida" tabindex="5"></button>
                <button style="background-image: url(<?= $pathIMG; ?>acessibilidade_t.svg); width:1.2rem;height:1.2rem;border:none;background-repeat:none;" class="btnTradutor" title="Traduzir" alt="Tradução não oficial do TRF5" tabindex="6"></button>
            </div>
            <div class="col-6 links nopadding" style="position: relative;right:50%">
                <a href="http://www.jfal.jus.br/" target="_blank" tabindex="7"><span class="botao" title="Acessar o Portal da Seção Judiciária de Alagoas">JFAL&nbsp;&nbsp;</span></a>
                <a href="http://www.jfce.jus.br/" target="_blank" tabindex="8"><span class="botao" title="Acessar o Portal da Seção Judiciária do Ceará">JFCE&nbsp;&nbsp;</span></a>
                <a href="http://www.jfpb.jus.br/" target="_blank" tabindex="9"><span class="botao" title="Acessar o Portal da Seção Judiciária da Paraiba">JFPB&nbsp;&nbsp;</span></a>
                <a href="http://www.jfpe.jus.br/" target="_blank" tabindex="10"><span class="botao" title="Acessar o Portal da Seção Judiciária de Pernambuco">JFPE&nbsp;&nbsp;</span></a>
                <a href="http://www.jfrn.jus.br/" target="_blank" tabindex="11"><span class="botao" title="Acessar o Portal da Seção Judiciária do Rio Grande do Norte">JFRN&nbsp;&nbsp;</span></a>
                <a href="http://www.jfse.jus.br/" target="_blank" tabindex="12"><span class="botao" title="Acessar o Portal da Seção Judiciária de Sergipe">JFSE&nbsp;&nbsp;</span></a>
            </div>
        </div>
        <div id="barraIdiomas" class="hidemobile" style="display:none; margin-right:9px ; font-size: 0.625rem; text-align: end;">
            <a href="javascript:trocarIdioma('en')">Inglês</a> /
            <a href="javascript:trocarIdioma('es')">Espanhol</a> /
            <a href="javascript:trocarIdioma('pt')">Português</a>
            <br>A tradução não é de responsabilidade do TRF5.
        </div>


        <div class="row">
            <div class="col-2 buscafield">
            </div>
            <div class="col-8 text-center">
		<a class="ajusta_logoCampanha" href="index.php/nas/cuidados-com-a-saude-na-pandemia"><img src="https://www.trf5.jus.br/images/junho-vermelho/logoMaiorJunhoVermelho20210526.png" alt="Campanha de Doação de Sangue - Junho Vermelho"></a>
                <img style="width:31.25rem" src="<?= $pathIMG; ?>trf5-completo.svg" alt="Logo Institucional – Portal da Justiça Federal da 5ª Região - Tribunal Regional Federal da 5ª Região">
            </div>
            <div class="col-2 busca_home text-center">
                <div class="row">
                    <div class="input-group inner-addon">
                        <input accesskey="3" tabindex="13" type="text" class="form-control inputPesquisaHomeWeb" placeholder="Consultar por" title="Digite um texto sobre o assunto que deseja encontrar no Portal do Tribunal Regional Federal da 5ª Região"></input>
                        <span class="input-group-addon" style="background:transparent;border:none">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <a href="index.php/ouvidoria" style="text-decoration:none;  font-size: 0.875rem;" title="Acesse ao Serviço de Informação ao Cidadão">SIC – Serviço de Informação ao Cidadão</a>
            </div>
        </div>
        <div class="row menu_index" title="Menu Principal">
            <a id="Menu_Principal" name="Menu_Principal"></a>
            <!-- MENU PRINCIPAL -->
            <jdoc:include type="modules" name="menuPrincipal" style="none" />
        </div>
    </div>
    <div class="atalhos" hidden>
        <a href="#Menu_Principal" accesskey="2" title="Atalho para o Menu Principal">
            <samp class="botao">| Menu Principal |</samp>
        </a>
        <a href="#Rodape" accesskey="4" title="Atalho para o Rodapé">
            <samp class="botao">| Rodapé |</samp>
        </a>
    </div>

    <div id="google_translate_element" class="boxTradutor" style="display:none"></div>
    <div class="headermenu mobileonly">
        <img class="logo" src="<?= $pathIMG; ?>logo.svg" alt="logo TRF5">
        <img class="togglemobilemenu hamburger" src="<?= $pathIMG; ?>harmburger.svg" alt="Imagem com linhas horizontais paralelas para representar menu fechado">
        <div class="clearfix"></div>
    </div>
    <div class="headermenucontent">
        <img class="togglemobilemenu close_menu" src="<?= $pathIMG; ?>close_menu.svg" alt="imagem com um X para fechar o menu">
        <div class="itens">
            <!-- MENU PRINCIPAL -->
            <jdoc:include type="modules" name="menuPrincipal" />
            <ul style="list-style:none;">
                <li>
                    <div class="input-group inner-addon" id="Search">
                        <input id="pesquisa" type="text" class="form-control inputPesquisaHome" placeholder="Consultar por" title="Digite um texto sobre o assunto que deseja encontrar no Portal do Tribunal Regional Federal da 5ª Região" />
                        <span class="input-group-addon" style="background:transparent !important;border:none !important;">
                            <svg style="margin-top:1.5rem" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg>
                        </span>
                    </div>
                </li>
                <li><a href="index.php/ouvidoria" style="color:#5776B0; text-decoration:none" title="Acesse ao Serviço de Informação ao Cidadão">SIC – Serviço de Informação ao Cidadão</a></li>
            </ul>
        </div>
    </div>


    <div id="fixado" class="hidemobile hided">
        <div class="container">
            <div class="row menu">
                <div class="col-2">
                    <img src="<?= $pathIMG; ?>logo.svg" alt="logo TRF5">
                </div>
                <div class="col-10">
                    <ul class="list-inline">
                        <!-- MENU PRINCIPAL -->
                        <jdoc:include type="modules" name="menuPrincipal" style="none" />
                        <li class="botao list-inline-item btnOuvidoria"><a href="index.php/ouvidoria" style="color:#FFF; text-decoration:none; ">SIC – Serviço de Informação ao Cidadão</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <?php

    if (strpos($_SERVER['REQUEST_URI'], "pesquisa-processual")) : ?>
        <jdoc:include type="modules" name="consultaProcessual" style="none" />
    <?php endif; ?>


    <?php if (strpos($_SERVER['REQUEST_URI'], "pesquisa") != false) : ?>
        <jdoc:include type="modules" name="consultaGeral" style="none" />
    <?php else : ?>

        <!-- CONSULTA PROCESSUAL -->
        <div id="boxConsultaProcessual">
            <jdoc:include type="modules" name="consultaProcessual" style="none" />
        </div>


        <!-- BANNER HOME -->
        <div id="boxBanner">
            <jdoc:include type="modules" name="bannerHome" style="none" />
        </div>

        <!-- Inicio do banner do PJE -->

        <a href="#" onClick="javascript:fecharBannerInformacaoPJE()">
            <div style="display:block; float:right;margin-top:-1px;padding:6px">
                <img src="images\portal\ico-close.png" width="1.375rem" alt="x" title="Aperte o x para fechar">
            </div>
        </a>

        <!-- Fim do banner PJE -->

        <!-- Inicio do banner Coronavirus -->
        <div class="coronavirus" id="campanhaCoronaVirus">
            <a href="index.php/trf5-no-combate-ao-coronavirus">

                <div style="display:block; float:left;margin-top:-10px">
                    <img src="templates\portalTRF5\images\CoronavirusCOVID-19AzulPetroleopq.png" alt="Imagem representativa do Coronavírus" title="TRF5 DURANTE A PANDEMIA: PRODUTIVIDADE, CONTATOS, NORMAS E AUXÍLIO EMERGENCIAL" style="width:3.625rem">
                </div>
                <a href="#" onClick="javascript:coronavirus()">
                    <div class=" coronavirusTexto" style="border:0px solid;" alt="TRF5 DURANTE A PANDEMIA: PRODUTIVIDADE, CONTATOS, NORMAS E AUXÍLIO EMERGENCIAL" title="TRF5 DURANTE A PANDEMIA: PRODUTIVIDADE, CONTATOS, NORMAS E AUXÍLIO EMERGENCIAL">
                        TRF5 DURANTE A PANDEMIA: PRODUTIVIDADE, CONTATOS, NORMAS E AUXÍLIO EMERGENCIAL
                    </div>
                </a>
            </a>
            <a href="#" onClick="javascript:fecharCampanhaCoronaVirus()">
                <div style="display:block; float:right;margin-top:-1px;padding:6px">
                    <img src="images\portal\ico-close.png" width="1.375rem" alt="x" title="Aperte o x para fechar">
                </div>
            </a>
        </div>
        <!-- Fim do banner Coronavirus -->

        <!-- CODIGO DE LIBRAS START -->
        <!-- Este código tem JS para alterar a posição de acordo com o estado do widget -->
        <a href="#" onclick="librasClicked()">
            <div vw class="enabled" style="position: sticky; top: 27%; float: right; margin-top: 2vh; margin-left: -100%;" title="Acessível em VLibras">
                <div vw-access-button class="active"></div>
                <div vw-plugin-wrapper>
                    <div class="vw-plugin-top-wrapper"></div>
                </div>
            </div>
        </a>
        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
        <!-- CODIGO DE LIBRAS END-->
        <div class="container" style="margin-top: 5px;" title="Conteúdo da Página">

            <div class="row nopadding" id="Principal" name="Principal">
                <div class="col-12 nopadding colmainbox" title="Inicio do Conteúdo da página">
                    <a id="Inicio_Conteudo" name="Inicio_Conteudo" href="index.php/consulta-processual-fisico-e-eletronico" class="main_box duplo" style="color: #fff; text-decoration: none;" title="Acessar a Busca Processual">
                        <div class="icone"><img src="<?= $pathIMG; ?>lupa.svg" alt="Representação gráfica de uma lupa"></div>
                        Busca Processual
                    </a>
                    <a class="main_box split" href="index.php/portal-transparencia" style="text-decoration: none; color: #fff" title="Acessar ao Portal da transparência">
                        <div class="icone"><img style="width: 12.5rem;max-width: 3.75rem;" src="<?= $pathIMG; ?>branco_olho.svg" alt="Representação gráfica de um Olho"></div>
                        Portal da transparência
                    </a>
                    <a class="main_box split" href="index.php/noticias" style="text-decoration: none; color: #fff" title="Acessar a Mais notícias">
                        <div class="icone"><img src="<?= $pathIMG; ?>conversa.svg" alt="Representação gráfica de um balão de mensagens"></div>
                        Mais notícias
                    </a>
                </div>
            </div>


            <div class="row boxMiniMenuPortal">
                <div class="spacer"></div>
                <!-- MINI MENU PORTAL -->
                <!-- <div class="boxMiniMenuPortal"> -->
                <jdoc:include type="modules" name="miniMenuPortal" style="none" />
                <!-- </div> -->
            </div>

            <div class="row m5">
                <div class="col-12 nopadding">

                    <div class="estilo_mod_menu_bot_home" style="border: 0px solid;float:right">

                        <!-- MENU BOTTOM HOME -->
                        <jdoc:include type="modules" name="menuBotHome" style="none" />
                    </div>

                    <div class="main_box_medio duplo cnj">
                        <div class="left">
                            <div class="cont">
                                <a href="index.php/pje" title="Acesse o Processo Judicial Eletrônico">
                                    <div class="icone"><img src="<?= $pathIMG; ?>pje.svg" alt="Representação gráfica para PJe"></div>
                                </a>
                            </div>
                        </div>
                        <div class="center">
                            <div class="cont">
                                <a href="index.php/pje" style="text-decoration: none; color: #fff;" title="Acesse o Processo Judicial Eletrônico">
                                    <span>PROCESSO<br> JUDICIAL ELETRÔNICO</span><br>
                                    <div class="small">Acesse aqui tudo o que precisar de maneira prática</div>
                                </a>
                            </div>
                        </div>
                        <div class="right">
                            <div class="cont">
                                <a href="index.php/pje " style="padding:5px" title="Acesse o Processo Judicial Eletrônico">
                                    <div class="box">O que é PJe</div>
                                </a>
                                <a href="index.php/pje?action=acesso-pje" style="padding:5px" title="Acesse os Acessos ao PJE">
                                    <div class="box">Acesso ao PJe</div>
                                </a>
                                <a href="https://pje.trf5.jus.br/pje/ConsultaPublica/listView.seam" style="padding:5px;" target="blank" title="Acesse a Consulta Pública do PJE">
                                    <div class="box">Consulta Pública</div>
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- MINI BANNER -->
                    <jdoc:include type="modules" name="miniBannerHome" style="none" />


                </div>
            </div>
        </div>
        <div class="container">
            <div class="spacer"></div>
            <div class="spacer"></div>

            <!-- NOTICIAS API -->
            <jdoc:include type="modules" name="noticiasHome" style="none" />

        </div>

    <?php endif; ?>

    <div class="footer">
        <div class="container">
            <img class="fixadorodape" src="<?= $pathIMG; ?>scroll.png" class="scrolltop" alt="Subir para o topo">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="row" style="position: relative;">
                        <div class="box fullwidth h158 align-self-center" style="position: relative">
                            <div class="icone icone_azul" style="position: absolute; top: -35px; left: calc(50% - 80px);"><img src="<?= $pathIMG; ?>acessibilidade_icones.png" alt="Representação gráfica para Acessibilidade Visual e Auditiva"></div>
                            Este site é preparado para<br>
                            pessoas com deficiências<br>
                            visual e auditiva<br>
                            <div class="acessibilidade">
                                <a id="Rodape" name="Rodape"></a>
                                <a href="#Principal" target="_self"><span style="color:#ffffff" title="Acessar o Conteúdo da Página">Conteúdo Principal&nbsp;&nbsp;</span></a>
                                <img class="botao btnFontMais" src="<?= $pathIMG; ?>a-1.svg" alt="A+" title="Aumentar o tamanho das letras">
                                <img class="botao btnFontMenos" src="<?= $pathIMG; ?>a-2.svg" alt="A-" title="Diminuir o tamanhao das letras">
                                <img class="botao btnDaltonismo" src="<?= $pathIMG; ?>a-3.svg" alt="Disco com uma metade azul e outra branca" title="Ativar ou desativar o modo Portal da Justiça Federal da 5ª Região em tons de cinza">
                                <img class="botao btnVoltarNormal" src="<?= $pathIMG; ?>a-4.svg" alt="Seta para a esquerda" title="Desfazer a configuração que foi escolhida">

                                <img class="botao btnTradutor" src="<?= $pathIMG; ?>a-5.svg" title="Traduzir" alt="Tradução não oficial do TRF5">
                                <div id="barraIdiomasInferior" class="hidemobile" style="display:none; color: #fff; margin-right:9px ; font-size: 0.625rem; ">
                                    <a style="color:#ffffff" href="javascript:trocarIdioma('en')">Inglês</a> /
                                    <a style="color:#ffffff" href="javascript:trocarIdioma('es')">Espanhol</a> /
                                    <a style="color:#ffffff" href="javascript:trocarIdioma('pt')">Português</a>
                                    <br>A tradução não é de responsabilidade do TRF5.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="row">
                        <div class="box links h72 c4" style="position: relative">
                            <div class="titulo_links_footer" style="position: absolute; top: -10px; left: calc(50% - 100px);">Acessos diretos</div>
                            <a href="http://www.jfal.jus.br/" target="_blank"><span class="botao" style='color:#ffffff' title="Acessar o Portal da Seção Judiciária de Alagoas">JFAL&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfce.jus.br/" target="_blank"><span class="botao" style='color:#ffffff' title="Acessar o Portal da Seção Judiciária do Ceará">JFCE&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfpb.jus.br/" target="_blank"><span class="botao" style='color:#ffffff' title="Acessar o Portal da Seção Judiciária da Paraiba">JFPB&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfpe.jus.br/" target="_blank"><span class="botao" style='color:#ffffff' title="Acessar o Portal da Seção Judiciária de Pernambuco">JFPE&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfrn.jus.br/" target="_blank"><span class="botao" style='color:#ffffff' title="Acessar o Portal da Seção Judiciária do Rio Grande do Norte">JFRN&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfse.jus.br/" target="_blank"><span class="botao" style='color:#ffffff' title="Acessar o Portal da Seção Judiciária de Sergipe">JFSE&nbsp;&nbsp;</span></a>
                            <div class="clearfix"></div>
                        </div>
                        <a class="botao box small links c1" style="font-weight:bold; font-size: 1.5625rem; width: 15.75rem; text-decoration: none;" href="https://www.trf5.jus.br/index.php/sei" title="Acessar o Sistema Eletrônico de Informações">sei!</a>
                    </div>
                    <div class="row">
                        <a class="botao box small c1 h72" target="_blank" href="https://www2.trf5.jus.br/ccheque/views/login.php" title="Acessar o Recursos Humanos">RECURSOS HUMANOS</a>
                        <a class="botao box small c1 h72" href="index.php/jornal-mural" title="Acessar o Jornal Mural Diario">JORNAL MURAL <br>DIARIO</a>
                        <a class="botao box small c1 h72" target="_blank" href="https://julia.trf5.jus.br/julia/entrar" title="Acessar a Julia">JULIA</a>
                        <a class="botao box small c2 white" style=" width: 15.75rem; text-decoration: none;" target="_blank" href="https://portalbi.trf5.jus.br/portal-bi/login.html" title="Acessar o Portal de Business Intelligence da 5ª Região">PORTAL BUSINESS INTELLIGENCE</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="row">
                        <a class="botao box small h40" href="index.php/lgpd" title="Acessar a LGPD - Lei Geral de Proteção de Dados Pessoais">LGPD - Lei Geral de Proteção <br> de Dados Pessoais</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <a class="botao box small sic white" href="index.php/ouvidoria" title="Acessar o Serviço de Informação ao Cidadão">SIC – Serviço de Informação ao Cidadão</a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="row">
                        <a class="botao box small h40" href="https://webmail.trf5.jus.br" target="_blank" title="Acessar o WEBMAIl">
                            <div class="icone_small"><img src="<?= $pathIMG; ?>mail.svg" alt="Representação gráfica para um envelope de carta"></div>
                            webmail
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="row footerlogo">
			<a href="index.php/nas/cuidados-com-a-saude-na-pandemia"><img src="https://www.trf5.jus.br/images/junho-vermelho/LogoJunhoVermelho20210526_1.png" alt="Campanha de Doação de Sangue - Junho Vermelho"></a>
                        <!--img src="< ?= $pathIMG; ?>trf5.svg" alt="Tribunal Regional Federal 5ª Região" -->
                        <div class="mapadosite" title="Acessar o mapa do site">Mapa do site</div>
                    </div>
                </div>
            </div>
            <div class="row negative-margin">
                <div class="col-9">
                    <div class="address">
                        <ol style="list-style:none">
                            <li><strong>
                                    Cais do Apolo, s/n - Edifício Ministro Djaci Falcão
                                    <br>Bairro do Recife - Recife - PE
                                </strong></li>
                            <li>CEP: 50030-908 | CNPJ:24.130.072/0001-11</li>
                            <li><strong>Horário de Atendimento: </strong> Das 09h às 18h.</li>
                        </ol>
                    </div>
                    <div class="address">
                        <ol style="list-style:none">
                            <li><strong>PABX: </strong><small>81</small> 3425.9000<br></li>
                            <li><strong>Protocolo: </strong><small>81</small> 3425.9550<br></li>
                            <li><strong>FAX: </strong><small>81</small> 3425.9952 | 53 | 54<br></li>
                        </ol>
                    </div>
                    <div class="social row ">
                        <a href="https://pt-br.facebook.com/pages/Tribunal-Regional-Federal-da-5%C2%AA-Regi%C3%A3o-TRF5/190892010955333" target="_blank" title="Link externo para o Facebook desse Portal">
                            <img src="<?= $pathIMG; ?>facebook.svg" alt="Acessar o facebook">
                        </a>
                        <a href="http://twitter.com/TRF5_oficial" target="_blank" title="Acessar o Twitter">
                            <img src="<?= $pathIMG; ?>twitter.svg" alt="Acessar o twitter">
                        </a>
                        <a href="https://www.instagram.com/trf5_oficial/" target="_blank" title="Acessar o Instagram">
                            <img src="<?= $pathIMG; ?>instagram.png" alt="Acessar o Instagram" style="max-width: 2.125rem">
                        </a>
                        <a href="https://www.youtube.com/TRF5Regiao" target="_blank" title="Acessar o Youtube">
                            <img src="<?= $pathIMG; ?>youTube.png" alt="Acessar o Youtube">
                        </a>
                        <a href="http://www.trf5.jus.br/noticias/rss-portal-completas.php" target="_blank" title="Acessar o RSS">
                            <img src="<?= $pathIMG; ?>feed.svg" alt="Acessar o RSS de Notícias">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mapadosite_conteudo">
        <div class="fecha_mapa">
            <img src="<?= $pathIMG; ?>fecha_mapa.png" alt="Imagem de x para fechar o mapa do site">
        </div>
        <div class="box">Mapa do site</div>
        <div class="superior">
            <ul>

                <li class="titulo"><a href="index.php/institucional-home">INSTITUCIONAL</a></li>

                <li><a href="index.php/biblioteca-home">Biblioteca</a> </li>
                <li><a href="index.php/feriados">Feriados</a></li>

                <li><a href="#">Competência e Composição</a></li>

                <li> <a href="index.php/portal-dos-servicos-publicos/administrativo-tela/conselho-de-administracao#container">Conselho de Administração</a></li>

                <li><a href="index.php/corregedoria">Corregedoria</a></li>

                <li><a href="https://ead.trf5.jus.br/login/index.php" target="_blank">Ensino a Distância - Portal EAD</a></li>

                <li><a href="index.php/esmafe-land">ESMAFE</a></li>

                <li><a href="#">Comitê Gestor do Cód. de Conduta (5ª Região)</a></li>

                <li><a href="index.php/ouvidoria" title="Link para Falar com o Presidente">Fale com o Presidente</a></li>

                <li><a href="index.php/gabinete-de-conciliacao" title="Link para o Gabinete de Conciliação">Gabinete de Conciliação</a></li>

                <li><a href="index.php/gabinete-da-revista" title="Link para o Gabinete de Revista">Gabinete de Revista</a></li>

                <li><a href="index.php/gestao-estrategica" title="Link para o Gestão Estratégica">Gestão Estratégica</a></li>

                <li><a href="http://govti.trf5.jus.br/" target="_blank" title="Link externo para Governança de TI">Governança de TI</a></li>

                <li><a href="http://www5.trf5.jus.br/jurisdicao/" target="_blank" title="Link externo para Jurisdição">Jurisdição</a></li>

                <li><a href="#">Lista Telefônica</a></li>

                <li><a href="#">Lista de Diretores</a></li>

                <li><a href="#">Memória</a></li>

                <li><a href="index.php/gestao-socio-ambiental">Responsabilidade Social </a></li>

                <li><a href="#">Organograma de Atribuições </a></li>

                <li><a href="index.php/trf5-sustentavel">TRF5 Sustentável </a></li>

                <li><a href="https://www4.trf5.jus.br/controleinspecao/" target="_blank">Inspeção no TRF5 2018 </a></li>

            </ul>

            <ul>
                <li class="titulo"><a href="index.php/portal-dos-servicos-publicos3">CARTA DE SERVIÇOS</a></li>

                <li><a href="https://www4.trf5.jus.br/baixa-eletronica/" target="_blank">Baixa Eletrônica </a></li>

                <li><a href="http://www5.trf5.jus.br/validar_assinatura/" target="_blank">Autenticidade de Documentos</a></li>

                <li><a href="https://www4.trf5.jus.br/AtaDeDistribuicao/" target="_blank">Atas de Distribuição - Processos Físicos</a></li>

                <li><a href="https://www4.trf5.jus.br/custasinternet/" target="_blank">Cálculos de Custas </a></li>

                <li><a href="https://certidoes.trf5.jus.br/certidoes/" target="_blank" title="Link externo para Certidão Negativa">Certidão Negat. Distri./Eleitoral/Penal</a></li>

                <li><a href="http://www5.trf5.jus.br/pautas_julgamento/" target="_blank">Consulta Pautas de Julgamento - Processos Físicos </a></li>

                <li><a href="index.php/portal-dos-servicos-publicos/tela-processos-fisicos/editais-de-eliminacao-2">Editais de Eliminação</a></li>

                <li> <a href="https://rpvprecatorio.trf5.jus.br/" target="_blank">Consulta RPV/Precatório</a></li>

                <li><a href="index.php/portal-dos-servicos-publicos/tela-judiciais/estatisticas-3">Estatísticas</a></li>

                <li> <a href="https://www4.trf5.jus.br/InteiroTeor/" target="_blank">Consulta Inteiro Teor</a></li>

                <li><a href="https://temis.trf5.jus.br/temis/login.jsf" target="_blank">Consulta de Transação e Suspensão Penal</a></li>

                <li><a href="http://jef.trf5.jus.br/home/home.php" target="_blank" title="Link externo para Juizados Especiais Federais">Juizados Federais - Portal dos JEFs </a></li>

                <li><a href="https://julia-pesquisa.trf5.jus.br/julia-pesquisa" target="_blank" title="Link externo para Jurisprudência TRF 5ª Região">Consulta Jurisprudência</a></li>

                <li><a href="https://www4.trf5.jus.br/processos-sobrestados/" target="_blank" title="Link externo para NUGEP – Processos Sobrestados">NUGEP – Processos Sobrestados</a></li>

                <li><a href="https://diariointernet.trf5.jus.br/diarioeletinternet/" target="_blank" title="Link externo para Diário Eletrônico da JF 5ª Região">Diário Eletrônico da JF 5ª Região</a></li>

                <li><a href="index.php/plantao-da-judiciaria">Plantão da Judiciária</a></li>

                <li><a href="index.php/portal-dos-servicos-publicos/tela-judiciais/quero-conciliar-2">Quero Conciliar!</a></li>

                <li><a href="https://pje.trf5.jus.br/pje/ConsultaPublica/listView.seam" target="_blank" title="Link externo para Processo Judicial Eletrônico">Processo Judicial Eletrônico</a></li>

                <li><a href="https://www4.trf5.jus.br/sustentacao-oral/login.html" target="_blank" title="Link externo para Sustentação Oral por Videoconferência">Sustentação Oral por Videoconferência </a></li>

                <li><a href="https://www4.trf5.jus.br/TRF5_Push/" target="_blank" title="Link para TRF5 Push">TRF5 Push </a></li>

                <li><a href="http://jef.trf5.jus.br/jurisprudencia/jurisprudencia.php" target="_blank" title="Link externo para Juizados Especiais Federais da 5ª Região">Turma Regional – JEF</a></li>

                <li><a href="#">Portaria 35/2017, TRF5</a></li>
            </ul>

            <ul>
                <li class="titulo"><a href="#">PUBLICAÇÕES</a></li>

                <li><a href="#">Planos de Autidoria</a></li>

                <li><a href="index.php/jurisdicao-publicacoes">Boletins de Jurisprudência</a></li>

                <li><a href="https://diariointernet.trf5.jus.br/diarioeletinternet/" target="_blank" title="Link externo para Diário Eletrônico da JF 5ª Região">Diário Eletrônico da JF 5ª Região</a></li>

                <li><a href="index.php/jurisdicao-publicacoes">Revistas de Jurisprudência</a></li>

                <li><a href="index.php/revista-esmafe">Revistas da ESMAFE</a></li>

                <li>&nbsp;</li>

                <li class="titulo"><a href="index.php/legislacao-home">LEGISLAÇÃO</a></li>

                <li><a href="index.php/legislacao-home">Regimento Interno</a></li>

                <li><a href="index.php/legislacao-home">Legislação - Busca por Tipo</a></li>

                <li><a href="index.php/legislacao-home">Portarias da Corregedoria-Geral do CJF</a></li>

                <li><a href="index.php/legislacao-home">Resoluções do CJF</a></li>

                <li><a href="index.php/legislacao-home">Súmulas</a></li>

                <li><a href="index.php/legislacao-home">Resoluções do Conselho de Administração </a></li>

                <li>&nbsp;</li>

                <li class="titulo"><a href="index.php/jurisprudencia-home" target="_blank">JURISPRUDÊNCIA</a></li>

                <li><a href="https://julia-pesquisa.trf5.jus.br/julia-pesquisa" target="_blank" title="Link externo para Jurisprudência TRF 5ª Região">Jurisprudência TRF 5ª Região</a></li>

                <li><a href="index.php/arguicao">Arguição de Inconstitucionalidade</a></li>

                <li><a href="http://jef.trf5.jus.br/jurisprudencia/jurisprudencia.php" target="_blank" title="Link externo para Juizados Especiais Federais da 5ª Região">Jurisprudência Turmas Recursais 5ª Região</a></li>

                <li><a href="index.php/uniformizacao">Uniformização de Jurisprudência</a></li>

                <li><a href="index.php/julgados-escolhidos">Julgados Escolhidos</a></li>

                <li><a href="https://www4.trf5.jus.br/irdr/paginas/publico.xhtml" target="_blank" title="Link para IRDR's">IRDR’s</a></li>

            </ul>

            <ul>
                <li class="titulo"><a href="index.php/portal-transparencia">PORTAL DA TRANSPARÊNCIA</a></li>

                <li><a href="index.php/convenios-e-acordos/termos-de-cooperacao-compromisso-e-parceria">Acordos, Termos e Convênios </a></li>

                <li><a href="index.php/licitacoes-e-contratos/atas-de-registro-de-preco#abaAdesao">Adesões às Atas de Registros de Preços</a></li>

                <li><a href="index.php/gestao-patrimonial">Administração Patrimonial de Bens Móveis</a></li>

                <li><a href="index.php/licitacoes-e-contratos/atas-de-registro-de-preco">Atas de Registro de Preços </a></li>

                <li><a href="index.php/gestao-de-pessoas/atividades-de-docencia-dos-magistrados">Atividades de Docência dos Magistrados</a></li>

                <li><a href="index.php/licitacoes-e-contratos/banco-de-termos-de-referencia">Banco de Termos de Referência</a></li>

                <li><a href="http://www4.trf5.jus.br/contratos_web/" target="_blank">Consulta de Contratos</a></li>

                <li><a href="https://temis.trf5.jus.br/temis/TemisHelp.htm" target="_blank">Consulta Transação e Suspensão Penal</a></li>

                <li><a href="index.php/licitacoes-e-contratos/contratacoes-diretas">Contratações Diretas</a></li>

                <li><a href="index.php/convenios-e-acordos">Convênios</a></li>

                <li><a href="index.php/licitacoes-e-contratos/cotacao-eletronica">Cotações Eletrônicas</a></li>

                <li><a href="index.php/gestao-patrimonial/desfazimento-de-bens">Desfazimento de Bens</a></li>

                <li><a href="#">Justiça Criminal</a></li>

                <li><a href="index.php/licitacoes-e-contratos/licitacoes">Licitações</a></li>

                <li><a href="index.php/licitacoes-e-contratos/participacoes-do-trf5-em-licitacoes-de-outros-orgaos">Participações do TRF5 em licitações de outros Órgãos</a></li>

                <li><a href="index.php/portal-transparencia">Portal da Transparência</a></li>

                <li><a href="index.php/licitacoes-e-contratos/processos-de-aplicacao-de-penalidades">Processos de Aplicação de Penalidades</a></li>

                <li><a href="index.php/gestao-patrimonial/relacao-de-imoveis">Relação de Imóveis</a></li>

                <li><a href="index.php/gestao-patrimonial/relacao-de-obras-reformas-em-execucao">Relação de Obras/Reformas</a></li>

                <li><a href="index.php/gestao-orcamentaria/gestao-demonstrativos-e-relatorios">Relatórios de Gestão</a></li>

                <li><a href="index.php/gestao-orcamentaria/gestao-demonstrativos-e-relatorios">Relatórios de Gestão Fiscal</a></li>

                <li><a href="index.php/ouvidoria" title="Acesse ao Serviço de Informação ao Cidadão">SIC – Serviço de Informação ao Cidadão</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="inferior">
            <ul>
                <li class="titulo"><a href="index.php/imprensa-home">IMPRENSA</a></li>

                <li><a href="index.php/banco-de-imagens">Banco de Imagens</a></li>

                <li><a href="index.php/assessoria-de-imprensa">Contatos</a></li>

                <li><a href="index.php/jornal-mural">Jornal Mural TRF</a></li>

                <li><a href="index.php/noticias">Notícias</a></li>

                <li><a href="index.php/projetos-especiais">Projetos Especiais</a></li>

                <li><a href="index.php/revista-argumento">Revista Argumento</a></li>
            </ul>

            <ul>
                <li class="titulo"><a href="index.php/concursos-selecoes">CONCURSOS E SELEÇÕES</a></li>

                <li><a href="index.php/estagiarios">Estagiários</a></li>

                <li><a href="index.php/magistrados">Magistrados</a></li>

                <li><a href="#">Magistrados – CNJ e CNMP</a></li>

                <li><a href="index.php/servidores-e-nomeacoes">Servidores</a></li>

                <li><a href="index.php/selecoes">Seleções</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <script src="<?= $pathJS; ?>jquery-3.3.1.min.js"></script>
    <script src="<?= $pathJS; ?>datatables.min.js"></script>
    <script src="<?= $pathJS; ?>jquery.mask.min.js"></script>
    <!-- <script src="<?php echo $pathJS; ?>tether.min.js"></script> -->
    <script src="<?= $pathJS; ?>bootstrap.min.js"></script>
    <script src="<?= $pathJS; ?>ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo $pathJS; ?>tether.js?v=3"></script>
    <script src="<?= $pathJS; ?>owl.carousel.min.js"></script>
    <script src="<?= $pathJS; ?>custom.js?v=3"></script>
    <script src="<?= $pathJS; ?>buscaProcessual.js"></script>
    <script src="<?= $pathJS; ?>buscaGeral.js"></script>
    <script src="<?= $pathJS; ?>pesquisaGeral.js"></script>
    <script src="<?= $pathJS; ?>pesquisaProcessual.js"></script>
    <script src="<?= $pathJS; ?>acessibilidade.js"></script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                var sticky = $('#fixado'),
                    scroll = $(window).scrollTop();
                if (scroll >= 100) sticky.addClass('fixed');
                else sticky.removeClass('fixed');
            });
            var anti_bounce_fix;
            $(window).scroll(function() {
                var sticky = $('.fixadorodape'),
                    scroll = $(window).scrollTop();
                var stop = $(document).height() - $('.footer').height() - $(window).height();
                if (scroll >= 100 && scroll < stop) {
                    sticky.addClass('fixed_rodape');
                } else {
                    sticky.removeClass('fixed_rodape');
                }
            });
        });
    </script>
    <script src="https://www.trf5.jus.br/includes/lgpd.js"></script>
</body>

</html>
