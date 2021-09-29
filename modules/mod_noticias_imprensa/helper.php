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
 * Helper for mod_articles_latest
 *
 * @since  1.6
 */
abstract class ModArticlesLatestHelper
{
	
	public static function getList(&$params) {
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			ini_set('soap.wsdl_cache_ttl', 900);
			ini_set('default_socket_timeout', 15);
			$client = new SoapClient($params->get('url_webservice'));

			$parametros = array('getNoticiasPaginadas' => array(
				'dataInicio' => '',
				'dataFim' => '',
				'texto' => '', 
				'limiteNoticiasPagina' => '0',
				'banner' => 'true',
				'pagina' => '0'
			));

			$method = $client->__soapCall('getNoticiasPaginadas', $parametros);

			$response = json_decode(json_encode($method), True);
			$noticias = $response['return'];

			return $noticias;

		} catch (Exception $e) {
			//echo "Erro ao consumir WebService!";
		}
	}

}
