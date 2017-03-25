    <section id="contact" class="bg-white"> 
        <div class="container">
            <div class="row">
            <br>
            <br>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Cancelar Recebimento de e-mail</h2>
                    <hr class="primary">
                    <br>
                    <br>
                    <?php if($error): ?>
                    <div class="alert alert-danger" role="alert"><h4><?=$error?></h4></div>
                    <hr>
                <?php elseif ($sucess):  ?>
                    <div class="alert alert-success" role="alert"><h4><?=$sucess?></h4></div>
                    <hr>
                <?php endif; ?>
                    <br>
                    <div class="alert alert-danger" role="alert"><h4>Para cancelar o recebimento de notificações, informe seu email abaixo</h4></div>
                    <form method="POST" action="<?=base_url('cancelar-assinatura')?>">
                        <input type="email" name="email" class="form-control" placeholder="Informe seu e-mail">
                    <br>
                    <button class="btn btn-lg bg-primary">Enviar</button>
                    <hr>
                    </form>
                </div>
            </div>
        </div>
    </section>