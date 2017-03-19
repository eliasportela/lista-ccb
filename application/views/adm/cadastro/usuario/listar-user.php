        <section>
            <div class="container">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <h2 class="text-center">Usuarios</h2>
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="<?=base_url('adm/cadastro-usuario')?>"><button class="btn btn-xl" id="">Novo Usuário</button></a>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-lg-12">
                        <table class="table">
                            <tr>
                                <th>Nome</th>
                                <th>User</th>
                                <th>Nivel</th>
                                <th>Opção</th>
                            </tr>
                        <?php foreach ($users as $usuarios): ?>
                            <tr>
                                <td><?=$usuarios->nome?></td>
                                <td><?=$usuarios->user;?></td>
                                <td><?=$usuarios->ds_tu;?></td>
                                <td><a href="<?=base_url('adm/editar-usuario?id=' . $usuarios->id_user);?>">
                                        Editar
                                    </a> | 
                                    <a onclick="return confirm('Deseja realmente excluir esse usuário?');" href="<?=base_url('adm/remover-usuario?id=' . $usuarios->id_user);?>">
                                        Remover
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                         </table>

                        </div>
                    </div>  
                </div>
            </section>