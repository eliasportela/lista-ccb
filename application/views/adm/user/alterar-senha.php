        <section id="cadastroProduto">
            <div class="container">
              <div class="row">
              <div class="text-center">
                <h2 class="text-center">Alterar Senha</h2>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                        <?php
                            if($error){
                          ?>
                            <hr>
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
                            <form method="POST" action="<?=base_url('adm/alterar-senha')?>">
                                <p><label for="senha">Senha</label></p>
                                <input type="password" id="senha" class="form-control" name="senha" required="" placeholder="Digite a senha atual" />
                                <br><p><label for="senha">Nova Senha</label></p>
                                <input type="password" id="NovaSenha" class="form-control" name="novaSenha" required="" placeholder="Digite a nova senha" />
                                <br><p><label for="confSenha">Confirmar Senha</label></p>
                                <input type="password" id="confSenha" class="form-control" name="confSenha" required="" placeholder="Confirme a nova senha" />
                                <div class="col-lg-12 text-center">
                                    <br>
                                    <input type="submit" class="btn btn-xl" value="Alterar" />
                                    <a href="<?=base_url('adm')?>"><h3>Voltar</h3></a>
                                </div>
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
        </section>