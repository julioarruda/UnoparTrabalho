<?php

if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.');
}

if(isset($_SESSION[email])) { exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.'); } else {

$mostrar = $mysqli->query("select * from dl_produtos where id='".$_GET[id]."' order by id desc");
$mostrar2 = $mostrar->fetch_array();

?>

<br /><br />
<div class="container marketing">



<div class="page-header">
<h2>Admin</h2>
</div>
<p class="lead">&Aacute;rea destinada a membros da administra&ccedil;&atilde;o, se estiver no lugar errado clique <a href="?page=cardapio">aqui.</a></p>
<ul class="nav nav-tabs" role="tablist">
        <li role="presentation"><a href="?page=adm">In&iacute;cio</a></li>
        <li role="presentation"><a href="?page=adm_categorias">Categorias</a></li>
        <li role="presentation"  class="active"><a href="?page=adm_produtos">Produtos</a></li>
		<li role="presentation"><a href="?page=adm_entregas">Entregas</a></li>
		<li role="presentation"><a href="?page=sair">Sair</a></li>
      </ul>


<h1 class="page-header">Editar Produto</h1>
<div style="width:50%;">
<form action="" method="post" enctype="multipart/form-data">
<input name="nome" class="form-control" type="text" value="<?=$mostrar2[nome];?>" placeholder="Nome..." required><br />
<input name="descricao" class="form-control" type="text" value="<?=$mostrar2[descricao];?>" placeholder="Descri&ccedil;&atilde;o..." required><br />
<input name="preco" class="form-control" type="text" value="<?=str_replace(".",",", $mostrar2[preco]);?>" placeholder="0.00" maxlength="5" required> <font color=red>valor 0 para produtos indisponíveis.</font><br /><br />
<?php
echo '<select name="categoria" class="form-control" style="width:80%;" required>
<option value="'.$mostrar2[categoria].'">'.$mostrar2[categoria].'</option>';
$mostrar = $mysqli->query("select * from dl_categorias order by id desc");
while($exibir = $mostrar->fetch_assoc())  {
echo '<option value="'.sql($exibir[nome]).'">'.sql($exibir[nome]).'</option>';
}
echo '</select>';
?><br />
<select name="promocao" class="form-control" style="width:80%;" required>
<option value="<?=$mostrar2[promocao];?>"><?php if($mostrar2[promocao] == 0) { echo "Sem promoção"; } else { echo "Com promoção"; } ?></option>
<option value="0">Sem Promo&ccedil;&atilde;o</option>
<option value="1">Com Promo&ccedil;&atilde;o</option>
</select><br />
<h4>Opções</h4>
<input name="opcao1" type="checkbox" value="1" <?php if($mostrar2[opcao1] == 1) { echo 'checked="checked"'; } ?> /> <?=$op1_n;?> 
<input name="opcao2" type="checkbox" value="1" <?php if($mostrar2[opcao2] == 1) { echo 'checked="checked"'; } ?> /> <?=$op2_n;?> 
<input name="opcao3" type="checkbox" value="1" <?php if($mostrar2[opcao3] == 1) { echo 'checked="checked"'; } ?> /> <?=$op3_n;?> 
<input name="opcao4" type="checkbox" value="1" <?php if($mostrar2[opcao4] == 1) { echo 'checked="checked"'; } ?> /> <?=$op4_n;?> 
<input name="opcao5" type="checkbox" value="1" <?php if($mostrar2[opcao5] == 1) { echo 'checked="checked"'; } ?> /> <?=$op5_n;?>  
<input name="opcao6" type="checkbox" value="1" <?php if($mostrar2[opcao6] == 1) { echo 'checked="checked"'; } ?> /> <?=$op6_n;?> 
<input name="opcao7" type="checkbox" value="1" <?php if($mostrar2[opcao7] == 1) { echo 'checked="checked"'; } ?> /> <?=$op7_n;?> 
<input name="opcao8" type="checkbox" value="1" <?php if($mostrar2[opcao8] == 1) { echo 'checked="checked"'; } ?> /> <?=$op8_n;?> 
<input name="opcao9" type="checkbox" value="1" <?php if($mostrar2[opcao9] == 1) { echo 'checked="checked"'; } ?> /> <?=$op9_n;?> 
<input name="opcao10" type="checkbox" value="1" <?php if($mostrar2[opcao10] == 1) { echo 'checked="checked"'; } ?> /> <?=$op10_n;?> <br />
<br /><bR />
<input class="btn btn-success btn-block" type="submit" value="Enviar" style="width:70%;" name="enviar">
</form></div><br>
<a href="?page=adm_produtos"><input class="btn btn-danger btn-block" type="submit" value="Voltar" style="width:35%;" name="enviar">
</a>

<br />

<?php 

if($_POST[enviar]) {

$mysqli -> query ("update dl_produtos set nome='".$_POST[nome]."',descricao='".$_POST[descricao]."', preco='".str_replace(",",".", $_POST[preco])."',categoria='".$_POST[categoria]."',promocao='".$_POST[promocao]."',opcao1='".$_POST[opcao1]."',opcao2='".$_POST[opcao2]."',opcao3='".$_POST[opcao3]."',opcao4='".$_POST[opcao4]."',opcao5='".$_POST[opcao5]."',opcao6='".$_POST[opcao6]."',opcao7='".$_POST[opcao7]."',opcao8='".$_POST[opcao8]."',opcao9='".$_POST[opcao9]."',opcao10='".$_POST[opcao10]."' where id='".$_GET[id]."'");

echo '<div class="alert alert-success" role="alert"><b>Sucesso!</b> produto editado.</div>';
}
} ?>