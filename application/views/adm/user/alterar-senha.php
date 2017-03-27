        <section id="cadastroProduto">
            <div class="container">
              <div class="row">
              <div class="text-center">
                <h2 class="text-center"><i class="fa fa-user"></i> Alterar Senha</h2>
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
                            <br>
                            <form method="POST" action="<?=base_url('alterar-senha')?>">
                                <label for="senha">Senha</label>
                                <input type="password" id="senha" class="form-control" name="senha" required="" placeholder="Digite a senha atual" />
                                <label for="senha">Nova Senha</label>
                                <input type="password" id="NovaSenha" class="form-control" name="novaSenha" required="" placeholder="Nova senha" />
                                <label for="confSenha">Confirmar Senha</label>
                                <input type="password" id="confSenha" class="form-control" name="confSenha" required="" placeholder="Confirme nova senha"/>
                                    <br>
                                    <a class="btn btn-lg btn-primary" href="<?=base_url('profile')?>">Voltar</a>
                                    <button class="btn btn-lg btn-primary">Alterar</button>
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
        </section>