    <section class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h2 class="text-center"><i class="fa fa-home"></i> Igrejas</h2>
                            <hr>
                            <?php if ($this->input->get('cod') == 1): ?>
                           	<div class="alert alert-success text-center" role="alert">Igreja editada com sucesso</div>
							<hr>
							<?php elseif ($this->input->get('cod') == 2): ?>
                           	<div class="alert alert-success text-center" role="alert">Igreja Removida com sucesso</div>
							<hr>
							<?php endif; ?>
							<form action="<?=base_url('adm/igrejas')?>" method="post">
								<div class="row">
									<div class=" col-md-2 text-left">
										<a href="<?=base_url('profile#menu')?>" class="btn bg-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" alt="lista-igrejas" placeholder="Para buscar a igreja digite aqui o nome da cidade. Ex.. Jacui" name="cidade" value="<?=$dataForm?>" autofocus>
									</div>
									<div class=" col-md-2 text-right">
										<a href="<?=base_url('adm/cadastro-igreja')?>" class="btn bg-primary">Nova Igreja <i class="fa fa-plus"></i></a>
									</div>
								</div>
								<br>
								<div class="row text-center">
									<button class="btn btn-primary btn-lg">Pesquisar</button>
								</div>
							</form>
							<br>
							<table class="table table-responsive table-hover text-center">
							<thead>
								<tr>
									<th><h4 class="text-center"><strong>Nome da Igreja</strong></h4></th>
									<th><h4 class="text-center"><strong>Cidade</strong></h4></th>
									<th><h4 class="text-center"><strong>Opções</strong></h4></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if ($igrejas):
								foreach ($igrejas as $igreja): 
									?>
									<tr>
										<td><?=$igreja->ds_igreja;?></td>
										<td><?=$igreja->nome_cidade;?></td>
										<td>
										<a href="<?=base_url('adm/editar-igreja?id='.$igreja->id_igreja)?>"><i class="fa fa-edit fa-2x" title="Editar Igreja"></i></a> 
										| 
										<a onclick="return confirm('Deseja realmente excluir essa igreja?');" 
										href="<?=base_url('adm/remover-igreja?id='.$igreja->id_igreja)?>"><i class="fa fa-remove fa-2x" title="Remover Igreja"></i></a></td>
									</tr>
								<?php endforeach;
								else:
								?>
									<tr>
										<td></td>
										<td><h4>Nenhuma cidade encontrada!</h4></td>
										<td></td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>