<?php
	$cabecalho = "Cadastro de Cidade";
	include("../../cabecalho_usuario.php");
	include("../conexao.php");
  ?>


	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Cadastro de Região</h2>
							<a href="procurar.php#pesquisa" class="btn btn-lg btn-primary">Ver Regiões</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center ">
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							
							<!-- Subimit do Cadastro-->
							<?php
								if (isset($_POST['subimit_cadastro'])) {
									# code...
									$nome_regiao = $_POST['regiao'];
									$id_pais = (int) $_POST['pais'];
									$id_estado = (int) $_POST['estado'];

									$query = "INSERT INTO `regiao`(`nome_regiao`, `id_estado`, `id_pais`) VALUES ('$nome_regiao',$id_estado,$id_pais)";
									$stmt = $conexao->query($query); #ESTANCIAMENTO
									if ($stmt) {
										?>
										<script type="text/javascript">alert("Inserido com sucesso");</script>
										<?php
									}
								}
							  ?>
							<!--Select Pais-->
							
							<?php  
								$query = "SELECT id_pais, nome_pais FROM pais";
						        $stmt = $conexao->query($query); #ESTANCIAMENTO
						        $resultado = $stmt->fetchAll();
							?>
								<label for="pais"><h4>País</h4></label>
								<select class="form-control" id="pais" name="pais">
							<?php foreach ($resultado as $paises) { ?>
									<option value="<?php echo $paises['id_pais'];?>"><?php echo $paises['nome_pais'];?></option>
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
									<option value="<?php echo $estados['id_estado'];?>" ><?php echo $estados['nome_estado'];?></option>
									<?php } ?>
								</select>

								<!--Nome da Região-->
								
								<label for="cidade"><h4>Região</h4></label>
								<input type="text" class="form-control" name="regiao" placeholder="Exemplo .. Região de Ribeirão Preto" id="regiao"> 
								</br>
								<a href="../usuarios/profile.php" class="btn btn-lg btn-primary">Cancelar</a>
								<button class="btn btn-lg btn-primary" name="subimit_cadastro">Inserir</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
<?php include("../../rodape_usuario.php");  ?>