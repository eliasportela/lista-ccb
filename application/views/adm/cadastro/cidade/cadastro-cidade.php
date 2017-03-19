	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Nova Cidade</h2>
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
							<form method="POST" action="<?=base_url('adm/cadastro-cidade')?>">
								<!--Select regiao-->
								<label for="regiao"><h4><strong>Região</strong></h4></label>
								<select class="form-control selectpicker" data-size="3" id="regiao" name="regiao" data-style="bg-primary" data-live-search="true" title="Selecione a Região" required="">
								<?php foreach ($regioes as $regiao): ?>
									<option value="<?=$regiao->id_regiao?>"
									<?php if($regiao->id_regiao == $dataRegister['regiao']) {echo "selected"; } ?>
									><?=$regiao->nome_regiao?></option>
								<?php endforeach ?>
								</select>
								
								<!-- Data da Lista-->
								
								<label for="cidade"><h4><strong>Nome da Cidade</strong></h4></label>
								<input type="text" class="form-control" name="cidade" id="cidade" required="" value="<?=$dataRegister['cidade']?>" placeholder="Insira o nome da Cidade"> 
								</br>
								<a href="<?=base_url('adm/cidades');?>" class="btn btn-lg btn-primary">Cancelar</a>
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