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
							<select class="form-control selectpicker" data-size="5" data-live-search="false" id="servico" name="servico" data-style="btn-primary" onchange="mudaServico()">
								<?php foreach ($servicos as $servico): ?>
									<option value="<?=$servico->id_servico?>" <?php if ($servico->id_servico == $dataForm['servico']): echo 'selected'; endif; ?>><?=$servico->nome_servico?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<!--Data-->
						<div class="col-md-2 col-sm-3 text-center">
							<label><h3><strong>Data</strong></h3></label>
							<input type="date" class="form-control" name="data" value="<?=$dataForm['data']; ?>" required autofocus>
						</div>
						<!--Horario-->
						<div class="col-md-1 col-sm-3 text-center">
							<label><h3><strong>Horario</strong></h3></label>
							<select class="form-control selectpicker" data-size="5" data-live-search="false" id="horario" name="horario" data-style="btn-primary">
								<?php foreach ($horarios as $horario): ?>
									<option value="<?=$horario->id_horario?>" <?php if ($horario->id_horario == $dataForm['horario']): echo 'selected'; endif; ?> > <?=date("H:i", strtotime($horario->horario))?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Cidade-->
						<div class="col-md-2 col-sm-3 text-center">
							<label><h3><strong><a href="#" data-toggle="modal" data-target="#Modal_cidade" title="Cadastrar" class="lc">Cidade</a></strong></h3></label>
							<div id="load_cidade">
								<select class="form-control selectpicker" data-size="2" data-live-search="true" id="cidade_sel" name="cidade" data-style="btn-primary" onchange="buscar_igreja('0')">
								<?php foreach ($cidades as $cidade): ?>	
									<option value="<?=$cidade->id_cidade?>" <?php if ($cidade->id_cidade == $dataForm['cidade']): echo 'selected'; endif; ?> > <?=$cidade->nome_cidade?></option>
								<?php endforeach ?>
								</select>
							</div>
						</div>
						<!--Igreja-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><a href="#" id="link_igreja" data-toggle="modal" data-target="#Modal_igreja" title="Cadastrar" class="lc"><strong>Igreja</strong></a></h3></label>
							<div id="load_igreja">
							<select class="form-control selectpicker" data-size="2" data-live-search="true" id="igreja_sel" name="igreja" data-style="btn-primary" data-title="Selecione uma cidade">
								<option value="0">Selecione uma cidade</option>
							</select>
							</div>
						</div>
						<!--Anciao-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><a href="#" data-toggle="modal" data-target="#Modal_presbitero" title="Cadastrar" class="lc"><strong>Ancião </strong></a></h3></label>
							<div id="load_anciao">
								<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao_sel" name="anciao" data-style="btn-primary">
									<?php foreach ($ancioes as $anciao): ?>
										<option value="<?=$anciao->id_presbitero?>" <?php if ($anciao->id_presbitero == 0): echo 'selected'; endif;?> > <?=$anciao->nome?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<!--Encarregado-->
						<div class="col-md-2 col-sm-4 text-center">
							<label><h3><a href="#" data-toggle="modal" data-target="#Modal_presbitero" title="Cadastrar" class="lc"><strong>Encarregado </strong></a></h3></label>
							<div id="load_encarregado">
								<select class="form-control selectpicker" data-size="2" data-live-search="true" id="encarregado_sel" name="encarregado" data-style="btn-primary">
									<?php foreach ($encarregados as $encarregado): ?>
										<option value="<?=$encarregado->id_presbitero?>" <?php if ($encarregado->id_presbitero == 1): echo 'selected'; endif; ?>><?=$encarregado->nome?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<br
					</div>
    				<div class="row">
    					<div class="col-md-12 text-center">
    						<br>
    						<button class="btn btn-xl btn-primary">Inserir</button>
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
	    					<h2><i class="fa fa-list"></i> Lista de Batismo e diversos. <?=$lista['regiao'] . ' - '. $lista['mes'] . ' de ' . $lista['data']?>.</h2>
								<hr>
								<div class="row">
								<div class=" col-sm-6 text-left">
									<a href="<?=base_url('adm/listas')?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
								</div>
								<div class=" col-sm-6 text-right">
									<a href="#" data-toggle="modal" data-target="#Modal_Inserir_file" class="btn btn-primary"><i class="fa fa-file-o"></i> Upload da Lista</a>
									<a href="<?=base_url('adm/cadastro-lista')?>" class="btn btn-primary">Nova Lista <i class="fa fa-plus"></i></a>
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
				    			</tr>
				    			<?php
				    			if ($dataRegister): // Verifica se a tabela esta vazia
				    			//die(var_dump($dataRegister));
				    			foreach ($dataRegister as $cultos): ?>
				    			<tr onclick="opcaoCulto(<?=$cultos->id_lista_culto?>)" title="Clique em qualquer lugar para Editar" style="font-size: 120%;font-weight: bold;">
    								<td><h5><?=date("d-m",strtotime($cultos->data))?></h5></td>
				    				<td><h5><?=$cultos->nome_servico?></h5></td>
				    				<td><h5><?=date("H:i", strtotime($cultos->horario))?></h5></td>
				    				<td><h5><?=$cultos->nome_cidade?></h5></td>
				    				<td><h5><?=$cultos->ds_igreja?></h5></td>
				    				<td><h5><?=$cultos->anciao?></h5></td>
				    				<td><h5><?=$cultos->encarregado?></h5></td>
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
			  		<!--Select regiao-->
					<label for="cidade"><h4><strong>Nome da Cidade</strong></h4></label>
					<br>
					<div id="cidade_alert" >
						<div class="alert alert-danger text-center" role="alert">A cidade sera incluida no estado e região referente a essa lista.<br>Para outros estados e regiões, acesse o menu cidades.<br>
						Obs: A igreja central referente a esta cidade, será incluida automaticamente.</div>
					</div>
					<input type="text" class="form-control" name="cidade" id="cidade_nome_cidade" required="" placeholder="Ex: Patrocinio Paulista"> 
					</br>
					<input type="hidden" name="regiao" id="cidade_id_regiao" value="<?=$lista['id_regiao']?>">
					<input type="hidden" name="lista" value="<?=$id_lc?>">
					<button class="btn btn-lg btn-primary" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-lg btn-primary" data-dismiss="modal" id="inserir_cidade">Inserir</button>
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
		  		<!--Select regiao-->
				<div class="alert alert-danger text-center" role="alert">Cuidado!! a Igreja será cadastrada na cidade que está selecionada</div>
				<label for="cidade"><h4><strong>Descriçao da Igreja</strong></h4></label>
				<input type="text" class="form-control" name="igreja" id="igreja_ds_igreja" required="" placeholder="Ex: Vila Nova"> 
				</br>
				<button class="btn btn-lg btn-primary" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-lg btn-primary" data-dismiss="modal" id="inserir_igreja">Inserir</button>
			</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ancaio -->
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
			  		<!--Select -->
			  		<div class="alert alert-info text-center" role="alert">Selecione Primeiramente a Função do Presbítero</div>
					<select class="form-control selectpicker" id="presbitero_id_funcao" name="funcao" data-size="2" data-style="btn-primary" title="Selecionar" required>
						<option value="1">Ancião</option>
						<option value="2">Encarregado Regional</option>
					</select>
					<label for="prebitero"><h4><strong>Nome do Presbitero</strong></h4></label>
					<input type="text" class="form-control" name="presbitero_modal" id="presbitero_nome" required="" placeholder="Ex: Daniel Campos" name="nome"> 
					</br>
					<button class="btn btn-lg btn-primary" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-lg btn-primary" id="inserir_presbitero">Inserir</button>
				
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

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
			  		<button class="btn btn-lg btn-primary" id="editarLc" value="0">Editar <i class="fa fa-edit"></i></button>
			  		<button class="btn btn-lg btn-primary" id="removerLc" value="0">Remover <i class="fa fa-remove"></i></button>
				
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

