<?php
include("configuracao.php");
?>
<!doctype html>
<html>
<head>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<head>
	<script src="../js/jquery-2.1.1.min.js"></script>
</head>
    <style type="text/css">
    body {
        background-color: #f0f0f2;
        margin: 0;
        padding: 0;
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        
    }
    div {
        width: 600px;
        margin: 5em auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 1em;
    }
    a:link, a:visited {
        color: #38488f;
        text-decoration: none;
    }
    @media (max-width: 700px) {
        body {
            background-color: #fff;
        }
        div {
            width: auto;
            margin: 0 auto;
            border-radius: 0;
            padding: 1em;
        }
    }
    </style>  
	  
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap.css" rel="stylesheet">
</head>

<body>
<div>
<h1>OPÇÕES</h1>
selecione a opção que desejar.
<form action="" method="post">
	<?php
	include("configuracao.php");
	$afez2 = $mysqli->query("select * from dl_produtos where id='".$_GET[idq]."'");
	$afez = $afez2->fetch_assoc();

 if(!empty($afez[opcao1])) {
	 echo '<select name="opcao1" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op1_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op1) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	  if(!empty($afez[opcao2])) {
	 echo '<select name="opcao2" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op2_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op2) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	  if(!empty($afez[opcao3])) {
	 echo '<select name="opcao3" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op3_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op3) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	  if(!empty($afez[opcao4])) {
	 echo '<select name="opcao4" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op4_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op4) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	  if(!empty($afez[opcao5])) {
	 echo '<select name="opcao5" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op5_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op5) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	  if(!empty($afez[opcao6])) {
	 echo '<select name="opcao6" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op6_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op6) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	 
	  if(!empty($afez[opcao7])) {
	 echo '<select name="opcao7" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op7_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op7) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	 
	  if(!empty($afez[opcao8])) {
	 echo '<select name="opcao8" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op8_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op8) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	 
	  if(!empty($afez[opcao9])) {
	 echo '<select name="opcao9" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op9_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op9) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }
	 
	 
	  if(!empty($afez[opcao10])) {
	 echo '<select name="opcao10" class="form-control" required>';
	 echo '<option selected="selected" disabled="disabled">--- '.$op10_n.' ---</option>';
	 while (list ($key2, $val2) = each ($op10) ) echo '<option value="['.$val2.']">'.$val2.'</option>';
	 echo '</select><br>'; 
	 }


echo "

<input type='hidden' name='price' value='".$afez[preco]."'>
<input type='hidden' name='name' value='".$afez[nome]."'>
<input type='hidden' name='category' value='".$afez[categoria]."'>
</tr>";

	?>
	
<input type="submit" value="ESCOLHER" name="finalizarq" style="width:100%;padding:2%;margin-bottom:1%;" class="btn btn-primary" /><br />
</form>
<?php
if($_POST[finalizarq]) {
$pr0 = $_POST[price];
$mysqli->query("insert into dl_carrinho(produto,preco,categoria,ip) values('".$_POST[name]." ".$_POST[opcao1]."".$_POST[opcao2]."".$_POST[opcao3]."".$_POST[opcao4]."".$_POST[opcao5]."".$_POST[opcao6]."".$_POST[opcao7]."".$_POST[opcao8]."".$_POST[opcao9]."".$_POST[opcao10]."','".$pr0."','".$_POST[category]."','".$_SERVER['REMOTE_ADDR']."')");
?>

<script type="text/javascript">
      window.parent.location.href="../index.php?page=cardapio";
   </script>
<?
}
?>
	</p>
</div>
</body>
</html>
