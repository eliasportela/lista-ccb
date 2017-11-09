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
                          	<div class="row">
								<div class="col-md-6">
									<label for="mes"><h4><strong>Mês</strong></h4></label>
									<select class="form-control selectpicker" data-size="3" id="mes" name="mes" data-style="bg-primary" data-live-search="true" required="">
									<?php foreach ($meses as $mesLista): ?>
										<option value="<?=$mesLista->id_mes?>" <?php if ($dataRegister['mes'] == $mesLista->id_mes): echo "selected"; endif; ?>><?=$mesLista->nome_mes?></option>
									<?php endforeach ?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="data"><h4><strong>Ano</strong></h4></label>
									<input type="number" class="form-control" name="data" id="data" min="2017" max="2040" value="<?=$dataRegister['data']?>">
								</div>
							</div>
							</br><br>
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