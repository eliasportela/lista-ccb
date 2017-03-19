<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
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
				$date = date('Y-m-d');
				$data['dataRegister'] = array('data' => $date, 'regiao' => '');	
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
				'id_usuario' => $this->session->userdata('id_usuario'));
				
				$res = $this->Crud_model->Insert('lista',$dataModel);
			
			if($res){
				$data['error'] = null;
				// os dados voltam vazios novamente depois da confirmação
				$date = date('Y-m-d');
				$data['dataRegister'] = array('data' => $date, 'regiao' => '');
				$data['success'] = "Lista Inserida com sucesso";
			}else{
				$data['error'] = "Não foi possivel inserir o Usuário";
			}
		}
		//cidades
		$data['regioes'] = $this->Crud_model->ReadAll('regiao');
		$header['title'] = "Lista CCB | Listas";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/lista/cadastro-lista',$data);
	    $this->load->view('adm/commons/footer');
		else:
			redirect(base_url('login'));
		endif;

	}

	public function Listar(){
		
		
	$nivel_user = 1; //Nivel requirido para visualizar a pagina

	if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
		
		#usuarios
		$sql = "SELECT l.id_lista, l.data_lista, r.nome_regiao, u.user
				FROM lista l
				INNER JOIN regiao r ON (l.id_regiao = r.id_regiao)
				INNER JOIN usuario u ON (l.id_usuario = u.id_usuario)
				WHERE l.fg_ativo = 1 ORDER BY l.data_lista DESC";
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
							$sql = "SELECT l.id_lista, l.data_lista, r.nome_regiao 
							FROM lista l 
							INNER JOIN regiao r ON (l.id_regiao = r.id_regiao)
							WHERE l.fg_ativo = 1 and l.id_lista = $id";

						$result = $this->Crud_model->Query($sql);

						//die(var_dump($result));
						// Se houver resultado, devolve o array com dados da consulta
						if ($result) {
							$data['dataRegister'] = 
								array(
									'id_lista' => $result[0]->id_lista,
									'data' => $result[0]->data_lista,
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
					'data_lista' => $dataRegister['data']);
				$res = $this->Crud_model->Update('lista',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/listas?cod=1'));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario

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
				redirect(base_url('adm/usuarios'));
			
			}else{ // Se estiver tudo ok

				// Id recebe o paramentro da url
				$id = (int) $this->input->get('id');
				$dataModel = array('fg_ativo' => 0);
				$par = array('id_user' => $id);
				$result = $this->Crud_model->Update('usuario',$dataModel,$par);

				//Se ocorrer a remocao
				if ($result) {
					redirect('adm/usuarios');
				}else{
					die('Erro na Remocao');
				}
			}
		}else{
			redirect(base_url('adm/login'));
		}
	}

}
