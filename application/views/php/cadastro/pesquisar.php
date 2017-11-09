<?php 
$parametro = (int)$_GET['parametro'];  ?>

<?php 	
	#Se o parametro for 1 exibe a pesquisa por cidade
	if ($parametro == 1) {
	 
		$pesquisa = $_GET['pesquisa'];
		$query = "SELECT c.id_cidade as id_cidade, c.nome_cidade as nome_cidade, r.nome_regiao as nome_regiao, e.nome_estado as nome_estado, p.nome_pais as nome_pais, p.id_pais as id_pais, r.id_regiao as id_regiao, e.id_estado as id_estado
			FROM cidade c
			INNER JOIN estado e ON(e.id_estado = c.id_estado)
			INNER JOIN regiao r ON(r.id_regiao = c.id_regiao)
			INNER JOIN pais p ON(p.id_pais = p.id_pais)
			WHERE c.nome_cidade LIKE '%$pesquisa%'";
											
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		$resultado = $stmt->fetchAll(); 
									
	?>
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="row">
					<div class="text-center">
						<h2 class="text-uppercase">Cidade</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
							<table class="table">
								<tr>
									<th>Cidade</th>
									<th>Região</th>
									<th>Estado</th>
									<th>País</th>									
									<th>Opção</th>
								</tr>
								<?php foreach ($resultado as $pesquisas) {  #die(var_dump($pesquisas)) ?>
								<form method="POST" action="editarCadastro.php">
									<tr>
										<td><?php echo $pesquisas['nome_cidade']; ?></td>
										<input type="hidden" name="cidade" value="<?php echo $pesquisas['nome_cidade']; ?>">
										<td><?php echo $pesquisas['nome_regiao']; ?></td>
										<input type="hidden" name="regiao" value="<?php echo $pesquisas['id_regiao']; ?>">
										<td><?php echo $pesquisas['nome_estado']; ?></td>
										<input type="hidden" name="estado" value="<?php echo $pesquisas['id_estado']; ?>">
										<td><?php echo $pesquisas['nome_pais']; ?></td>
										<input type="hidden" name="pais" value="<?php echo $pesquisas['id_pais']; ?>">
										<input type="hidden" name="id_cidade" value="<?php echo $pesquisas['id_cidade']; ?>">
										<td><button class="btn btn-default  sr-button" name="submit_editar_cidade">Editar</button></td>
									</tr>
								</form>
								<?php } ?>
								
							</table>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
<?php  }


	#se o parametro for Regiao
	elseif ($parametro == 2) {
	#Pesquisa da Regiao
	$pesquisa = $_GET['pesquisa'];
	$query = "SELECT r.id_regiao as id_regiao, r.nome_regiao as nome_regiao, e.nome_estado as nome_estado, p.nome_pais as nome_pais, p.id_pais as id_pais, e.id_estado as id_estado
		FROM regiao r
		INNER JOIN estado e ON(e.id_estado = r.id_estado)
		INNER JOIN pais p ON(p.id_pais = e.id_pais)
		WHERE r.nome_regiao LIKE '%$pesquisa%'";

	$stmt = $conexao->query($query); #ESTANCIAMENTO
	$resultado = $stmt->fetchAll(); 
							
?>
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="row">
					<div class="text-center">
						<h2 class="text-uppercase">Região</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
							<table class="table">
								<tr>
									<th>Região</th>
									<th>Estado</th>
									<th>País</th>									
									<th>Opção</th>
								</tr>
								<?php foreach ($resultado as $pesquisas) {  #die(var_dump($pesquisas)) ?>
								<form method="POST" action="editarCadastro.php">
									<tr>
										<td><?php echo $pesquisas['nome_regiao']; ?></td>
										<input type="hidden" name="nome_regiao" value="<?php echo $pesquisas['nome_regiao']; ?>">
										<td><?php echo $pesquisas['nome_estado']; ?></td>
										<input type="hidden" name="estado" value="<?php echo $pesquisas['id_estado']; ?>">
										<td><?php echo $pesquisas['nome_pais']; ?></td>
										<input type="hidden" name="pais" value="<?php echo $pesquisas['id_pais']; ?>">
										<input type="hidden" name="id_regiao" value="<?php echo $pesquisas['id_regiao']; ?>">
										<td><button class="btn btn-default  sr-button" name="submit_editar_regiao">Editar</button></td>
									</tr>
								</form>
								<?php } ?>
								
							</table>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
<?php  } 

