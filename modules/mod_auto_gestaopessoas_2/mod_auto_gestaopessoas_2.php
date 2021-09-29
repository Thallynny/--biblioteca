<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModAutoGestaoPessoas::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_gestaopessoas_2', $params->get('layout', 'default'));

?>