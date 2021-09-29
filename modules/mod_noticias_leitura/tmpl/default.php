<style type="text/css">
    body {background-color: #fff; font-family: Tahoma,Arial;}
    .posicao {
        position: fixed;
        top: 30%;
        color: #FFF;
        background-color:#E4E8F3;
        text-align: center; 
        z-index: 1000;
		flex-direction: row;
        justify-content: center;
        align-items: center;
		display: none;
    }
	#fundo {
	  opacity: 0.8;
	  background-color: #000;
	  position: fixed;
	  width: 100%;
	  height: 100%;
	  z-index: 98;
	  top: 0;
	  left: 0;
	  display: none;
	}
    #fechar { margin: 5px; font-size: 12px; }
  </style>

<div id="fundo" class="fundo" style="display: none;"></div>
<script>
	document.title = "Portal TRF5 - Imprensa - <?php echo $dados->noticia->titulo; ?>";
</script>

<?php
defined('_JEXEC') or die;

function strip_html_tags2( $text ){
	$text = preg_replace(array('@<((br)|(hr))@iu'),		array(' '),	$text );
	return $text;
}

function strip_html_tags( $text ){
	$text = str_replace("<table","<table bordercor='#5776B0;' ",$text);
	$text = str_replace('border="0"','border="1"',$text);
return str_replace("style=","a=",$text);
}

$texto = strip_html_tags($dados->noticia->texto);
//var_dump($dados);
//exit;
?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1" style="overflow-y: -moz-hidden-unscrollable;" >
		<div class="titulo" style="width: 100%;"> <?php echo $dados->noticia->titulo; ?> 
		<br><small style="margin-left: 0px;text-transform: none;">Última atualização: <?php $date = date_create($dados->noticia->data_publicacao);
echo date_format($date, ' d/m/Y')." às ".date_format($date, 'H:i:s');?></small>
		<br><br>
		</div>
		<br>
		<div class="" style="float:left; ">
		
		
<?php 
//var_dump($dados);
$id_capa = 0;
if(!empty($dados->anexos)){
	foreach($dados->anexos as $anexo){
		if(empty($anexo->id)){
			$anexo = $dados->anexos;
		}
		$file_teste_link = get_headers($anexo->url);	
		$verfica_arquivo = strpos($file_teste_link[0], '404 Not Found');
		if(!$verfica_arquivo  ){
		$pos = strpos(strtolower($anexo->title), 'jpg');
		$pos2 = strpos(strtolower($anexo->title), 'png');
		if(($pos || $pos2)  ){
			if(!empty($anexo) ){	?>
<div id="ampliarImagem" class="posicao" style="display: none; border:1px solid;    left: 10%;"> 
	<div id="fechar" align="right" ><a href="javascript:fechar();" alt="Fechar"  title="Fechar"><button type="button" class="btn btn-primary">FECHAR</button></a></div> 
	<div id="divzap" style="padding: 5px;  ">
	<?php if(!empty($anexo)){ ?>
	<?php $id_capa = $anexo->id;?>
			<img class="fundo resolucao-leitura-ampliar-1" src="<?php echo $anexo->url; ?>"  style="  " alt="<?php echo $anexo->title; ?>" title="<?php echo $anexo->title; ?>">
	<?php }else{ ?>
	<?php $id_capa = $anexo->id;?>
			<div class="resolucao-leitura-ampliar-1" style=" " alt="Imagem padrão das notícias do TRF5." title="Imagem padrão das notícias do TRF5.">
			<img class="fundo resolucao-leitura-ampliar-1" src="https://www5.trf5.jus.br/noticias/get_anexo.php?id=109354&feeder" class="resolucao-leitura-ampliar-1">
			</div>
	<?php }					?>		
	</div>
</div>
				<?php $id_capa = $anexo->id;?>
				<a href="javascript:ampliarImagem();">
				<div class="resolucao-leitura-botao-anexo" alt="<?php echo $anexo->title; ?>" title="<?php echo $anexo->title; ?>" >
				<img class="fundo resolucao-leitura-botao-anexo" src="<?php echo $anexo->url; ?>" style="">
					<div style=" margin-top: -26px; position: relative; z-index: 1;color: #000;"><i><?php //echo mb_strimwidth(strip_tags(html_entity_decode($dados->anexos->legenda)), 0, 27, "..."); ?></i></div>
					<div style="display:none;width:100%; height:21px; background-color: #095aef;   color:#000; margin-top: 25px; opacity: 0.7;position: relative;z-index: 0;">
					</div>
				</div></a> 
				<?php 
				}
				
				break;
			}else{
				echo"<div class='resolucao-leitura-botao-anexo' style='height:1' alt='".$anexo->title."' title='".$anexo->title."'></div>";
			}
			}else{
			echo"<div class='resolucao-leitura-botao-anexo' style='height:1' alt='".$anexo->title."' title='".$anexo->title."'></div>";

				break;
			}
		}
}else{
				?>
				<div class="resolucao-leitura-botao-anexo" style=""  alt="<?php echo $dados->noticia->titulo; ?>" title="<?php echo $dados->noticia->titulo; ?>">
				</div>		
<?php }?>				
        </div>
        <div class="resolucao-leitura " style="width:70%; margin-left:13px;">
			<div class="resolucao-leitura" style="text-align:left;font-size:13px;"><?php echo $dados->noticia->subtitulo; ?></div>
           
			<br><div class="resolucao-leitura" style="text-align: left; font-size: 12.0pt;margin-top: -15px; line-height: 115%;  line-height: 1.5; "><?php echo $texto; ?>
			
			
			<br><div class="fundo"  style="text-align:right; margin-right:2em;">Por: <?php echo $dados->noticia->autor; ?></div>
			
			
			<div class="" style="text-align:lef;">
					 <br> <hr style=" width: 98%;  MARGIN-LEFT: 1px;  border: 1px solid;    border-color: #fff;"></hr>
			<?php 	
					if(!empty($dados->anexos)){	
					echo "";
						foreach ($dados->anexos as $anexo){
						$anexo2 = $anexo;
							if(empty($anexo->id)){
								$anexo = $dados->anexos;
							}
							$legenda = "Anexo";
							if($anexo->title != ""){
								$legenda = $anexo->title;
							}
							if($id_capa != $anexo->id){
								?>
								<a href="<?php echo $anexo->url; ?>" target="blank">
								<div class="" style=" width: 100%; height: 10%;border:0px solid; padding:0px"  alt="Baixar o anexo: <?php echo $anexo->title; ?>" title="Baixar o anexo: <?php echo $anexo->title; ?>"> <?php echo $legenda; ?></div>
								</a>
			<?php 
							if(empty($anexo2->id)){
								break;
							}
						}
						}
						}					?>
					</div><br>
			</div>
			<br><br>
        </div>
    </div>
</div>