#pesquisar por Igreja
#se o parametro for igreja
	elseif ($parametro == 3) {
	#Pesquisa da Regiao
	$pesquisa = $_GET['pesquisa'];
	$query = "SELECT i.ds_igreja, i.id_cidade, c.nome_cidade, r.nome_regiao, r.id_regiao 
		FROM igreja i
		INNER JOIN cidade c ON(c.id_cidade = i.id_cidade)
		INNER JOIN regiao r ON(r.id_regiao = c.id_regiao)
		WHERE c.nome_cidade LIKE '%$pesquisa%'";

	$stmt = $conexao->query($query); #ESTANCIAMENTO
	$resultado = $stmt->fetchAll(); 
							
?>
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="row">
					<div class="text-center">
						<h2 class="text-uppercase">Igrejas</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
							<table class="table">
								<tr>
									<th>Região</th>
									<th>Cidade</th>
									<th>Descrição</th>									
									<th>Opção</th>
								</tr>
								<?php foreach ($resultado as $pesquisas) {  #die(var_dump($pesquisas)) ?>
								<form method="POST" action="editarCadastro.php">
									<tr>
										<td><?php echo $pesquisas['nome_regiao']; ?></td>
										<input type="hidden" name="regiao" value="<?php echo $pesquisas['id_regiao']; ?>">
										<td><?php echo $pesquisas['nome_cidade']; ?></td>
										<input type="hidden" name="cidade" value="<?php echo $pesquisas['id_cidade']; ?>">
										<td><?php echo $pesquisas['ds_igreja']; ?></td>
										<input type="hidden" name="ds_igreja" value="<?php echo $pesquisas['ds_igreja']; ?>">
										<td><button class="btn btn-default  sr-button" name="submit_editar_igreja">Editar</button></td>
									</tr>
								</form>
								<?php } ?>
								
							</table>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
<?php  } 

#pesquisar por Presbitero
#se o parametro for presbitero
	elseif ($parametro == 4) {
	#Pesquisa da Regiao
	$pesquisa = $_GET['pesquisa'];
	$query = "SELECT p.id_presbitero, p.nome, p.id_regiao, p.id_funcao, r.nome_regiao, f.ds_funcao
		FROM presbitero p
		INNER JOIN regiao r ON (r.id_regiao = p.id_regiao)
		INNER JOIN funcao f ON (f.id_funcao = p.id_funcao)
		WHERE p.nome LIKE '%$pesquisa%'";

	$stmt = $conexao->query($query); #ESTANCIAMENTO
	$resultado = $stmt->fetchAll(); 
							
?>
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="row">
					<div class="text-center">
						<h2 class="text-uppercase">Região</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
							<table class="table">
								<tr>
									<th>Nome</th>
									<th>Região</th>
									<th>Função</th>									
									<th>Opção</th>
								</tr>
								<?php foreach ($resultado as $pesquisas) {  #die(var_dump($pesquisas)) ?>
								<form method="POST" action="editarCadastro.php">
									<tr>
										<td><?php echo $pesquisas['nome']; ?></td>
										<input type="hidden" name="nome" value="<?php echo $pesquisas['nome']; ?>">					
										<td><?php echo $pesquisas['nome_regiao']; ?></td>
										<input type="hidden" name="regiao" value="<?php echo $pesquisas['id_regiao']; ?>">
										<td><?php echo $pesquisas['ds_funcao']; ?></td>
										<input type="hidden" name="funcao" value="<?php echo $pesquisas['id_funcao']; ?>">
										<td><button class="btn btn-default  sr-button" name="submit_editar_presbitero">Editar</button></td>
									</tr>
								</form>
								<?php } ?>
								
							</table>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
<?php  } 


?>

