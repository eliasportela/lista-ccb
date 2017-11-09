							<table class="table table-responsive">
								<tr>
									<th>Editar</th>
									<th>Tipo de Serviço</th>
									<th>Data</th>
									<th>Horario</th>
									<th>Cidade</th>
									<th>Igreja</th>
									<th>Ancião</th>
									<th>Encarregado</th>	
								<!--Campo dos registros-->
							
<?php  
										
										$query = "SELECT `id_lista_culto`, `id_lista`, `data`, `id_servico`, `id_horario`, `id_igreja`, `id_cidade`, `id_presbitero`, `id_encarregado`, `fg_ativo` FROM `lista_cultos` WHERE fg_ativo = 1 AND id_lista = $id_lista ORDER BY id_servico";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									
									foreach ($resultado as $cultos) {
										# code...
									?>
								<form method="POST" action="editar_cultos.php">
									<input type="hidden" name="id_lista_culto_editar" value="<?php echo $cultos['id_lista_culto'] ?>">
									<tr>
										
										<!-- checkbox para editar a lista-->
										<td><input type="checkbox" class="form-control" id="habilitar" name="habilitar"></td>
										
										<!-- Select do tipo de servico -->	
									<?php  
										$query = "SELECT `id_servico`, `nome_servico` FROM `tipo_servico`";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="servico_editar" name="servico_editar" onchange="tipoServicoEditar()" disabled>
									<?php foreach ($resultado as $servicos) { ?>
												<option value="<?php echo $servicos['id_servico'];?>" <?php if ($servicos['id_servico'] == $cultos['id_servico']) {
													echo "selected";
												}?> ><?php echo $servicos['nome_servico'];?></option>
									<?php } ?>
											</select>
										</td>
										
										<!--Input da data -->
										<td><input type="date" class="form-control" name="data_editar" id="data_editar" value="<?php echo $cultos['data']; ?>" disabled></td>
										
										<!--Select Tipo de Servico-->
									<?php  
										$query = "SELECT `id_horario`, `horario` FROM `horario`";
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="horario_editar" name="horario_editar" disabled>
									<?php foreach ($resultado as $horarios) { ?>
												<option value="<?php echo $horarios['id_horario'];?>" <?php if ($horarios['id_horario'] == $cultos['id_horario']) {
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
											<select class="form-control" id="cidade_editar" name="cidade_editar" disabled>
									<?php foreach ($resultado as $localidades) { ?>
												<option value="<?php echo $localidades['id_cidade'];?>" <?php if ($localidades['id_cidade'] == $cultos['id_cidade']) {
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
											<select class="form-control" id="igreja_editar" name="igreja_editar" disabled>
									<?php foreach ($resultado as $localidades) { ?>
												<option value="<?php echo $localidades['id_igreja'];?>" <?php if ($localidades['id_igreja'] == $cultos['id_igreja']) {
													# code...
													echo "selected";
												} ?> ><?php echo $localidades['ds_igreja'];?></option>
									<?php } ?>
											</select>
										</td>




										<!--Select anciao-->
									<?php  
										$query = "SELECT `id_presbitero`, `nome`, `sobrenome` FROM `presbitero` WHERE id_funcao = 1"; 
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="anciao_editar" name="presbitero_editar" disabled>
									<?php foreach ($resultado as $anciaes) {  ?>
												<option value="<?php echo $anciaes['id_presbitero'];?>" <?php if ($anciaes['id_presbitero']==$cultos['id_presbitero']) {
													# code...
													echo "selected";
												}?> ><?php echo $anciaes['nome'] . ' ' . $anciaes['sobrenome'];?></option>
									<?php } ?>
											</select>
										</td>	


										<!--Select Encarregado-->
									<?php  
										$query = "SELECT `id_presbitero`, `nome`, `sobrenome` FROM `presbitero` WHERE id_funcao = 2"; 
								        $stmt = $conexao->query($query); #ESTANCIAMENTO
								        $resultado = $stmt->fetchAll();
									?>
										<td>
											<select class="form-control" id="encarregado_editar" name="encarregado_editar" disabled>
									<?php foreach ($resultado as $encarregados) { ?>
												<option value="<?php echo $encarregados['id_presbitero'];?>" <?php if ($encarregados['id_presbitero'] == $cultos['id_encarregado']) {
													# code...
													echo "selected";
												} ?> ><?php echo $encarregados['nome'] . ' ' . $encarregados['sobrenome'];?></option>
									<?php } ?>
											</select>
										</td>	
										<input type="hidden" name="lista_editar" value="<?php echo $id_lista ?>">
										
										<td><button class="btn btn-default" name="submit_editar" id="submit_editar" disabled>Editar</button></td>	
								</tr>
								</form>
								<?php } ?>
							</table>
							