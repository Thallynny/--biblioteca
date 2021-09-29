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

abstract class ModArticlesLatestHelper
{
	
	public function getDados($params) {
		$lista['info'] = ['titulo' => $params->get('titulo')];

		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client   = new SoapClient($params->get('url_webservice'));
			$response = '';
			$servico = $params->get('servico');

			if($servico == "getRelatorioGestaoFiscal"){
				$response = json_decode(json_encode($client->getRelatorioGestaoFiscal()), True);
			}elseif ($servico == "getDiarias") {
				$response = json_decode(json_encode($client->getDiarias()), True);
			}elseif ($servico == "getPassagens") {
				$response = json_decode(json_encode($client->getPassagens()), True);
			}elseif ($servico == "getValoresPagos") {
				$response = json_decode(json_encode($client->getValoresPagos()), True);
			}elseif ($servico == "getDistribuicaoOrcamentaria") {
				$response = json_decode(json_encode($client->getDistribuicaoOrcamentaria()), True);
			}else{
				echo "Servico Invalido!";
			}
			
			$lista['dados'] = $response['return'];

			return $lista;
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}
	
	public static function getList(&$params) {
		$retorno = array();
		try {
			$retorno = self::getDados($params);
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $retorno;
	}

}
