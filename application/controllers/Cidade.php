<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	} 
	
	public function Register() {

		$nivel_user = 2; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

		$data['success'] = null;

		 
		$this->form_validation->set_rules('cidade','Nome da Cidade','required|min_length[4]|trim');
    	$this->form_validation->set_rules('regiao','Região','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Região'));

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
			if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é vazio,*/
				$data['dataRegister'] = array('regiao' => '', 'cidade' => '');	
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
				'nome_cidade' => $dataRegister['cidade'], 
				'id_regiao' => $dataRegister['regiao']);
				$res = $this->Crud_model->InsertId('cidade',$dataModel);
			// A commum centrar ira ser criada automaticamente da cidade
			$dataModel2 = array(
				'ds_igreja' => 'Central',
				'id_cidade' => $res
				);
				$res = $this->Crud_model->Insert('igreja',$dataModel2);
			if($res){
				$data['error'] = null;
				// os dados voltam vazios novamente depois da confirmação
				$data['dataRegister'] = array('cidade' => '', 'regiao' => '');
				$data['success'] = $dataRegister['cidade']." foi inserido(a) com sucesso, e a igreja central foi criada automaticamente";
			}else{
				$data['error'] = "Não foi possivel inserir a Região";
			}
		}
		//cidades
		$data['regioes'] = $this->Crud_model->ReadAll('regiao');
		$header['title'] = "Lista CCB | Cidades";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/cidade/cadastro-cidade',$data);
	    $this->load->view('adm/commons/footer');
		else:
			redirect(base_url('login'));
		endif;

	}

	public function Listar(){
		
		
	$nivel_user = 1; //Nivel requirido para visualizar a pagina

	if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
		
		$this->form_validation->set_rules('cidade','Nome da Cidade','required|min_length[4]|trim');

		if($this->form_validation->run() == FALSE){

			$sql = "SELECT c.id_cidade, c.nome_cidade, r.nome_regiao 
				FROM cidade c
				INNER JOIN regiao r ON (c.id_regiao = r.id_regiao)
				WHERE c.fg_ativo = 1 ORDER BY c.id_cidade desc limit 10";

				$data['dataForm'] = ''; //Campo pesqusia vazio

		}else {
			$dataRegister = $this->input->post('cidade');

			$sql = "SELECT c.id_cidade, c.nome_cidade, r.nome_regiao 
				FROM cidade c
				INNER JOIN regiao r ON (c.id_regiao = r.id_regiao)
				WHERE c.fg_ativo = 1  and c.nome_cidade like '%$dataRegister%' ORDER BY c.nome_cidade desc limit 10";

			$data['dataForm'] = $dataRegister; //Campo pesqusia com o que foi pesquisado
		}
		//consultando
		$data['cidades'] = $this->Crud_model->Query($sql);

		//die(var_dump($data['cidades']));
		$header['title'] = "Lista CCB | Cidades";
		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/cadastro/cidade/cidades',$data);
		
			}else{
			redirect(base_url('login'));
		}
	}

	public function Editar(){
		
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

			//validar dados
			$this->form_validation->set_rules('cidade','Nome da Cidade','required|min_length[4]|trim');
	    	$this->form_validation->set_rules('regiao','Região','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Região'));

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
						redirect(base_url('adm/cidades'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$id = (int) $this->input->get('id');
						//formular consulta
						$dataModel = array('id_cidade' => $id);
						
						$result = $this->Crud_model->Read('cidade',$dataModel);

						
						// Se houver resultado, devolve o array com dados da consulta
						if ($result) {
							$data['dataRegister'] = 
								array(
									'id_cidade' => $result->id_cidade,
									'cidade' => $result->nome_cidade,
									'regiao' => $result->id_regiao);
							$data['regioes'] = $this->Crud_model->ReadAll('regiao'); 
						}
						//die(var_dump($data['dataRegister']));
					}

				// Se a validação ocorreu e existe erros
				}else{
					/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar tudo novamente no formulario*/
					$result = true;
					$data['dataRegister'] = $this->input->post();
					$data['regioes'] = $this->Crud_model->ReadAll('regiao');
					//die(var_dump($data['dataRegister']));
				}

			// Se não existir erros na validação, então insere no banco de dados
			}else{

				$dataRegister = $this->input->post();
				$par = array('id_cidade' => $dataRegister['id_cidade']);
				$dataModel = array(
					'nome_cidade' => $dataRegister['cidade'],
					'id_regiao' => $dataRegister['regiao']);

				$res = $this->Crud_model->Update('cidade',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/cidades?cod=1'));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario

			//Cabecalho
			$header['title'] = "Lista CCB | Cidades";
			$this->load->view('adm/commons/header',$header);
			
			//Se houver resultados na pesquisa, mostrar a pagina de edicao
			if($result){
				//Buscando os tipos de usuarios
				//$data['_user'] = $this->Crud_model->ReadAll('tipo_user');
				$this->load->view('adm/cadastro/cidade/editar-cidade',$data);
	
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
				redirect(base_url('adm/cidades'));
			
			}else{ // Se estiver tudo ok

				// Id recebe o paramentro da url
				$id = (int) $this->input->get('id');
				$dataModel = array('fg_ativo' => 0);
				$par = array('id_cidade' => $id);
				$result = $this->Crud_model->Update('cidade',$dataModel,$par);

				//Se ocorrer a remocao
				if ($result) {
					redirect('adm/cidades?cod=2');
				}else{
					die('Erro na Remocao');
				}
			}
		}else{
			redirect(base_url('adm/login'));
		}
	}

}
