<?php

if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.');
}
?>
<br /><br />
<div class="container marketing">



<div class="page-header">
<h2>Admin</h2>
</div>
<p class="lead">&Aacute;rea destinada a membros da administra&ccedil;&atilde;o, se estiver no lugar errado clique <a href="?page=cardapio">aqui.</a></p>


<?php if(isset($_SESSION[login])) { ?>



<ul class="nav nav-tabs" role="tablist">
        <li role="presentation"><a href="?page=adm">In&iacute;cio</a></li>
        <li role="presentation"><a href="?page=adm_categorias">Categorias</a></li>
        <li role="presentation"><a href="?page=adm_produtos">Produtos</a></li>
		<li role="presentation" class="active"><a href="?page=adm_entregas">Entregas</a></li>
		<li role="presentation"><a href="?page=sair">Sair</a></li>
      </ul><br />
	  
	  
	  
<?php if(file_exists("entrega")) { ?>

<form action="" method="post">
<input type="submit" name="go" value="Desativar Entregas" class="btn btn-danger" />
</form>


<? 
if($_POST[go]) {
unlink("entrega");
echo '<script>location.href="?page=adm_entregas";</script>';
}
} else { ?>

<form action="" method="post">
<input type="submit" name="go" value="Ativar Entregas" class="btn btn-success" />
</form>

<? 
if($_POST[go]) {
$fp = fopen("entrega", "w");
$escreve = fwrite($fp, "");
fclose($fp); 
echo '<script>location.href="?page=adm_entregas";</script>';
}
} ?>
	  
	  
	  
	  
	  
	  
<? } else { ?>

<div style="width:50%">
<form action="" method="post">
<input type="text" name="user" class="form-control" placeholder="Usu&aacute;rio..." /><br />
<input type="text" name="pw" class="form-control" placeholder="Senha..." /><br />

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


