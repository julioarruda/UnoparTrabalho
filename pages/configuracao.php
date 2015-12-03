<?php
if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit('<h1>ERROR 404</h1>Entre em contato conosco e envie detalhes.');
}


// PHP LIVRE - DIREITOS RESERVADOS

$fch = "0";  /* DESEJA QUE A LOJA FECHE SOZINHA NOS HORÁRIOS? 1: SIM 0: NÃO */

$cfg = array(
     "servidor" => "br-cdbr-azure-south-a.cloudapp.net",              // IP HOST
	 "login" => "bce2ac5be3ae53",                      // LOGIN HOST
	 "senha" => "51dd72c0",                       // SENHA HOST
	 "database" => "unoparACdHfHf0la",                     // DATABASE HOST
	 "empresa" => "Pizzaria Maveana",                // NOME DA EMPRESA
	 "email"    => "contato@maveana.com.br",   // EMAIL DE CONTATO
     "site"    => "www.maveana.com.br",     // SITE DA EMPRESA
	"facebook" => "https://www.facebook.com/maveana", // FACEBOOK DA EMPRESA
	"entrega" => "3,00",                            // TAXA DE ENTREGA
	"minimo" => "10,00",                             // VALOR DO PEDIDO MINIMO
	"horario" => "17",                            // HORARIO DE ABERTURA SEM MINUTOS
	"horario2" => "21",                         // HORARIO DE FECHAMENTO SEM MINUTOS
	"diasf" => "Quarta à Domingo",                         // DIAS DE FUNCIONAMENTO
	"entrega_min" => "50 min",                 // TEMPO DE ENTREGA ESTIMADO
	"bairros" => "Bangu, Realengo, Padre Miguel", // BAIRROS PARA ENTREGA
	"user" => "admin",                          // LOGIN DO ADMIN
	"pw" => "admin",                           // SENHA DO ADMIN
	"tel1" => "(21) 3332-3208",                // TELEFONE 1
	"tel2" => "(21) 9206-3872",               // TELEFONE 2
	"endereco" => "Rio de Janeiro, Realengo RJ.",      // ESTADO E CIDADE
	"endereco2" => "Rua do governo, 380.",      // RUA E NUMERO
	"cartoes" => "MasterCard, Visa e Dinners"    // Cartões aceitos
	 );
	 
	 // LINK DO IFRAME DO MAPA DE SUA LOJA, PEGAR NO GOOGLE MAPS
	 $map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.9294613660513!2d-43.466941000000034!3d-22.879063999999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdfec61c43b9b%3A0x1290c707e98df4bd!2sBangu+Shopping!5e0!3m2!1spt-BR!2sbr!4v1430413674997';
	 
	 $op1_n = "Metades";
	 $op1=array('1 Metade','2 Metades','3 Metades','4 Metades');      // OPCOES PARA O PRODUTO
	 
	 $op2_n = "Sabores 1";
	 $op2=array('Frango Catupry','Calabresa','4 Queijos','Portuguesa');      // OPCOES PARA O PRODUTO
	 
	 $op3_n = "Sabores 2";
	 $op3=array('Frango Catupry','Calabresa','4 Queijos','Portuguesa');      // OPCOES PARA O PRODUTO
	 
	 $op4_n = "Sabores 3";
	 $op4=array('Frango Catupry','Calabresa','4 Queijos','Portuguesa');      // OPCOES PARA O PRODUTO
	 
	 $op5_n = "Sabores 4";
	 $op5=array('Frango Catupry','Calabresa','4 Queijos','Portuguesa');      // OPCOES PARA O PRODUTO
	 
	 $op6_n = "Tipo do Hambúrguer";
	 $op6=array('Carne','Frango','Bovino');                    // OPCOES PARA O PRODUTO
	 
	 $op7_n = "Alface";
	 $op7=array('Com Alface','Sem Alface');                                  // OPCOES PARA O PRODUTO
	 
	 $op8_n = "Molho";
	 $op8=array('Com Molho','Sem Molho');                                 // OPCOES PARA O PRODUTO
	 
	 $op9_n = "Ovos";
	 $op9=array('Com Ovos','Sem Ovos');                                 // OPCOES PARA O PRODUTO
	 
	 $op10_n = "Suco";
	 $op10=array('A&ccedil;&uacute;car','Ado&ccedil;ante','Sem nada');                               // OPCOES PARA O PRODUTO
	 
// MÉTODOS DE PAGAMENTOS ONLINE
$pg_online = "sim";                                             // HABILITA OPÇÃO DE PAGAMENTOS ONLINE

// MERCADO PAGO
require_once "mercadopago.php";
$mp = new MP('SEU_CLIENT_ID', 'SEU_CLIENT_SECRET');  // CLIENT_ID E CLIENTE_SECRET
$pg_mp = "contato@phplivre.com";                                // EMAIL DO MERCADO PAGO, CASO QUEIRA DESATIVAR DEIXE EM BRANCO

// PAYPAL
$pg_pp = "contato@phplivre.com";                                // EMAIL DO PAYPAL, CASO QUEIRA DESATIVAR DEIXE EM BRANCO

// MOIP
$pg_moip = "contato@phplivre.com";                                // EMAIL DO MOIP, CASO QUEIRA DESATIVAR DEIXE EM BRANCO

// BCASH
$pg_bcash = "contato@phplivre.com";                                // EMAIL DO BCASH, CASO QUEIRA DESATIVAR DEIXE EM BRANCO


// PAGSEGURO
$pg_ps = "contato@phplivre.com";                                // EMAIL DO PAG SEGURO, CASO QUEIRA DESATIVAR DEIXE EM BRANCO


// CONEXAO, N�O MECHER
$mysqli = new mysqli ($cfg[servidor],$cfg[login],$cfg[senha],$cfg[database]);
if (mysqli_connect_errno()) {
    die('Não foi possível conectar-se ao banco de dados: ' . mysqli_connect_error());
    exit();
}

if($_GET[page] === "sair") {
@session_start();
@session_destroy();
@session_unset();
echo '<meta http-equiv="refresh" content="0;url=?page=adm">';
}

if(!function_exists("sql")) {
function sql($campo, $adicionaBarras = false) {
$campo = preg_replace("/(from|alter table|select|insert|delete|update|were|drop table|show tables|#|\*|--|\\\\)/i","",$campo);
$campo = trim($campo);
$campo = strip_tags($campo);
if($adicionaBarras || !get_magic_quotes_gpc())
$campo = addslashes($campo);
return $campo; 
} }

if(!function_exists("email")) {
function email($email,$titulo,$msg,$empresa,$email2) {
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: ".$empresa." <".$email2.">\r\n"; 
$headers .= "Return-Path: ".$empresa." <".$email2.">\r\n"; 
mail("".$email."", "".$titulo."", "".$msg." <br><br>
-----------------------------------------------------------<br>
<br>
<b>".$empresa."</b><br>
".$email2."", $headers);
}}
?>