<section id="pesquisa"> 
    <div class="container-fluid">
    <?php 
    $cont = 0;
    foreach ($cultos as $culto) { 
 ?>
        <div class="row" id="rdm">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2 class="section-heading"><?=$culto['nome_servico']?></h2>
                    <p><?=$regiao->nome_regiao;?></p>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table table-responsive table-hover text-center">
                            <thead>
                                <tr>
                                    <th><h4 class="text-center"><strong>Cidade</strong></h4></th>
                                    <th><h4 class="text-center"><strong>Data Horarios</strong></h4></th>
                                    <th><h4 class="text-center"><strong>
                                        <?php if($culto['id_servico'] != 5){
                                            echo "Ancião";
                                        }else{
                                            echo "Encarregado";
                                        } ?>
                                            
                                        </strong></h4></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($culto[$cont] == null): ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Desculpe-nos o incoveniente, ainda não temos cadastro para essa sua consulta.<br>
                            <?php
                            else:
                            foreach ($culto[$cont] as $resultado): // se nao for ensaio regional
                                if($culto['id_servico'] != 5): ?>
                                <tr>
                                    <td><h4><strong><?=$resultado->nome_cidade?></strong></h4></td>
                                    <td><h4><strong><?=date('d-m', strtotime($resultado->data)) . ' ' . date("H:i",strtotime($resultado->horario))?></strong></h4></td>
                                    <td><h4><strong><?=$resultado->anciao?></strong></h4></td>
                                </tr>
                            <?php else: // se for ensaio regional
                                ?>
                                    <tr>
                                    <td><h4><strong><?=$resultado->nome_cidade?></strong></h4></td>
                                    <td><h4><strong><?=date('d-m', strtotime($resultado->data)) . ' ' . date("H:i",strtotime($resultado->horario))?></strong></h4></td>
                                    <td><h4><strong><?=$resultado->encarregado?></strong></h4></td>
                                </tr>
                            <?php endif; endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <br><br >
        <?php $cont++; } ?>
        <div class="row text-center">
            <h3>Continue Pesquisando <a href="http://listaccb.com/#indexpesquisa"><button class="btn bg-primary">Voltar</button></a></h3>
            <h3>Receber em meu e-mail <a href="#" data-toggle="modal" data-target="#contato"><button class="btn bg-primary">Enviar</button></a></h3>
        </div>
    </div>
</section>
   

    <section id="contact" class="bg-primary"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Junte-se a nós :)</h2>
                    <hr class="primary">
                    <p>Seja como vários voluntários espalhados pelo Brasil e mantenha o Lista CCB atualizado com os Serviços de Culto da sua Região.</p>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-facebook fa-3x sr-contact"></i>
                    <a href="https://www.facebook.com/ListaCCB/"><p>www.facebook.com/listaccb</p></a>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="#" class="">contato@listaccb.com</a></p>
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
                            Que tal receber uma notificação em seu e-mail quando uma lista da sua região for inserida?<br>
                        </p>
                        <form method="POST" action="<?=base_url('adm/contato')?>">
                            <input type="email" name="email" class="form-control" placeholder="Informe-nos o seu email">
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
