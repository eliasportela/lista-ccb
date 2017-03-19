<?php
	session_start();
    if (isset($_SESSION['logado'])):

	$cabecalho = "Buscar Cadastro";
	include("../../cabecalho_usuario.php");
	include("../conexao.php");
  ?>

<section class="bg-primary" id="view">
	<div class="container">

	<?php
		if (isset($_GET['submit_pesquisa'])) {
			#Insere as tabelas de pesquisa
			include("pesquisar.php");			
		 } ?>
	
	</div>
</section>

<!-- secao visualizacao-->
<section id="pesquisa" class="bg-default">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 text-center">
						<h2>Escolha a sua pesquisa</h2>
						<hr class="light">
						<select class="form-control" name="parametro">
							<option value="1">Cidade</option>
							<option value="2">Região</option>
							<option value="3">Igreja</option>
							<option value="4">Presbítero</option>
						</select>
					</div>
					<div class="col-md-2"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 text-center">
						<h2>Pesquisar</h2>
						<hr class="light">
						<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="search" name="pesquisa" class="form-control" placeholder="Digite aqui sua pesquisa...">
							<br>
							<button class="btn btn-primary btn-xl sr-button" name="submit_pesquisa">Pesquisar</button>
						</form>
					</div>
					<div class="col-md-2"></div>
				</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php	include("../../rodape_usuario.php");  ?>
<?php
    else: header("location: ../../areadousuario.php");	
    	endif; ?>
?>


