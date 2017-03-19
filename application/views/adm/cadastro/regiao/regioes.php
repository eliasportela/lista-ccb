    <section class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h2 class="text-center"><i class="fa fa-map-o"></i> Regiões</h2>
                            <hr>
                            <?php if ($this->input->get('cod') == 1): ?>
                           	<div class="alert alert-success text-center" role="alert">Região editado com sucesso</div>
							<hr>
							<?php elseif ($this->input->get('cod') == 2): ?>
                           	<div class="alert alert-success text-center" role="alert">Região Removida com sucesso</div>
							<hr>
							<?php endif; ?>
							<div class="row">
								<div class="col-sm-6 text-left">
									<a href="<?=base_url('profile#menu')?>" class="btn bg-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
								</div>
								<div class="col-sm-6 text-right">
									<a href="<?=base_url('adm/cadastro-regiao')?>" class="btn bg-primary">Nova Região <i class="fa fa-plus"></i></a>
								</div>
							</div>
							<br>
							<table class="table table-responsive table-hover text-center">
								<tr>
									<th><h4 class="text-center"><strong>Nome da Região</strong></h4></th>
									<th><h4 class="text-center"><strong>Estado</strong></h4></th>
									<th><h4 class="text-center"><strong>Opções</strong></h4></th>
								</tr>
								
								<?php foreach ($regioes as $regiao): 
									?>
									<tr>
										<td><?=$regiao->nome_regiao;?></td>
										<td><?=$regiao->nome_estado;?></td>
										<td>
										<a href="<?=base_url('adm/editar-regiao/?id='.$regiao->id_regiao)?>"><i class="fa fa-edit fa-2x" title="Editar Região"></i></a> 
										| 
										<a onclick="return confirm('Deseja realmente excluir essa Região?');" 
										href="<?=base_url('adm/remover-regiao/?id='.$regiao->id_regiao)?>"><i class="fa fa-remove fa-2x" title="Remover Região"></i></a></td>
									</tr>
								<?php endforeach ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>