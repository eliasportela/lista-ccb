<?php session_start(); ?>
<?php #die(var_dump($_POST));
	if (isset($_POST['submit_lista_editar'])) {
    $_SESSION['lista'] = (int)$_POST['id_lista'];  
  }

	if (isset($_SESSION['logado']) and isset($_SESSION['lista'])):
	
 ?>

<?php
	$cabecalho = "Cadastro de Cidade";
	include("../../cabecalho_usuario.php");
	include("../conexao.php");
  ?>

<?php 

$id_lista = (int)$_SESSION['lista'];

$query = "SELECT l.data_lista, l.id_regiao, r.nome_regiao FROM lista l INNER JOIN regiao r ON(r.id_regiao = l.id_regiao) WHERE id_lista = $id_lista";
$stmt = $conexao->query($query);
$lista = $stmt->fetch();

$regiao = (int)$lista['id_regiao'];
$data = $lista['data_lista'];
$nome_regiao = $lista['nome_regiao'];
 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/lista.js"></script>
</head>
<body>
<section id="view" class="bg-primary">
	<div class="container">

		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="row">
					<div class="text-center">
						<h3 class="text-uppercase"><?php echo "Lista de Batismo e diversos. " . $nome_regiao . " " . $data; ?></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
                <!--Inserir cultos na lista-->
                <?php include("inserir_lista.php") ?>
								<!--Cultos ja  cadastrados-->
								<?php include("cultos.php"); ?>
  				</div>
  			</div>
  		</div>
    </div>
  </div>
</section>
  
  <script>
  	function buscar_igreja(){
      var cidade = $('#cidade').val();
      if(cidade){
        var url = '../buscar_igreja.php?cidade='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_igreja').html(dataReturn);
        });
      }
    }
  </script>

</body>
</html>

<?php include("../../rodape_usuario.php");?>
<?php
    else: echo "Erro na requisição da pagina, credenciais invalidas, redirecionando.. ";
    	echo "<meta HTTP-EQUIV='refresh' CONTENT='4;URL=../../areadousuario.php'>";
    	endif; ?>