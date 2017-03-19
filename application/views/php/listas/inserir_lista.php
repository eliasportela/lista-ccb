<?php
	if (isset($_POST["submit_inserir"])) {
	  	# code...
	  	$servico 	= 	(int)$_POST["servico"];
		$data 		=		$_POST["data"];
		$horario 	= 	(int)$_POST["horario"];
		$cidade 	= 	(int)$_POST["cidade"];
		$igreja 	= 	(int)$_POST["igreja"];
		$presbitero = 	(int)$_POST["presbitero"];
		$lista 		= 	(int)$_POST["lista"];
		if (isset($_POST['encarregado'])) {
			$encarregado = 	(int)$_POST["encarregado"]; #se estiver sendo cadastrado um ensaio regional
		}
		else {
			$encarregado = 	1;	# se for outro servico, 1 = Nao Informado.
		}

		$query = "INSERT INTO `lista_cultos`(`id_lista`, `data`, `id_servico`, `id_horario`, `id_igreja`, `id_cidade`, `id_presbitero`, `id_encarregado`) VALUES ($lista,'$data',$servico,$horario,$igreja,$cidade,$presbitero,$encarregado)";
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		if ($stmt) {
			# code...
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=lista.php'>";
		}
		else {
			# code...
			echo "Erro ao inseir no Banco de dados, Entrar em contato com um administrador";
		}

	}
?>

						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="text-center"><h3>Inserir na Lista</h3></div>
							<table class="table table-responsive">
								<tr>
									<th>Tipo de Serviço</th>
									<th>Data</th>
									<th>Horario</th>
									<th>Cidade</th>
									<th>Igreja</th>
									<th>Ancião</th>
									<th>Encarregado</th>									
									<th>Opção</th>
								<tr>
										<!--Select Tipo de Servico-->
									<?php
										$dia = date("Y-m-d");
										$query = "SELECT `id_servico`, `nome_servico` FROM `tipo_servico`";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="servico" name="servico" onchange="tipoServicoInserir()">
									<?php foreach ($resultado as $servicos) { ?>
												<option value="<?php echo $servicos['id_servico'];?>" ><?php echo $servicos['nome_servico'];?></option>
									<?php } ?>
											</select>
										</td>
										
										<!--Input da data -->
										<td><input type="date" class="form-control" name="data" value="<?php echo $dia;?>"></td>
										
										<!--Select Tipo de Servico-->
									<?php  
										$query = "SELECT `id_horario`, `horario` FROM `horario`";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="horario" name="horario">
O									<?php foreach ($resultado as $horarios) { ?>
												<option value="<?php echo $horarios['id_horario'];?>" ><?php echo $horarios['horario'];?></option>
									<?php } ?>
											</select>
										</td>

										<!--Select Localidade-->
									<?php  
										$query = "SELECT `id_cidade`, `nome_cidade` FROM cidade WHERE id_regiao = $regiao";#WHERE id_regiao = $regiao
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="cidade" name="cidade" onchange="buscar_igreja()">
											<option>Selecione..</option>
									<?php foreach ($resultado as $localidades) { ?>
												<option value="<?php echo $localidades['id_cidade'];?>" ><?php echo $localidades['nome_cidade'];?></option>
									<?php } ?>
											</select>
										</td>
										<!--Select igreja-->
										<td>
											<div id="load_igreja">
												<select class="form-control" id="igreja" name="igreja">
													<option value="0">Selecione a Cidade</option>
												</select>
											</div>
										</td>

										<!--Select anciao-->
									<?php  
										$query = "SELECT `id_presbitero`, `nome` FROM `presbitero` WHERE id_funcao = 1 ORDER BY id_presbitero"; 
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="presbitero" name="presbitero">
									<?php foreach ($resultado as $anciaes) { ?>
												<option value="<?php echo $anciaes['id_presbitero'];?>" ><?php echo $anciaes['nome'];?></option>
									<?php } ?>
											</select>
										</td>	


										<!--Select Encarregado-->
									<?php  
										$query = "SELECT `id_presbitero`, `nome` FROM `presbitero` WHERE id_funcao = 2 ORDER BY id_presbitero"; 
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="encarregado" name="encarregado" disabled>
									<?php foreach ($resultado as $encarregados) { ?>
												<option value="<?php echo $encarregados['id_presbitero'];?>" ><?php echo $encarregados['nome'];?></option>
									<?php } ?>
											</select>
										</td>	
										<input type="hidden" name="lista" value="<?php echo $id_lista ?>">
										<td><button class="btn btn-default" name="submit_inserir">Inserir</button></td>	
									</tr>
								</table>
							</form>