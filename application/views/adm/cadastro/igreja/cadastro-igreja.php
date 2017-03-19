	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Nova Igreja</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center">
						<?php if($error): ?>
                            <hr>
                          	<div class="alert alert-danger" role="alert"><?=$error?></div>
                        <?php elseif ($success): ?>
                            <hr>
                           	<div class="alert alert-success" role="alert"><?=$success?></div>
                        <?php endif; ?>
                          	<hr>
							<form method="POST" action="<?=base_url('adm/cadastro-igreja')?>">
								<!--Select cidade-->
								<label for="cidade"><h4><strong>Cidade</strong></h4></label>
								<select class="form-control selectpicker" data-size="3" id="cidade" name="cidade" data-style="bg-primary" data-live-search="true" title="Selecione a Cidade" required="">
								<?php foreach ($cidades as $cidade): ?>
									<option value="<?=$cidade->id_cidade?>"
									<?php if($cidade->id_cidade == $dataRegister['cidade']) {echo "selected"; } ?>
									><?=$cidade->nome_cidade?></option>
								<?php endforeach ?>
								</select>
								
								<!-- Data da Lista-->
								
								<label for="Igreja"><h4><strong>Nome da igreja</strong></h4></label>
								<input type="text" class="form-control" name="igreja" id="igreja" required="" value="<?=$dataRegister['igreja']?>" placeholder="Insira o nome da Igreja"> 
								</br>
								<a href="<?=base_url('adm/igrejas');?>" class="btn btn-lg btn-primary">Cancelar</a>
								<button class="btn btn-lg btn-primary">Inserir</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
	<!-- devs-->