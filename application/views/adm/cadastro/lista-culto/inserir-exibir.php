
    <section class="bg-white">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-lg-12">
    				<br>
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center">
								<h2><i class="fa fa-list"></i> Cadastrar Cultos</h2>
								 <?php if($error): //ocorrendo erro na validacao ?>
							  	<hr>
									<div class="alert alert-danger" role="alert"><?=$error?></div>
					  		<?php endif ?>
						
							</div>
						</div>
						<div clas="row">
						<hr>
						<form method="POST" action="<?=base_url('adm/lista-inserir?id='.$id_lc)?>">

						<!--Tipo de Servico-->
						<div class="col-md-1 col-sm-3 text-center">
							<label><h3><strong>Serviço</strong></h3></label>
							<select class="form-control selectpicker" data-size="5" data-live-search="false" id="servico" name="servico" data-style="bg-primary" onchange="Servico()">
								<?php foreach ($servicos as $servico): ?>
									<option value="<?=$servico->id_servico?>" <?php if ($servico->id_servico == $dataForm['servico']): echo 'selected'; endif; ?>><?=$servico->nome_servico?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Data-->
						<div class="col-md-2 col-sm-3 text-center">
							<label><h3><strong>Data</strong></h3></label>
							<input type="date" class="form-control" name="data" value="<?=$dataForm['data']; ?>" required>
						</div>
						<!--Horario-->
						<div class="col-md-1 col-sm-3 text-center">
							<label><h3><strong>Horario</strong></h3></label>
							<select class="form-control selectpicker" data-size="5" data-live-search="false" id="horario" name="horario" data-style="bg-primary">
								<?php foreach ($horarios as $horario): ?>
									<option value="<?=$horario->id_horario?>" <?php if ($horario->id_horario == $dataForm['horario']): echo 'selected'; endif; ?> > <?=date("H:i", strtotime($horario->horario))?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Cidade-->
						<div class="col-md-2 col-sm-3 text-center">
							<label><h3><strong>Cidade </strong><a href="#" data-toggle="modal" data-target="#Modal_cidade"><i class="fa fa-external-link" title="Cadastrar Cidade"></i></a></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="cidade" name="cidade" data-style="bg-primary" data-title="Selecione uma cidade" onchange="buscar_igreja()">
								<?php foreach ($cidades as $cidade): ?>
									<option value="<?=$cidade->id_cidade?>"><?=$cidade->nome_cidade?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Igreja-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><strong>Igreja </strong><a href="#" data-toggle="modal" data-target="#Modal_igreja"><i class="fa fa-external-link" title="Cadastrar Igreja"></i></a></h3></label>
							<div id="load_igreja">
							<select class="form-control" id="igreja" name="igreja">
								<option value="0">Selecione uma cidade</option>
							</select>
							</div>
						</div>
						<!--Anciao-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><strong>Ancião </strong><a href="#" data-toggle="modal" data-target="#Modal_presbitero"><i class="fa fa-external-link" title="Cadastrar Anciao"></i></a></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao" name="anciao" data-style="bg-primary">
								<?php foreach ($ancioes as $anciao): ?>
									<option value="<?=$anciao->id_presbitero?>"><?=$anciao->nome?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Encarregado-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><strong>Encarregado </strong><a href="#" data-toggle="modal" data-target="#Modal_presbitero"><i class="fa fa-external-link" title="Cadastrar Encarregado"></i></a></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="encarregado" name="encarregado" data-style="bg-primary">
								<?php foreach ($encarregados as $encarregado): ?>
									<option value="<?=$encarregado->id_presbitero?>" <?php if ($encarregado->id_presbitero == 1): echo 'selected'; endif; ?>><?=$encarregado->nome?></option>
								<?php endforeach ?>
							</select>
						</div>
						<br
					</div>
    				<div class="row">
    					<div class="col-md-12 text-center">
    						<br>
    						<button class="btn btn-xl bg-primary">Inserir</button>
								<br><br>
    					</div>
    				</div>
    			</div>
    		</div>
				</form>
			
			<div class="row">
	    		<div class="col-lg-12">
	    			<div class="row">
	    				<div class="col-md-1"></div>
	    				<div class="col-md-10 text-center">
	    					<h2><i class="fa fa-list"></i> Lista de Batismo e diversos. <?=$lista['regiao']?>. <?=date("d-m-Y", strtotime($lista['data']))?>.</h2>
								<hr>
								<div class="row">
								<div class=" col-sm-6 text-left">
									<a href="<?=base_url('adm/listas')?>" class="btn bg-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
								</div>
								<div class=" col-sm-6 text-right">
									<a href="<?=base_url('adm/cadastro-lista')?>" class="btn bg-primary">Nova Lista <i class="fa fa-plus"></i></a>
								</div>
							</div>
								<br>
				    		<table class="table table-responsive table-hover">
				    			<tr>
				    				<th><h4 class="text-center"><strong>Data</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Serviço</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Horario</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Cidade</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Igreja</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Ancião</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Encarregado</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Opção</strong></h4></th>
				    			</tr>
				    			<?php
				    			if ($dataRegister): // Verifica se a tabela esta vazia
				    			//die(var_dump($dataRegister));
				    			foreach ($dataRegister as $cultos): ?>
				    			<tr>
				    				<td><?=date("d-m",strtotime($cultos->data))?></td>
				    				<td><?=$cultos->nome_servico?></td>
				    				<td><?=date("H:i", strtotime($cultos->horario))?></td>
				    				<td><?=$cultos->nome_cidade?></td>
				    				<td><?=$cultos->ds_igreja?></td>
				    				<td><?=$cultos->anciao?></td>
				    				<td><?=$cultos->encarregado?></td>
				    				<td>
				    					<a href="<?=base_url('adm/lista-editar-servicos?id='.$cultos->id_lista_culto)?>"><i class="fa fa-edit fa-2x"></i></a> 
				    					|
				    					<a href="#"><i class="fa fa-remove fa-2x"></i></a>
				    				</td>
				    			</tr>
				    			<?php endforeach; 
				    			else: 
				    				echo "";
				    			endif;  
				    			?>
			    			</table>
    					</div>
    					<div class="col-md-1"></div>
    				</div>
	    		</div>
	    	</div>
    	</div>
    </section>

