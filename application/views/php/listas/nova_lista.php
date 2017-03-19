<?php session_start(); ?>
<?php

    if (isset($_SESSION['logado'])): 
    	$id_usuario = (int)$_SESSION['usuario'];
    	?>

	 <?php include("../../cabecalho_usuario.php");
	 include("../conexao.php");	
	 ?>
	<!-- devs-->
	  <script>
  	function buscar_regiao(){
      var estado = $('#estado').val();
      if(estado){
        var url = '../buscar.php?estado='+estado;
        $.get(url, function(dataReturn) {
          $('#load_regiao').html(dataReturn);
        });
      }
    }
  </script>



	<!--Secao cadastro-->
	<section id="cadastro" class="bg-primary">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Nova Lista</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center ">

						<?php 
								#Busca no banco de  dados se o usuario podera editar a lista
									$query = "SELECT id_tipo_usuario
										FROM usuario
										WHERE id_usuario = $id_usuario";

									$stmt = $conexao->query($query); #ESTANCIAMENTO
									$resultado = $stmt->fetch();
									
									if ($resultado['id_tipo_usuario']==1) { #se for administrador ?> 

	

							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							
							<!-- Subimit do Cadastro-->
							<?php
								if (isset($_POST['subimit_cadastro'])) {
									# code...
									#die(var_dump($_POST));

									$nome_data = $_POST['data'];
									$id_regiao = (int) $_POST['regiao'];
									$id_usuario = (int) $_SESSION['usuario'];
									$id_estado = (int) $_POST['estado'];

									$query = "INSERT INTO `lista`(`data_lista`, `id_regiao`, `id_usuario`) VALUES ('$nome_data',$id_regiao,$id_usuario)";
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

								<!--Select Regiao-->
								<label for="regiao"><h4>Região</h4></label>
								<div id="load_regiao">
									<select class="form-control" id="regiao" name="regiao">
										<option>Selecione o Estado</option>
									</select>
								</div>
								
								<!-- Data da Lista-->
								
								<label for="data"><h4>Data da Lista</h4></label>
								<input type="date" class="form-control" name="data" id="data"> 
								</br>
								<a href="../usuarios/profile.php#view" class="btn btn-lg btn-default">Cancelar</a>
								<button class="btn btn-lg btn-default" name="subimit_cadastro">Inserir</button>
							</form>
							<?php } #fim da condicao de adm 

							else {

								$query = "SELECT u.id_tipo_usuario, r.nome_regiao, r.id_regiao, e.id_estado, e.nome_estado
										FROM usuario u
										INNER JOIN igreja i ON (i.id_igreja = u.id_igreja)
										INNER JOIN cidade c ON (c.id_cidade = i.id_cidade)
										INNER JOIN regiao r ON (r.id_regiao = c.id_regiao)
										INNER JOIN estado e ON (e.id_estado = r.id_estado)
										WHERE u.id_usuario = $id_usuario";
									$stmt = $conexao->query($query); #ESTANCIAMENTO
									$resultado = $stmt->fetch();
									$id_regiao = (int)$resultado['id_regiao'];
									$nome_regiao = $resultado['nome_regiao'];
									$id_estado = (int)$resultado['id_estado'];
									$nome_estado = $resultado['nome_estado'];
									
									?>
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							
							<!-- Subimit do Cadastro-->
							<?php
								if (isset($_POST['subimit_cadastro'])) {
									# code...
									#die(var_dump($_POST));

									$nome_data = $_POST['data'];
									$id_regiao = (int) $_POST['regiao'];
									$id_usuario = (int) $_SESSION['usuario'];
									$id_estado = (int) $_POST['estado'];

									$query = "INSERT INTO `lista`(`data_lista`, `id_regiao`, `id_usuario`) VALUES ('$nome_data',$id_regiao,$id_usuario)";
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
								<label for="estado"><h4>Estado</h4></label>
								<select class="form-control" name="estado">
									<option value="<?php echo $id_estados;?>" ><?php echo $nome_estado ?></option>
								</select>

								<!--Select Regiao-->
								<label for="regiao"><h4>Região</h4></label>
								<select class="form-control" id="regiao" name="regiao">
									<option value="<?php echo $id_regiao;?>"><?php echo $nome_regiao; ?></option>
								</select>
								
								<!-- Data da Lista-->
								
								<label for="data"><h4>Data da Lista</h4></label>
								<input type="date" class="form-control" name="data" id="data"> 
								</br>
								<a href="../usuarios/profile.php#view" class="btn btn-lg btn-default">Cancelar</a>
								<button class="btn btn-lg btn-default" name="subimit_cadastro"></button>
							</form>		
							
							<?php } ?> 

						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
	<!-- devs-->
 <?php include("../../rodape_usuario.php");?>
<?php else: header("location: ../../areadousuario.php");	
    	endif; ?>