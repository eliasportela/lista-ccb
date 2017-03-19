    <section class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h2 class="text-center"><i class="fa fa-map-o"></i> Cidades</h2>
                            <hr>
                            <?php if ($this->input->get('cod') == 1): ?>
                           	<div class="alert alert-success text-center" role="alert">Cidade editada com sucesso</div>
							<hr>
							<?php elseif ($this->input->get('cod') == 2): ?>
                           	<div class="alert alert-success text-center" role="alert">Cidade Removida com sucesso</div>
							<hr>
							<?php endif; ?>
							<div class="row">
								<div class=" col-md-2 text-left">
									<a href="<?=base_url('profile#menu')?>" class="btn bg-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
								</div>
								<div class="col-md-8">
									<input type="text" class="form-control input-search" alt="lista-cidades" placeholder="Buscar nessa Lista">
								</div>
								<div class=" col-md-2 text-right">
									<a href="<?=base_url('adm/cadastro-cidade')?>" class="btn bg-primary">Nova Cidade <i class="fa fa-plus"></i></a>
								</div>
							</div>
							<br>
							<table class="table table-responsive table-hover text-center">
							<thead>
								<tr>
									<th><h4 class="text-center"><strong>Nome da Cidade</strong></h4></th>
									<th><h4 class="text-center"><strong>Região</strong></h4></th>
									<th><h4 class="text-center"><strong>Opções</strong></h4></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cidades as $cidade): 
									?>
									<tr>
										<td><?=$cidade->nome_cidade;?></td>
										<td><?=$cidade->nome_regiao;?></td>
										<td>
										<a href="<?=base_url('adm/editar-cidade?id='.$cidade->id_cidade)?>"><i class="fa fa-edit fa-2x" title="Editar Cidade"></i></a> 
										| 
										<a onclick="return confirm('Deseja realmente excluir essa Cidade?');" 
										href="<?=base_url('adm/remover-cidade?id='.$cidade->id_cidade)?>"><i class="fa fa-remove fa-2x" title="Remover Cidade"></i></a></td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>