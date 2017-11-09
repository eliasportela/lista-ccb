<?php
	if (isset($_GET['estado'])){
		include("conexao.php");
		$estado = $_GET['estado'];

		$query = "SELECT id_regiao, nome_regiao FROM regiao where id_estado = $estado ORDER BY nome_regiao";
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		$resultado = $stmt->fetchAll();

		?>
		<select class="form-control" id="regiao" name="regiao">
		<?php foreach ($resultado as $regioes) { ?>
			<option value="<?php echo $regioes['id_regiao'];?>"><?php echo $regioes['nome_regiao'];?></option>
		<?php } ?>							
		</select>

<?php } ?>