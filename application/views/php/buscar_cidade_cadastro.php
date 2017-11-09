<?php
	if (isset($_GET['regiao'])){
		include("conexao.php");
		$regiao = (int)$_GET['regiao'];

		$query = "SELECT `id_cidade`, `nome_cidade` FROM `cidade` where id_regiao = $regiao ORDER BY nome_cidade";
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		$resultado = $stmt->fetchAll();

		?>
		<select class="form-control" id="cidade" name="cidade">
		<?php foreach ($resultado as $cidade) { ?>	
			<option value="<?php echo $cidade['id_cidade'];?>"><?php echo $cidade['nome_cidade'];?></option>
		<?php } ?>							
		</select>

<?php } ?>