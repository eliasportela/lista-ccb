<section class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
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
    		<div class="col-lg-12 text-center">
                <h2 class="section-heading">Login</h2>
                <hr class="light">
    			<div class="row">
    				<div class="col-md-4"></div>
    				<div class="col-md-4">
    					<form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<div class="control-group">
                                <div class="controls">
                                	<input class="form-control" id="inputUser" type="text" name="user" placeholder="Usuário" />
                           	    </div>
                            </div>
                            <br>
                            <div class="control-group">
                            	<div class="controls">
                                	<input class="form-control" id="inputPassword" type="password" name="senha" placeholder="Senha" />
                                </div>
                            </div>
                            <div class="control-group">
                               <div class="controls">
                               		<p></p>
                                	<button class="btn btn-default btn-xl sr-button" name="submit" type="submit">Acessar</button>
                                </div>
                            </div>
                        </form>				
    				</div>
    				<div class="col-md-4"></div>
    			</div>
    		</div>
    	</div>
    </div>
    </section>