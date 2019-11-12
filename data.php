<?php
$h = "3"; //HORAS DO FUSO ((BRASÍLIA = -3) COLOCA-SE SEM O SINAL -).
$hm = $h * 60;
$ms = $hm * 60;
//COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -3) SINAL -) ANTES DO ($ms). DATA
$gmdata = gmdate("Y-m-d", time() - ($ms));
//COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -3) SINAL -) ANTES DO ($ms). HORA
$gmhora = gmdate("g:i:s", time() - ($ms));

echo $gmdata;
echo '<br>';
echo $gmhora;
?>
