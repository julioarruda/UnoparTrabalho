<?php
$mysqli->query("CREATE TABLE `dl_carrinho` (
  `ip` text NOT NULL,
  `produto` text NOT NULL,
  `preco` text NOT NULL,
  `categoria` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$mysqli->query("CREATE TABLE `dl_categorias` (
  `nome` text NOT NULL,
  `id` int(4) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$mysqli->query("CREATE TABLE `dl_pedidos` (
  `id` int(4) NOT NULL auto_increment,
  `valor` text NOT NULL,
  `data` text NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(255) NOT NULL default 'Processando',
  `email` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$mysqli->query("CREATE TABLE `dl_produtos` (
  `id` int(4) NOT NULL auto_increment,
  `nome` text NOT NULL,
  `descricao` text NOT NULL,
  `foto` text NOT NULL,
  `categoria` text NOT NULL,
  `preco` text NOT NULL,
  `promocao` int(4) NOT NULL,
  `opcao1` int(4) NOT NULL,
  `opcao2` int(4) NOT NULL,
  `opcao3` int(4) NOT NULL,
  `opcao4` int(4) NOT NULL,
  `opcao5` int(4) NOT NULL,
  `opcao6` int(4) NOT NULL,
  `opcao7` int(4) NOT NULL,
  `opcao8` int(4) NOT NULL,
  `opcao9` int(4) NOT NULL,
  `opcao10` int(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
?>