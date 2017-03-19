	<!--Secao cadastro-->
	<section id="cadastro">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="text-center">
							<h2 class="text-uppercase">Obrigado por querer contribuir!</h2>
							<hr>
							<h3>Para começar o cadastro informe o seu Local</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 text-center">
					<hr>
					<form method="POST" action="http://127.0.0.1/lista-ccb-estruturado/cadastrar/2">
						<div class="row">
                        	<div class="col-lg-12">
								<div class="col-sm-12">
									<div id="load_cidade">
	                                    <select class="form-control">
	                                    	<option>Brasil</option>
	                                    </select>
	                                </div>
	                            </div>
							</div>
						</div>
						<br>
						<div class="row">
                        	<div class="col-lg-12">
								<div class="col-sm-12">
									<div id="load_cidade">
	                                    <select class="form-control selectpicker"  id="estado" name="estado" data-style="bg-primary" data-live-search="true" onchange="buscar_regiao()">
	                                    	<option value="0">Selecione o Estado</option>
	                                    	<?php foreach ($estado as $estados) { ?>
	                                    	<option value="<?=$estados->id_estado?>"><?=$estados->nome_estado?></option>
	                                    	<?php } ?>
	                                    </select>
	                                </div>
	                            </div>
							</div>
						</div>
						<br>
						<div class="row">
                        	<div class="col-lg-12">
								<div class="col-sm-12">
									<div id="load_regiao">
	                                    <select class="form-control selectpicker"  id="regiao" name="regiao" data-style="bg-primary" data-live-search="true">
	                                    	<option>Selecione a Região</option>
	                                    </select>
	                                </div>
	                            </div>
							</div>
						</div>
						<br>
						<br>
						<button class="btn btn-lg btn-primary">Seguinte</button>
					</form>
					<br><br>
					<h4>Não encontrou?</h4>
					<h4 class="">Envie um e-mail para contato@lista.ccb para maiores informações.</h4>
				</div>
				<div class="col-md-3"></div>
			</div>	
		</div>								
	</section>
	<script type="text/javascript" src="<?=base_url('assets/js/regiao.js')?>"></script>
	