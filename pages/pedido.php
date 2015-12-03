<?php

if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.');
}
?>
<br /><br />
<div class="container marketing">
<?php
$pegar_car = $mysqli->query("select * from dl_pedidos where id='".sql($_GET[id])."'");
$pegar_ca = $pegar_car->fetch_assoc();

switch($pegar_ca[status]) {
case "Processando": $xds = '<span style="margin-left:2%;" class="label label-info">';
break;
case "Enviado": $xds = '<span style="margin-left:2%;" class="label label-success">';
break;
case "Entregue": $xds = '<span style="margin-left:2%;" class="label label-success">';
break;
case "Devolvido": $xds = '<span style="margin-left:2%;" class="label label-danger">';
break;
case "Cancelado": $xds = '<span style="margin-left:2%;" class="label label-danger">';
break;
case "Cliente Ausente": $xds = '<span style="margin-left:2%;" class="label label-warning">';
break;
default: $xds = '<span style="margin-left:2%;" class="label label-primary">';
}
?>


<div class="page-header">
<h2>Pedido #<?=$pegar_ca[id];?> <?=$xds;?>Status: <?=$pegar_ca[status];?> </span> <a style="font-size:14px;margin-left:1%;" href="javascript:null(0)" onclick="window.print();">[Imprimir]</a></h2>
</div>

<?php
		  $pegar_car = $mysqli->query("select * from dl_pedidos where id='".sql($_GET[id])."'");
		  $pegar_ca = $pegar_car->fetch_assoc();
		  if($pegar_ca == 0) { echo '<center><br><br><img src="css/img_carrinho_vazio.png"/><br>
	<h3>Nenhum pedido</h3>Que tal achar uma coisa gostosa para <a href="?page=cardapio">comer?</a></center>'; } else {
		  echo $pegar_ca[descricao];
		  }
		  ?>
<?php
if($pg_online == sim and $pegar_ca[status] != Entregue) {?>
<br /><bR />
<h3>Pague também com:</h3>
<br />












<?php if(!empty($pg_ps)) { ?>
<form method="post" target="pagseguro"  
action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
          
        <!-- Campos obrigatórios -->  
        <input name="receiverEmail" type="hidden" value="<?=$pg_ps;?>">  
        <input name="currency" type="hidden" value="BRL">  
  
        <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
        <input name="itemId1" type="hidden" value="<?=$pegar_ca[id];?>">  
        <input name="itemDescription1" type="hidden" value="PEDIDO: <?=$pegar_ca[id];?>">  
        <input name="itemAmount1" type="hidden" value="<?=$pegar_ca[valor];?>">  
        <input name="itemQuantity1" type="hidden" value="1">  
        <input name="itemWeight1" type="hidden" value="1000">  
  
        <!-- Código de referência do pagamento no seu sistema (opcional) -->  
        <input name="reference" type="hidden" value="PEDIDO <?=$pegar_ca[id];?>">    
         
		
		
		
		
		<input name="shippingType" type="hidden" value="1">  
        <input name="shippingAddressCountry" type="hidden" value="BRA"> 
		
		<input name="senderEmail" type="hidden" value="<?=$pegar_ca[email];?>"> 
		
  
        <!-- submit do form (obrigatório) -->  
        <input alt="Pague com PagSeguro" style="float:left;" name="submit"  type="image"  
src="css/ps.gif"/>     
</form>  
<? } ?>


<?php if(!empty($pg_pp)) { ?>

<form class="nicepaypalbuttonlite" action="https://www.paypal.com//cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="business" value="<?=$pg_ps;?>" />
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="item_name" value="PEDIDO: <?=$pegar_ca[id];?>" />
<input type="hidden" name="amount" value="<?=$pegar_ca[valor];?>" />
<input type="hidden" name="currency_code" value="BRL" />
<input type="hidden" name="lc" value="BR" />
<input type="hidden" name="return" value="http://<?php echo $_SERVER['HTTP_HOST'] . "/?page=pedido&id=" . $_GET[id]; ?>&paypal=1">
<input type="image" name="submit" style="border: 0;float:left;margin-left:1%;" src="css/pp.png" alt="PayPal" /></form>

<? 
if($_GET[paypal] == 1) {
echo "<script>alert('Seu pagamento pelo paypal está sendo processado.');</script>";
}
} ?>


<?php if(!empty($pg_moip)) { ?>
<form method='post' action='https://desenvolvedor.moip.com.br/sandbox/PagamentoMoIP.do' target="_blank">
<input type='hidden' name='id_carteira' value='<?=$pg_moip;?>'/>
<input type='hidden' name='valor' value='<?=substr(str_replace(".","0",$pegar_ca[valor]),0,3);?>0'/>
<input type='hidden' name='nome' value='PEDIDO: <?=$pegar_ca[id];?>'/>
<input type='image' name='submit' src='css/moip.png' style="border: 0;float:left;margin-left:1%;" alt='MOIP' border='0' />
</form>

<? } ?>

<?php if(!empty($pg_bcash)) { ?>

<form action="https://www.bcash.com.br/checkout/car/" method="post" target="carrinho">
<input name="email_loja" type="hidden" value="contato@ongincafe.org">
<input name="acao" type="hidden" value="add"> <input name="cod_prod" type="hidden" value="<?=$pegar_ca[id];?>">
<input name="nome_prod" type="hidden" value="PEDIDO: <?=$pegar_ca[id];?>"> <input name="valor_prod" type="hidden" value="<?=$pegar_ca[valor];?>" >
<input name="peso_prod" type="hidden" value="25"> <input name="quant_prod" type="hidden" value="1">
<input name="email_dependente_1" type="hidden" value="<?=$pegar_ca[email];?>">
<input name="valor_dependente_1" type="hidden" value="<?=$pegar_ca[valor];?>">
<input type="image" src="css/bcash.png" value="Adicionar ao Carrinho" style="border: 0;float:left;margin-left:1%;" alt="Bcash" border="0" align="absbottom" >
</form>

<? } ?>


<?php if(!empty($pg_mp)) {
function get_numeric($val) { 
  if (is_numeric($val)) { 
    return $val + 0; 
  } 
  return 0; 
} 


$preference_data = array(
    "items" => array(
       array(
           "title" => "PEDIDO: ".$pegar_ca[id]."",
           "quantity" => 1,
           "currency_id" => "BRL",
           "unit_price" => get_numeric($pegar_ca[valor])
       )
    )
);

$preference = $mp->create_preference($preference_data);
?>

<a href="<?=$preference["response"]["init_point"];?>" style="float:left;margin:1%;" target="_blank"><img src="css/mp.png" /></a>

<?
if($_GET[mp] == aprovado) {
echo "<script>alert('Seu pagamento pelo mercado pago foi aprovado, atualizaremos em breve.');</script>";
}
if($_GET[mp] == recusado) {
echo "<script>alert('Seu pagamento pelo mercado pago foi recusado, atualizaremos em breve.');</script>";
}
if($_GET[mp] == processando) {
echo "<script>alert('Seu pagamento pelo mercado pago está processando, atualizaremos em breve.');</script>";
}

} ?>















<? } ?>
<br /><br />
<div style="clear:both;"></div>
<h3>Para cancelar ou mudar seu pedido ligue para nossa central.</h3>
<h3><span class="label label-warning"><?=$cfg[tel1];?> \ <?=$cfg[tel2];?></span></h3>

<h2><span class="label label-primary">Obrigado pela preferência!</span></h2>
</div>

