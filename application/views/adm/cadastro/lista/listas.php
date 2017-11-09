<section class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h2 class="text-center"><i class="fa fa-list"></i> Listas</h2>
                            <hr>
                            <?php if ($this->input->get('cod') == 1): ?>
                           	<div class="alert alert-success text-center" role="alert">Lista Editada com sucesso</div>
							<hr>
							<?php endif; ?>
							<div class="row">
								<div class=" col-sm-6 text-left">
									<a href="<?=base_url('profile#menu')?>" class="btn bg-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
								</div>
								<div class=" col-sm-6 text-right">
									<a href="<?=base_url('adm/cadastro-lista')?>" class="btn bg-primary">Nova Lista <i class="fa fa-plus"></i></a>
								</div>
							</div>
							<br>
							<table class="table table-responsive table-hover text-center">
								<tr>
									<th><h4 class="text-center"><strong>Mês Lista</strong></h4></th>
									<th><h4 class="text-center"><strong>Região</strong></h4></th>
									<th><h4 class="text-center"><strong>Cadastrado por</strong></h4></th>
								</tr>
								
								<?php foreach ($lista as $listas): 
									?>
									<tr onclick="opcaoLista(<?=$listas->id_lista?>)" title="Clique para acessar">
										<td><h5><?=$listas->nome_mes . " - " . $listas->data_lista?></h5></td>
										<td><h5><?=$listas->nome_regiao;?></h5></td>
										<td><h5><?=$listas->user;?></h5></td>
									</tr>
								<?php endforeach ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal Selecao -->
	<div class="container-fluid">
	  <div class="modal fade" id="opcoesModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header text-center">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <p class="text-uppercase">Escolha uma das opções!</p>
	        </div>
	        <div class="modal-body">
	        	<div class="row text-center">
	        		<div class="col-sm-1"></div>
	        		<div class="col-sm-10">
				  		<!--Select -->
				  		<button class="btn btn-lg btn-primary" id="removerLista" value="0">Remover <i class="fa fa-remove"></i></button>
				  		<button class="btn btn-lg btn-primary" id="editarLista" value="0">Editar <i class="fa fa-edit"></i></button>
						<button class="btn btn-lg btn-primary" id="acessarLista" value="0">Abrir <i class="fa fa-edit"></i></button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal">Cancelar</button>
			</div>
	      </div>
	    </div>
	  </div>
	</div>



    <script src="<?=base_url('assets/js/adm/lista-culto.js')?>"></script>