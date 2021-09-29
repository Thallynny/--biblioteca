<?php
$WService  = (!empty($_GET['WService'])) ? urldecode($_GET['WService']) : "";
$nivel = (!empty($_GET['nivel'])) ? $_GET['nivel'] : "0";
$arg0 = (!empty($_GET['arg0'])) ? $_GET['arg0'] : "biblioteca";
$origem = (!empty($_GET['origem'])) ? $_GET['origem'] : "1";
$params = (!empty($_GET['params'])) ? $_GET['params'] : "0";
$tituloNiveis = (!empty($_GET['tituloNiveis'])) ? $_GET['tituloNiveis'] : "0";
$sentido = (!empty($_GET['sentido'])) ? $_GET['sentido'] : "avancar";
$titleInput = "Digite um texto sobre o assunto que deseja encontrar na Biblioteca";

//Rotina para navegar adiante nas telas
$origens = "";
$listaOrigem = explode("/", $origem);
if (!empty($listaOrigem[count($listaOrigem) - 2])) {
	$origens = $listaOrigem[count($listaOrigem) - 2]; //pega a penultima posição para preencher a opção do botão voltar
	unset($listaOrigem[count($listaOrigem) - 1]); //elimina a ultima posição da lista de string da origem
}

//Rotina para o botão voltar
$origem1 = "";
foreach ($listaOrigem as $teste) {
	$origem1 .= "/" . $teste;
}
$tituloNiveis = str_replace("//", "/", $tituloNiveis);

//remover ultima posição da lista de itens quando voltar apra tela anterior
if ($sentido == "voltar") {
	$listaTitulo = explode("/", $tituloNiveis);
	unset($listaTitulo[count($listaTitulo) - 1]); //elimina a ultima posição da lista de string da origem
	$tituloNiveis = "";
	foreach ($listaTitulo as $titulo) {
		$tituloNiveis .= $titulo . "/";
	}
	$tituloNiveis = substr($tituloNiveis, 0, -1);
}

try {
	ini_set("soap.wsdl_cache_enabled", "0");
	$client = new SoapClient($WService);
	$arguments = array('buscaGuiada' => array('arg0' => $arg0, 'origem' => $origem, 'nivel' => $nivel, 'params' => $params, 'title' => $tituloNiveis));
	$buscaGuiadaServico = $client->__soapCall("buscaGuiada", $arguments);
} catch (Exception $e) {
	$nivel = "resultado";
}

//$numeroElementoBotao = (!empty($buscaGuiadaServico->return->conteudo) && count($buscaGuiadaServico->return->conteudo)> 4)? "" : "noborder";	

function tamanhoFontBotao($str)
{
	if (strlen($str) > 80) {
		return "font-size: 0.625rem;";
	}
	return "";
}

function getTitle($title)
{
	if (strlen($title) > 80) {
		$newTitle = substr_replace($title, ' ...', 80);
		return $newTitle;
	}
	return $title;
}
?>

<?php
if ($nivel == "resultado") {	?>
	<div class="row">
		<div class="col-2">
			<div class="searchlbox">
				Biblioteca
			</div>
		</div>
		<div class="col-10 consultacontainer">
			<button title="Fechar" class="fecha" onClick="fecharBuscaGuiada();">
				FECHAR A JANELA DE PESQUISA X
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12 consultacontainer">
			<div class="box mt-2">
				Não foi possível carregar a consulta geral, <a href="#" onclick="javascript:resultadoBuscaGuiada('biblioteca','1','0','avancar')" title="Tente Novamente">Tente novamente</a>.
				<div class='clearfix'></div>
			</div>
		</div>
	</div>
<?php exit;
}
?>