<div class="container-fluid">
  <div class="modal fade" id="Modal_Inserir_file" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
      	<form method="POST" action="" id="inserirFile">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>Inserir Lista Digitalizada</h4>
        </div>
        <div class="modal-body">
        	<div class="row text-center">
        		<div class="col-sm-1"></div>
        		<div class="col-sm-10">	
			  		<!--Select -->
			  		<div class="alert alert-info text-center" role="alert">
			  			Os arquivos devem ser nos formatos (pdf, png, jpg, jpeg). Se tiver mais de uma foto procure agrupar em um arquivo PDF.   
			  		</div>
			  		<div class="text-center">
			  			<label for="file">Selecionar Arquivo</label>
			  			<input type="file" class="form-control" name="file" id="file" required>
			  		</div>
			  		<br>
			  		<?php if ($lista['file']): ?>
			  		<label>Lista Inserida</label>
		  			<div class="list-group">
					  <a href="<?=base_url('/uploads/listas/'.$lista['file'])?>" target="_blank" class="list-group-item"><i class="fa fa-file"></i> - Arquivo da lista <span class="pull-right" style="vertical-align: middle;"> Visualizar</span></a>
					</div>
			  		<?php endif ?>
					<input type="hidden" name="file_id_lista" id="file_id_lista" value="<?=$lista['id_lista']?>"> 
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
			<button class="btn btn-primary pull-right" id="inserir_presbitero" type="submit">Inserir Arquivo</button>
		</div>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="modal fade" id="Modal_Load" role="dialog">
    <div class="modal-dialog" style="width: 20vw">
      <!-- Modal content-->
      <div class="modal-content text-center">
        <div class="modal-body">
       		<i class="fa fa-spinner fa-spin fa-3x"></i> 
       		<h5 class="text-uppercase">Enviando..</h5>	
		</div>
      </div>
    </div>
  </div>
</div>




<script src="<?=base_url('assets/js/adm/lista-culto2.js')?>"></script>


