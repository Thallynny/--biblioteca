(function($) {

  var URL = "../templates/portalImprensa/includes/noticias.php";

  var $formPesquisa      = $('#formPesquisa');
  var $inputPesquisa     = $('#inputPesquisaImprensa');
  var $noticiasContainer = $('#noticiasContainer');
  var $buttonLoadMore    = $('#buttonLoadMore');
  var $inputLimite       = $('#inputLimite');
  var $dataInicio        = $('#dataInicioNoticia');
  var $dataFim           = $('#dataFimNoticia');
  var $qtdRegistros      = $('#qtdRegistros');
  var $inputPagina       = $('#inputPagina');
  var $inputPesquisaBotao= $('#inputPesquisaBotao');
  var $inputBotaoLimpar= $('#inputBotaoLimpar');
  
  
  $inputBotaoLimpar.on('click', limparCampos);
  $inputPesquisaBotao.on('click', pesquisarNoticiasBotao);
  $inputPesquisa.on('keypress', pesquisarNoticias);
  $dataInicio.on('keypress', pesquisarNoticias);
  $dataFim.on('keypress', pesquisarNoticias);
  $buttonLoadMore.on('click', carregarMaisNoticias);

  function pesquisarNoticiasBotao(e) {
	  $inputLimite.val(0);
	  $inputPagina.val(0);
      e.preventDefault();
      $noticiasContainer.html("<p>Carregando noticias...</p>");
      $.post(URL, $formPesquisa.serialize(), renderNoticias);
  }

  function pesquisarNoticias(e) {
	  $inputLimite.val(0);
	  $inputPagina.val(0);
    if (e.which === 13) {
      e.preventDefault();
      $noticiasContainer.html("<p>Carregando noticias...</p>");
      $.post(URL, $formPesquisa.serialize(), renderNoticias);
    }
  }

  function carregarMaisNoticias() {
    $buttonLoadMore.text("Carregando...");
    $.post(URL, $formPesquisa.serialize(), renderMaisNoticias);
  }
  
  function limparCampos() {
	document.getElementById('dataInicioNoticia').value = '';
	document.getElementById('dataFimNoticia').value = '';
	document.getElementById('inputPesquisaImprensa').value = '';
  }

  function renderMaisNoticias(noticias) {
    var retorno = "";
    var lista = JSON.parse(noticias);
	
	var paginaTela = document.getElementById('inputPagina');
	pagina = parseInt(paginaTela.value) + 12;
	
	paginaTela.value = pagina;
	
	if(lista.totalRegistros <= pagina){
		document.getElementById('buttonLoadMore').style.display = "none";
	}else{
		document.getElementById('buttonLoadMore').style.display = "block";
	}
	
    lista.listaNoticias.forEach(function(noticia) {
      retorno += renderNoticia(noticia);
    });
    $buttonLoadMore.text("Carregar Mais");
    $noticiasContainer.append(retorno);
  }

  function renderNoticias(noticias) {
    var retorno = "";
	
/*
//var resultado = noticias.indexOf("VAZIO");
	if(!JSON.parse(noticias)){
		$noticiasContainer.html("<p>Nenhuma noticia encontrada</p>");
	}*/
	
	try {
		var lista = JSON.parse(noticias);
	
		if(!lista.listaNoticias.length){
			lista.listaNoticias = [ lista.listaNoticias];
		}

	}
	catch(err) {
	 $noticiasContainer.html('');
	 document.getElementById('buttonLoadMore').style.display = "none";
	 document.getElementById('resultadoPesquisa').innerHTML= "<div class='resultadoPesquisa' style='background-color:#ffcccc; '>Nenhuma notícia encontrada</div>";
	 return false;
	}

	
    $inputLimite.val(lista.numPagina);
	$qtdRegistros.val(lista.totalRegistros);
	$inputPagina.val(lista.qtdRegistros);
	
	if(lista.qtdRegistros >= 12){
		document.getElementById('buttonLoadMore').style.display = "block";
	}else{
		document.getElementById('buttonLoadMore').style.display = "none";
	}
	//alert(lista.qtdRegistros);
	//console.log(lista.qtdRegistros);
	//$.isEmptyObject({});
	if(lista.qtdRegistros >= 1){
		lista.listaNoticias.forEach(function(noticia) {
		  retorno += renderNoticia(noticia);
		});
	}
    if (retorno === '') {
     $noticiasContainer.html('');
	 document.getElementById('buttonLoadMore').style.display = "none";
	 document.getElementById('resultadoPesquisa').innerHTML= "<div class='resultadoPesquisa' style='background-color:#ffcccc;'>Nenhuma notícia encontrada</div>";
    } else {
      $noticiasContainer.html("").html(retorno);
    }
  }

  function getImagemAnexoNoticia(anexo, isVazio) {
    if(isVazio == true){
      if(anexo.title !== null){
        var title = ""+anexo.title;
        if(title.includes("png") || title.includes("jpg")){
          return `<img class="fundo noticia-imagem" src="`+anexo.url+`" style="" `+anexo.title+`>`;
        }
      }
    }
  }

  function renderNoticia(noticia) {
	 // var imagem = '/images/PadraoAusenciaImagemNoticia23062020.jpg';
	  var imagem = null;
	  var legenda = '';
    var title = '';
    
    var mensagem = "Foi encontrado 1 registro.";
    if (noticia.totalRegistro > 1) {
      mensagem = "Foram encontrados " + noticia.totalRegistro + " registros.";
    }
    document.getElementById('resultadoPesquisa').innerHTML = "<div class='resultadoPesquisa' style='background-color:#afff9b;'>" + mensagem + "</div>";

	  if(noticia.anexos != null){
    //imagem = noticia.anexos.url;
    if(noticia.anexos.url != null)    
      imagem = `<img class="fundo noticia-imagem" src="`+noticia.anexos.url+`" style="" `+title+`>`;
    else 
    if(Array.isArray(noticia.anexos)){
      var isVazio = true;
      noticia.anexos.forEach(function(anexo) {
        var retorno = getImagemAnexoNoticia(anexo, isVazio);
        if(retorno!=null && isVazio){
          imagem = retorno;
          isVazio = imagem==null;
        }
      });
    }
	
	  title = ' title="'+noticia.titulo+'"  alt="'+noticia.titulo+'"';
	  legenda =` 		
						<div class="noticia-anexo" style="display:none"  alt=" Há `+noticia.quantidadeAnexos+` anexo(s) nessa notícia" title=" Há `+noticia.quantidadeAnexos+` anexo(s) nessa notícia" style="">Anexo(s): `+noticia.quantidadeAnexos+`</small>
						</div>
						<div class="badge badge-light noticia-legenda"  style="">
					</div>
	 					`;
   }
   
   if(imagem == null)
   imagem = '<div class="noticia-imagem" title="'+noticia.titulo+'"  alt="'+noticia.titulo+'"></div>';

    return `
      <a class="box_simples" href="noticias/leitura-de-noticias?/id=${noticia.id}" style="text-decoration: none; color: #5776B0">  
        <div class="conteudo_noticias">
				<div style="width:100%; height:144px; " `+title+`>
				`+imagem+`
					
					`+legenda+`
					
					
				</div>
		
          <div class="titulo lower ml-4 noticia-resolucao270" style=" color:#3AB186; margin-top: 11px;">
            ${noticia.titulo}
          </div> 
          <div class="p-box-noticias-1 ml-4 mr-3 mt-3 noticia-resolucao270">
            ${noticia.texto.substring(0, 285)}...
          </div>
          <div class="box-plus mt-1 mb-2 mr-4 noticia-resolucao270">
            <img class="conteudo_icone_mais" alt="Para ler a notícia completa, clique aqui." title="Para ler a notícia completa, clique aqui."  width="20" src="../templates/portalImprensa/images/plus.svg">
          </div>
        </div>
      </a>
    `;
  }

})(jQuery);



   function fechar() { 
        document.getElementById('fundo').style.display = 'none'; 
        document.getElementById('ampliarImagem').style.display = 'none'; 
    }
	
   function ampliarImagem() { 
        document.getElementById('fundo').style.display = 'block'; 
        document.getElementById('ampliarImagem').style.display = 'block'; 
    }