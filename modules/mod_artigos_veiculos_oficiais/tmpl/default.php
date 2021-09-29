<?php defined('_JEXEC') or die;

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

?>

<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado" data-aba-id="1">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Relação de Veículos - TRF-5ª Região</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['veiculosTRF']); ?></small>
			</div>
			<?php
			$anoTemp = 0;
			foreach ($list['veiculosTRF'] as $itemTrf) :
				if (!empty($itemTrf['exibe'])) :
					if ($anoTemp != $itemTrf['ano']) :
						$anoTemp = $itemTrf['ano']; ?>

						<div class="row report">
							<ul>
								<li class="titulo"><?= $itemTrf['ano'] ?></li>
								<li class="arrow-down">
									<a href="#report" title="Expandir ano de <?= $itemTrf['ano'] ?>"><img src="templates/portalTRF5/images/arrow_down_2.svg"  alt="Abrir conteúdo"></a>
								</li>
							</ul>
						</div>
						<div class="row botoes">
							<ul>
								<?php
								foreach ($list['veiculosTRF'] as $itemTrfTemp) :
									if (!empty($itemTrfTemp['exibe'])) :
										if ($anoTemp == $itemTrfTemp['ano']): ?>
											<li class="inline">
												<div class="box" role="button">
													<a style="text-decoration: none" title="Acessar a Relação de Veículos - TRF-5ª Região - <?= $itemTrfTemp['ano'] ?>" href="#conteudo" onclick="exibirArquivo('../gestao-orcamentaria/resultado-pdf', '<?= $itemTrfTemp['id'] ?>', 'SV6', '<?php echo urlencode('GESTÃO PATRIMONIAL/VEÍCULOS OFICIAIS/Relação de Veículos - TRF-5ª Região/' . $itemTrfTemp['ano']); ?>')">
														Relação de Veículos - TRF-5ª Região - <?= $itemTrfTemp['ano'] ?>
													</a>
												</div>
											</li>
										<?php endif; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					<?php endif;	?>
				<?php endif;	?>
			<?php endforeach; ?>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="titulo">Relatório Geral de Veículos - Todas as Seções e Subseções</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['veiculosSecoes']); ?></small>
			</div>
			<?php
			$anoTemp = 0;
			foreach ($list['veiculosSecoes'] as $itemSecoes) :
				if (!empty($itemSecoes['exibe'])) :
					if ($anoTemp != $itemSecoes['ano']) :
						$anoTemp = $itemSecoes['ano']; ?>

						<div class="row report">
							<ul>
								<li class="titulo"><?= $itemSecoes['ano'] ?></li>
								<li class="arrow-down">
									<a href="#report" title="Expandir ano de <?= $itemSecoes['ano'] ?>"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a>
								</li>
							</ul>
						</div>
						<div class="row botoes">
							<ul>
								<?php foreach ($list['veiculosSecoes'] as $itemSecoesTemp) : ?>
									<?php if (!empty($itemSecoesTemp['exibe'])) : ?>
										<?php if ($anoTemp == $itemSecoesTemp['ano']) : ?>
											<li class="inline">
												<div class="box" role="button">
													<a style="text-decoration: none" title="Acessar ao Relatório Geral de Veículos - Todas as Seções e Subseções - <?= $itemSecoesTemp['ano'] ?>" href="#conteudo" onclick="exibirArquivo('../gestao-orcamentaria/resultado-pdf', '<?= $itemSecoesTemp['id'] ?>', 'SV7', '<?php echo urlencode('GESTÃO PATRIMONIAL/VEÍCULOS OFICIAIS/Relatório Geral de Veículos - Todas as Seções e Subseções/' . $itemSecoesTemp['ano']); ?>')">
														Relatório Geral de Veículos - Todas as Seções e Subseções - <?= $itemSecoesTemp['ano'] ?>
													</a>
												</div>
											</li>
										<?php endif;	?>
									<?php endif;	?>
								<?php endforeach; ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					<?php endif;	?>
				<?php endif;	?>
			<?php endforeach; ?>
		</div>
	</div>
	<div id="div_arquivo"></div>
</div>