<?php
	if (isset($_GET['cidade'])){
		include("conexao.php");
		$cidade = (int)$_GET['cidade'];

		$query = "SELECT `id_igreja`, `ds_igreja` FROM `igreja` WHERE id_cidade = 8";#WHERE id_regiao = $regiao
		$stmt = $conexao->query($query); #ESTANCIAMENTO
		$resultado = $stmt->fetchAll();
		?>
		
		<select class="form-control" id="igreja_inserir" name="igreja">
			<option value="0">Selecione..</option>
		<?php foreach ($resultado as $igrejas) { ?>
			<option value="<?php echo $igrejas['id_igreja'];?>"><?php echo $regioes['ds_igreja'];?></option>
		<?php } ?>							
		</select>

<?php } ?>
