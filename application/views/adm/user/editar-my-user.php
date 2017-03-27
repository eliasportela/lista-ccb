       <section id="cadastroProduto">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="row text-center">
                            <h2 class="text-center"><i class="fa fa-user"></i> Perfil</h2>
                              <?php
                            if($error){
                          ?>
                          <div class="alert alert-danger" role="alert"><?=$error?></div>
                          <?php
                            }
                            if($success){
                          ?>
                            <hr>
                           <div class="alert alert-success" role="alert"><?=$success?></div>
                          <?php
                            }
                          ?>
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
                                    <label for="alterar-foto"><img class="img-responsive img-circle" src="<?=base_url('assets/img/users/'.$user->img_perfil)?>"></label>
                                    <!-- Alterar foto -->
                                    <label for="alterar-foto" class="btn btn-primary">Alterar Foto</label>
                                    <input id="alterar-foto" type="file" name="foto" class="form-control btn" placeholder="Foto">
                                    <script type="text/javascript">
                                        $("#alterar-foto").hide();
                                    </script>
                                </div>
                                <div class="col-sm-6">
                               
                                    <!-- Nome -->
                                    <h3>Informações do Usuário</h3>
                                    <hr>
                                    <label>Nome</label>
                                    <input type="text" id="nome" class="form-control" name="nome" value="<?=$user->nome?>" required/>
                                    <!-- User -->
                                    <label>User</label>
                                    <input type="text" name="user" class="form-control" value="<?=$user->user?>" required>
                                    <!-- Cidade -->
                                    <label>Cidade</label>
                                    <select class="form-control selectpicker" data-style="btn-primary" data-size="2" data-live-search="true">
                                        <?php foreach ($cidades as $cidade): ?>
                                            <option value="<?=$cidade->id_cidade?>"
                                            <?php if($cidade->id_cidade == $user->id_cidade): echo "selected"; endif; ?>
                                            ><?=$cidade->nome_cidade?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- Id_user -->
                                    <input type="hidden" name="id_user" >
                                    <br><br>
                                    <a href="<?=base_url('profile')?>" class="btn btn-xl btn-primary">Voltar</a>
                                    <button class="btn btn-xl btn-primary" value="Editar">Editar</button>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </section>