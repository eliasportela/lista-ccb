<?php

	try {
        
        $conexao = new \PDO("mysql:12:8080;dbname=ccb","root","");
        $conexao->exec("set names utf8");
    }
    catch (\PDOException $e) {
        die("Erro ao conectar ao DB".$e->getCode());
    }
  ?>