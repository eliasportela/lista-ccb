
<?php session_start(); ?>
<?php
	include("../conexao.php");	
	$_SESSION['usuario'] = 1;
	$sessao_usuario = (int)$_SESSION['usuario'];
	unset($_SESSION['lista']);

	if ($conexao) {
		# code...
		echo "Conectou";
	}
	else{
		echo "Nao Conectou";
	}

    ?>	

	<?php include("perfil.php")  ?>

 <?php include("../../rodape_usuario.php");?>