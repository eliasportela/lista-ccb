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
									<th><h4 class="text-center"><strong>Data da Lista</strong></h4></th>
									<th><h4 class="text-center"><strong>Região</strong></h4></th>
									<th><h4 class="text-center"><strong>Cadastrado por</strong></h4></th>					
									<th><h4 class="text-center"><strong>Opção</strong></h4></th>
								</tr>
								
								<?php foreach ($lista as $listas): 
									?>
									<tr>
										<td><?=date("d/m/Y", strtotime($listas->data_lista));?></td>
										<td><?=$listas->nome_regiao;?></td>
										<td><?=$listas->user;?></td>
										<td><a href="<?=base_url('adm/lista-inserir?id='.$listas->id_lista)?>"><i class="fa fa-external-link-square fa-2x" title="Abrir Lista"></i></a> | <a href="<?=base_url('adm/editar-lista/?id='.$listas->id_lista)?>"><i class="fa fa-edit fa-2x" title="Editar Lista"></i></a></td>
									</tr>
								<?php endforeach ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>