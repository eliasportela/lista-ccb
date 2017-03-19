<?php  
	include ("../conexao.php");
	$id_lista_culto = (int)$_POST["id_lista_culto_editar"];
	$servico = (int)$_POST["servico_editar"];
	$data = $_POST["data_editar"];
	$horario = (int)$_POST["horario_editar"];
	$cidade = (int)$_POST["cidade_editar"];
	$igreja = (int)$_POST["igreja_editar"];
	$anciao = (int)$_POST["presbitero_editar"];
	$encarregado = (int)$_POST["encarregado_editar"];
	$lista = (int)$_POST["lista_editar"];

	
	$query = "UPDATE `lista_cultos` SET `id_lista`=$lista,`data`= '$data',`id_servico`=$servico,`id_horario`=$horario,`id_igreja`=$igreja,`id_cidade`=$cidade,`id_presbitero`=$anciao,id_encarregado = $encarregado WHERE id_lista_culto = $id_lista_culto";

	 $stmt = $conexao->query($query);
	 if ($stmt) {
	 	# code...
	 	header("location: lista.php");
	 }
	 else{
	 	echo "Ops, houve algum erro na Inserção";
	 }

?>