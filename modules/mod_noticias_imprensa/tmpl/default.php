<?php 
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
 
//var_dump($list);

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container demonstrativo bg_azul_fundo" >
  <div class="row conteudo selecionado responsivo" data-aba-id="1" style="padding-bottom: 20px;">

    <!-- TITULO -->
	
	<div class="titulo ">
			<h4><b>Notícias</b></h4>
	</div>
    <div class="col-12 col-noticia">
		
      <div class="spacer"></div>
   <br>
        <small><b>PESQUISAR POR</b></small>
     <br> 
      <!-- FORM CONSULTA -->
        
		  <div style=" line-height: 3.5"><img src="templates/portalTransparencia/images/arrow_down_2.svg" style="transform: rotate(270deg); height: 8px; padding: 0px 0px 0px 4px; margin-left: -5px;">Palavra, Texto ou frase</div>
          <form id="formPesquisa" method="post" class="form-baixa-login">
			<input type="hidden" id="inputLimite" name="limite" value="0">
            <input type="hidden" id="inputPagina" name="pagina" value="12">
            <input type="hidden" id="qtdRegistros" name="qtdRegistros" value="0">
            <input type="hidden" id="banner" name="banner" value="true">
			
            <div class="">
              <input 
                name="txtTextoPesquisa"
                id="inputPesquisaImprensa" 
                class="a-campo-i6-6 inputPesquisarNoticiaTexto" 
                type="text" 
                placeholder="Palavra, frase ou texto que deseja encontrar"  
                style="margin-top:0px;text-align: left;padding: 6px 3px;">
            </div>
       
		 <div style=" line-height: 3.5"><img src="templates/portalTransparencia/images/arrow_down_2.svg" style="transform: rotate(270deg); height: 8px; padding: 0px 0px 0px 4px; margin-left: -5px;">Período (Intervalo)</div>
        <div class="col-12">
            <div class="row">
              <div class="" style="padding: 0 5px 5 0;">
				<input 
                  data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy"
                  id="dataInicioNoticia"
                  style="text-align: left; text-align-last: left; margin-top:0px;padding: 6px 3px;" 
                  class="inputPesquisarNoticiaPeriodo" 
                  name="txtDataInicio" 
                  type="text"
                  placeholder="Data Início">
              </div>
              <div class="" style="padding: 0 0 0 0px;">
                <input 
                  data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy"
                  id="dataFimNoticia"
                  style="text-align: left; left; text-align-last: left; margin-top:0px;padding: 6px 3px;" 
                  class="inputPesquisarNoticiaPeriodo" 
                  name="txtDataFim" 
                  type="text"
                  placeholder="Data Fim">
              </div>
            </div>
		</div>

				<div class="col-12 ">
				<br>
					<div class="row">
						<div id="resultadoPesquisa" style="" class="resultadoPesquisa"></div>
					<div class="" >
							<div  style="padding: 0 5 5 0;">
							<input 
								style="padding: 6px 3px;"
							  id="inputPesquisaBotao" 
							  type="button"
							  class="inputNoticiaBotao botaoProcurar "
							  alt="Aperte neste botão para que a sua pesquisa seja executada."
							  title="Aperte neste botão para que a sua pesquisa seja executada."
							  value="Procurar">
						  </div>
					</div>
					<div class="">
							<div  style="padding: 0 0 0 0;">
							<input 
							  style="padding: 6px 3px;"
							  id="inputBotaoLimpar" 
							  type="button"
							  class="inputNoticiaBotao botaoLimparNoticia"
							  alt="Aperte neste botão para limpar a sua pesquisa e reiniciá-la, caso ache necessário."
							  title="Aperte neste botão para limpar a sua pesquisa e reiniciá-la, caso ache necessário."
							  value="Limpar">
							</div>
					</div>
					</div>
				</div>
		</form>
		<br><br>		
	</div>

      <!-- NOTICIAS -->
      <div class=" p-0 row-noticia">
        <div class="col-12 p-0" style="left: 25px;">
          <div class="container_conteudo" id="noticiasContainer">
		  
		  <hr style=" width: 93%;  MARGIN-LEFT: 11px;  border: 1px solid;    border-color: #fff;"></hr>
		
	
          <h5 STYLE="MARGIN-LEFT: 11px;"><b>VER TODAS AS NOTÍCIAS</b></h5>
			 <?php
			 $listaNoticias = $list['listaNoticias'];
		   foreach($listaNoticias as $noticia): ?>

              <a class="box_simples" href="index.php/noticias/leitura-de-noticias?/id=<?= $noticia['id']; ?>" style="text-decoration: none; color: #5776B0">  
                <div class="conteudo_noticias" style=" cursor: pointer;">
				<?php 
				$limitTexto = "225";
				$legenda = "";
				$imagem = "vazio";
				
				if(!empty($noticia['anexos'])){
					$listaAnexos = $noticia['anexos'];
										
					//var_dump($listaAnexos);					
					if(empty($listaAnexos['url'])) {
						//echo "is array ";
						foreach($listaAnexos as $anexo){
							//var_dump($anexo);
							if($imagem == "vazio"){
								$file_teste_link = get_headers($anexo['url']);	
								$verfica_arquivo = strpos($file_teste_link[0], '404 Not Found');
								if(!$verfica_arquivo  ){
									$pos = strpos($anexo['title'], 'jpg');
									$pos2 = strpos($anexo['title'], 'png');
									if(($pos || $pos2)  ){
									$imagem = $anexo['url'];
									$limitTexto = 225;
									$legenda = $anexo['legenda'];
									}
								}
							}
						}
					}else{
						//echo "isnt array ";
						$file_teste_link = get_headers($noticia['anexos']['url']);	
						$verfica_arquivo = strpos($file_teste_link[0], '404 Not Found');
						if(!$verfica_arquivo  ){
							$pos = strpos($noticia['anexos']['title'], 'jpg');
							$pos2 = strpos($noticia['anexos']['title'], 'png');
							if(($pos || $pos2)  ){
							$imagem = $noticia['anexos']['url'];
							$limitTexto = 225;
							$legenda = $noticia['anexos']['legenda'];
							}
						}
					}						
					//var_dump($imagem);					
				}
				
				
					?>
					<div class="" style=" " title="<?php echo $noticia['titulo']; ?>" alt="<?php echo $noticia['titulo']; ?>">
					
					<?php if(!empty($noticia['anexos']) && $imagem != "vazio"){ ?> 
					<img class="fundo noticia-imagem" src="<?php echo $imagem; ?>"  >	
						
						<div class="noticia-anexo" style="display:none" alt=" Há <?= $noticia['quantidadeAnexos']; ?> anexo(s) nessa notícia" title=" Há <?= $noticia['quantidadeAnexos']; ?> anexo(s) nessa notícia" style="">Anexo(s): <?= $noticia['quantidadeAnexos']; ?></small>
						</div>
						<div class="noticia-legenda" style="">
						</div>
						
					<?php }else{ ?>
						<div class="noticia-imagem"></div>
						
						<?php } ?>
					</div>
                  <div class="titulo lower ml-4 noticia-resolucao270" style="color:#3AB186;margin-top: 11px;" ><?= $noticia['titulo']; ?></div> 
                  <div class="p-box-noticias-1 ml-4 mr-3 mt-3 noticia-resolucao270">
                    <?php echo mb_strimwidth(strip_tags(html_entity_decode($noticia['texto'])), 0, $limitTexto, "..."); ?>
                  </div>
                </div>
                <img class="conteudo_icone_mais" width="20" alt="Para ler a notícia completa, clique aqui." title="Para ler a notícia completa, clique aqui." src="templates/portalProcessosConsultas/images/plus.svg">
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      
    </div>
    <br/>
    <br/>

		<center>
			<button id="buttonLoadMore" class="button-load-more" title="Para listar mais notícias, clique aqui."  alt="Para listar mais notícias, clique aqui." value="Carregar mais">
				Carregar Mais
			</button>
			 <br/>
    <br/>
			
		</center>
		  </div>
		
  <div class="clearfix"></div>
</div>
