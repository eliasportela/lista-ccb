<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lista de Batizmo e cultos da Congregação Cristã no Brasil">
    <meta name="author" content="Equipe Anonimos da CCB">

    <title>Lista CCB</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>


    <!-- Plugin CSS -->
    <link href="<?=base_url('assets/vendor/magnific-popup/magnific-popup.css')?>" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?=base_url('assets/css/creative2.css')?>" rel="stylesheet">
    <!-- jQuery -->
    <link rel = "stylesheet" href="<?=base_url('assets/vendor/bootstrap/css/bootstrap-select.min.css')?>">
    
     <!-- Shortcut -->
    <link rel="shortcut icon" type="image/x-png" href="<?=base_url('assets/img/short.jpg')?>">

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="http://www.listaccb.com">LISTA CCB</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="<?=base_url('assets/#indexpesquisa')?>">Pesquisa</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?=base_url('assets/#contact')?>">Contato</a>
                    </li>
                    <?php if ($this->session->userdata('logged')) { ?>
                    <li>
                        <a href="<?=base_url('logout')?>">Sair</a>
                    </li>
                    <li>
                        <a href="<?=base_url('profile')?>"><i class="fa fa-home fa-1x"></i></a>
                    </li>
                        <?php }
                        else { ?>
                    <li>
                        <a href="<?=base_url('login')?>">Login</a>
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
                <hr class="light">
                <p>Lista CCB irá te ajudar encontrar serviços de cultos em apenas alguns filtros<br>Insira as informações e clique em pesquisar</p>
                <a href="#indexpesquisa" class="btn bg-white btn-xl page-scroll">Começar</a>
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
                        <table class="table">
                            <tr>
                                <!-- Tipo de Servico -->
                                <td><h4><strong>Tipo de Serviço</h4></strong></td>
                                <td>
                                    <select class="form-control" id="servico" name="servico" required>
                                        <option value="0">Todos</option>
                                   <?php foreach ($servicos as $servico): ?> 
                                        <option value="<?=$servico->id_servico?>"><?=$servico->nome_servico;?></option>
                                    <?php endforeach ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- Select Região -->
                            <tr>
                                <td><h4><strong>Região</strong></h4></td>
                                <td>
                                    <select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao" nome="anciao" data-style="bg-white">
                            
                                    <?php foreach ($regioes as $regiao): ?> 
                                        <option value="<?=$regiao->id_regiao?>"><?=$regiao->nome_regiao;?></option>
                                    <?php endforeach ?>
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

    <aside class="bg-white">
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
    <script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?=base_url('assets/vendor/scrollreveal/scrollreveal.min.js')?>"></script>
    <script src="<?=base_url('assets/vendor/magnific-popup/jquery.magnific-popup.min.js')?>"></script>

    <!-- Theme JavaScript -->
   <script src="<?=base_url('assets/js/creative.min.js')?>"></script>
<script src = "<?=base_url('assets/vendor/bootstrap/js/bootstrap-select.min.js')?>"> </script>


</body>

</html>
