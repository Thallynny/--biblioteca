<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';


$id = "";
if(!empty($_POST['id'])){
	$id = $_POST['id'];
}else{
	if(!empty($_GET['/id'])){
		$id = $_GET['/id'];
	}
}

$mod = "";
if (!empty($_POST['mod'])) {
	$mod = $_POST['mod'];
} else {
	if(!empty($_GET['MOD'])){
		$mod = $_GET['MOD'];
	}
}

$niveis = "";
if (!empty($_POST['niveis'])) {
	$niveis = urldecode($_POST['niveis']);
} else {
	if(!empty($_GET['niveis'])){
		$niveis = $_GET['niveis'];
	}
}

$buscaAberta = "";
if (!empty($_POST['buscaAberta'])) {
	$buscaAberta = $_POST['buscaAberta'];
} else {
	if (!empty($_GET['buscaAberta'])) {
		$buscaAberta = $_GET['buscaAberta'];
	}
}

$dados = ModResultadoHelper::getDadosWebService($params, $id, $mod, $niveis);

require JModuleHelper::getLayoutPath('mod_resultado', $params->get('layout', 'default'));

?>



