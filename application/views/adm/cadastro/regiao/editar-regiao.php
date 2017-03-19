	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Editar Região</h2>
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
							<form method="POST" action="<?=base_url('adm/editar-regiao')?>">
								<!--Select Estado-->
								<label for="estado"><h4><strong>Estado</strong></h4></label>
								<select class="form-control selectpicker" data-size="3" id="estado" name="estado" data-style="bg-primary" data-live-search="true" title="Selecione o Estado" required="">
								<?php foreach ($estados as $estado): ?>
									<option value="<?=$estado->id_estado?>"
									<?php if($estado->id_estado == $dataRegister['estado']) {echo "selected"; } ?>
									><?=$estado->nome_estado?></option>
								<?php endforeach ?>
								</select>
								
								<!-- Data da Lista-->
								
								<label for="regiao"><h4><strong>Nome da Região</strong></h4></label>
								<input type="text" class="form-control" name="regiao" id="regiao" required="" value="<?=$dataRegister['regiao']?>" placeholder="Insira o nome da Região"> 
								</br>
								<!-- Id da regiao -->
								<input type="hidden" name="id_regiao" value="<?=$dataRegister['id_regiao']?>">
								<a href="<?=base_url('adm/regioes');?>" class="btn btn-lg btn-primary">Cancelar</a>
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