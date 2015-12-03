<?php

if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.');
}

?><head>
<meta http-equiv="refresh" content="60;url=?page=adm">
<?php if(isset($_SESSION[login])) { ?>
<script type="text/javascript" >
	$(document).ready(function () {
        $.fancybox({
            'width': '40%',
            'height': '40%',
            'autoScale': true,
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'type': 'iframe',
            'href': 'pages/pw2.php'
        });
});
</script>
<? } ?>
</head>


<br><br><bR>


<br /><br />
<div class="container marketing">



<div class="page-header">
<h2>Admin</h2>
</div>
<p class="lead">&Aacute;rea destinada a membros da administra&ccedil;&atilde;o, se estiver no lugar errado clique <a href="?page=cardapio">aqui.</a></p>


<?php if(isset($_SESSION[login])) { ?>



<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="?page=adm">In&iacute;cio</a></li>
        <li role="presentation"><a href="?page=adm_categorias">Categorias</a></li>
        <li role="presentation"><a href="?page=adm_produtos">Produtos</a></li>
		<li role="presentation"><a href="?page=adm_entregas">Entregas</a></li>
		<li role="presentation"><a href="?page=sair">Sair</a></li>
      </ul><br />
<h3>Vai fechar o caixa?</h3>
Até agora conseguimos <b style="color:green;">R$ 
<?php
$sql = $mysqli->query("SELECT SUM(valor) from dl_pedidos where data='".date('d/m/Y')."' and status='Entregue'");
$exibir = $sql->fetch_array();
echo number_format($exibir['SUM(valor)'],2,",",".");
?>.</b>
<br>Contando somente com os pedidos com o status de entregue.<br><br>

Ontem tivemos <b style="color:red;font-size:16px;">
<?php
$sql2 = $mysqli->query("SELECT * from dl_pedidos where data='".date('d/m/Y', strtotime("-1 days"))."'");
$exibir2 = $sql2->num_rows;
echo $exibir2;
?> </b> pedidos.
<br><br />
Hoje tivemos <b style="color:orange;">
<?php
$sql2 = $mysqli->query("SELECT * from dl_pedidos where data='".date('d/m/Y')."'");
$exibir2 = $sql2->num_rows;
echo $exibir2;
?> </b> pedidos.
<br>
<b style="color:blue">
<?php
$sql3 = $mysqli->query("SELECT * from dl_pedidos where data='".date('d/m/Y')."' and status='Entregue'");
$exibir3 = $sql3->num_rows;
echo $exibir3;
?></b> deles foram entregues.

<br><br>


<?php
$result = $mysqli -> query ("SELECT * from dl_pedidos");
$row_tickets = $result->num_rows;
if($row_tickets == 0) {
echo '<div class="alert alert-danger" role="alert"><b>Erro!</b> nenhum pedido, tente novamente mais tarde.</div>';
} else {

$busca = "SELECT * FROM dl_pedidos";
$total_reg = "10";

$pagina=$_GET['pagina']; if (!$pagina) { $pc = "1"; } else { $pc = $pagina; }


$inicio = $pc - 1; $inicio = $inicio * $total_reg;


$limite = $mysqli->query("$busca order by id desc LIMIT $inicio,$total_reg");
  $todos = $mysqli->query("$busca");
 
  $tr = $todos->num_rows; 
  $tp = $tr / $total_reg; 
 
while($exibir = $limite->fetch_assoc()) {
echo $exibir[descricao];
echo "<form action='' method='post'>
<input type='hidden' name='id' value='".$exibir[id]."'>
<select name='status' style='width:15%;padding:0.4%;' required>
<option value='".$exibir[status]."'>".$exibir[status]."</option>
<option value='Sendo Separado'>Sendo Separado</option>
<option value='Separado'>Separado</option>
<option value='Enviado'>Enviado</option>
<option value='Entregue'>Entregue</option>
<option value='Processando'>Processando</option>
<option value='Devolvido'>Devolvido</option>
<option value='Cliente Ausente'>Cliente Ausente</option>
<option value='Reembolsado'>Reembolsado</option>
<option value='Dados Errados'>Dados Errados</option>
<option value='Cancelado'>Cancelado</option>
<option value='Extraviado'>Extraviado</option>
</select>
<input type='submit' name='modificar' value='Modificar' class='btn btn-warning'>
<input type='submit' name='deletar' value='Deletar' class='btn btn-danger'>
</form>
";
echo "<br><br>";
	}

}
if($_POST[deletar]) {
$mysqli->query("delete from dl_pedidos where id='".$_POST['id']."'");
echo '<script>location.href="?page=adm";</script>';
}

if($_POST[modificar]) {
echo "<script>alert('Modificado, email enviado para o cliente.');</script>";
$mysqli->query("update dl_pedidos set status='".$_POST['status']."' where id='".$_POST[id]."'");
$pegar = $mysqli->query("select * from dl_pedidos where id='".$_POST[id]."'");
$em = $pegar->fetch_assoc();
email($em[email],"Mudança no status do pedido","O seu pedido <b>#".$em[id]."</b> foi alterado para ".$_POST['status'].".<br>
<a href='http://".$cfg[site]."/?page=pedido&id=".$em[id]."'>http://".$cfg[site]."/?page=pedido&id=".$em[id]."</a>",$cfg[empresa],$cfg[email]);
}
  
 echo "<center>";

  $anterior = $pc -1;
  $proximo = $pc +1;
  if ($pc>1) {
  echo "<a href='?page=adm&pagina=$anterior' class='btn btn-info'>Anterior</a>";
  }
  echo " ";
  if ($pc<$tp) {
  echo "<a href='?page=adm&pagina=$proximo' class='btn btn-info'>Pr&oacute;ximo</a>";
  }
echo "</center>";
?> 
	  
	  
	  
	  
	  
	  
<? } else { ?>

<div style="width:50%">
<form action="" method="post">
<input type="text" name="user" class="form-control" placeholder="Usu&aacute;rio..." /><br />
<input type="password" name="pw" class="form-control" placeholder="Senha..." /><br />

<input type="submit" value="Entrar" name="entrar" style="width:100%;margin-bottom:1%;" class="btn btn-success" />
</form>

<?php
if($_POST[entrar]) {

if(empty($_POST[user]) || empty($_POST[pw])) {

echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, existem campos em branco. </div>';
}elseif($_POST[user] === $cfg[user] and $_POST[pw] === $cfg[pw]) {
session_start();
$_SESSION[login] = $cfg[user];
$_SESSION[nome] = $cfg[empresa];
echo '<script>location.href="?page=adm";</script>';
} else {
echo '<br><div class="alert alert-info fade in"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="margin-right:0.5%;"></span> Desculpe, o usu&aacute;rio ou senha inv&aacute;lidos. </div>';

}}
?>
</div>

<? } ?>

</div>


