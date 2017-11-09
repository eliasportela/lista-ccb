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
    <link href="<?=base_url('assets/css/creative.css')?>" rel="stylesheet">
    <!-- jQuery -->
    <link rel = "stylesheet" href="<?=base_url('assets/vendor/bootstrap/css/bootstrap-select.min.css')?>">
    
     <!-- Shortcut -->
    <link rel="shortcut icon" type="image/x-png" href="<?=base_url('assets/img/short.jpg')?>">

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86505771-1', 'auto');
  ga('send', 'pageview');
</script>
</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="<?=base_url('adm.listaccb.com')?>">LISTA CCB</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="<?=base_url('adm.listaccb.com#indexpesquisa')?>">Pesquisa</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?=base_url('adm.listaccb.com#contact')?>">Contato</a>
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
