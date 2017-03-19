<?php
	session_start();
    if (isset($_SESSION['logado'])):

    $cabecalho = "Edição dos Cadastro";
	include ("../conexao.php"); ?>
<?php include ("../../cabecalho_usuario.php"); ?>

<!--Editar cidade -->
<!-- Se tiver clicado no botao editar -->
	<?php 
		if (isset($_POST['submit_editar_cidade'])) { 

		$cidade =	$_POST['cidade'];
		$estado =	(int)$_POST['estado'];
		$regiao =	(int)$_POST['regiao'];
		$pais =		(int)$_POST['pais'];
		$id_cidade =	(int)$_POST['id_cidade'];

			?> 
	<!--Secao cadastro-->
	<section id="editar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Cidade</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center ">
							<form method="POST" action="editar.php">
							
							<!-- Subimit do Cadastro-->
							
							<!--Select Pais-->
							<?php  
								$query = "SELECT id_pais, nome_pais FROM pais";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="pais"><h4>País</h4></label>
								<select class="form-control" id="pais" name="pais">
							<?php foreach ($resultado as $paises) { ?>
									<option value="<?php echo $paises['id_pais'];?>" <?php if($paises['id_pais'] == $pais) echo "selected"?>><?php echo $paises['nome_pais'];?></option>
								<?php } ?>
								</select>
							
								<!--Select Estado-->
							<?php  
								$query = "SELECT id_estado, nome_estado FROM estado";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="estado"><h4>Estado</h4></label>
								<select class="form-control" name="estado" id="estado" onchange="buscar_regiao()">
								<option>Selecione...</option>
								<?php foreach ($resultado as $estados) { ?>
									<option value="<?php echo $estados['id_estado'];?>" <?php if($estados['id_estado'] == $estado) echo "selected"?> ><?php echo $estados['nome_estado'];?></option>
									<?php } ?>
								</select>

								<!--Select Região-->
							<?php
								$query = "SELECT id_regiao, nome_regiao FROM regiao";
								$stmt = $conexao->query($query); #ESTANCIAMENTO
								$resultado = $stmt->fetchAll();
							?>
								<label for="regiao"><h4>Região</h4></label>
								<select class="form-control" id="regiao" name="regiao">
								<?php foreach ($resultado as $regioes) { ?>
									<option value="<?php echo $regioes['id_regiao'];?>" <?php if($regioes['id_regiao'] == $regiao) echo "selected"?> ><?php echo $regioes['nome_regiao'];?></option>
								<?php } ?>							
								</select>

								<!--Nome da cidade-->
								<label for="cidade"><h4>Cidade</h4></label>
								<input type="text" class="form-control" name="cidade" placeholder="Exemplo .. Jacuí" id="cidade" value="<?php echo $cidade;?>"> 
								</br>
								<input type="hidden" name="id_cidade" value="<?php echo $id_cidade;?>" >
								<a href="cadastro_cidade.php" class="btn btn-lg btn-primary">Cancelar</a>
								<button class="btn btn-lg btn-primary" name="editar_cidade">Concluir</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>

<?php } ?>

<!--Editar Região -->
<!-- Se tiver clicado no botao editar -->
	<?php 
		if (isset($_POST['submit_editar_regiao'])) { 

		$estado =	(int)$_POST['estado'];
		$nome_regiao =	$_POST['nome_regiao'];
		$pais =		(int)$_POST['pais'];
		$id_regiao =	(int)$_POST['id_regiao'];

 ?>
	<!--Secao cadastro-->
	<section id="editar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Região</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center ">
						
							<form method="POST" action="editar.php">
							
							<!-- Subimit do Cadastro-->
									
							<!--Select Pais-->
							<?php  
								$query = "SELECT id_pais, nome_pais FROM pais";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="pais"><h4>País</h4></label>
								<select class="form-control" id="pais" name="pais">
							<?php foreach ($resultado as $paises) { ?>
									<option value="<?php echo $paises['id_pais'];?>" <?php if($paises['id_pais'] == $pais) echo "selected"?>><?php echo $paises['nome_pais'];?></option>
								<?php } ?>
								</select>
							
								<!--Select Estado-->
							<?php  
								$query = "SELECT id_estado, nome_estado FROM estado";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="estado"><h4>Estado</h4></label>
								<select class="form-control" name="estado" id="estado" >
								<option>Selecione...</option>
								<?php foreach ($resultado as $estados) { ?>
									<option value="<?php echo $estados['id_estado'];?>" <?php if($estados['id_estado'] == $estado) echo "selected"?> ><?php echo $estados['nome_estado'];?></option>
									<?php } ?>
								</select>

								
								<!--Nome da regiao-->
								<label for="regiao"><h4>Região</h4></label>
								<input type="text" class="form-control" name="nome_regiao" placeholder="Exemplo .. Região de Ribeirão Preto" id="regiao" value="<?php echo $nome_regiao;?>">
								</br>
								<input type="hidden" name="id_regiao" value="<?php echo $id_regiao; ?>">
								<a href="cadastro_cidade.php" class="btn btn-lg btn-primary">Cancelar</a>
								<input type="submit" class="btn btn-lg btn-primary" name="editar_regiao" value="Concluir">
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
<?php } ?>

