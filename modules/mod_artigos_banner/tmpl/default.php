<?php defined('_JEXEC') or die; ?>

<div class="carousel" data-ride="carousel">
  <?php $qtdBanners = 1;

  function limitChars($text)
  {
    if (strlen($text) > 100) {
      $corteTexto = substr($text, 0, 100);
      $text = substr($corteTexto, 0, strrpos($corteTexto, ' ')) . '...';
      return $text;
    } else {
      return $text;
    }
  }
  ?>

  <?php foreach ($list as $key => $item) :
    $link = explode("noticias/", $item['linkNoticia']);
    $file_teste_link = get_headers($item['url']);
    $verfica_arquivo = strpos($file_teste_link[0], '404 Not Found');
    if (!$verfica_arquivo) {
  ?>
      <?php if ($key == 0) :  ?>
        <a href="index.php/noticias/leitura-de-noticias?/id=<?= $link[1]; ?>">
          <div class="banner-item banner-item-active" style="display: block" id="banner_<?= $qtdBanners; ?>" title="Acesse a not&iacute;cia completa: <?= $item['titulo']; ?>">
            <img class="fundo" src="<?= $item['url']; ?>" longdesc="#descricao_<?= $qtdBanners; ?>" alt="Acesse a notícia completa: <?= $item['url']; ?>">
            <div class="titulo">
              <span id="descricao_<?= $qtdBanners; ?>"><?= $item['titulo']; ?></span>
              <div class="border"></div>
              <div class="subtitulo">
                <?= $item['resumoNoticia']; ?>
              </div>
            </div>
          </div>
        </a>
        <?php else :
        if ($item['url'] == "") { ?>
          <a href="index.php/noticias/leitura-de-noticias?/id=<?= $item['linkNoticia']; ?>&tipoNoticia=artigo">
            <div class="banner-item" style="display: none" id="banner_<?= $qtdBanners; ?>" alt="Acesse a not&iacute;cia completa: <?= $item['titulo']; ?>" title="Acesse a not&iacute;cia completa: <?= $item['titulo']; ?>">
              <img class="fundo" src="<?= $item['url']; ?>" longdesc="#descricao_<?= $qtdBanners; ?>" alt="Acesse a notícia completa: <?= $item['url']; ?>">
              <div class="titulo">
                <span id="descricao_<?= $qtdBanners; ?>"><?= $item['titulo']; ?></span>
                <div class="border"></div>
                <div class="subtitulo">
                  <?= $item['resumoNoticia']; ?>
                </div>
              </div>
            </div>
          </a>
        <?php  } else { ?>
          <a href="index.php/noticias/leitura-de-noticias?/id=<?= $link[1]; ?>">
            <div class="banner-item" style="display: none" id="banner_<?= $qtdBanners; ?>" alt="Acesse a not&iacute;cia completa: <?= $item['titulo']; ?>" title="Acesse a not&iacute;cia completa: <?= $item['titulo']; ?>">
              <img class="fundo" src="<?= $item['url']; ?>" longdesc="#descricao_<?= $qtdBanners; ?>" alt="Acesse a notícia completa: <?= $item['url']; ?>">
              <div class="titulo">
                <span id="descricao_<?= $qtdBanners; ?>"><?= $item['titulo']; ?></span>
                <div class="border"></div>
                <div class="subtitulo">
                  <?= $item['resumoNoticia'];  ?>
                </div>
              </div>
            </div>
          </a>
        <?php } ?>

      <?php endif; ?>

      <?php $qtdBanners++; ?>
    <?php

    } else { ?>
      <a href="index.php/noticias/leitura-de-noticias?/id=<?= $link[1]; ?>">
        <div class="banner-item banner-item-active" style="display: block" id="banner_<?= $qtdBanners; ?>" alt="Acesse a not&iacute;cia completa: <?= $item['titulo']; ?>" title="Acesse a not&iacute;cia completa: <?= limitChars($item['titulo']); ?>">
          <div class="fundo"></div>
          <div class="titulo">
            <?= $item['titulo']; ?>
            <div class="border"></div>
            <div class="subtitulo">
              <?= $item['resumoNoticia']; ?>
            </div>
          </div>
        </div>
      </a>
  <?php }
  endforeach; ?>

  <div class="ccontainer">
    <div id="totalNoticias" style='display:none'><?php echo $qtdBanners - 1; ?></div>
    <div id="contatorBanner" style='display:none'>1</div>
    <button class="volta bgBotoesBanner" onClick="javascript:voltarBannerJS()">
      <img src="templates/portalTRF5/images/seta_esquerda.svg" alt="Voltar para a Notícia em destaque anteior" title="Banner Anterior">
    </button>
    <button class="avanca bgBotoesBanner" onClick="javascript:avancarBannerJS()">
      <img src="templates/portalTRF5/images/seta_direita.svg" alt="Ir para proxima Notícia em Destaque" title="Próximo Banner">
    </button>
  </div>

</div>