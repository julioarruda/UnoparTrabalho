<?php
// INDEX
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set('America/Brazilia');
session_start();
ob_start();
require_once("pages/configuracao.php");
$verificar = $mysqli->query("select * from dl_produtos");
if($verificar === FALSE) {
require_once("querys.php");
}

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


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Delivery de comidas.">
    <meta name="author" content="PHP LIVRE">
    <title><?=$cfg[empresa];?> | <?=$cfg[site];?></title>
	<script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/js.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
<?php
if(!$_SESSION[gsw]) { $_SESSION[gsw] = 1; ?>
	$(document).ready(function () {
        $.fancybox({
            'width': '400',
            'height': '400',
            'autoScale': true,
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'type': 'iframe',
			'closeBtn' : false,
			'hideOnOverlayClick':false,
        'hideOnContentClick':false,
			'closeBtn' : false, helpers : { 
  overlay : {closeClick: false}
},
            'href': 'pages/pw.php'
        });
});
<? } ?>
</script>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
  </head>

  <body scroll="no">

  
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container"><div style="float:right;"><a href="?page=cardapio"><img src="css/entrar.png" width="120" height="50"></a></div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navega&ccedil;&atilde;o</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?page=inicio"><?=$cfg[empresa];?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
                <li <? if($_GET[page] == "inicio") { echo 'class="active"'; } ?>><a href="?page=inicio">In&iacute;cio</a></li>
				<li <? if($_GET[page] == "cardapio" || $_GET[page] == "fechar" || $_GET[page] == "pedido") { echo 'class="active"'; } ?>><a href="?page=cardapio">Card&aacute;pio</a></li>
				<li <? if($_GET[page] == "promocoes") { echo 'class="active"'; } ?>><a href="?page=promocoes">Promo&ccedil;&otilde;es</a></li>
                <li <? if($_GET[page] == "fale_conosco") { echo 'class="active"'; } ?>><a href="?page=fale_conosco">Fale Conosco</a></li>
          </ul>
        </div>
      </div>
    </nav>
  
<?php 
if($_GET[page] and file_exists("pages/".$_GET[page].".php")) {
include("pages/".$_GET[page].".php");
} else {
include("pages/inicio.php");
}
?>

      <hr class="featurette-divider">
      <footer style="padding-left:2%;padding-right:2%;">
        <p class="pull-right"><a href="#" style="float:right;">TOPO</a><br> <?=data();?>.</p>
        <p>&copy; <?=date('Y');?> <?=$cfg[empresa];?>, Inc.  &bull;  <a href="?page=adm">Admin.</a></p>
      </footer>
  </body>
</html>

<?php
if($fch == 1) {
foreach( range($cfg[horario2] - 1 , $cfg[horario]) as $numero ) {
    $oks .= $numero.",";
}
$pso = $oks;

if(!strstr($pso, date('H'))==TRUE) {
if(file_exists("entrega")) {
unlink("entrega");
echo '<script>location.href="?'.$_SERVER['QUERY_STRING'].'";</script>';
}
} else {
if(!file_exists("entrega")) {
$fp = fopen("entrega", "w");
$escreve = fwrite($fp, "");
fclose($fp); 
echo '<script>location.href="?'.$_SERVER['QUERY_STRING'].'";</script>';
}
}
}
?>