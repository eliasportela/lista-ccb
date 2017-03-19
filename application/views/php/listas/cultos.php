						
							<div class="text-center"><h3>Lista</h3></div>
							
							<table class="table table-responsive">
								<tr>
									<th>Serviço</th>
									<th>Cidade</th>
									<th>Igreja</th>
									<th>Ancião</th>
									<th>Encarregado</th>
									<th>Data</th>
									<th>Horario</th>
									<th>Editar</th>
								</tr>	
								<!--Campo dos registros-->
							
								<?php  
										
									$query = "SELECT l.id_lista_culto, l.id_lista, l.id_servico, l.data, s.nome_servico, h.horario, l.id_horario, i.id_igreja, i.ds_igreja, c.nome_cidade, c.id_cidade, r.nome_regiao, lt.id_regiao, p.nome as anciao, l.id_presbitero as id_anciao, ec.nome as encarregado, l.id_encarregado as id_encarregado
										FROM lista_cultos l 
										INNER JOIN lista lt ON (lt.id_lista = l.id_lista)
										INNER JOIN tipo_servico s ON (s.id_servico = l.id_servico)
										INNER JOIN horario h ON  (h.id_horario = l.id_horario)
										INNER JOIN igreja i ON (i.id_igreja = l.id_igreja)
										INNER JOIN cidade c ON (c.id_cidade = l.id_cidade)
										INNER JOIN presbitero p ON(p.id_presbitero = l.id_presbitero)
										INNER JOIN presbitero ec ON (ec.id_presbitero = l.id_encarregado)
										INNER JOIN regiao r ON (r.id_regiao = lt.id_regiao)
										WHERE l.id_lista = $id_lista AND l.fg_ativo = 1 ORDER BY l.id_servico";

								    $stmt = $conexao->query($query); #ESTANCIAMENTO
								    $resultado = $stmt->fetchAll();
									
									foreach ($resultado as $cultos) {
										# code...
									?>
								<form method="POST" action="editar_cultos.php">
								<tr>
									<!--id da lista-->
									<input type="hidden" name="id_lista_editar" value="<?php echo $cultos['id_lista'] ?>">
									<!--id do culto-->
									<input type="hidden" name="id_lista_culto_editar" value="<?php echo $cultos['id_lista_culto'] ?>">
									<input type="hidden" name="id_regiao" value="<?php echo $cultos['id_regiao'] ?>">
									<!--id do servico-->
									<input type="hidden" name="id_servico_editar" value="<?php echo $cultos['id_servico']; ?>">
									<td><?php echo $cultos['nome_servico']; ?></td>
									<!--id da cidade-->
									<input type="hidden" name="id_cidade_editar" value="<?php echo $cultos['id_cidade'] ?>">
									<td><?php echo $cultos['nome_cidade']; ?></td>
									<!--id da igreja-->
									<input type="hidden" name="id_igreja_editar" value="<?php echo $cultos['id_igreja'] ?>">
									<td><?php echo $cultos['ds_igreja']; ?></td>
									<!--id do anciao-->
									<input type="hidden" name="id_anciao_editar" value="<?php echo $cultos['id_anciao'] ?>">
									<td><?php echo $cultos['anciao'];?></td>
									<!--id do encarregado-->
									<input type="hidden" name="id_encarregado_editar" value="<?php echo $cultos['id_encarregado'] ?>">
									<td><?php echo $cultos['encarregado']; ?></td>
									<!-- data -->
									<input type="hidden" name="id_data_editar" value="<?php echo $cultos['data'] ?>">
									<td><?php echo $cultos['data']; ?></td>
									<!--id do horario-->
									<input type="hidden" name="id_horario_editar" value="<?php echo $cultos['id_horario'] ?>">
									<td><?php echo $cultos['horario']; ?></td>
									<!--Botao para editar-->
									<td><button class="btn btn-default" name="editar_cultos"><i class="fa fa-edit fa-1x"></i></button></td>
								</tr>
								</form>
								<?php } ?>
							</table>
							