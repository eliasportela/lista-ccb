<?php
	session_start();
    if (isset($_SESSION['logado'])):
	
	$cabecalho = "Cadastro de Presbítero";
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
							<h2 class="text-uppercase">Cadastro de Anciães ou Encarregados</h2>
							<a href="procurar.php#pesquisa" class="btn btn-lg btn-primary">Ver Presbíteros</a>
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
									#die(var_dump($_POST));
									$id_regiao = (int) $_POST['regiao'];
									$nome = $_POST['nome'];
									$id_funcao = (int) $_POST['funcao'];

									$query = "INSERT INTO `presbitero`(`nome`, `id_regiao`, `id_funcao`) VALUES ('$nome',$id_regiao,$id_funcao)";
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
								<!--Endereço-->
				                <label for="funcao"><h4>Função</h4></label>
				                <select class="form-control" name="funcao">
				                	<option value="1">Ancião</option>
				                	<option value="2">Encarregado Regional</option>
				                </select>
								<label for="nome"><h4>Nome</h4></label>
									<input type="text" class="form-control" name="nome" placeholder="Exemplo .. José" id="nome">	
								</br>
								<a href="../usuarios/profile.php#view" class="btn btn-lg btn-primary">Cancelar</a>
								<button class="btn btn-lg btn-primary" name="subimit_cadastro">Inserir</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
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

<?php include("../../rodape_usuario.php");  ?>
<?php
    else: header("location: ../../areadousuario.php");	
    	endif; ?>