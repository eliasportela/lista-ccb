							<div class="text-right">
								<a href="../listas/nova_lista.php" class="btn btn-default xl">Nova Lista</a>
							</div>
							<table class="table">
								<tr>
									<th>Data da Lista</th>
									<th>Região</th>
									<th>Estado</th>									
									<th>Opção</th>
								</tr>
								<?php
									$query = "SELECT l.id_lista , l.data_lista, r.nome_regiao, e.nome_estado
										FROM lista l 
										INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
										INNER JOIN estado e ON (e.id_estado = r.id_estado)
										WHERE l.id_usuario = $id_usuario AND l.fg_ativo = 1";

        							$stmt = $conexao->query($query); #ESTANCIAMENTO
        							$resultado = $stmt->fetchAll();
								  ?>
								<?php foreach ($resultado as $listas) {  #die(var_dump($lista)) ?>
								<form method="POST" action="../listas/lista.php">
									<tr>
										<td><?php echo $listas['data_lista']; ?></td>
										<input type="hidden" name="data" value="<?php echo $listas['data_lista']; ?>">
										<input type="hidden" name="id_lista" value="<?php echo $listas['id_lista']; ?>">
										<td><?php echo $listas['nome_regiao']; ?></td>
										<td><?php echo $listas['nome_estado']; ?></td>
										<td><button class="btn btn-default  sr-button" name="submit_lista_editar"><i class="fa fa-plus fa-1x"> Abrir</i></button></td>
									</tr>
								</form>
								<?php } ?>
							</table>