<section id="pesquisa"> 
    <div class="container-fluid">
        <div class="row" id="rdm">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2><?=$regiao->nome_regiao;?></h2>
                    <hr>
                </div>
                  <?php 
                    $cont = 0;
                    foreach ($cultos as $culto) { 
                 ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading text-center"><h4 class="section-heading"><strong><?=$culto['nome_servico']?></strong></h4></div>
                        <?php
                        if ($culto[$cont] == null): ?>
                          <div class="alert alert-danger text-center" role="alert">
                          Desculpe-nos o incoveniente, ainda não temos nenhum cadastro para essa consulta.<br></div>
                        <?php
                            else:
                        ?>
                        <table class="table table-responsive table-hover text-center">
                            <thead>
                                <tr>
                                    <th><h4 class="text-center"><strong>Cidade</strong></h4></th>
                                    <th><h4 class="text-center"><strong>Data Horarios</strong></h4></th>
                                    <th><h4 class="text-center"><strong>
                                        <?php if($culto['id_servico'] != 5){
                                            echo "Ancião";
                                        }else{
                                            echo "Enc.";
                                        } ?>
                                            
                                        </strong></h4></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($culto[$cont] as $resultado): // se nao for ensaio regional
                                if($culto['id_servico'] != 5): ?>
                                <tr <?php if($resultado->nome_cidade == false){echo 'class="info"';}?> > <!-- Inserir logica para o evento do facebook -->
                                    <td><h4><strong><?=$resultado->nome_cidade.' ('.$resultado->ds_igreja.')'?></strong></h4></td>
                                    <td><h4><strong><?=date('d-m', strtotime($resultado->data)) . ' ' . date("H:i",strtotime($resultado->horario))?></strong></h4></td>
                                    <td><h4><strong><?=$resultado->anciao?></strong></h4></td>
                                </tr>
                            <?php else: // se for ensaio regional
                                ?>
                                    <tr>
                                    <td><h4><strong><?=$resultado->nome_cidade .' ('.$resultado->ds_igreja.')'?></strong></h4></td>
                                    <td><h4><strong><?=date('d-m', strtotime($resultado->data)) . ' ' . date("H:i",strtotime($resultado->horario))?></strong></h4></td>
                                    <td><h4><strong><?=$resultado->encarregado?></strong></h4></td>
                                </tr>
                            <?php endif; endforeach; endif; ?>
                            </tbody>
                        </table>
                      </div>
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <br><br >
        <?php $cont++; } ?>
        <div class="row text-center">
            <h3>Continue Pesquisando</h3>
            <a href="http://listaccb.com/#indexpesquisa"><button class="btn bg-primary">Voltar</button></a>
            <h3>Receba em seu e-mail</h3>
            <a href="#" data-toggle="modal" data-target="#contato"><button class="btn bg-primary">Enviar</button></a>
            <h3>Seja um Voluntário!</h3>
            <a href="<?=base_url('contato')?>" class="btn bg-primary">Saiba mais</a>
        </div>
    </div>
</section>
   

    <section id="contact" class="bg-primary"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h4>Curta nossa pagina no Facebook</h4>
                    <div class="col-lg-4 col-lg-offset-2 text-center">
                      <i class="fa fa-facebook fa-3x sr-contact"></i>
                      <a href="https://www.facebook.com/ListaCCB/" target="_blank"><p>www.facebook.com/listaccb</p></a>
                    </div>
                    <div class="col-lg-4 text-center">
                      <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                      <p><a href="mailto:contato@listaccb.com?Subject=Lista CCB%20again" target="_top">contato@listaccb.com</a></p>
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
      </div>
    </section>

    <div class="container-fluid">
      <div class="modal fade" id="contato" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="text-uppercase">Receba em seu email :)</h3>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <h4>Gostou do lista ccb?<h4>
                        <p>
                            Receba em seu e-mail uma notificação quando for inserida uma lista da sua região!<br>
                        </p>
                        <form method="POST" action="<?=base_url('assinatura')?>">
                            <select class="form-control selectpicker" data-size="4" data-live-search="true" id="regiao" name="regiao" data-style="bg-primary">                           
                            <?php foreach ($regioes as $regiao2): ?> 
                                <option value="<?=$regiao2->id_regiao?>" <?php if ($regiao2->id_regiao == $regiao->id_regiao): echo "selected"; endif; ?> > <?=$regiao2->nome_regiao .' - '. $regiao2->sigla_estado;?></option>
                            <?php endforeach ?>
                            </select>
                            <br><br>
                            <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                            <br>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                            <br>
                            <button class="btn btn-lg bg-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
            </div>
          </div>

        </div>
      </div>
    </div>

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
