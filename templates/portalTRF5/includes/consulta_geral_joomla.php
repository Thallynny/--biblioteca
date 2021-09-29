<?php

require('functions.php');
$linhas  = !empty($_GET['linhas']) ? $_GET['linhas'] : 10;
$termo   = $_POST['termo'];
$ordenar = !empty($_POST['ordenar']) ? $_POST['ordenar'] : 'true';
$ordenar = $ordenar == "desc" ? "false" : "true";
$retorno = buscaGeralJoomla($termo, $linhas, $ordenar);
echo json_encode($retorno);