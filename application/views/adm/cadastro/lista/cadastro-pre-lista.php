<!--Secao cadastro-->
 <br>
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Encaminhar Lista</h2>
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
							<form method="POST" action="<?=base_url('adm/cadastro-pre-lista')?>" enctype="multipart/form-data">
								<!-- Data da Lista-->
								<div class="row">
									<div class="col-md-6">
										<label for="data"><h4><strong>Encaminhar para</strong></h4></label>
										<select class="form-control selectpicker" data-size="3" id="usuario" name="usuario" data-style="bg-primary" data-live-search="true" required="">
										<option value="0">Todos Voluntários</option>
										<?php foreach ($usuarios as $usuario): ?>
											<option value="<?=$usuario->id_usuario?>"
											<?php if($usuario->id_usuario == $dataRegister['usuario']) {echo "selected"; } ?>
											><?=$usuario->nome?></option>
										<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-6">
										<!--Select Regiao-->
										<label for="regiao"><h4><strong>Região</strong></h4></label>
										<select class="form-control selectpicker" data-size="3" id="regiao" name="regiao" data-style="bg-primary" data-live-search="true" required="">
										<?php foreach ($regioes as $regiao): ?>
											<option value="<?=$regiao->id_regiao?>"
											<?php if($regiao->id_regiao == $dataRegister['regiao']) {echo "selected"; } ?>
											><?=$regiao->nome_regiao?></option>
										<?php endforeach ?>
										</select>	
									</div>
									<div class="col-md-4">
										<label for="mes"><h4><strong>Mês</strong></h4></label>
										<select class="form-control selectpicker" data-size="3" id="mes" name="mes" data-style="bg-primary" data-live-search="true" required="">
											<option value="1" <?php if ($dataRegister['mes'] == 1): echo "selected"; endif; ?>>Janeiro</option>
											<option value="2" <?php if ($dataRegister['mes'] == 2): echo "selected"; endif; ?>>Fevereiro</option>
											<option value="3" <?php if ($dataRegister['mes'] == 3): echo "selected"; endif; ?>>Março</option>
											<option value="4" <?php if ($dataRegister['mes'] == 4): echo "selected"; endif; ?>>Abril</option>
											<option value="5" <?php if ($dataRegister['mes'] == 5): echo "selected"; endif; ?>>Maio</option>
											<option value="6" <?php if ($dataRegister['mes'] == 6): echo "selected"; endif; ?>>Junho</option>
											<option value="7" <?php if ($dataRegister['mes'] == 7): echo "selected"; endif; ?>>Julho</option>
											<option value="8" <?php if ($dataRegister['mes'] == 8): echo "selected"; endif; ?>>Agosto</option>
											<option value="9" <?php if ($dataRegister['mes'] == 9): echo "selected"; endif; ?>>Setembro</option>
											<option value="10" <?php if ($dataRegister['mes'] == 10): echo "selected"; endif; ?>>Outubro</option>
											<option value="11" <?php if ($dataRegister['mes'] == 11): echo "selected"; endif; ?>>Novembro</option>
											<option value="12" <?php if ($dataRegister['mes'] == 12): echo "selected"; endif; ?>>Dezembro</option>
										</select>	
									</div>
									<div class="col-md-4">
										<label for="data"><h4><strong>Ano</strong></h4></label>
										<input type="number" class="form-control" name="data" id="data" min="2017" max="2040" value="<?=$dataRegister['data']?>">
									</div>
									<div class="col-md-4">
										<label for="file"><h4><strong>Enviar Arquivo</strong></h4></label>
										<input type="file" class="form-control" name="arquivo" id="file" required>
									</div>
								</div>
								</br><br>
								<a href="<?=base_url('profile');?>" class="btn btn-lg btn-primary">Voltar</a>
								<button class="btn btn-lg btn-primary">Encaminhar</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>	
		</div>
		 <br><br><br>
	</section>
	<!-- devs-->