<?php
	if (isset($_GET['cidade'])){
		include("conexao.php");
		$cidade = (int)$_GET['cidade'];

		$query = "SELECT `id_igreja`, `ds_igreja` FROM `igreja` WHERE id_cidade = $cidade 	ORDER BY ds_igreja";

		$stmt = $conexao->query($query); #ESTANCIAMENTO  id="igreja_inserir"
		$resultado = $stmt->fetchAll();
		?>
		
		<select class="form-control" name="igreja">
		<?php foreach ($resultado as $igrejas) { ?>
			<option value="<?php echo $igrejas['id_igreja'];?>"><?php echo $igrejas['ds_igreja'];?></option>
		<?php } ?>							
		</select>

<?php } ?>
