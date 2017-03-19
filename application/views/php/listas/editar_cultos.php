<?php 
	session_start(); ?>
<?php
    if (isset($_SESSION['logado'])): 
	include("../../cabecalho_usuario.php");
	include ("../conexao.php");

	#die(var_dump($_POST));
	$id_lista_culto = (int)$_POST["id_lista_culto_editar"];
	$servico = (int)$_POST["id_servico_editar"];
	$data = $_POST["id_data_editar"];
	$horario = (int)$_POST["id_horario_editar"];
	$cidade = (int)$_POST["id_cidade_editar"];
	$igreja = (int)$_POST["id_igreja_editar"];
	$anciao = (int)$_POST["id_anciao_editar"];
	$encarregado = (int)$_POST["id_encarregado_editar"];
	$lista = (int)$_POST["id_lista_editar"];
	$regiao = (int)$_POST['id_regiao'];
	#die(var_dump($servico));

  ?>

<section id="view" class="bg-primary">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="row">
					<div class="text-center">
						<h3 class="text-uppercase"><?php echo "Editar" ?></h3>
					</div>
				</div>
				<form method="POST" action="concluirEdicao.php">
					<div class="row">
						<div class="col-md-12">
                		<!--Editar cultos na lista-->
  							<table class="table table-responsive">
								<tr>
									<th>Tipo de Serviço</th>
									<th>Data</th>
									<th>Horario</th>
									<th>Cidade</th>
									<th>Igreja</th>
									<th>Ancião</th>
									<th>Encarregado</th>	
								<!--Campo dos registros-->
									<input type="hidden" name="id_lista_culto_editar" value="<?php echo $id_lista_culto; ?>">
									<tr>
										<!-- Select do tipo de servico -->	
									<?php  
										$query = "SELECT `id_servico`, `nome_servico` FROM `tipo_servico`";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="servico_editar" name="servico_editar" onchange="tipoServicoEditar()" >
									<?php foreach ($resultado as $servicos) { ?>
												<option value="<?php echo $servicos['id_servico'];?>" <?php if ($servicos['id_servico'] == $servico) {
													echo "selected";
												}?> ><?php echo $servicos['nome_servico'];?></option>
									<?php } ?>
											</select>
										</td>
										
										<!--Input da data -->
										<td><input type="date" class="form-control" name="data_editar" id="data_editar" value="<?php echo $data ?>" ></td>
										
										<!--Select Tipo de Servico-->
									<?php  
										$query = "SELECT `id_horario`, `horario` FROM `horario`";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="horario_editar" name="horario_editar" >
									<?php foreach ($resultado as $horarios) { ?>
												<option value="<?php echo $horarios['id_horario'];?>" <?php if ($horarios['id_horario'] == $horario) {
													echo "selected";
												}?> ><?php echo $horarios['horario'];?></option>
									<?php } ?>
											</select>
										</td>

										<!--Select Localidade-->
									<?php  
										$query = "SELECT `id_cidade`, `nome_cidade` FROM cidade WHERE id_regiao = $regiao";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="cidade_editar" name="cidade_editar" >
									<?php foreach ($resultado as $localidades) { ?>
												<option value="<?php echo $localidades['id_cidade'];?>" <?php if ($localidades['id_cidade'] == $cidade) {
													# code...
													echo "selected";
												} ?> ><?php echo $localidades['nome_cidade'];?></option>
									<?php } ?>
											</select>
										</td>

									<!--Select Localidade-->
									<?php  
										$query = "SELECT `id_igreja`, `ds_igreja` FROM `igreja`";#WHERE id_regiao = $regiao
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="igreja_editar" name="igreja_editar" >
									<?php foreach ($resultado as $localidades) { ?>
												<option value="<?php echo $localidades['id_igreja'];?>" <?php if ($localidades['id_igreja'] == $igreja) {
													# code...
													echo "selected";
												} ?> ><?php echo $localidades['ds_igreja'];?></option>
									<?php } ?>
											</select>
										</td>




										<!--Select anciao-->
									<?php  
										$query = "SELECT `id_presbitero`, `nome` FROM `presbitero` WHERE id_funcao = 1"; 
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="anciao_editar" name="presbitero_editar" >
									<?php foreach ($resultado as $anciaes) {  ?>
												<option value="<?php echo $anciaes['id_presbitero'];?>" <?php if ($anciaes['id_presbitero']==$anciao) {
													# code...
													echo "selected";
												}?> ><?php echo $anciaes['nome'];?></option>
									<?php } ?>
											</select>
										</td>	


										<!--Select Encarregado-->
									<?php  
										$query = "SELECT `id_presbitero`, `nome` FROM `presbitero` WHERE id_funcao = 2"; 
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="encarregado_editar" name="encarregado_editar" >
									<?php foreach ($resultado as $encarregados) { ?>
												<option value="<?php echo $encarregados['id_presbitero'];?>" <?php if ($encarregados['id_presbitero'] == $encarregado) {
													# code...
													echo "selected";
												} ?> ><?php echo $encarregados['nome'];?></option>
									<?php } ?>
											</select>
										</td>	
										<input type="hidden" name="lista_editar" value="<?php echo $lista ?>">	
								</tr>
							</table>
  						</div>
  					</div>
			  		<div class="text-center">
			  			<hr class="light">
			  			<button class="btn btn-default text-center" name="submit_cultos_editar" id="submit_editar" >Concluir</button>
					</div>
				</form>
    		</div>
  		</div>
  	</div>
</section>
 <?php include("../../rodape_usuario.php");?>
<?php else: header("location: ../../areadousuario.php");	
    	endif; ?>