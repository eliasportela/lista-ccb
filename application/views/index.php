<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lista CCB é um site de busca onde poderá ser econtrado as listas recentes de Batizmo, Reuniões para Mocidade, Santa Ceias, Ensaios Regionais e muito mais da Congregação Cristã no Brasil. Escolha os filtos, clique em pesquisar, e serão listas os resultados da sua pesquisa.">
    <meta name="author" content="Equipe Anonimos da CCB">

    <title>Lista CCB</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://www.listaccb.com/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://www.listaccb.com/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="http://www.listaccb.com/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="http://www.listaccb.com/css/creative.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="http://www.listaccb.com/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://www.listaccb.com/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="http://www.listaccb.com/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="http://www.listaccb.com/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="http://www.listaccb.com/js/creative.min.js"></script>

     <!-- Shortcut -->
    <link rel="shortcut icon" type="image/x-png" href="http://www.listaccb.com/img/short.jpg">

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86505771-1', 'auto');
  ga('send', 'pageview');

</script>

</head>
</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="http://www.listaccb.com/cod-lista-ccb/">LISTA CCB</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="http://www.listaccb.com/#indexpesquisa">Pesquisa</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="http://www.listaccb.com/#contact">Contato</a>
                    </li>
                    <?php if (isset($_SESSION['logado'])) { ?>
                    <li>
                        <a href="http://www.listaccb.com/php/logout.php">Sair</a>
                    </li>
                    <li>
                        <a href="http://www.listaccb.com/areadousuario.php"><i class="fa fa-home fa-1x"></i></a>
                    </li>
                        <?php }
                        else { ?>
                    <li>
                        <a href="http://www.listaccb.com/cod-lista-ccb/login">Login</a>
                    </li>
                         <?php  } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Lista CCB</h1>
                <hr>
                <p>Lista CCB irá te ajudar encontrar serviços de cultos em apenas alguns filtros<br>Insira as informações e clique em pesquisar</p>
                <a href="#indexpesquisa" class="btn btn-primary btn-xl page-scroll">Começar</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="indexpesquisa">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Filtros de Pesquisa</h2>
                    <hr class="light">
                    <form method="GET" action="resultado.php">
                        <table class="table">>
                            <tr>
                            <!-- Tipo de Servico -->
                                <td><h4><strong>Tipo de Serviço</h4></strong></td>
                        <?php  
                            $query = "SELECT `id_servico`, `nome_servico` FROM `tipo_servico`"; # Select de todos os servicos
                            $stmt = $conexao->query($query); #ESTANCIAMENTO
                             $resultado = $stmt->fetchAll();
                        ?>
                                <td>
                                    <select class="form-control" id="servico" name="servico" required> 
                            <?php foreach ($resultado as $servicos) { #envio todos os resultados para um html select?> 
                                        <option value="<?php echo $servicos['id_servico'];?>" ><?php echo $servicos['nome_servico'];?></option>
                                <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- Tipo de Servico FIM -->
                            <!--Selecionar o Estado-->
                            <tr>
                                <td><h4><strong>Estado</strong></h4></td>
                                <td>
                        <?php  
                                $query = "SELECT id_estado, nome_estado FROM estado"; # Seleciona todos os estados cadastrados
                                $stmt = $conexao->query($query); #ESTANCIAMENTO
                                $resultado = $stmt->fetchAll();
                                ?>
                                    <select class="form-control" name="estado" id="estado" onchange="buscar_regiao()">
                                        <option value="0">Selecione...</option>
                                    <?php foreach ($resultado as $estados) { ?>
                                        <option value="<?php echo $estados['id_estado'];?>" ><?php echo $estados['nome_estado'];?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- Select Estado FIM -->
                            <!-- Select Região -->
                            <tr>
                                <td><h4><strong>Região</strong></h4></td>
                                <td>
                                    <div id="load_regiao">
                                        <select class="form-control" id="regiao" name="regiao">
                                            <option value="0">Selecione..</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Select Região FIM -->
                            <!-- Select cidade -->
                            <tr>
                                <td><h4><strong>Cidade</strong></h4></td>
                                <td>
                                    <div id="load_cidade">
                                        <select class="form-control" id="cidade" name="cidade">
                                            <option value="0">Campo em Branco</option>
                                        </select>
                                    </div>
                                </td>
                            <!-- FIM Select cidade -->
                            <!-- Select periodo da pesquisa -->
                            <tr>
                                <td><h4><strong>Período</strong></h4></td>
                                    <td>
                                    <select name="periodo" class="form-control">
                                        <option value="0">Todos</option>
                                        <option value="1">Hoje</option>
                                        <option value="7">1 Semana</option>
                                        <option value="15">15 dias</option>
                                        <option value="30">30 dias</option>
                                        <option value="60">60 dias</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <hr class="light">
                        <button class="page-scroll btn btn-default btn-xl sr-button">Procurar</button>
                     </form>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Área do Voluntário</h2>
                <a href="areadousuario.php" class="btn btn-primary btn-xl sr-button">Entrar</a>
            </div>
        </div>
    </aside>

    <section id="contact" class="bg-primary"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Junte-se a nós :)</h2>
                    <hr class="primary">
                    <p>Seja como vários voluntários espalhados pelo Brasil e mantenha o Lista CCB atualizado com os Serviços de Culto da sua Região.</p>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-facebook fa-3x sr-contact"></i>
                    <a href="https://www.facebook.com/ListaCCB/"><p>www.facebook.com/ListaCCB</p></a>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="#" class="">contato@listaccb.esy.es</a></p>
                </div>
            </div>
        </div>
        <p class="text-center">Este site é administrado por membros da CCB e não tem vínculo com a instituição ou com o ministério.</p>
         <ul class="list-inline quicklinks text-center">
                        <li><a href="#">Política de Privacidade</a>
                        </li>
                        <li><a href="#">Termos de uso</a>
                        </li>
                    </ul>
    </section>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
   <script src="js/creative.min.js"></script>

<script>
    function buscar_regiao(){
      var estado = $('#estado').val();
      if(estado){
        var url = 'php/buscar.php?estado='+estado;
        $.get(url, function(dataReturn) {
          $('#load_regiao').html(dataReturn);
        });
      }
    }
</script>

<!--Scrip de buscar das regioes-->
<script>
    function buscar_cidade(){
      var regiao = $('#regiao').val();
      if(regiao){
        var url = 'php/buscar_cidade.php?regiao='+regiao;
        $.get(url, function(dataReturn) {
          $('#load_cidade').html(dataReturn);
        });
      }
    }

</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86505771-1', 'auto');
  ga('send', 'pageview');

</script>


</body>

</html>
