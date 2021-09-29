<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

use Joomla\Utilities\ArrayHelper;

/**
 * Helper for ModArticlesBannertHelper
 *
 * @since  1.6
 */
abstract class ModArticlesBannertHelper
{
	/**
	 * Retrieve a list of article
	 *
	 * @param   \Joomla\Registry\Registry  &$params  module parameters
	 *
	 * @return  mixed
	 *
	 * @since   1.6
	 */
	public function getBannerJoomla(&$params)
	{
		// Get the dbo
		$db = JFactory::getDbo();

		// Get an instance of the generic articles model
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app       = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);

		// Set the filters based on the module params
		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('count', 5));
		$model->setState('filter.published', 1);

		// This module does not use tags data
		$model->setState('load_tags', false);

		// Access filter
		$access     = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);

		// Category filter
		$model->setState('filter.category_id', $params->get('catid', array()));

		// User filter
		$userId = JFactory::getUser()->get('id');

		switch ($params->get('user_id'))
		{
			case 'by_me' :
				$model->setState('filter.author_id', (int) $userId);
				break;
			case 'not_me' :
				$model->setState('filter.author_id', $userId);
				$model->setState('filter.author_id.include', false);
				break;

			case '0' :
				break;

			default:
				$model->setState('filter.author_id', (int) $params->get('user_id'));
				break;
		}

		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());

		//  Featured switch
		switch ($params->get('show_featured'))
		{
			case '1' :
				$model->setState('filter.featured', 'only');
				break;
			case '0' :
				$model->setState('filter.featured', 'hide');
				break;
			default :
				$model->setState('filter.featured', 'show');
				break;
		}

		// Set ordering
		$order_map = array(
			'm_dsc' => 'a.modified DESC, a.created',
			'mc_dsc' => 'CASE WHEN (a.modified = ' . $db->quote($db->getNullDate()) . ') THEN a.created ELSE a.modified END',
			'c_dsc' => 'a.created',
			'p_dsc' => 'a.publish_up',
			'random' => $db->getQuery(true)->Rand(),
		);

		$ordering = ArrayHelper::getValue($order_map, $params->get('ordering'), 'a.publish_up');
		$dir      = 'DESC';

		$model->setState('list.ordering', $ordering);
		$model->setState('list.direction', $dir);

		$items = $model->getItems();

		foreach ($items as &$item)
		{ 
			$item->slug    = $item->id . ':' . $item->alias;

			/** @deprecated Catslug is deprecated, use catid instead. 4.0 */
			$item->catslug = $item->catid . ':' . $item->category_alias;

			if ($access || in_array($item->access, $authorised))
			{
				// We know that user has the privilege to view the article
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
			}
			else
			{
				$item->link = JRoute::_('index.php?option=com_users&view=login');
			}
		}

		$bannersJoomla = array();

		for ($i = 0; $i < count($items); $i++) { 

			$imagem = json_decode($items[$i]->images);

		 	$bannersJoomla[$i] = array(
		 		'url' => $imagem->image_intro,
				'resumoNoticia' => $items[$i]->title,
				'titulo' => $items[$i]->title,
				'tipoNoticia' => 'atigo',
				'linkNoticia' => $items[$i]->id
			 );
		}
		

		return $bannersJoomla;
	}

	public static function getList(&$params) {

		$items   = array();
		$banners = array();

		$bannersJoomla = self::getBannerJoomla($params);

		if ($params->get('url_webservice') != "") {
			try {

				$limite = 12;
				if($params->get('quantidadeNoticias') != ""){
					$limite = $params->get('quantidadeNoticias');
				}

				$parametros = array('bannersHome' => array('arg0' => $limite));

				$client = new SoapClient($params->get('url_webservice'));

				$method = $client->__soapCall('bannersHome', $parametros);
				$response = json_decode(json_encode($method), True);
	
				//$response = json_decode(json_encode($client->bannersHome()), True);
				$items    = $response['return'];
				
			} catch (Exception $e) {
				//echo "Erro ao consumir WebService!";
			}
		}

		if (count($items) > 0) {
			$banners = array_merge($items, $bannersJoomla);
		} else {
			$banners = $bannersJoomla;
		}

		return $banners;

	}

}