<!--Editar Igreja -->
<!-- Se tiver clicado no botao editar -->
	<?php 
		if (isset($_POST['submit_editar_igreja'])) { 
		die(var_dump($_POST));	
		$estado =	(int)$_POST['estado'];
		$nome_regiao =	$_POST['nome_regiao'];
		$pais =		(int)$_POST['pais'];
		$id_regiao =	(int)$_POST['id_regiao'];

 ?>
	<!--Secao cadastro-->
	<section id="editar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Região</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center ">
						
							<form method="POST" action="editar.php">
							
							<!-- Subimit do Cadastro-->
									
							<!--Select Pais-->
							<?php  
								$query = "SELECT id_pais, nome_pais FROM pais";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="pais"><h4>País</h4></label>
								<select class="form-control" id="pais" name="pais">
							<?php foreach ($resultado as $paises) { ?>
									<option value="<?php echo $paises['id_pais'];?>" <?php if($paises['id_pais'] == $pais) echo "selected"?>><?php echo $paises['nome_pais'];?></option>
								<?php } ?>
								</select>
							
								<!--Select Estado-->
							<?php  
								$query = "SELECT id_estado, nome_estado FROM estado";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="estado"><h4>Estado</h4></label>
								<select class="form-control" name="estado" id="estado" >
								<option>Selecione...</option>
								<?php foreach ($resultado as $estados) { ?>
									<option value="<?php echo $estados['id_estado'];?>" <?php if($estados['id_estado'] == $estado) echo "selected"?> ><?php echo $estados['nome_estado'];?></option>
									<?php } ?>
								</select>

								
								<!--Nome da regiao-->
								<label for="regiao"><h4>Região</h4></label>
								<input type="text" class="form-control" name="nome_regiao" placeholder="Exemplo .. Região de Ribeirão Preto" id="regiao" value="<?php echo $nome_regiao;?>">
								</br>
								<input type="hidden" name="id_regiao" value="<?php echo $id_regiao; ?>">
								<a href="cadastro_cidade.php" class="btn btn-lg btn-primary">Cancelar</a>
								<input type="submit" class="btn btn-lg btn-primary" name="editar_regiao" value="Concluir">
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
<?php } ?>

<!--Editar Região -->
<!-- Se tiver clicado no botao editar -->
	<?php 
		if (isset($_POST['submit_editar_regiao'])) { 

		$estado =	(int)$_POST['estado'];
		$nome_regiao =	$_POST['nome_regiao'];
		$pais =		(int)$_POST['pais'];
		$id_regiao =	(int)$_POST['id_regiao'];

 ?>
	<!--Secao cadastro-->
	<section id="editar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Região</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center ">
						
							<form method="POST" action="editar.php">
							
							<!-- Subimit do Cadastro-->
									
							<!--Select Pais-->
							<?php  
								$query = "SELECT id_pais, nome_pais FROM pais";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="pais"><h4>País</h4></label>
								<select class="form-control" id="pais" name="pais">
							<?php foreach ($resultado as $paises) { ?>
									<option value="<?php echo $paises['id_pais'];?>" <?php if($paises['id_pais'] == $pais) echo "selected"?>><?php echo $paises['nome_pais'];?></option>
								<?php } ?>
								</select>
							
								<!--Select Estado-->
							<?php  
								$query = "SELECT id_estado, nome_estado FROM estado";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="estado"><h4>Estado</h4></label>
								<select class="form-control" name="estado" id="estado" >
								<option>Selecione...</option>
								<?php foreach ($resultado as $estados) { ?>
									<option value="<?php echo $estados['id_estado'];?>" <?php if($estados['id_estado'] == $estado) echo "selected"?> ><?php echo $estados['nome_estado'];?></option>
									<?php } ?>
								</select>

								
								<!--Nome da regiao-->
								<label for="regiao"><h4>Região</h4></label>
								<input type="text" class="form-control" name="nome_regiao" placeholder="Exemplo .. Região de Ribeirão Preto" id="regiao" value="<?php echo $nome_regiao;?>">
								</br>
								<input type="hidden" name="id_regiao" value="<?php echo $id_regiao; ?>">
								<a href="cadastro_cidade.php" class="btn btn-lg btn-primary">Cancelar</a>
								<input type="submit" class="btn btn-lg btn-primary" name="editar_regiao" value="Concluir">
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
<?php } 

	include("../../rodape_usuario.php");  ?>
<?php
    else: header("location: ../../areadousuario.php");	
    	endif; ?>
?>

