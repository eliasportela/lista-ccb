
    <div class="container-fluid">
      <div class="modal fade" id="contato" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="text-uppercase">Junte-se a nós :)</h3>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <h4>Vire um voluntário e ajude muitos que usam o Lista CCB<h4>
                        <p>
                            Gostou do lista ccb? Existem várias formas de ajudar.
                        </p>
                        <select class="form-control">
                          <option value="desenvolvedor">Desenvolvedor</option>
                          <option value="voluntario" selected>Voluntário para cadastro de listas</option>
                        </select>
                        <br>
                        <input type="text" name="nome" class="form-control" placeholder="Nome">
                        <br>
                        <input type="email" name="email" class="form-control" placeholder="Informe seu email">
                        <br>
                        <button class="btn btn-lg bg-primary">Enviar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
            </div>
          </div>

        </div>
      </div>
    </div>

      <!--  Rodape -->
    <footer class="complete">
        <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                    <ul class="list-inline quicklinks text-center bg-dark">
                        <li><a href="#">Política de Privacidade</a>
                        </li>
                        <li><a href="#">Termos de uso</a>
                        </li>
                    </ul>
                    <p class="copyright">Copyright &copy; Lista CCB 2017</p>
                    <p>"Tudo que Deus faz, tem um propósito"</p>
                </div>
            </div>
        </aside>
    </footer>
  </body>




    <script>

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-86515353-1', 'auto');
      ga('send', 'pageview');

    </script>

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
</html>