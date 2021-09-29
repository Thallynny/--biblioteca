function sempreExibir(e) {
	alert(e);
}	

(function($) {
  var URL_ARQUIVO        = "../templates/portalTRF5/includes/consulta_cp.php";
  var URL_ARQUIVO_DADOS  = "../templates/portalTRF5/includes/consulta_cp_dados.php";
  var URL_ARQUIVO_PAGINADO  = "../templates/portalTRF5/includes/consulta_cp_paginado.php";

  var $formPesquisaNumero = $('#formPesquisaNumero');
  var $formPesquisaNome   = $('#formPesquisaNome');
  var $formPesquisaOab    = $('#formPesquisaOab');
  var $fromPesquisaCpf    = $('#formPesquisaCpf');
  var $botaoLimparProcessual    = $('.botaoLimparProcessual');
  
  var $btnMostrarMaisProcessosPJE    = $('#btnMostrarMaisProcessosPJE');
  var $btnMostrarMaisProcessosESPARTA    = $('#btnMostrarMaisProcessosESPARTA');
  
  var resultadoTotalPJE  = 0;
  var resultadoTotalEsparta  = 0;
  var mostrarMais = "Mostrar Mais +";
  
  $btnMostrarMaisProcessosPJE.on('click', carregarMaisProcessosPJE);
  $btnMostrarMaisProcessosESPARTA.on('click', carregarMaisProcessosESPARTA);
  $botaoLimparProcessual.on('click', limparCampos);
  $(".spanResResulta").text('0');

  
  $formPesquisaNumero.on('submit', function(e) {
	limparGrid();
	$(".paginadorPJE").val('0');
	$(".paginadorESPARTA").val('0');
	$("#criterioMaisPJE").text('numero');
	$("#paginaMaisPJE").text('0');
	$("#criterioMaisESPARTA").text('numero');
	$("#paginaMaisESPARTA").text('0');
	$('#btnMostrarMaisProcessosPJE').hide();
	$('#btnMostrarMaisProcessosESPARTA').hide();
	$('#pesquisa__body-links').hide();
	$('#pesquisa__body-news').hide();
    e.preventDefault();
    pesquisarProcessoPaginado($(this), '0');	
  });

  $formPesquisaNome.on('submit', function(e) {
	var resultado_texto = this[2].value.split(' ');
   if(!resultado_texto[1]){
   	alert('Por favor, adicione 2 termos para serem consultados');
	return;
   }
	limparGrid();
	$(".paginadorPJE").val('0');
	$(".paginadorESPARTA").val('0');
	$("#criterioMaisPJE").text('nome');
	$("#paginaMaisPJE").text('0');
	$("#criterioMaisESPARTA").text('nome');
	$("#paginaMaisESPARTA").text('0');
	$('#btnMostrarMaisProcessosPJE').hide();
	$('#btnMostrarMaisProcessosESPARTA').hide();
	$('#pesquisa__body-links').hide();
	$('#pesquisa__body-news').hide();
    e.preventDefault();
    pesquisarProcessoPaginado($(this), '0');
  });

  $formPesquisaOab.on('submit', function(e) {
	limparGrid();
	$(".paginadorPJE").val('0');
	$(".paginadorESPARTA").val('0');
	$("#criterioMaisPJE").text('oab');
	$("#paginaMaisPJE").text('0');
	$("#criterioMaisESPARTA").text('oab');
	$("#paginaMaisESPARTA").text('0');
	$('#btnMostrarMaisProcessosPJE').hide();
	$('#btnMostrarMaisProcessosESPARTA').hide();
	$('#pesquisa__body-links').hide();
	$('#pesquisa__body-news').hide();
    e.preventDefault();
    pesquisarProcessoPaginado($(this), '0');
  });

  $fromPesquisaCpf.on('submit', function(e) {
	limparGrid();
	$(".paginadorPJE").val('0');
	$(".paginadorESPARTA").val('0');
	$("#criterioMaisPJE").text('cpf');
	$("#paginaMaisPJE").text('0');
	$("#criterioMaisESPARTA").text('cpf');
	$("#paginaMaisESPARTA").text('0');
	$('#btnMostrarMaisProcessosPJE').hide();
	$('#btnMostrarMaisProcessosESPARTA').hide();
	$('#pesquisa__body-links').hide();
	$('#pesquisa__body-news').hide();
    e.preventDefault();
    pesquisarProcessoPaginado($(this), '0');
  });
  
  function carregarMaisProcessosPJE() {
	  
	$("#btnMostrarMaisProcessosPJE").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
	
	if($("#criterioMaisPJE").text() == 'numero'){
		pesquisarProcessoPaginado($formPesquisaNumero, 'PJE');
	}
	if($("#criterioMaisPJE").text() == 'nome'){
		pesquisarProcessoPaginado($formPesquisaNome, 'PJE');
	}
	if($("#criterioMaisPJE").text() == 'cpf'){
		pesquisarProcessoPaginado($fromPesquisaCpf, 'PJE');
	}
	if($("#criterioMaisPJE").text() == 'oab'){
		pesquisarProcessoPaginado($formPesquisaOab, 'PJE');
	}
  }
  
  
   function carregarMaisProcessosESPARTA() {
	   
	$("#btnMostrarMaisProcessosESPARTA").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
	
	if($("#criterioMaisPJE").text() == 'numero'){
		pesquisarProcessoPaginado($formPesquisaNumero, 'ESPARTA');
	}
	if($("#criterioMaisPJE").text() == 'nome'){
		pesquisarProcessoPaginado($formPesquisaNome, 'ESPARTA');
	}
	if($("#criterioMaisPJE").text() == 'cpf'){
		pesquisarProcessoPaginado($fromPesquisaCpf, 'ESPARTA');
	}
	if($("#criterioMaisPJE").text() == 'oab'){
		pesquisarProcessoPaginado($formPesquisaOab, 'ESPARTA');
	}
  }
  
	function limparCampos() {
		document.getElementById('campoNumero').value = '';
		document.getElementById('campoNome').value = '';
		document.getElementById('campoCriterio').value = '';
		document.getElementById('campoCPF').value = '';
		$(".spanResResulta").text('');
		$("#pesquisa__body-processos").html('');
		$("#pesquisa__body-processos-esparta").html('');
		$('#btnMostrarMaisProcessosPJE').hide();
		$('#btnMostrarMaisProcessosESPARTA').hide();
	}
	
	function limparGrid() {
		resultadoTotalPJE  = -1;
		resultadoTotalEsparta  = -1;
		$(".spanResResulta").text('');
		$("#paginaMaisPJE").text('0');
		$("#paginaMaisESPARTA").text('0');
		$("#pesquisa__body-processos").html('');
		$("#pesquisa__body-processos-esparta").html('');
	}

  $('.pesquisa__box-button').on('click', function() {
	limparCampos();
    $formPesquisaNumero.hide();
    $formPesquisaNome.hide();
    $formPesquisaOab.hide();
    $fromPesquisaCpf.hide();
    resultadoTotalPJE = -1;
    resultadoTotalEsparta = -1;
	if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
    switch($(this).text()) {
      case "Número do Processo":
          $formPesquisaNumero.fadeIn();
        break; 
      case "Nome da Parte":
          $formPesquisaNome.fadeIn();
        break; 
      case "Número da OAB":
          $formPesquisaOab.fadeIn();
        break;
      case "Número do CPF ou CNPJ":
          $fromPesquisaCpf.fadeIn();
        break;  
    }

   removeClassActiveButton();

    $(this).addClass('box-button--active');
  });

$('#collapse__body').on('click', function(e) {
 var divCollapseContent = e.target.parentElement.parentElement; 
	if($('.collapse__content').hasClass('collapse--active')){
		divCollapseContent.classList.toggle('collapse--active'); 
	}else{   
		removeClassActive();
    }
 });

   
    $('#pesquisa__body-processos').on('click', function(e) {
 var divCollapseContent = e.target.parentElement.parentElement;
 var toggleAux = $(divCollapseContent).hasClass('collapse--active');
 var isBoddy = ( $(divCollapseContent).hasClass('collapse__body') || $(e.target.parentElement).hasClass('collapse__body') );
 var isHeader = ( $(divCollapseContent).hasClass('collapse__header') || $(e.target.parentElement).hasClass('collapse__header') );
 
 if($('.collapse__content').hasClass('collapse--active') && !isBoddy && isHeader){
		removeClassActive();
 }
 if(isHeader){
	
		if(e.target.alt != null){
			var valoresImg = e.target.alt.split(" - ");
			var numero  = valoresImg[0].trim(); 
			var orgao   = valoresImg[1].trim(); 
			var sistema = valoresImg[2].trim(); 
			var idDivContent = valoresImg[3].trim();
			pesquisarDadosProcesso(orgao, sistema, numero, idDivContent);  
			if(!isBoddy && !toggleAux) divCollapseContent.classList.toggle('collapse--active'); 
		}else{
			var valores = e.target.textContent.split(" - "); 
			var numero  = valores[0].trim(); 
			var orgao   = valores[1].trim(); 
			var sistema = valores[2].trim(); 
			
			if (numero !== "Nenhum processo encontrado") { 
				pesquisarDadosProcesso(orgao, sistema, numero, divCollapseContent); 
				if(!isBoddy && !toggleAux) divCollapseContent.classList.toggle('collapse--active'); 
			} else { 
				 alert("Nenhum Processo encontrado!"); 
			}
		}
	}
    
 });

 $('#pesquisa__body-processos-esparta').on('click', function(e) {	 
 var divCollapseContent = e.target.parentElement.parentElement;
 var toggleAux = $(divCollapseContent).hasClass('collapse--active');
 var isBoddy = ( $(divCollapseContent).hasClass('collapse__body') || $(e.target.parentElement).hasClass('collapse__body') );
 var isHeader = ( $(divCollapseContent).hasClass('collapse__header') || $(e.target.parentElement).hasClass('collapse__header') );
 
 if($('.collapse__content').hasClass('collapse--active') && !isBoddy && isHeader){
		removeClassActive();
 }
 if(isHeader){
	
		if(e.target.alt != null){
			var valoresImg = e.target.alt.split(" - ");
			var numero  = valoresImg[0].trim(); 
			var orgao   = valoresImg[1].trim(); 
			var sistema = valoresImg[2].trim(); 
			var idDivContent = valoresImg[3].trim();
			pesquisarDadosProcesso(orgao, sistema, numero, idDivContent);  
			if(!isBoddy && !toggleAux) divCollapseContent.classList.toggle('collapse--active'); 
		}else{
			var valores = e.target.textContent.split(" - "); 
			var numero  = valores[0].trim(); 
			var orgao   = valores[1].trim(); 
			var sistema = valores[2].trim(); 
			
			if (numero !== "Nenhum processo encontrado") { 
				pesquisarDadosProcesso(orgao, sistema, numero, divCollapseContent); 
				if(!isBoddy && !toggleAux) divCollapseContent.classList.toggle('collapse--active'); 
			} else { 
				 alert("Nenhum Processo encontrado!"); 
			}
		}
	}
  });
 

  function removeClassActive() {
    $('.collapse__content').removeClass('collapse--active');
  }

  function removeClassActiveButton() {
    $('.pesquisa__box-button').removeClass('box-button--active');
  }


  /**
   * Função que realiza o request com os dados da paginado
   */
   
   	
	
	
  function pesquisarProcessoPaginado(form, consulta) {
	  	$(".spanResResulta").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
		var estado = $('select[name="estado"]').val();
		var campoTexto = $("#campoCriterio").val();
		
		var informacao = estado + campoTexto;
		//alert(informacao.serialize());
		// form.serialize()
		  if(consulta == 'PJE' || consulta == '0'){
			resultadoTotalPJE  = -1;
			$.post(URL_ARQUIVO_PAGINADO, form.serialize(), processarDadosPJE).done(function() {
				$("#paginaMaisPJE").text(parseInt($("#paginaMaisPJE").text()) + 1);
				$(".paginadorPJE").val(parseInt($("#paginaMaisPJE").text()));
				
			}).fail(function(){
				alert('Erro PJE');
			});
		  }
		  if(consulta == 'ESPARTA' || consulta == '0'){
			resultadoTotalEsparta  = -1;
			$.post(URL_ARQUIVO_PAGINADO, form.serialize(), processarDadosESPARTA).done(function() {
				$("#paginaMaisESPARTA").text(	parseInt($("#paginaMaisESPARTA").text()) + 1);
				$(".paginadorESPARTA").val(parseInt($("#paginaMaisESPARTA").text()));
			}).fail(function(){
				alert('Erro ESPARTA');
			});
		  }
   
  }
 
  /**
   * Função que realiza o request com os dados de um processo especifico
   */
  function pesquisarDadosProcesso(orgao, sistema, numero, _processo) {
      $.get(URL_ARQUIVO_DADOS+"?orgao="+orgao+"&sistema="+sistema+"&numero="+numero, function(retorno) {
      var processo = JSON.parse(retorno);
      var nomeDaParte = "<ul>";
      processo.partes.forEach(function(nome) {
        nomeDaParte += "<li>"+nome.nome+"</li>";
      });
      nomeDaParte += "</ul>";

      var listaMovimentacoes = "<ul>";
      processo.movimentacoes.forEach(function(mov) {
        listaMovimentacoes += "<li>" + mov.data + " - " + mov.descricao +"</li>";
      });
      listaMovimentacoes += "</ul>";

      var texto = `
        <p style="color: #5776B0;">Nome da Parte</p>
        ${nomeDaParte}

        <p style="color: #5776B0;">Últimas Movimentações</p>
        ${listaMovimentacoes}

        <p>Link: ${processo.url ? '<a href="' + processo.url + '" target="_blank">Clique aqui</a>' : 'Não'}</p>
      `;
		if(document.getElementById(_processo)){

			document.getElementById(_processo).innerHTML = texto;
			document.getElementById('_'+_processo).classList.add('collapse--active');
		}else{
			_processo.querySelector('.collapse__body').innerHTML = texto;
		}
    });
  }


	function ocultarBotao(totalGeral, botao, valorPagina){
		var totalPagina = totalGeral/10;
		$('#'+botao).hide();
		if(totalPagina > parseInt(valorPagina) + 1){
			 $('#'+botao).show();
		}
	}

  /**
   * Função de callback para processar os dados retornados da consulta
   * @param retorno Dados dos processos consultados
   */
  function processarDadosPJE(retorno) {
  		if(retorno=="error===error"){ 
			resultadoTotalPJE = 0;
			if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
			alert("Erro no retorno de dados do serviço PJE!");
			return;			
		}
		var splits_limpeza = retorno.split("\n");
		
		var tamanho_split = splits_limpeza.length;
		var splits = retorno.split('==='); //splits_limpeza[tamanho_split - 1].split('===');
		response = JSON.parse(splits[0]);
		var i = 0;
		if(response[0].processos.length == 0){
			 //alert("Nenhum processo do PJE foi encontrado!");			 
			 $('#btnMostrarMaisProcessosPJE').hide();
			 $('#pesquisa__body-news').hide();
			resultadoTotalPJE = 0;
			if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
			return;
		}else{			
			 $('#btnMostrarMaisProcessosPJE').show();
			 $('#pesquisa__body-news').show();
		}
		var resultadoProcessoPJE = '';
		var resultadoProcessoESPARTA = '';
		response[0].processos.forEach(function(sistema) {
		console.log(response[0].sistemaProcessual.id);
			if (response[0].sistemaProcessual.id == "ESPARTA") {
			  var processosEsparta = [];
			  resultadoProcessoESPARTA = adicionarProcessos(processosEsparta, response[0].processos, response[0].processos.length, 'pesquisa__body-processos-esparta',response[0].sistemaProcessual.id, response[0].orgao);
				
			} else {
			  var processosPJE = [];
			    resultadoProcessoPJE = adicionarProcessos(processosPJE, response[0].processos, response[0].processos.length, 'pesquisa__body-processos', response[0].sistemaProcessual.id, response[0].orgao);
			}
			i++;
		});
		var pje = $(".paginadorPJE").val();
		$('#pesquisa__body-processos').html( $('#pesquisa__body-processos').html() + resultadoProcessoPJE );		
		resultadoTotalPJE = parseInt(response[0].totalProcessos);		
	  	if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
		$("#btnMostrarMaisProcessosPJE").text(mostrarMais);
		ocultarBotao(parseInt(response[0].totalProcessos),'btnMostrarMaisProcessosPJE', pje);
  }


 function processarDadosESPARTA(retorno) {
  		if(retorno=="error===error"){ 	
			resultadoTotalEsparta = 0;
			if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
			alert("Erro no retorno de dados do serviço ESPARTA!");
			return;		
		}
		var splits = retorno.split('===');
		response = JSON.parse(splits[1]);
		var i = 0;
		if(response[0].processos.length == 0){
			 $('#btnMostrarMaisProcessosESPARTA').hide();
			 $('#pesquisa__body-links').hide();
			 //alert("Nenhum processo do ESPARTA foi encontrado!");
			resultadoTotalEsparta = 0;
			if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
		return;
		}else{			
			 $('#pesquisa__body-links').show();
			 $('#btnMostrarMaisProcessosESPARTA').show();
		}
		var resultadoProcessoPJE = '';
		var resultadoProcessoESPARTA = '';
		response[0].processos.forEach(function(sistema) {
		console.log(response[0].sistemaProcessual.id);
			if (response[0].sistemaProcessual.id == "ESPARTA") {
			  var processosEsparta = [];
			  resultadoProcessoESPARTA = adicionarProcessos(processosEsparta, response[0].processos, response[0].processos.length, 'pesquisa__body-processos-esparta',response[0].sistemaProcessual.id, response[0].orgao);
			
			} else {
			  var processosPJE = [];
			    resultadoProcessoPJE = adicionarProcessos(processosPJE, response[0].processos, response[0].processos.length, 'pesquisa__body-processos-esparta', response[0].sistemaProcessual.id, response[0].orgao);
			}
			i++;
		});
		var esparta = $(".paginadorESPARTA").val();
		$('#pesquisa__body-processos-esparta').html(  $('#pesquisa__body-processos-esparta').html() + resultadoProcessoESPARTA  );
		resultadoTotalEsparta = parseInt(response[0].totalProcessos);		
	  	if(resultadoTotalEsparta>=0 && resultadoTotalPJE>=0)$(".spanResResulta").text(resultadoTotalPJE + resultadoTotalEsparta);
		$("#btnMostrarMaisProcessosESPARTA").text(mostrarMais);
		ocultarBotao(parseInt(response[0].totalProcessos),'btnMostrarMaisProcessosESPARTA', esparta);
  }


  function adicionarProcessos(processos, sistema, totalProcessos, divRenderProcessos, sistema_tipo, orgao) {
    if (totalProcessos > 0) {
	    sistema.forEach(function(processo){
        processos.push({
          orgao: orgao,
          sistema_tipo: sistema_tipo,
          resultado: processo.classeJudicial,
          numero: processo.numero,
          nomeParte: null,								
          link: processo.url,
          dataAutuacao: processo.dataDistribuicao,
          classeJudicial: processo.classeJudicial,
          assunto: null,
          orgaoJulgador: processo.orgao
        })
      })
    } else {
      processos.push({
        orgao: orgao,
        sistema_tipo: sistema_tipo,
        resultado: sistema.resultado.mensagem,
        numero: "Nenhum processo encontrado",
        nomeParte: null,							
        link: null,
        dataAutuacao: null,
        classeJudicial: null,
        assunto: null,
        orgaoJulgador: null
      })
    }

    var dadosProcesso = "";
    var i = 0;
    processos.forEach(function(processo, i) {
      dadosProcesso += renderProcesso(processos, i);
	  i++;
    });
return dadosProcesso;
 } 
	
  function renderProcesso(processo, i) {
	  var imagem = `<span><img onClick="javascript:exibirProcesso('${i}')" alt="${processo[i].numero} - ${processo[i].orgao} - ${processo[i].sistema_tipo} - ${processo[i].sistema_tipo}collapse${i}" src="../templates/portalTRF5/images/seta_baixo.png"></span>`;

    return `    	  
      <div class="collapse__content collapse${i}"  id="_${processo[i].sistema_tipo}collapse${i}" >
        <header class="collapse__header callapse">
           <span>${processo[i].numero} - ${processo[i].orgao} - ${processo[i].sistema_tipo}</span>
          ${
            processo[i].numero !== "Nenhum processo encontrado"
              ? imagem
              : ''
          }
        </header>
        <div class="collapse__body" onclick="javascript:sempreexibir(this))" id="${processo[i].sistema_tipo}collapse${i}"></div>
      </div>

    `;
  }

})(jQuery);

	$('#campoCriterio').on('keypress input blur', function() {
      var value = $(this).val();
	  value = value.replace(/[^\d]/g, '');
      $(this).val(value);
    })
	
	$('#campoCPF').on('keypress input blur', function() {
      var value = $(this).val();
	  value = value.replace(/[^\d]/g, '');
      $(this).val(value);
    })
	
	$('#campoNumero').on('keypress input blur', function() {
      var value = $(this).val();
	  value = value.replace(/[^\d]/g, '');
	  $(this).val(value);
    })
	
function apenasNumero (e){
    $('#campoCriterio').on('keypress input blur', function() {
      var value = e.val();
	  value = value.replace(/[^\d]/g, '');	  
      e.val(value);
    })
  }

function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        if (charCode != 8 && charCode != 9) { 
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }
	



function exibirProcesso(collapse) {
	if($('.collapse'+collapse).hide()){
		$('.collapse'+collapse).show();
	}else{
		$('.collapse'+collapse).hide();
	}
  
}	