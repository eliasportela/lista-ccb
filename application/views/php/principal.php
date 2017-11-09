
<?php session_start(); ?>
<?php

    if (isset($_SESSION['logado'])):?>
	 <?php include("../cabecalho_usuario.php");?>	
	<!-- devs-->
	<section class="bg-primary">
	    <div class="container-fluid">
	    	<div class="row">
	    		<div class="col-lg-12">
	    			
	    			<br>
	    			<div class="row">
	    				<div class="col-md-2"></div>
	    				<div class="col-md-8">
		    				<div class="row">
		    					<div class="col-lg-12">
		    						<div class="row">
		    							<div class="col-md-6">
		    							<div class="text-center">
		    								<i class="fa fa-edit fa-3x"> Cadastro</i>
		    					  			<hr class="light">
		    							</div>
		    								<table class="table">
												<tr>
													<td><a href="cadastro/cadastro_cidade.php#cadastro" class="btn btn-default btn-xl sr-button">Cidade</a></td>
													<td><a href="cadastro/cadastro_regiao.php#cadastro" class="btn btn-default btn-xl sr-button">Região</a></td>
												</tr>
												<tr>	
													<td><a href="" class="btn btn-default btn-xl sr-button">Igreja</a></td>
													<td><a href="" class="btn btn-default btn-xl sr-button">Presbítero</a></td>
												</tr>								
					    					</table>
		    							</div>
		    							<div class="col-md-6">
		    								<div class="text-center">
		    									<i class="fa fa-list-alt fa-3x"> Lista de Culto</i>
		    									<hr class="light">
		    								</div>
		    								<table class="table">
		    									<tr>
													<td><a href="listas/nova_lista.php" class="btn btn-default btn-xl sr-button">Nova Lista de Cultos</a></td>
													<td><a href="" class="btn btn-default btn-xl sr-button">Adcionar Culto na Lista</a></td>
												</tr>			
		    								</table>
		    							</div>
		    						</div>
		    					</div>
		    				</div>
	    				</div>
	    				<div class="col-md-2"></div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </section>
	<!-- devs-->

 <?php include("../rodape_usuario.php");?>
<?php
    else: header("location: ../areadousuario.php");	
    	endif; ?>