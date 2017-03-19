<?php

	try {
        
        $conexao = new \PDO("mysql:host=mysql.hostinger.com.br;dbname=u814523892_ccb","u814523892_admin","yg2sb1t7hvd9w");
        $conexao->exec("set names utf8");
    }
    catch (\PDOException $e) {
        die("Erro ao conectar ao DB".$e->getCode());
    }
  ?>