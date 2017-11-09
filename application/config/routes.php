<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'User/Login';

$route['resultado'] = 'Exibicao/Pesquisa';
$route['contato'] = 'Exibicao/Contato';
$route['assinatura'] = 'Exibicao/News';
$route['cancelar-assinatura'] = 'Exibicao/Cancelar';
$route['profile'] = 'Exibicao/Profile';

# rotas da area administrativa
#Usuario
$route['login'] = 'User/Login';
$route['logout'] = 'User/Logout';
$route['alterar-senha'] = 'User/UpdatePassw';
$route['profile-editar'] = 'User/EditarMyUser';
$route['profile/recortar'] = 'User/Recortar';
$route['profile/visualizacao'] = 'User/Visualizacao';

$route['adm/usuarios'] = 'User/ListarUser';
$route['adm/cadastro-usuario'] = 'User/Register';
$route['adm/editar-usuario'] = 'User/EditarUser';
$route['adm/remover-usuario'] = 'User/RemoverUser';

$route['adm/listas'] = 'Lista/Listar';
$route['adm/cadastro-lista'] = 'Lista/Register';
$route['adm/cadastro-pre-lista'] = 'Lista/RegisterPreLista';
$route['adm/gerar-lista'] = 'Lista/GerarLista';
$route['adm/editar-lista'] = 'Lista/Editar';
$route['adm/remover-lista'] = 'Lista/Remover'; //Pensar em uma maneira de implementar

$route['adm/regioes'] = 'Regiao/Listar';
$route['adm/cadastro-regiao'] = 'Regiao/Register';
$route['adm/editar-regiao'] = 'Regiao/Editar';
$route['adm/remover-regiao'] = 'Regiao/Remover';

$route['adm/cidades'] = 'Cidade/Listar';
$route['adm/cadastro-cidade'] = 'Cidade/Register';
$route['adm/editar-cidade'] = 'Cidade/Editar';
$route['adm/remover-cidade'] = 'Cidade/Remover';

$route['adm/igrejas'] = 'Igreja/Listar';
$route['adm/cadastro-igreja'] = 'Igreja/Register';
$route['adm/editar-igreja'] = 'Igreja/Editar';
$route['adm/remover-igreja'] = 'Igreja/Remover';

$route['adm/presbiteros'] = 'Presbitero/Listar';
$route['adm/cadastro-presbitero'] = 'Presbitero/Register';
$route['adm/editar-presbitero'] = 'Presbitero/Editar';
$route['adm/remover-presbitero'] = 'Presbitero/Remover';

$route['adm/lista-inserir'] = 'ListaCulto/Register';
$route['adm/lista-editar-servicos'] = 'ListaCulto/Editar';
$route['adm/lista-remover-servicos'] = 'ListaCulto/Remover';

#rotas api
$route['adm/lc/buscar-igreja'] = 'Api/ListarIgreja';
$route['adm/lc/buscar-cidade'] = 'Api/ListarCidade';
$route['adm/lc/buscar-anciao'] = 'Api/ListarAnciao';
$route['adm/lc/buscar-encarregado'] = 'Api/ListarEncarregado';
$route['adm/lc/inserir-presbitero'] = 'Api/CadastroPresbitero';
$route['adm/lc/inserir-igreja'] = 'Api/CadastroIgreja';
$route['adm/lc/inserir-cidade'] = 'Api/CadastroCidade';
$route['adm/lc/inserir-arquivo'] = 'Api/InserirPDF';

#API do aplicatico appListaCCB
$route['app/regioes'] = 'ApiApp/ListarRegioes';
$route['app/lista'] = 'ApiApp/Lista';
$route['app/estados'] = 'ApiApp/ListarEstados';
$route['app/cidades'] = 'ApiApp/ListarCidades';
$route['app/lista-cidade'] = 'ApiApp/ListasPerCidade';
$route['app/lista-culto'] = 'ApiApp/ListasPerCulto';
$route['app/culto-detalhes'] = 'ApiApp/CultoDetalhe';
$route['app/lista-id'] = 'ApiApp/ListarPerId';
$route['app/email'] = 'ApiApp/EnviarEmail';
$route['app/assinar'] = 'ApiApp/AssinarEmail';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
