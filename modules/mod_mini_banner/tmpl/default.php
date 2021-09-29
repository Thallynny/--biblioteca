<?php

defined('_JEXEC') or die;

JLoader::register('BannerHelper', JPATH_ROOT . '/components/com_banners/helpers/banner.php');
?>

<div class="main_box_medio duplo cinza" >

	

	
<div id="carouselExampleIndicators" class="carousel slide" style=" width:32.5rem;height:9.375rem;background-color: transparent;" data-ride="carousel">
  <ol class="carousel-indicators" style="bottom: 0px; position: absolute;">
  
  
    <?php
	$a = 0;
	for($i  = 0 ; $i < count($list); ) { ?>
    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $a; ?>"></li>
	<?php $i = $i + 2; $a++; ?>
	<?php } ?>
	
	
	
  </ol>
  <div class="carousel-inner" >
  
  
	
	
	
<?php 
	$a = 1;
	$itemCarrossel = "";
	$botaoNum = 0;
	echo "<div class='carousel-item  active ' >";
foreach ($list as $index => $item) {
	$link = JRoute::_('index.php?option=com_banners&task=click&id=' . $item->id); 
	$imageurl = $item->params->get('imageurl'); 
	$baseurl = strpos($imageurl, 'http') === 0 ? '' : JUri::base();
	
	echo "	<div class='miniBannerItem' style='width:17.5rem' background-color: transparent;>
					<a href='".$link."' style='text-decoration: none; color: #fff;'>
						<div class='miniBannerItem__content' style='background: url(".$baseurl.$imageurl."); background-repeat: no-repeat; background-size: 70px 65px; background-position: top;'>
							<div class='miniBannerItem__img' ></div>							
							<div class='miniBannerItem__text'>
								<span>".$item->name."</span>
								<strong style='font-size: 0.875rem; display: block;'>
									". substr(strip_tags($item->description), 0, 18)."
								</strong>
							</div>
						</div>
					</a>
				</div>";
			echo "";	
				if($botaoNum == 1 && $a <  count($list)){
					echo "</div>";
					echo "<div class='carousel-item  ' >";
					$botaoNum = 0;
				}else{
					$botaoNum++;
				}
	$a++;
	} ?>
</div>
	

    
	
	
	
	
	
	
	
	
	
	
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" title="voltar Banner">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" title="avançar Banner">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>
	

</div>