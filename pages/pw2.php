<?php
session_start();
include("configuracao.php");
function data() {
$data = date('D');
$mes = date('M');
$dia = date('d');
$ano = date('Y');
 
$semana = array(
'Sun' => 'Domingo',
'Mon' => 'Segunda-Feira',
'Tue' => 'Terca-Feira',
'Wed' => 'Quarta-Feira',
'Thu' => 'Quinta-Feira',
'Fri' => 'Sexta-Feira',
'Sat' => 'Sábado'
);
 
$mes_extenso = array(
'Jan' => 'Janeiro',
'Feb' => 'Fevereiro',
'Mar' => 'Marco',
'Apr' => 'Abril',
'May' => 'Maio',
'Jun' => 'Junho',
'Jul' => 'Julho',
'Aug' => 'Agosto',
'Nov' => 'Novembro',
'Sep' => 'Setembro',
'Oct' => 'Outubro',
'Dec' => 'Dezembro'
);
 
return $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}" . " às " . date('H:i:s');
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="refresh" content="3;url=?page=adm">
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<head>
	<script src="../js/jquery-2.1.1.min.js"></script>
</head>
	  
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap.css" rel="stylesheet">
	<style>
	body {
	background-color:#F9F9F9;
	}
	</style>
</head>

<body>
<div style="margin-left:5%;">
<br>
<?=data();?>
<h4>
<?php
$sql2 = $mysqli->query("SELECT * from dl_pedidos where data='".date('d/m/Y')."'");
$exibir2 = $sql2->num_rows;
echo $exibir2;
if($_SESSION[qs] == $exibir2) {
echo "";
} else {
echo '<audio src="../notificacao.mp3" id="mp3" preload="autoplay" autoplay="1"></audio>';
session_start();
ob_start();
$_SESSION[qs] = $exibir2;
}

?>
 PEDIDOS <font size=3px color=orange>(R$ <?php
$sql = $mysqli->query("SELECT SUM(valor) from dl_pedidos where data='".date('d/m/Y')."'");
$exibir = $sql->fetch_array();
echo number_format($exibir['SUM(valor)'],2,",",".");
?>)</font><br>
  
<?php
$sql3 = $mysqli->query("SELECT * from dl_pedidos where data='".date('d/m/Y')."' and status='Entregue'");
$exibir3 = $sql3->num_rows;
echo $exibir3;
?> ENTREGUES <font size=3px color=green>(R$ <?php
$sql = $mysqli->query("SELECT SUM(valor) from dl_pedidos where data='".date('d/m/Y')."' and status='Entregue'");
$exibir = $sql->fetch_array();
echo number_format($exibir['SUM(valor)'],2,",",".");
?>)</font>
<bR>

</h4>
	</p>
</div>
</body>
</html>
