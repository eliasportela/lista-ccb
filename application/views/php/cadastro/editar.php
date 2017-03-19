
<?php
	# Conexao com o Banco de dados
	include ("../conexao.php");
	
	
	# Editar regiao
	if (isset($_POST['editar_regiao'])) {
		# code...

		$pais = (int)$_POST["pais"];
		$estado = (int)$_POST["estado"];
		$nome_regiao = $_POST["nome_regiao"];
		$id_regiao = (int)$_POST["id_regiao"];

		#die(var_dump($id_regiao));
		$query = "UPDATE `regiao` SET `nome_regiao` = '$nome_regiao', `id_estado`= $estado,`id_pais`= $pais WHERE id_regiao = $id_regiao";
		
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		header("location: hhttp://127.0.0.1:8080/projetos/ProjetoGloria/versao2/php/cadastro/cadastro_regiao.php");
	}

	# Editar cidade
	if (isset($_POST['editar_cidade'])) {
		# code...
		#die(var_dump($_POST));
		$id_cidade = (int)$_POST['id_cidade'];
		$nome_cidade = $_POST['cidade'];
		$id_regiao = (int) $_POST['regiao'];
		$id_pais = (int) $_POST['pais'];
		$id_estado = (int) $_POST['estado'];
		
		$query = "UPDATE `cidade` SET `nome_cidade`= '$nome_cidade',`id_regiao`= $id_regiao,`id_estado`= $id_estado,`id_pais` = $id_pais WHERE id_cidade = $id_cidade";
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		header("location: http://127.0.0.1:8080/projetos/ProjetoGloria/versao2/php/cadastro/cadastro_cidade.php");
	}

	

 ?>

					
