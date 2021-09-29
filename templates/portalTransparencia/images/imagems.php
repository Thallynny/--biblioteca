<body bgcolor="#ccc">


<?php

$diretoria = ""; // esta linha não precisas é só um exemplo do conteudo que a variável vai ter

$imagens = glob($diretoria . "*");
echo"<div style='float:left; border: 1px solid'> ";
foreach($imagens as $imagem){
	
	
echo"<div style='float:left; padding:10px; border: 1px solid; height:120px'> ";
 echo "<a href='".$imagem."'><img src='".$imagem."' width=100 height=100 title='".$imagem."' /></a>";
 echo "<BR><a href='".$imagem."'><font color='black'>".$imagem."</font></a>";
 echo "<br>";
 echo"</div> ";
}
 echo"</div> ";

?>