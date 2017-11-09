
	 <?php include("../../cabecalho_usuario.php");
	 $id_usuario = (int) $resultado['id_usuario'];
	 $nome = $resultado['nome'];
	 $sobrenome = $resultado['sobrenome'];
 	 $comum_cgg = $resultado['ds_igreja'];
	 $celular = $resultado['celular'];
	 $email = $resultado['email'];
	 $funcao = $resultado['ds_tipo_usuario'];
	 $cidade = $resultado['nome_cidade'];
	 $estado = $resultado['sigla_estado'];
	 $user = $resultado['user'];
	 $regiao = $resultado['nome_regiao'];
	 $id_regiao = (int)$resultado['id_regiao'];

?>
<!-- devs-->

<!-- PERFIL -->	
	<section class="bg-primary">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-lg-12">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-3">
							<img src="img/<?php echo $user; ?>.jpg" class="img-responsive img-circle center-block" alt="perfil">
						</div>
						<div class="col-md-3">
							<br><br>
							<h2><strong><?php echo $nome; ?></strong></h2>
							<dl>
								<dt><strong>Funcão</strong></dt>
								<dd><?php echo $funcao; ?></dd>
								<dt>Região</dt>
								<dd><?php echo $regiao; ?><dd>
								<dt>Comum Congregação</dt>
								<dd><?php echo $comum_cgg; ?><dd>
								<dt>Cidade</dt>
								<dd><?php echo $cidade; ?> - <?php echo $estado; ?></dd>
								<dt>Celular</dt>
								<dd><?php echo $celular; ?> </dd>
							</dl>
						</div>
						<div class="col-md-3"></div>

					</div>
				</div>
			</div>
		</div>
	</section>
<!-- PERFIL -->
	<section id="view">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
		    			<div class="col-md-8">
			    			<div class="row">
			    				<i class="fa fa-edit fa-3x"> Cadastro</i>
			    		  		<hr class="light">
							</div>
			    			<div class="row">
			    				<div class="col-lg-12">
									<div class="row">
										<ul class="list-inline text-center intro-social-buttons">
											<li>
												<a href="../cadastro/cadastro_regiao.php" class="btn btn-primary btn-xl sr-button">Região</a>
											</li>
											<li>
												<a href="../cadastro/cadastro_igreja.php" class="btn btn-primary btn-xl sr-button">Igreja</a>
											</li>
											<li> </li>
											<li>
					    						<a href="../cadastro/cadastro_presbitero.php" class="btn btn-primary btn-xl sr-button">Presbítero</a>
					    					</li>
					    					<li> </li>
					    					<li>
					    						<a href="../cadastro/cadastro_cidade.php" class="btn btn-primary btn-xl sr-button">Cidade</a>
					    					</li>
					    				</ul>
					    			</div>
					    		</div>	
			    			</div>
		    				<div class="col-md-2"></div>
		    			</div>
		    		</div>
		    		<br><br><br>		
						<!--Inicio da Tabela-->
						<?php 
							include("minhas_listas.php");
						 ?>
						<!--Fim da Tabela-->						
						</div>	
						<div class="col-md-1"></div>
					</div>
					<hr class="light">		
				</div>
			</div>
		</div>
    </section>
	<!-- devs-->