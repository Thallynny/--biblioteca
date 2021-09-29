<?php
    
    $WService  = (!empty($_GET['WService'])) ? urldecode($_GET['WService']) : "";
    $nivel = (!empty($_GET['nivel'])) ? $_GET['nivel'] : "0";
    $arg0 = (!empty($_GET['arg0'])) ? $_GET['arg0'] : "biblioteca";
    $origem = (!empty($_GET['origem'])) ? $_GET['origem'] : "biblioteca";
    $termoBusca = (!empty($_GET['termobusca'])) ? $_GET['termobusca'] : "";
    $pagina = (!empty($_GET['pagina'])) ? $_GET['pagina'] : 0;
    $limite = (!empty($_GET['limite'])) ? $_GET['limite'] : 15;

?>