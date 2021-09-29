<?php 
defined('_JEXEC') or die;
require_once 'func.php';

function getDataAtualizacao3($array){
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataPublicacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataPublicacao']));
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}
$titulo = $params->get('titulo');		?>
<div class="container demonstrativo bg_azul_fundo">
	<div class="  conteudo selecionado">
		<div class="col-12">
			<div class="row">
			   <div class="titulo"><?= $titulo ?></div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao3($list) ?></small>
			</div>
			<div class="row report">
				<ol>
	<?php			foreach ($list as $listDados){
						echo "<li><a href='#conteudo' onclick=\"exibirArquivo('/index.php/gestao-orcamentaria/resultado-pdf', '".$listDados['id']."', 'SV57', '".urlencode("INSTITUCIONAL/CURRICULO DE MAGISTRADO/".$listDados['descricao']) . "')\">" . $listDados['descricao'] . " </a></li>";
					}							?>
				</ol>
			</div>
		</div>
	</div>
 </div>
 
<div id="div_arquivo"></div>	