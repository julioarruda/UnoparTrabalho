<?php

if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.');
}
?>
<html>
<head>
<script type="text/javascript" >

    $(document).ready(function(){
                $("#cep").blur(function(){
                        $("#rua").val("...")
                $("#bairro").val("...")
				$("#xd").val("Procurando seu endereço...")
            $("#cidade").val("...")
                $("#uf").val("...")
        
        consulta = $("#cep").val()
                
                $.getScript("http://www.toolsweb.com.br/webservice/clienteWebService.php?cep="+consulta+"&formato=javascript", function(){

                        rua=unescape(resultadoCEP.logradouro)
                        bairro=unescape(resultadoCEP.bairro)
                        cidade=unescape(resultadoCEP.cidade)
                        uf=unescape(resultadoCEP.uf)

                        $("#rua").val(rua)
                        $("#bairro").val(bairro)
						$("#xd").val('Rua '+rua+', '+bairro+', '+cidade)
                        $("#cidade").val(cidade)
                        $("#uf").val(uf)
        
                        });
                });
        });

</script>

</head>

<br /><br />
<div class="container marketing">



<div class="page-header">
<h2>Finalizar Pedido</h2>
</div>

<?php
		  $pegar_car = $mysqli->query("select * from dl_carrinho where ip='".$_SERVER["REMOTE_ADDR"]."'");
		  $pegar_ca = $pegar_car->num_rows;
		  if($pegar_ca == 0) { echo '<center><br><br><img src="css/img_carrinho_vazio.png"/><br>
	<h3>Carrinho vazio</h3>Que tal achar uma coisa gostosa para <a href="?page=cardapio">comer?</a></center>'; } else {
	      echo "<p class='lead'> Observer sua lista, caso queira adicionar mais alguma coisa clique <a href='?page=cardapio'>aqui</a>! :)</p>";
		  echo "<table class='table table-striped'>";
		  while($exibir = $pegar_car->fetch_assoc()) {
		  echo " <tr> <td><h4> ".sql($exibir[categoria])."</b> - ".sql($exibir[produto])." <b>R$ ".number_format($exibir[preco],2,",",".")."</b></td></tr></h4>";
		  }
		  echo "</table>";
		  ?>
<div style="float:right;"><h3> Total <font style="color:#009900;font-weight:bold;"> R$	  
<?php
$sql = $mysqli->query("SELECT SUM(preco) from dl_carrinho where ip='".$_SERVER['REMOTE_ADDR']."'");

while ($exibir = $sql->fetch_array()){;
if($exibir['SUM(preco)'] == 0) { $exibir['SUM(preco)'] = "0,00"; } else { $exibir['SUM(preco)'] = $exibir['SUM(preco)'] + $cfg[entrega]; }
echo number_format($exibir['SUM(preco)'],2,",",".");;
$qr = $exibir['SUM(preco)'];
}
?>
</font>
</h3>entrega inclu&iacute;da.
</div>

<br />
<div class="page-header">
<h2>Seus dados</h2>
</div>
<div style="float:right;"><img src="css/moto-boy.fw_.png"></div>
<div style="width:40%;margin-left:10%">
<form action="" method="post">
<input type="hidden" name="prds" class="form-control" value="
<?php
$sql = $mysqli->query("SELECT * from dl_carrinho where ip='".$_SERVER['REMOTE_ADDR']."'");
while($pg = $sql->fetch_assoc()) {
echo $pg[produto].", ";
}
?>" />

<input type="text" name="nome" class="form-control" value="<?=$_SESSION[dv_nome];?>" placeholder="Nome..." /><br />
<input type="text" name="email" class="form-control" value="<?=$_SESSION[dv_email];?>" placeholder="Email..." /><br />
<input type="text" name="tel" class="form-control" value="<?=$_SESSION[dv_tel];?>" maxlength="9" placeholder="Tel de contato, somente n&uacute;meros..." /><br />
<input type="text" name="cep" value="<?=$_SESSION[dv_cep];?>" id="cep" class="form-control" maxlength="8" placeholder="CEP" />
<input name="xd" type="text" id="xd" size="60" disabled="disabled" style="color:#006600;" class="form-control" /><br>
<input type="text" name="numero" value="<?=$_SESSION[dv_numero];?>" class="form-control" maxlength="5" placeholder="Número da casa..." /><br />

<input name="pagamento" id="elemento" type="radio" value="Dinheiro"> Dinheiro
<input name="pagamento" id="elemento2" type="radio" checked style="margin-left:4%;" value="Cartão de Crédito"> <b>Cartões de Créditos</b> (<?=$cfg[cartoes];?>)<br><br>

<div id="hiddenEl" style="display:none"><b>Troco para</b><br> <input type="text" name="pagamento2" class="form-control" placeholder="20,00" /><br /></div>  

<script>  
    function showElement() {  
        document.getElementById("hiddenEl").style.display = "block";  
    }  
    function hideElement() {  
        document.getElementById("hiddenEl").style.display = "none";  
    }  
    document.getElementById("elemento").addEventListener("click", showElement, false);  
    document.getElementById("elemento2").addEventListener("click", hideElement, false);  
</script>

<textarea name="descricao" class="form-control" placeholder="Coment&aacute;rios e Observa&ccedil;&otilde;es.
ex: Apartamento, fundos, avenida...
ex 2: x-tudo sem tomate, pizza sem molho..." cols="55" rows="5"></textarea><br />
<input type="submit" value="FINALIZAR PEDIDO" name="finalizar" style="width:100%;margin-bottom:1%;" class="btn btn-success" /><br />
<a href="?page=cardapio" name="voltar" style="width:100%" class="btn btn-warning" />VOLTAR AO CARD&Aacute;PIO</a>
<input name="cep" type="hidden" id="cep" value="" size="15" maxlength="8" />
<input name="rua" type="hidden" id="rua" size="60" />
<input name="bairro" type="hidden" id="rua" size="60" />
<input name="bairro" type="hidden" id="bairro" size="60" />
<input name="cidade" type="hidden" id="cidade" size="60" />

</form>
</div>

<?php
if($_POST[finalizar]) {
$_SESSION[dv_nome] = $_POST[nome];
$_SESSION[dv_email] = $_POST[email];
$_SESSION[dv_tel] = $_POST[tel];
$_SESSION[dv_cep] = $_POST[cep];
$_SESSION[dv_numero] = $_POST[numero];

if($_POST[pagamento] == "Dinheiro") {
$qrws = "Troco para <b>R$ " . $_POST[pagamento2] . "</b>";
} else {
$qrws = "Cart&atilde;o de Cr&eacute;dito";
}

if(empty($_POST[nome]) || empty($_POST[email]) || empty($_POST[tel]) || empty($_POST[numero]) || empty($_POST[pagamento])) {
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, existem campos em branco. </div>';
} elseif(!file_exists('entrega')) {
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, n&atilde;o estamos entregando no momento. </div>';

} elseif(!strstr($cfg[bairros], $_POST[bairro])==TRUE) {
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, n&atilde;o entregamos em '.$_POST[bairro].'. </div>';
} elseif($cfg[minimo] > $qr) {
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, o valor min&iacute;mo para entregas &eacute; de R$ '.$cfg[minimo].'. </div>';
} elseif(ereg('[^0-9]',$_POST[tel]) || ereg('[^0-9]',$_POST[numero])){
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, o n&uacute;mero de telefone est&aacute; incorreto, somente n&uacute;meros. </div>';
} elseif(strlen($_POST[tel]) < 8){
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, o n&uacute;mero de telefone est&aacute; incorreto, faltando n&uacute;meros. </div>';
} else {
$ps = $mysqli->query("select * from dl_pedidos order by id desc");
$new_d = $ps->fetch_assoc();
$new_dd = $new_d[id] + 1;
$mysqli->query("insert into dl_pedidos(valor,data,descricao,email) values('".$qr."','".date('d/m/Y')."','

<table class=table table-bordered>
<tr style=font-weight:bold;text-align:center;>
<td><span style=margin-left:2%; class=label label-info><a href=?page=pedido&id=".$new_dd." target=_blank>Pedido ".$new_dd."</a></span></td>
<td>Telefone</td>
<td>Local</td>
<td>Produtos</td>
<td>Pagamento</td>
<td>Total</td>
<td>Descricao</td>
</tr>
<tr>
<td><b>".$_POST[nome]."</b><br>".sql($_POST[email])."</td>
<td>".sql($_POST[tel])."</td>
<td>".$_POST[bairro].", Rua ".$_POST[rua]." ".$_POST[numero].".</td>
<td>".$_POST[prds]."</td>
<td>".$qrws." ".data()."</td>
<td><b>R$ ".number_format($qr,2,",",".")."<b></td>
<td><i>".$_POST[descricao]."</i></td>
</tr>
</table>
','".$_POST[email]."')");
$mysqli->query("delete from dl_carrinho where ip='".$_SERVER['REMOTE_ADDR']."'");
$chegar = $mysqli->query("select * from dl_pedidos order by id desc");
$chegar2 = $chegar->fetch_assoc();
email($_POST[email],"Novo pedido realizado","O seu novo pedido <b>#".$chegar2[id]."</b> foi realizado, aguarde instruções.<br>
<a href='http://".$cfg[site]."/?page=pedido&id=".$chegar2[id]."'>http://".$cfg[site]."/?page=pedido&id=".$chegar2[id]."</a>",$cfg[empresa],$cfg[email]);
echo '<script>location.href="?page=pedido&id='.$chegar2[id].'";</script>';
}

}
?>

<?php } ?>

</div>


</div>


<body>


    </form>
</body>
</html>