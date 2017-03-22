        <section>
            <div class="container">
                    <div class="row">
                        <div class="col-lg-12"> 
                             <h2 class="text-center"><i class="fa fa-user"></i> Usuários</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class=" col-sm-6 text-left">
                        <a href="<?=base_url('profile#menu')?>" class="btn bg-primary"><i class="fa fa-chevron-left"></i> Voltar</a>
                      </div>
                      <div class=" col-sm-6 text-right">
                        <a href="<?=base_url('adm/cadastro-usuario')?>" class="btn bg-primary">Novo Usuario <i class="fa fa-plus"></i></a>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                        <table class="table table-hover table-responsive text-center">
                            <tr>
                              <th><h4 class="text-center"><strong>Nome</strong></h4></th>
                                <th><h4 class="text-center"><strong>User</strong></h4></th>
                                <th><h4 class="text-center"><strong>Nivel</strong></h4></th>
                                <th><h4 class="text-center"><strong>Opção</strong></h4></th>
                            </tr>
                        <?php foreach ($users as $usuarios): ?>
                            <tr>
                                <td><?=$usuarios->nome?></td>
                                <td><?=$usuarios->user;?></td>
                                <td><?=$usuarios->ds_tipo_usuario;?></td>
                                <td><a href="<?=base_url('adm/editar-usuario?id='.$usuarios->id_usuario)?>"><i class="fa fa-edit fa-2x" title="Editar Usuario"></i></a> | <a href="<?=base_url('adm/remover-usuario/?id='.$usuarios->id_usuario)?>"><i class="fa fa-remove fa-2x" title="Remover Usuario"></i></a></td>
                            </tr>
                            <?php endforeach ?>
                         </table>

                        </div>
                    </div>  
                </div>
            </section>