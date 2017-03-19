<!-- PERFIL -->	
	<section class="bg-white">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-lg-12">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-3">
							<img src="<?=base_url('assets/img/users/'.$user->img_perfil)?>" class="img-responsive img-circle center-block" alt="perfil">
						</div>
						<div class="col-md-3">
							<br><br>
							<h2><strong><?=$user->nome ?></strong></h2>
							<dl>
								<dt><strong>Função</strong></dt>
								<dd><?=$user->ds_tipo_usuario?></dd>
								<dt><strong>Cidade</strong></dt>
								<dd><?=$user->nome_cidade?><dd>
								<br>
								<dt>
									<a href=""><button class="btn bg-primary">Editar</button></a>
									<a href=""><button class="btn bg-primary">Alterar Senha</button></a>
								</dt>
							</dl>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- PERFIL -->
	<section id="menu" class="bg-primary">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-lg-12">
					<div class="row">
						<div class="col-md-2"></div>
		    			<div class="col-md-8">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<div class="row">
		    							<div class="col-sm-2 text-center">
		    								<h3><a href="<?=base_url('adm/regioes')?>"><i class="fa fa-map-o fa-2x"></i><br>Regiões</a></h3>
		    							</div>
		    							<div class="col-sm-2 text-center">
		    								<h3><a href="<?=base_url('adm/cidades')?>"><i class="fa fa-flag-o fa-2x"></i><br>Cidades</a></h3>
		    							</div>
		    							<div class="col-sm-2 text-center">
		    								<h3><a href="<?=base_url('adm/presbiteros')?>"><i class="fa fa-edit fa-2x"></i><br>Presbiteros</a></h3>
		    							</div>
		    							<div class="col-sm-2 text-center">
		    								<h3><a href="<?=base_url('adm/igrejas')?>"><i class="fa fa-home fa-2x"></i><br>Igrejas</a></h3>
		    							</div>
		    							<div class="col-sm-2 text-center">
		    								<h3><a href="<?=base_url('adm/listas')?>"><i class="fa fa-list fa-2x"></i><br>Listas</a></h3>
		    							</div>
		    							<div class="col-sm-2 text-center">
		    								<h3><a href="<?=base_url('adm/usuarios')?>"><i class="fa fa-user fa-2x"></i><br>Usuarios</a></h3>
		    							</div>
			    					</div>
			    		  		</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
										
					    			