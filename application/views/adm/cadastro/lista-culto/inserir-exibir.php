    <section class="bg-white">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-lg-12">
    				<br>
					<div class="row text-center">
						<h2><i class="fa fa-list"></i> Cadastrar Lista </h2>
						<hr>
					</div>
					<div clas="row">
						<!--Tipo de Servico-->
						<div class="col-md-1 col-sm-3 text-center">
							<label><h3><strong>Serviço</strong></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="false" id="anciao" nome="anciao" data-style="bg-primary">
								<?php foreach ($servicos as $servico): ?>
									<option value="<?=$servico->id_servico?>"><?=$servico->nome_servico?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Data-->
						<div class="col-md-2 col-sm-3 text-center">
							<label><h3><strong>Data</strong></h3></label>
							<input type="date" class="form-control " name="">
						</div>
						<!--Horario-->
						<div class="col-md-1 col-sm-3 text-center">
							<label><h3><strong>Horario</strong></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="false" id="anciao" nome="anciao" data-style="bg-primary">
								<?php foreach ($horarios as $horario): ?>
									<option value="<?=$horario->id_horario?>"><?=date("H:i", strtotime($horario->horario))?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Cidade-->
						<div class="col-md-2 col-sm-3 text-center">
							<label><h3><strong>Cidade </strong><a href="#" data-toggle="modal" data-target="#cidade"><i class="fa fa-external-link" title="Cadastrar Cidade"></i></a></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao" nome="anciao" data-style="bg-primary">
								<?php foreach ($cidades as $cidade): ?>
									<option value="<?=$cidade->id_cidade?>"><?=$cidade->nome_cidade?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Igreja-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><strong>Igreja </strong><a href="#" data-toggle="modal" data-target="#igreja"><i class="fa fa-external-link" title="Cadastrar Igreja"></i></a></h3></label>
							<select class="form-control" id="anciao" nome="anciao" data-style="bg-primary">
								<?php foreach ($igrejas as $igreja): ?>
									<option value="<?=$igreja->id_igreja?>"><?=$igreja->ds_igreja?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Anciao-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><strong>Ancião </strong><a href="#" data-toggle="modal" data-target="#presbitero"><i class="fa fa-external-link" title="Cadastrar Anciao"></i></a></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao" nome="anciao" data-style="bg-primary">
								<?php foreach ($ancioes as $anciao): ?>
									<option value="<?=$anciao->id_presbitero?>"><?=$anciao->nome?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Encarregado-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><strong>Encarregado </strong><a href="#" data-toggle="modal" data-target="#presbitero"><i class="fa fa-external-link" title="Cadastrar Encarregado"></i></a></h3></label>
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao" nome="anciao" data-style="bg-primary">
								<?php foreach ($encarregados as $encarregado): ?>
									<option value="<?=$encarregado->id_presbitero?>"><?=$encarregado->nome?></option>
								<?php endforeach ?>
							</select>
						</div>
						<br
					</div>
    				<div class="row">
    					<div class="col-md-12 text-center">
    						<br>
    						<button class="btn btn-xl bg-primary">Inserir</button>
    					</div>
    				</div>
    			</div>
    		</div>
			<div class="row">
	    		<div class="col-lg-12">
	    			<div class="row">
	    				<div class="col-md-1"></div>
	    				<div class="col-md-10 text-center">
	    					<h2><i class="fa fa-list"></i> Lista de Batismo e diversos. <?=$lista['regiao']?>. <?=date("d-m-Y", strtotime($lista['data']))?>.</h2>
				    		<table class="table table-responsive table-hover">
				    			<tr>
				    				<th><h4 class="text-center"><strong>Data</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Serviço</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Horario</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Cidade</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Igreja</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Anciao</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Encarregado</strong></h4></th>
				    				<th><h4 class="text-center"><strong>Opção</strong></h4></th>
				    			</tr>
				    			<?php
				    			if ($dataRegister): // Verifica se a tabela esta vazia
				    			die(var_dump($dataRegister));
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
				    					<a href="#"><i class="fa fa-edit fa-2x"></i></a> 
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
  <div class="modal fade" id="cidade" role="dialog">
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
  <div class="modal fade" id="igreja" role="dialog">
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
					<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao" nome="anciao" data-style="bg-primary" data-title="Selecione a Cidade">
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
  <div class="modal fade" id="presbitero" role="dialog">
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
					<input type="text" class="form-control" name="cidade" id="prebitero" required="" placeholder="Ex: Daniel Campos"> 
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