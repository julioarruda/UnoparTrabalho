<br /><br />
<div class="container marketing">



<div class="page-header">
<h2>Promo&ccedil;&otilde;es</h2>
</div>

<?php
		  $pegar_car = $mysqli->query("select * from dl_produtos where promocao='1'");
		  $pegar_ca = $pegar_car->fetch_assoc();
		  if($pegar_ca == 0) { echo '<center><br><br><img src="css/img_carrinho_vazio.png"/><br>
	<h3>Nenhuma promo&ccedil;&atilde;o</h3>Que tal achar uma coisa gostosa para <a href="?page=cardapio">comer?</a></center>'; } else {
	$pegar2 = $mysqli->query("select * from dl_produtos where promocao='1' order by rand() limit 0,5");
	while($pegar = $pegar2->fetch_assoc()) {
	echo "<div style='float:left;width:20%;'>
	<center><a href='?page=cardapio'><img src='css/produtos/".$pegar[foto]."' width='130' height='70'></a><br><br>
	";
		  echo "<b>$pegar[nome]</b> por<br><h4> R$ ".number_format($pegar[preco],2,",",".")."</h4>";
		  echo "</center></div>";
		  }
		  }
		  ?>

</div>

<div style="clear:both;"></div><br />
