
        
       <section id="cadastroProduto">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="row text-center">
                            <h2 class="text-center"><i class="fa fa-user"></i> Perfil</h2>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img class="img-responsive img-circle" src="<?=base_url('assets/img/users/'.$perfil->img_perfil)?>">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#contato" style="margin-top:5px;">Alterar Foto</button>
                                </div>

                                <div class="col-sm-6">
                                    <form method="POST" action="<?=base_url('profile-editar')?>">
                                        <!-- Nome -->
                                        <h3>Informações do Usuário</h3>
                                          <?php
                                            if($error){ ?>
                                              <div class="alert alert-danger" role="alert"><?=$error?></div>
                                              <?php }
                                            if($success){ ?>
                                               <div class="alert alert-success" role="alert"><?=$success?></div>
                                            <?php } ?>
                                        <hr>
                                        <label>Nome</label>
                                        <input type="text" id="nome" class="form-control" name="nome" value="<?=$dataRegister['nome']?>" required/>
                                        <!-- User -->
                                        <label>User</label>
                                        <input type="text" name="user" class="form-control" value="<?=$dataRegister['user']?>" required>
                                        <!-- Cidade -->
                                        <label>Cidade</label>
                                        <select class="form-control selectpicker" data-style="btn-primary" data-size="2" data-live-search="true" data-live-search-Normalize="true" name="cidade">
                                            <?php foreach ($cidades as $cidade): ?>
                                                <option value="<?=$cidade->id_cidade?>"
                                                <?php if($cidade->id_cidade == $dataRegister['cidade']): echo "selected"; endif; ?>
                                                ><?=$cidade->nome_cidade?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- Id_user -->
                                        <input type="hidden" name="id_user" >
                                        <br><br>
                                        <a href="<?=base_url('profile')?>" class="btn btn-xl btn-primary">Voltar</a>
                                        <button class="btn btn-xl btn-primary" value="Editar">Editar</button>
                                    </form>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </section>                                  

    <div class="container-fluid">
      <div class="modal fade" id="contato" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="text-uppercase">Alterar Imagem Perfil</h3>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <form method="POST" enctype="multipart/form-data" action="<?=base_url('profile/recortar')?>">       
                        
                    <div id="text-seleciona">
                        <h4>Selecione Uma foto<h4>
                        <label class="btn btn-primary" for="seleciona-imagem">Selecionar</label>
                    </div>
                    <input id="seleciona-imagem" type="file" name="imagem" required>
                    <div class="col-sm-12" id="imagem-box">
                        <h4>Selecione uma área da foto para recortar</h4>
                        <img src="" id="visualizacao_img" class="img-responsive">
                        <br>
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="wcrop" name="wcrop" />
                        <input type="hidden" id="hcrop" name="hcrop" />
                        <input type="hidden" id="wvisualizacao" name="wvisualizacao" />
                        <input type="hidden" id="hvisualizacao" name="hvisualizacao" />
                        <input type="hidden" id="woriginal" name="woriginal" />
                        <input type="hidden" id="horiginal" name="horiginal" />
                        <a class="btn btn-primary" href="<?=base_url('profile-editar')?>">Cancelar</a>
                        <button class="btn btn-primary">Alterar</button>
                    </div>
                    </form>
                </div>    
            </div>
            <div class="modal-footer text-center">
            </div>
          </div>

        </div>
      </div>
    </div>
    <script type="text/javascript">
        $("#seleciona-imagem").hide();
        $("#imagem-box").hide();
    </script>