<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lista de Batizmo e cultos da Congregação Cristã no Brasil">
    <meta name="author" content="Equipe Anonimos da CCB">

    <title><?=$title?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url('assets/vendor/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>


    <!-- Plugin CSS -->
    <link href="<?=base_url('assets/vendor/magnific-popup/magnific-popup.css')?>" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?=base_url('assets/css/creative2.css')?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=base_url('assets/vendor/jquery/jquery.easing.min.js')?>"></script>
    <link rel = "stylesheet" href="<?=base_url('assets/vendor/bootstrap/css/bootstrap-select.min.css')?>">
    <script src="<?=base_url('assets/vendor/scrollreveal/scrollreveal.min.js')?>"></script>
    <script src="<?=base_url('assets/vendor/magnific-popup/jquery.magnific-popup.min.js')?>"></script>

    <!-- Theme JavaScript -->
    <script src="<?=base_url('assets/js/creative.min.js')?>"></script>

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
                    	<a href="<?=base_url('adm/login')?>">Login</a>
                    </li>
                         <?php	} ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	