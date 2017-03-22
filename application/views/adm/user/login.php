<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <?php
                        if($error){
                      ?>
                      <div class="alert alert-danger" role="alert"><?=$error?></div>
                      <?php
                        }
                      ?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    	<div class="row">
        <br><br><br>

    		<div class="col-lg-12 text-center">
                <h2 class="section-heading">Login</h2>
                <hr><br>
    			<div class="row">
    				<div class="col-md-4"></div>
    				<div class="col-md-4">
    					<form class="form-horizontal" method="POST" action="<?=base_url('login'); ?>">
                        	<div class="control-group">
                                <div class="controls">
                                	<input class="form-control" id="inputUser" type="text" name="user" placeholder="Digite o seu Usuário..." />
                           	    </div>
                            </div>
                            <br>
                            <div class="control-group">
                            	<div class="controls">
                                	<input class="form-control" id="inputPassword" type="password" name="senha" placeholder="Digite a sua senha..." />
                                </div>
                            </div>
                            <br>
                            <div class="control-group">
                               <div class="controls">
                               		<p></p>
                                	<button class="btn btn-lg bg-primary" type="submit">Login</button>
                                </div>
                            </div>
                        </form>				
    				</div>
    				<div class="col-md-4"></div>
    			</div>
    		</div>
    	</div>
    </div>
  <br><br><br>
</section>