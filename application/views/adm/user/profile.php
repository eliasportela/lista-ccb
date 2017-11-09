<!DOCTYPE html>
<html>
<title><?=$title ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}a{text-decoration: none;}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-list w3-margin-right"></i>Lista CCB</a>
  <div class="w3-dropdown-hover w3-right">
    <a href="#" class="w3-button w3-hide-small w3-padding" title="My Account"><img src="<?=base_url('assets/img/users/'.$user->img_perfil)?>" class="w3-circle" style="max-height:35px;max-width:35px" alt="Avatar"></a>
    <div class="w3-dropdown-content w3-card-4 w3-bar-block w3-right" style="right:0">
      <a href="<?=base_url('profile-editar')?>" class="w3-bar-item w3-button">Meu Perfil</a>
      <a href="<?=base_url('logout')?>" class="w3-bar-item w3-button">Sair</a>
    </div>
  </div>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i>
      <?php if($qtdListasPendentes): ?>  
      <span class="w3-badge w3-right w3-small w3-green"><?=$qtdListasPendentes?></span>
      <?php endif; ?>  
    </button>     
    <div class="w3-dropdown-content w3-card w3-bar-block">
      <?php if($qtdListasPendentes): ?>  
      <a href="#listas-encaminhadas" class="w3-bar-item w3-button">
        Há <?php echo $qtdListasPendentes; ?> listas pendentes
      </a>
      <?php else: ?>
        <h6 class="w3-bar w3-padding w3-center">
          Não há nenhum alerta
        </h6>
      <?php endif;?>
    </div>
  </div>
  
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?=$nome_user;?></h4>
         <p class="w3-center"><img src="<?=base_url('assets/img/users/'.$user->img_perfil)?>" class="w3-image" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-user-o fa-fw w3-margin-right w3-text-theme"></i> <?=$user->ds_tipo_usuario?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?=$user->nome_cidade?></p>
         <p><a href="<?=base_url('profile-editar')?>" class="w3-btn w3-teal w3-block w3-round">Editar Perfil</button></a>
         <p><a href="<?=base_url('alterar-senha')?>" class="w3-btn w3-teal w3-block w3-round">Alterar Senha</button></a> 
        </div>
      </div>
      <br>
      <?php if ($permissao == 1): ?>
      <div class="w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity w3-center"><i class="fa fa-th"></i> Menu</h6>
              <hr>
              <div class="w3-row-padding w3-margin-bottom">
                <ul class="w3-ul">
                  <a class="w3-bar" href="<?php echo base_url('adm/listas')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Listas
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/cadastro-pre-lista')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Encaminhar Listas
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/usuarios')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Usuários
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/igrejas')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Igrejas
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/cidades')?>">
                    <li class="w3-cell-row w3-padding-12 w3-border-bottom ">
                      <div class="w3-cell w3-cell-middle">
                        Cidades
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <a class="w3-bar" href="<?php echo base_url('adm/regioes')?>">
                    <li class="w3-cell-row w3-padding-12">
                      <div class="w3-cell w3-cell-middle">
                        Regiões
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  <!--
                  <a class="w3-bar" href="<?php echo base_url('')?>" disabled>
                    <li class="w3-cell-row w3-padding-12 ">
                      <div class="w3-cell w3-cell-middle">
                        Presbíteros
                      </div>
                      <div class="w3-cell w3-cell-middle w3-margin-right w3-right">
                        <i class="fa fa-chevron-right"></i>
                      </div>
                    </li>
                  </a>
                  -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    <!-- End Left Column -->
    </div>
    <!-- Middle Column -->
    <div class="w3-col m7">
    <?php if ($permissao == 1): ?>
    <div class="w3-margin-top w3-hide-large"></div>
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h4 class="w3-opacity w3-center">Acesso Rápido</h4>
              <hr>
              <div class="w3-row-padding w3-margin-bottom w3-center">
                <div class="w3-quarter">
                  <h6>Listas</h6>
                  <a href="<?=base_url('adm/listas')?>">
                  <div class="w3-container w3-teal w3-padding-16 w3-center w3-round">
                    <i class="fa fa-th-list w3-xlarge"></i>
                    <div class="w3-clear"></div>
                  </div>
                  </a>
                </div>
                <div class="w3-quarter">
                  <a href="<?php echo base_url('adm/cadastro-pre-lista')?>">
                    <h6>Encaminhar Lista</h6>
                    <div class="w3-container w3-teal w3-text-white w3-padding-16 w3-center w3-round">
                      <i class="fa fa-share w3-xlarge"></i>
                      <div class="w3-clear"></div>
                    </div>
                  </a>
                </div>
                <div class="w3-quarter">
                  <a href="<?=base_url('adm/regioes')?>">
                    <h6>Regiões</h6>
                    <div class="w3-container w3-teal w3-text-white w3-padding-16 w3-center w3-round">
                      <i class="fa fa-map-signs w3-xlarge"></i>
                      <div class="w3-clear"></div>
                    </div>
                  </a>
                </div>
                <div class="w3-quarter">
                  <a href="<?=base_url('adm/cidades')?>">
                    <h6>Cidades</h4>
                    <div class="w3-container w3-teal w3-text-white w3-padding-16 w3-center w3-round">
                      <i class="fa fa-map-marker w3-xlarge"></i>
                      <div class="w3-clear"></div>
                    </div>
                  </a>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="w3-row-padding">
        <div class="w3-col m12">
      <div class="w3-card w3-white w3-round w3-padding"><br>
        <h4 class="w3-opacity w3-center">Fila de Espera - Todos Voluntários</h4>
        <hr>
        <?php if ($listasPendentes): ?>
        <table class="w3-table w3-striped w3-white">
          <thead class="w3-teal">
            <th class="" style="width: 20%">Enviado por</th>
            <th style="width: 30%">Região</th>
            <th class="" style="width: 15%">Mês</th>
            <th class="" style="width: 15%">PDF da Lista</th>
            <th class="w3-center" style="width: 20%">Cadastrar Lista</th>
          </thead>
          <tbody style="min-height: 40vh">
            <?php foreach ($listasPendentes as $lista): ?>
            <tr>
              <td style="vertical-align: middle;"><?php echo $lista->remetente ?></td>
              <td style="vertical-align: middle;"><?php echo $lista->nome_regiao ?></td>
              <td style="vertical-align: middle;"><?php echo $lista->nome_mes ?></td>
              <td style="vertical-align: middle;">
                <a href="<?php echo base_url('uploads/listas/'.$lista->file_lista) ?>" class="w3-btn w3-blue w3-block w3-round w3-small" title="Cadastrar lista" target="_blank">
                  Visualizar
                </a>
              </td>
              <td>
                <a href="<?php echo base_url('adm/gerar-lista?id='.$lista->id_pre_lista) ?>" class="w3-btn w3-blue w3-block w3-round w3-small" title="Cadastrar lista">
                  Cadastrar
                </a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php else: ?> 
          <div class="w3-padding-16 w3-center">
            <p class="w3-opacity">Não há nenhuma lista pendente :)</p>
          </div>
        <?php endif; ?>
        <br>
      </div>
    </div>
  </div>

      <a name="listas-encaminhadas"></a>
      <div class="w3-row-padding w3-margin-top" id="listas-encaminhadas">
        <div class="w3-col m12">
      <div class="w3-card w3-white w3-round w3-padding"><br>
        <h4 class="w3-opacity w3-center">Listas Encaminhadas para mim</h4>
        <hr>
        <?php if ($listasPendentesUser): ?>
        <table class="w3-table w3-striped w3-white">
          <thead class="w3-teal">
            <th class="" style="width: 20%">Enviado por</th>
            <th style="width: 30%">Região</th>
            <th class="" style="width: 15%">Mês</th>
            <th class="" style="width: 15%">PDF da Lista</th>
            <th class="w3-center" style="width: 20%">Cadastrar Lista</th>
          </thead>
          <tbody style="min-height: 40vh">
            <?php foreach ($listasPendentesUser as $lista): ?>
            <tr>
              <td style="vertical-align: middle;"><?php echo $lista->remetente ?></td>
              <td style="vertical-align: middle;"><?php echo $lista->nome_regiao ?></td>
              <td style="vertical-align: middle;"><?php echo $lista->nome_mes ?></td>
              <td style="vertical-align: middle;">
                <a href="<?php echo base_url('uploads/listas/'.$lista->file_lista) ?>" class="w3-btn w3-blue w3-block w3-round w3-small" title="Cadastrar lista" target="_blank">
                  Visualizar
                </a>
              </td>
              <td>
                <a href="<?php echo base_url('adm/gerar-lista?id='.$lista->id_pre_lista) ?>" class="w3-btn w3-blue w3-block w3-round w3-small" title="Cadastrar lista">
                  Cadastrar
                </a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php else: ?> 
          <div class="w3-padding-16 w3-center">
            <p class="w3-opacity">Não há nenhuma lista encaminhada :)</p>
          </div>
        <?php endif; ?>
        <br>
      </div>
    </div>
  </div>

      
      <div class="w3-container w3-card w3-white w3-round w3-margin w3-padding"><br>
        <h4 class="w3-opacity w3-center">Minhas Listas</h4>
        <hr>
        <?php if ($listas): ?>
        <table class="w3-table w3-striped w3-white">
          <thead class="w3-teal">
            <th style="width: 60%">Região</th>
            <th class="" style="width: 30%">Mês</th>
            <th style="width: 10%" class="w3-center">Acessar</th>
          </thead>
          <tbody style="min-height: 40vh">
            <?php foreach ($listas as $lista): ?>
            <tr>
              <td style="vertical-align: middle;"><?php echo $lista->nome_regiao ?></td>
              <td style="vertical-align: middle;"><?php echo $lista->nome_mes ?></td>
              <td><a href="<?php echo base_url('adm/lista-inserir?id='.$lista->id_lista) ?>" class="w3-btn w3-teal w3-round w3-small"><i class="fa fa-external-link"></i> Acessar</a></td>
            </tr>
            <?php 
            endforeach;?>
          </tbody>
        </table>
        <?php else: ?> 
          <div class="w3-padding-32 w3-center">
            <p class="w3-opacity">Nenhuma Lista Cadastrada :)</p>
          </div>
        <?php endif; ?>
        <?php if ($permissao == 1): ?>
          <a href="<?php echo base_url('adm/listas') ?>"><h6 class="w3-center w3-padding-16 w3-margin-right w3-text-theme">Todas as listas
        <?php endif ?>
        </h6></a>
      </div>
      

      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      
      <div class="w3-card w3-round w3-white w3-center w3-padding w3-padding-16">
        <h6 class="w3-opacity">Últimas Listas</h6>
        <hr>
        <div style="height: 70vh; overflow-y: auto;">
          <?php foreach ($noticias as $noticia): ?>
          <div class="w3-cell-row w3-border-bottom w3-padding-16">
            <div class="w3-cell" style="width: 20%">
              <img src="<?php echo base_url('assets/img/users/'.$noticia->img_perfil) ?>" class="w3-image w3-circle" style="width: 30px;height: 30px;">
            </div>
            <div class="w3-cell w3-small w3-cell-middle" style="width: 80%">
              <b><?php echo $noticia->nome?></b> cadastrou uma nova lista da <?php echo $noticia->nome_regiao;  ?><br>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
      <br>
      
      <!--
      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
      -->
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16 w3-center">
  <h5>"Tudo que Deus faz, tem um propósito"</h5>
</footer>

<footer class="w3-container w3-theme-d5 w3-right-align">
  <p>Lista CCB 2018 - <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">Termos de Uso</a></p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 
