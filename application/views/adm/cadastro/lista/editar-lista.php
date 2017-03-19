	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Lista <?=$dataRegister['regiao']?></h2>
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
                        <?php endif; ?>
                          	<hr>
							<form method="POST" action="<?=base_url('adm/editar-lista')?>">
								<?php /*
								<!--Select Regiao-->
								<label for="regiao"><h4><strong>Região</strong></h4></label>
								<div id="load_regiao">
									<select class="form-control selectpicker" data-size="3" id="regiao" name="regiao" data-style="bg-primary" data-live-search="true" title="Selecione a Regiao" required="">
									<?php foreach ($regioes as $regiao): ?>
										<option value="<?=$regiao->id_regiao?>"
										<?php if($regiao->id_regiao == $dataRegister['regiao']) {echo "selected"; } ?>
										><?=$regiao->nome_regiao?></option>
									<?php endforeach ?>
									</select>
								</div>
								*/ ?>
								<!-- Data da Lista-->
								
								<label for="data"><h4><strong>Data da Lista</strong></h4></label>
								<input type="date" class="form-control" name="data" id="data" required="" value="<?=$dataRegister['data']?>"> 
								</br>
								<!-- Id da Lista-->
								<input type="hidden" name="id_lista" value="<?=$dataRegister['id_lista'];?>">
								<a href="<?=base_url('adm/listas');?>" class="btn btn-lg btn-primary">Cancelar</a>
								<button class="btn btn-lg btn-primary">Editar</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>								
	</section>
	<!-- devs-->