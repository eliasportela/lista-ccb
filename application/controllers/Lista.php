<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library(['form_validation','upload']);
	} 
	
	public function Register() {

		$nivel_user = 2; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

		$data['success'] = null;
		 
		$this->form_validation->set_rules('data','Data da Lista','required|trim');
    	$this->form_validation->set_rules('regiao','Região','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione uma Região'));

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
			if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é vazio,*/
				$date = date('Y');
				$mes = date('m');
				$data['dataRegister'] = array('data' => $date, 'regiao' => '', 'mes' => $mes);
			}
			else{

				$data['dataRegister'] = $this->input->post();
				//die(var_dump($data['dataRegister']));
				/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar 
				tudo novamente no formulario*/
			}
		}else{
			$dataRegister = $this->input->post();
			$dataModel = array(
				'data_lista' => $dataRegister['data'], 
				'id_regiao' => $dataRegister['regiao'],
				'mes_lista' => $dataRegister['mes'],
				'id_usuario' => $this->session->userdata('id_usuario'));
				
				$res = $this->Crud_model->InsertId('lista',$dataModel);
			
			if($res){ // envio de email para os contatos

				$this->load->library('myemail');
	      		$dados = $dataRegister['regiao'];
				if($this->myemail->EnviarPoRegiao($dados)){
					redirect(base_url('adm/lista-inserir?id='.$res));
				}else{
					$date = date('Y-m-d');
					$data['dataRegister'] = array('data' => $date, 'regiao' => '');
					$data['success'] = null;
					$data['error'] = "Lista cadastrada, porem não foi possivel enviar notificações paras as listas de e-mails!<br><a href=".base_url('adm/lista-inserir?id=$res').">Acessar Lista</a>";		
				}
				
			}else{
				$data['error'] = "Não foi possivel inserir a LIsta";
			}
		}
		//cidades
		$data['regioes'] = $this->Crud_model->ReadAll('regiao');
		//usuarios
		$data['usuarios'] = $this->Crud_model->ReadAll('usuario');

		$header['title'] = "Lista CCB | Listas";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/lista/cadastro-lista',$data);
	    $this->load->view('adm/commons/footer');
		else:
			redirect(base_url('login'));
		endif;

	}

	//pre lista
	public function RegisterPreLista() {

		$nivel_user = 1; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

		$data['success'] = null;
		//$data['usuario'] = $this->session->userdata('id_usuario'));
		 
		$this->form_validation->set_rules('data','Data da Lista','required|trim');
    	$this->form_validation->set_rules('regiao','Região','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione uma Região'));

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
			if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é vazio,*/
				$date = date('Y');
				$mes = date('m');
				$data['dataRegister'] = array('data' => $date, 'regiao' => '', 'mes' => $mes, 'usuario' => '','file' => '');
			}
			else{

				$data['dataRegister'] = $this->input->post();
				die(var_dump($data['dataRegister']));
				/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar 
				tudo novamente no formulario*/
			}
		}else{
			$dataRegister = $this->input->post();

			//Upload da lista
			$this->load->library('upload');
			$path = './uploads/listas/';
			$config['upload_path'] = $path;
			//define os tipos de arquivos suportados
			$config['allowed_types'] = 'pdf|jpg|jpeg|png';
			//define o tamanho máximo do arquivo (em Kb)
			$config['max_size'] = '5000';
			//nome aleatorio
			$config['encrypt_name']  = TRUE;
 			
			//verifica se o path é válido, se não for cria o diretório
			if (!is_dir($path)) {
				mkdir($path, 0777, $recursive = true);
			}
			//Inicializa o método de upload
			$this->upload->initialize($config);
			
			//processa o upload e verifica o status
			if (!$this->upload->do_upload('arquivo')) {
				//MSG DE ERRO
				$data['error'] = $this->upload->display_errors(null,null);
 			} else {
				//recupera os dados da imagem
				$dadosImagem = $this->upload->data();
				$file_name = $dadosImagem['file_name'];

			}

			//die(var_dump($data['error']));

			//enviar ao BD
			$dataModel = array(
				'data_lista' => $dataRegister['data'], 
				'id_regiao' => $dataRegister['regiao'],
				'mes_lista' => $dataRegister['mes'],
				'file_lista' => $file_name,
				'id_remetente' => $this->session->userdata('id_usuario'),
				'id_destinatario' => $dataRegister['usuario']);

				
				$res = $this->Crud_model->InsertId('pre_lista',$dataModel);
			
			if($res){
				//redirect(base_url('adm/lista-inserir?id='.$res));
				$date = date('Y');
				$mes = date('m');
				$data['dataRegister'] = array('data' => $date, 'regiao' => '', 'mes' => $mes, 'usuario' => $this->session->userdata('id_usuario'));
				$data['success'] = "Lista encaminhada!";
				$data['error'] = null;

			}else{
				$data['error'] = "Não foi possivel Encaminhar a lista";
			}
		}
		//cidades
		$data['regioes'] = $this->Crud_model->ReadAll('regiao');
		//usuarios
		$data['usuarios'] = $this->Crud_model->ReadAll('usuario');

		$header['title'] = "Lista CCB | Pré Listas";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/lista/cadastro-pre-lista',$data);
	    $this->load->view('adm/commons/footer');
		else:
			redirect(base_url('login'));
		endif;

	}

	//Gerar lista a partir da pre lista
	public function GerarLista(){

		$nivel_user = 2; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
			
			if ($this->input->get('id') == null) {
				echo "id da pre lista nao passado";
			}
			
			$id_pre_lista = (int)$this->input->get('id');
			
			//recuperar dados da pre lista
			$pre_lista = $this->Crud_model->Read('pre_lista',array('id_pre_lista' => $id_pre_lista));
			//die(var_dump($pre_lista));
			
			$dataModel = array('data_lista' => $pre_lista->data_lista,'id_regiao' => $pre_lista->id_regiao, 'id_usuario' => $this->session->userdata('id_usuario'), 'mes_lista' => $pre_lista->mes_lista, 'file_lista' => $pre_lista->file_lista);
			
			//Gerando Lista
			$res = $this->Crud_model->InsertId('lista',$dataModel);
			
			if ($res) {
				
				//atualiza para falso o fg da pre lista (por ja usou)	
				$dataUpdate = array('fg_ativo' => 0);
				$par = array('id_pre_lista' => $id_pre_lista);
				$this->Crud_model->Update('pre_lista',$dataUpdate,$par);

				//redireciona para a lista cadastrada
				redirect(base_url('adm/lista-inserir?id='.$res));
			
			}else{
				echo "ERRO!!!";
			}


			
		}else{
			redirect(base_url('login'));
		}
	
	}


	public function Listar(){
		
		
	$nivel_user = 1; //Nivel requirido para visualizar a pagina

	if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
		
		#usuarios
		$sql = "SELECT l.id_lista, m.nome_mes, l.data_lista, r.nome_regiao, u.user
				FROM lista l
				INNER JOIN regiao r ON (l.id_regiao = r.id_regiao)
				INNER JOIN mes m ON (m.id_mes = l.mes_lista)
				LEFT OUTER JOIN usuario u ON (l.id_usuario = u.id_usuario)
				WHERE l.fg_ativo = 1 ORDER BY l.id_lista DESC LIMIT 50";

		//consultando
		$data['lista'] = $this->Crud_model->Query($sql);
		

		//die(var_dump($data['users']));
		$header['title'] = "Lista CCB | Listas";
		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/cadastro/lista/listas',$data);
		$this->load->view('adm/commons/footer');
		
			}else{
			redirect(base_url('login'));
		}
	}

	public function Editar(){
		
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

			//validar dados
			$this->form_validation->set_rules('data','Data da Lista','required|trim');
	    	//$this->form_validation->set_rules('regiao','Região','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione uma Região'));

			// Se ainda não foi inserido o formulario
			if ($this->form_validation->run() == FALSE) {
				$data['error'] = validation_errors();

				// Verificando se a validação ainda não ocorreu
				if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é o que vai ser editado*/

					// Verificando se a url passada tem o parametro de consulta				
					if($this->input->get('id') == FALSE){

						//Não havendo o parametro, redireciona a pagina
						redirect(base_url('adm/listas'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$id = (int) $this->input->get('id');
						//formular consulta
						$dataModel = array('id_lista' => $id);
							$sql = "SELECT l.id_lista, l.data_lista, l.mes_lista, r.nome_regiao
							FROM lista l
							inner join regiao r ON (r.id_regiao = l.id_regiao)
							WHERE l.fg_ativo = 1 and l.id_lista = $id";

						$result = $this->Crud_model->Query($sql);

						//die(var_dump($result));
						// Se houver resultado, devolve o array com dados da consulta
						if ($result) {
							$data['dataRegister'] = 
								array(
									'id_lista' => $result[0]->id_lista,
									'data' => $result[0]->data_lista,
									'mes' => $result[0]->mes_lista, 
									'regiao' => $result[0]->nome_regiao);
						}
						//die(var_dump($data['dataRegister']));
					}

				// Se a validação ocorreu e existe erros
				}else{
					/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar tudo novamente no formulario*/
					$result = true;
					$data['dataRegister'] = $this->input->post();
				}

			// Se não existir erros na validação, então insere no banco de dados
			}else{

				$dataRegister = $this->input->post();
				$par = array('id_lista' => $dataRegister['id_lista']);
				$dataModel = array(
					'data_lista' => $dataRegister['data'], 'mes_lista' => $dataRegister['mes']);
				$res = $this->Crud_model->Update('lista',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/listas?cod='.$dataRegister['id_lista']));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario
			$data['meses'] = $this->Crud_model->ReadAll('mes');
			//Cabecalho
			$header['title'] = "Lista CCB | Editar Lista";
			$this->load->view('adm/commons/header',$header);
			
			//Se houver resultados na pesquisa, mostrar a pagina de edicao
			if($result){
				//Buscando os tipos de usuarios
				//$data['_user'] = $this->Crud_model->ReadAll('tipo_user');
				$this->load->view('adm/cadastro/lista/editar-lista',$data);
	
			}else{ // Se não tiver resultado na pesquisa, exibe mensagem de erro (Possivelmente mudou a url)

				$data['mensagem'] = "Não existe dados para essa consulta, verifique o link e tente novamente";
				$data['link'] = "adm/usuarios"; 
				//Mensagem de erro se a url estiver invalida
				$this->load->view('errors/cli/meu_erro',$data);
				}
			
			//Rodape
			$this->load->view('adm/commons/footer');

		else: // Se não estiver logado redireciona para tela de login..
			redirect(base_url('login'));
		endif;

		//Fim da função
	}

	public function Remover(){
		
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tu') <= $nivel_user)) {
			
			//Se a url nao tiver o parametro de consulta
			if ($this->input->get('id') == FALSE) {
				
				//redireciona para outra pagina
				redirect(base_url('adm/listas'));
			
			}else{ // Se estiver tudo ok

				// Id recebe o paramentro da url
				$id = (int) $this->input->get('id');
				$dataModel = array('fg_ativo' => 0);
				$par = array('id_lista' => $id);
				$result = $this->Crud_model->Update('lista',$dataModel,$par);

				//Se ocorrer a remocao
				if ($result) {
					redirect('adm/listas');
				}else{
					die('Erro na Remocao');
				}
			}
		}else{
			redirect(base_url('adm/login'));
		}
	}

	

}