<?php
if ($nivel == 0) {
	$origemAberta = $arg0;
	$arg = $arg0;
	$subNivel = $nivel;
	$paginaAberta = (!empty($_GET['pagina'])) ? $_GET['pagina'] : 0;
	$limiteAberta = (!empty($_GET['limite'])) ? $_GET['limite'] : 5;
	$termoBuscaAberta = (!empty($_GET['termobusca'])) ? $_GET['termobusca'] : "";
?>
	<div class="row">
		<div class="col-2">
			<div class="searchlbox">
				Biblioteca
			</div>
		</div>
		<div class="col-10 consultacontainer">
			<button title="Fechar" class="fecha" onClick="fecharBuscaGuiada();">
				FECHAR A JANELA DE PESQUISA X
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12 consultacontainer">
			<?php include_once('buscaGeral.php'); ?>
			<div class="box" id="buscaGuiada">
				<div class="titulo-consulta-box">Consulta Guiada</div>
				<ul class="mt-2">
					<?php
					foreach ($buscaGuiadaServico as $retorno) {
						foreach ($retorno->categoria as $botoes) {
							if (is_object($botoes)) {
								if (!empty($botoes->link) && $botoes->link != "") {
									$link = str_replace("biblioteca/", "", $botoes->link);
					?>
									<li class="left">
										<a class="box noborder" title="Link para <?php echo $botoes->title; ?>" style="<?php echo tamanhoFontBotao($botoes->title); ?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
											<?php echo getTitle($botoes->title); ?>
										</a>
									</li>
								<?php } else { ?>
									<li class="left">
										<button title="Link para <?php echo $botoes->title; ?>" class="box noborder" onclick="javascript:resultadoBuscaGuiada('<?php echo $botoes->id; ?>','<?php echo "biblioteca/" . $botoes->id; ?>','<?php echo $nivel + 1; ?>','','<?php echo $botoes->title; ?>', 'avancar')" ;>
											<?php echo getTitle($botoes->title); ?>
										</button>
									</li>
					<?php }
							}
						}
					}
					?>
				</ul>
				<div class='clearfix'></div>
			</div>
		</div>
	</div>
<?php 	}	?>

<?php
if ($nivel >= 1 and $nivel  <= 100) {

	$listaTitulos = explode("/", $tituloNiveis);
	$titulo = "";
	foreach ($listaTitulos as $titulos) {
		$titulo .= " > " . $titulos;
	}
	$titleInput = $titleInput . " na área de " . $listaTitulos[0];
?>
	<div id="id_tela_busca" style="display:none;"><?php //echo $buscaGuiadaServico->return->origem; 
													?></div>
	<div class="row">
		<div class="col-2">
			<div class="searchlbox">
				<?php echo utf8_encode("Biblioteca"); ?>
			</div>
		</div>
		<div class="col-10 consultacontainer">
			<button title="Fechar" class="fecha" onClick="fecharBuscaGuiada();">
				FECHAR A JANELA DE PESQUISA X
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12 consultacontainer">
			<div class="box" id="conteudoGuiada">
				<div class="titulo-consulta-box">Consulta Guiada</div>
				<div class="descricao">
					<button title="Voltar" class="box noborder" onclick="javascript:resultadoBuscaGuiada('<?php echo $origens; ?>','<?php echo $origem1; ?>','<?php echo  $nivel - 1; ?>','0','<?php echo $tituloNiveis; ?>','voltar')" ;>
						VOLTAR
					</button>
					<?php echo $titulo; ?>
				</div>
				<ul class="mt-4">
					<?php
					foreach ($buscaGuiadaServico as $retorno) {
						if (!empty($retorno->conteudo)) {
							foreach ($retorno->conteudo as $botoes) {
								if (is_object($botoes)) {
									if ($botoes->exibe) {
										if (!empty($botoes->sv) && $botoes->sv != "") { ?>
											<li class="left">
												<button title="Link para <?php echo $botoes->title; ?>" class="box noborder" style="<?php echo tamanhoFontBotao($botoes->title); ?>" onClick="exibirArquivo('../index.php/gestao-orcamentaria/resultado-pdf', '<?php echo $botoes->id; ?>', '<?php echo $botoes->sv; ?>', '<?php echo $tituloNiveis; ?>')">
													<?php echo getTitle($botoes->title); ?>
												</button>
											</li>
										<?php
										} else if (!empty($botoes->link) && $botoes->link != "") {
											$link = str_replace("biblioteca/", "", $botoes->link);
										?>
											<li class="left">
												<a class="box noborder" title="Link para <?php echo $botoes->title; ?>" href="<?php echo $link; ?>" <?php echo strpos($link, 'index.php/') ? '' : 'target="_blank"'; ?>>
													<?php echo getTitle($botoes->title); ?>
												</a>
											</li>
										<?php } else { ?>
											<li class="left">
												<button title="Link para <?php echo $botoes->title; ?>" class="box noborder" onclick="javascript:resultadoBuscaGuiada('<?php echo $botoes->path; ?>','<?php echo $origem . "/" . $botoes->path; ?>','<?php echo $nivel + 1; ?>','<?php echo $botoes->params; ?>','<?php echo $tituloNiveis . "/" . $botoes->title; ?>','avancar')" ;>
													<?php echo getTitle($botoes->title); ?>
												</button>
											</li>
					<?php }
									}
								}
							}
						} else {
							echo "Não existe Conteúdo.";
						}
					}
					?>
				</ul>
				<div class='clearfix'></div>
			</div>
		</div>
	</div>
<?php 	}	?>
<div id="div_arquivo"></div>