<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModTermosSessaUso::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_termos_sessao_uso', $params->get('layout', 'default'));

?>