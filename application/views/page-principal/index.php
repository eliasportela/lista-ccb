    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Lista CCB</h1>
                <hr>
                <p>Lista CCB irá te ajudar encontrar serviços de cultos em apenas alguns filtros<br>Insira as informações e clique em pesquisar</p>
                <a href="#indexpesquisa" class="btn btn-primary btn-xl page-scroll">Começar</a>
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
                                    <?php foreach ($resultado as $servicos) { #envio todos os resultados para um html select?> 
                                        <option value="<?php echo $servicos['id_servico'];?>" ><?php echo $servicos['nome_servico'];?></option>
                                    <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- Tipo de Servico FIM -->
                            <!--Selecionar o Estado-->
                            <tr>
                                <td><h4><strong>Estado</strong></h4></td>
                                <td>
                                    <select class="form-control" name="estado" id="estado" onchange="buscar_regiao()">
                                        <option value="0">Selecione...</option>
                                    <?php foreach ($resultado as $estados) { ?>
                                        <option value="<?php echo $estados['id_estado'];?>" ><?php echo $estados['nome_estado'];?></option>
                                    <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- Select Estado FIM -->
                            <!-- Select Região -->
                            <tr>
                                <td><h4><strong>Região</strong></h4></td>
                                <td>
                                    <div id="load_regiao">
                                        <select class="form-control" id="regiao" name="regiao">
                                            <option value="0">Selecione..</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Select Região FIM -->
                            <!-- Select cidade -->
                            <tr>
                                <td><h4><strong>Cidade</strong></h4></td>
                                <td>
                                    <div id="load_cidade">
                                        <select class="form-control" id="cidade" name="cidade">
                                            <option value="0">Campo em Branco</option>
                                        </select>
                                    </div>
                                </td>
                            <!-- FIM Select cidade -->
                            <!-- Select periodo da pesquisa -->
                            <tr>
                                <td><h4><strong>Período</strong></h4></td>
                                    <td>
                                    <select name="periodo" class="form-control">
                                        <option value="0">Todos</option>
                                        <option value="1">Hoje</option>
                                        <option value="7">1 Semana</option>
                                        <option value="15">15 dias</option>
                                        <option value="30">30 dias</option>
                                        <option value="60">60 dias</option>
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

    <aside class="bg-dark">
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

<script>
    function buscar_regiao(){
      var estado = $('#estado').val();
      if(estado){
        var url = 'php/buscar.php?estado='+estado;
        $.get(url, function(dataReturn) {
          $('#load_regiao').html(dataReturn);
        });
      }
    }
</script>

<!--Scrip de buscar das regioes-->
<script>
    function buscar_cidade(){
      var regiao = $('#regiao').val();
      if(regiao){
        var url = 'php/buscar_cidade.php?regiao='+regiao;
        $.get(url, function(dataReturn) {
          $('#load_cidade').html(dataReturn);
        });
      }
    }

</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86505771-1', 'auto');
  ga('send', 'pageview');

</script>


</body>

</html>
