<?php session_start(); ?>
<?php

    if (isset($_SESSION['logado'])):?>
	 <?php include("../../cabecalho_usuario.php");?>	
	<!-- devs-->
	<section class="bg-primary">
	    <div class="container">
	    	<div class="row">
	    	</div>
	    </div>
    </section>
	<!-- devs-->

 <?php include("../../rodape_usuario.php");?>
<?php
    else: header("location: ../areadousuario.php");	
    	endif; ?>