<head>
<script type="text/javascript">
<?php
if($_GET[idq]) { ?>
	$(document).ready(function () {
        $.fancybox({
            'width': '40%',
            'height': '40%',
            'autoScale': true,
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'type': 'iframe',
			'hideOnOverlayClick':false,
        'hideOnContentClick':false,
			'closeBtn' : false, helpers : { 
  overlay : {closeClick: false}
},
            'href': 'pages/go.php?idq=<?=$_GET[idq];?>'
        });
		
});
<? } ?>
</script>
</head>

<?php
require('configuracao.php');
if(isset($_POST[c])) {
if(empty($_POST[c])) { $cw = "select * from dl_produtos order by id desc"; } else { $cw = "select * from dl_produtos where categoria like '%".$c."%' or nome like '%".$c."%' or descricao like '%".$c."%' order by id desc"; }
	  $pegar_categorias = $mysqli->query($cw);
	  $pegar_zero = $pegar_categorias->num_rows;
	  if($pegar_zero == 0) { echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;height:5%;"></span> Nenhum produto encontrado em sua busca. </div>'; }
	  include("configuracao.php");	  
	  echo "<table class='table table-hover' style='border:none;'>";  
	  while($afez = $pegar_categorias->fetch_assoc()) {

	  echo " <tr height='100%' style='border:none;'><td>
	  <img src='css/produtos/$afez[foto]' style='position:absolute;  z-index: 1;' width='130' height='70'>";
	  if($afez[promocao] == 1) { echo "<img src='css/promocao.png' style='position:absolute;  z-index: 2;'  width='80' height='70'>"; }
	  
	  echo "
 <td style='padding-left:20%;  z-index: 3;'><b> ".sql($afez[nome])."</b><br>".sql($afez[descricao])."<td>";
 

	  echo "
<td style='text-align:right;padding-top:3%;'> <h4><b>R$ ".number_format($afez[preco],2,",",".")."</b></h4><td>
 <td style='text-align:right;width:10%;'>
<form action='' method='post'>
<input type='hidden' name='id' value='".$afez[id]."'>
<input type='hidden' name='price' value='".$afez[preco]."'>
<input type='hidden' name='name' value='".$afez[nome]."'>
<input type='hidden' name='category' value='".$afez[categoria]."'>";
if($afez[preco] == 0) { echo "<br><font color=red>produto indisponível</font>"; } else { echo "
<br><input type='image' name='qws' value='`' src='css/+.png'>
";
} 
echo "
</form>
</tr>";
	  }
	  
	  
	  echo "</table>"; 
} else {
if($_POST[qws]) {
$_GET[idq] = $_POST[id];
echo '<script>location.href="?page=cardapio&idq='.$_POST[id].'"</script>';

}
?>

<br />

<div class="container marketing" style="margin-top:5%;">
<div class="wrapper">
<div style="float:left;margin:2% 4% 2% 2%;"><iframe src="<?=$map;?>" width="250" height="150" frameborder="0" style="border:0"></iframe></div>
<div style="width:100%;height:40%;background-color:#F2F3F3;padding:1%;border:thin solid #D6D6D6;margin-bottom:2%;">
<img src="css/logo.png" style="margin:0 2% 0 2%;float:right;" />
<h3><?=$cfg[empresa];?></h3>

<?php
if(file_exists("entrega")) {
echo '<h4 style="color:#000;"><img src="css/aberto.png" title="Loja aberta"> Aberto <font style="color:#999;font-size:14px;"> (Fecha às '.$cfg[horario2].' horas)</font></h4>';
} else {
echo '<h4 style="color:#000;"><img src="css/fechado.png" title="Loja fechada"> Fechada <font style="color:#999;font-size:14px;">(Abrirá às '.$cfg[horario].' horas)</font></h4>';
}
?> <?=$cfg[diasf];?> das <?=$cfg[horario];?>:00 &agrave;s <?=$cfg[horario2];?>:00.<br />
<h4><span class="glyphicon glyphicon-time" aria-hidden="true" style="margin-right:0.5%;height:5%;color:#BFBFC0;" ></span>  <?=$cfg[entrega_min];?> 
<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="margin-right:0.5%;height:5%;margin-left:2%;color:#BFBFC0;"></span>  <?php
$pegar_xss = $mysqli->query("select * from dl_pedidos");
$pegar_xssw = $pegar_xss->num_rows;
echo $pegar_xssw;
?></h4>
<div style="clear:both;"></div>
</div>

<?php
if(file_exists("entrega")) {
?>
<form action="" method="post"> 
<table width="100%" border="0">
  <tr>
    <td><div style="width:30%;height:30%;float:right;border:thin solid #EAEAEA;">
	<div style="background-color:#F2F3F3;"><img src="css/car.png" width="100%" /></div>
	
	<br>
	<?php
		  $pegar_car = $mysqli->query("select * from dl_carrinho where ip='".$_SERVER["REMOTE_ADDR"]."'");
		  $pegar_ca = $pegar_car->num_rows;
		  if($pegar_ca == 0) { echo '<center><img src="css/img_carrinho_vazio.png" width="20%" height="20%" />
	<h4>Carrinho vazio</h4>Que tal achar uma coisa gostosa<br /> para comer?</center>'; }
		  while($exibir = $pegar_car->fetch_assoc()) {
		  echo "<form action='' method='post'>
		  <input type='hidden' name='id' value='".sql($exibir[id])."'>
		  <input type='hidden' name='produto' value='".sql($exibir[produto])."'>
		  
		  
		  <div style=margin:5%;><input type='submit' name='dell' value='[x]' style='margin:0;padding:0;border:none;background-color:#fff;color:#990000;'> ".sql($exibir[produto])." <div style='float:right;'><b>R$ ".number_format($exibir[preco],2,",",".")."</b></div></div><div style='clear:both;'></div></form>";
		  }
		  ?>
<?php
if($_POST[dell]) {
$mysqli->query("DELETE FROM dl_carrinho WHERE ip='".$_SERVER["REMOTE_ADDR"]."' and produto='".$_POST[produto]."'");
echo '<script>location.href="?page=cardapio"</script>';
}
?>	  
<head>
<script language="javascript">
 function changeImage(element) {
     element.src = element.bln ? "css/car2.png" : "css/car22.png";
     element.bln = !element.bln; 
 }
</script>
</head>
	<div id="afs"></div><br>
	<hr style="padding:0;margin:0;">
	<img src="css/car2.png" id="imgName" id="changer" onclick="changeImage(this)">
	<hr style="padding:0;margin-top:0;">
	<div style="margin:5%;width:90%;font-size:12px;color:#000;">Taxa Entrega <div style="float:right;">R$ <?=$cfg[entrega];?><br></div><div style="clear:both;"></div>
	Pedido Mínimo <div style="float:right;">R$ <?=$cfg[minimo];?></div><br>
	</div>
	<hr>
	<div style="margin:5%;width:90%;font-size:16px;">Sub-Total do Pedido <div style="font-size:20px;float:right;color:#009900;font-weight:bold;">R$ 
	<?php
$sql = $mysqli->query("SELECT SUM(preco) from dl_carrinho where ip='".$_SERVER['REMOTE_ADDR']."'");

while ($exibir = $sql->fetch_array()){;
if($exibir['SUM(preco)'] == 0) { $exibir['SUM(preco)'] = "0,00"; } else { $exibir['SUM(preco)'] = $exibir['SUM(preco)'] + $cfg[entrega]; }
echo number_format($exibir['SUM(preco)'],2,",",".");;
}
?><br>

	</div>
</div>
	<a href="?page=fechar" class="btn btn-success" style="width:90%;margin:5% 5% 1% 5%;"><h4 style="font-weight:bold;">Fechar Pedido</h4></a>
	<input type="submit" value="Cancelar" name="cancelar" class="btn btn-danger" style="width:90%;margin:1% 5% 5% 5%;" />
	
	<br>
	<center>Pague na entrega com dinheiro <br><b>OU</b><br>
	<img src="css/bandeiras.png" title="Cartões de Créditos"><br><br>
	</div></center>
<?
}
?>
	<table width="68%">
	<tr>
	<td>
	<select name="categoria" class="form-control" style="width:98%;padding:3%;height:30%;color:#A9A9A9;font-size:16px;" id="buscar" onChange="go(resultado,buscar)">
		  <option value="" disabled="disabled" selected="selected">Filtrar Menu</option>
		  <option value="">Todos</option>
		  <?php
		  $pegar_categorias = $mysqli->query("select * from dl_categorias");
		  while($exibir = $pegar_categorias->fetch_assoc()) {
		  echo "<option value='".sql(substr($exibir[nome],0, 3))."'>".sql($exibir[nome])."</option>";
		  }
		  ?>
		  </select></td>

		  <td>
		  
	
	<input type="text" class="form-control" onKeyUp="go(resultado,buscar2)" onKeyPress="go(resultado,buscar2)" id="buscar2" placeholder="Prato, ingrediente, etc..." style="width:100%;padding:2.5%;height:20%;color:#A9A9A9;font-size:16px;">
	</td>
	</tr>
	</table>
	<div style="width:68%">
<div id="resultado">
<div class="page-header">
<h2>Card&aacute;pio</h2>
</div>
<p class="lead">
<?php
if(file_exists("entrega")) {
?>
visualize nosso card&aacute;pio e vire um apaixonado pelo sabor! :)</p>
<? } else {
?>

<font color="#990000"><b>Ooops!</b><br> Desculpe, estamos fechado, volte outra hora ou consulte nossos preços.</font>

<? } ?>
</div>
</div>
	</td>
  </tr>
</table>
</form> 
      
<?php
if($_POST[cancelar]) {
$mysqli->query("delete from dl_carrinho where ip='".$_SERVER['REMOTE_ADDR']."'");
?>
<script language= "JavaScript">
location.href="?page=cardapio"
</script>
<?
}
?>


<? } ?>