<!-- Modal Cidade -->
<div class="container-fluid">
  <div class="modal fade" id="Modal_cidade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="text-uppercase">Nova Cidade</h2>
        </div>
        <div class="modal-body">
        	<div class="row text-center">
        	<div class="col-sm-1"></div>
        	<div class="col-sm-10">
			  	<form method="POST" action="<?=base_url('adm/cadastro-cidade')?>">
					<!--Select regiao-->
					<label for="cidade"><h4><strong>Nome da Cidade</strong></h4></label>
					<input type="text" class="form-control" name="cidade" id="cidade" required="" placeholder="Ex: Patrocinio Paulista"> 
					</br>
					<div class="alert alert-success text-center" role="alert">A cidade sera incluida no estado e região referente a essa lista.
						<br>Para outros estados e regiões, acesse o menu cidades.</div>
					<button class="btn btn-lg btn-primary" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-lg btn-primary">Inserir</button>
				</form>
			</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Igreja -->
<div class="container-fluid">
  <div class="modal fade" id="Modal_igreja" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="text-uppercase">Igreja</h2>
        </div>
        <div class="modal-body">
        	<div class="row text-center">
        	<div class="col-sm-1"></div>
        	<div class="col-sm-10">
			  	<form method="POST" action="<?=base_url('adm/cadastro-cidade')?>">
					<!--Select regiao-->
					<select class="form-control selectpicker" data-size="2" data-live-search="true" id="igreja" nome="Igreja" data-style="bg-primary" data-title="Selecione a Cidade">
						<?php foreach ($cidades as $cidade): ?>
							<option value="<?=$cidade->id_cidade?>"><?=$cidade->nome_cidade?></option>
						<?php endforeach ?>
					</select>
					<label for="cidade"><h4><strong>Descriçao da Igreja</strong></h4></label>
					<input type="text" class="form-control" name="cidade" id="cidade" required="" placeholder="Ex: Vila Nova"> 
					</br>
					<button class="btn btn-lg btn-primary" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-lg btn-primary">Inserir</button>
				</form>
			</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal presbitero -->
<div class="container-fluid">
  <div class="modal fade" id="Modal_presbitero" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="text-uppercase">Presbitero</h2>
        </div>
        <div class="modal-body">
        	<div class="row text-center">
        	<div class="col-sm-1"></div>
        	<div class="col-sm-10">
			  	<form method="POST" action="<?=base_url('adm/cadastro-cidade')?>">
					<!--Select -->
					<label for="funcao"><h4><strong>Função</strong></h4></label>
					<select class="form-control" id="funcao">
						<option value="1">Ancião</option>
						<option value="2">Encarregado Regional</option>
					</select>
					<label for="prebitero"><h4><strong>Nome do Presbitero</strong></h4></label>
					<input type="text" class="form-control" name="presbitero_modal" id="prebitero" required="" placeholder="Ex: Daniel Campos"> 
					</br>
					<button class="btn btn-lg btn-primary" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-lg btn-primary">Inserir</button>
				</form>
			</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<script>
	function buscar_igreja(){
      var cidade = $('#cidade').val();
      if(cidade){
        var url = '<?=base_url('teste?id')?>='+cidade;
        $.get(url, function(dataReturn) {
          $('#load_igreja').html(dataReturn);
        });
      }
    }
</script>
