<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Igreja extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	} 
	
	public function Register() {

		$nivel_user = 2; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

		$data['success'] = null;

		 
		$this->form_validation->set_rules('igreja','Descriçao Igreja','required|min_length[4]|trim');
    	$this->form_validation->set_rules('cidade','Cidade','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Cidade'));

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
			if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é vazio,*/
				$data['dataRegister'] = array('igreja' => '', 'cidade' => '');	
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
				'ds_igreja' => $dataRegister['igreja'], 
				'id_cidade' => $dataRegister['cidade']);
				$res = $this->Crud_model->Insert('igreja',$dataModel);

			if($res){
				$data['error'] = null;
				// os dados voltam vazios novamente depois da confirmação
				$data['dataRegister'] = array('cidade' => '', 'igreja' => '');
				$data['success'] = "Igreja inserida com sucesso";
			}else{
				$data['error'] = "Não foi possivel inserir a igreja";
			}
		}
		//cidades
		$data['cidades'] = $this->Crud_model->ReadAll('cidade');
		$header['title'] = "Lista CCB | Igrejas";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/igreja/cadastro-igreja',$data);
	    $this->load->view('adm/commons/footer');
		else:
			redirect(base_url('login'));
		endif;

	}

	public function Listar(){
		
		
	$nivel_user = 1; //Nivel requirido para visualizar a pagina

	if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
		
		#igrejas
		$this->form_validation->set_rules('cidade','Nome da Cidade','required|min_length[4]|trim');

		if($this->form_validation->run() == FALSE){

			$sql = "SELECT i.id_igreja, i.ds_igreja, c.nome_cidade 
				FROM igreja i
				INNER JOIN cidade c ON (c.id_cidade = i.id_cidade)
				WHERE c.fg_ativo = 1 ORDER BY c.id_cidade desc limit 10";

			$data['dataForm'] = ''; //Campo pesqusia vazio

		}else {
			$dataRegister = $this->input->post('cidade');

			$sql = "SELECT i.id_igreja, i.ds_igreja, c.nome_cidade 
				FROM igreja i
				INNER JOIN cidade c ON (c.id_cidade = i.id_cidade)
				WHERE c.fg_ativo = 1  and c.nome_cidade like '%$dataRegister%' ORDER BY c.nome_cidade desc limit 10";
			$data['dataForm'] = $dataRegister; //Campo pesqusia com o que foi pesquisado
		}

		//consultando
		$data['igrejas'] = $this->Crud_model->Query($sql);
		//die(var_dump($data['cidades']));
		$header['title'] = "Lista CCB | Igrejas";
		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/cadastro/igreja/igrejas',$data);
		
			}else{
			redirect(base_url('login'));
		}
	}

	public function Editar(){
		
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

			//validar dados
			
			$this->form_validation->set_rules('igreja','Descriçao Igreja','required|min_length[4]|trim');
	    	$this->form_validation->set_rules('cidade','Cidade','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Cidade'));

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
						redirect(base_url('adm/igrejas'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$id = (int) $this->input->get('id');
						//formular consulta
						$dataModel = array('id_igreja' => $id);
						
						$result = $this->Crud_model->Read('igreja',$dataModel);

						
						// Se houver resultado, devolve o array com dados da consulta
						if ($result) {
							$data['dataRegister'] = 
								array(
									'id_igreja' => $result->id_igreja,
									'igreja' => $result->ds_igreja,
									'cidade' => $result->id_cidade);
							$data['cidades'] = $this->Crud_model->ReadAll('cidade'); 
						}
						//die(var_dump($data['dataRegister']));
					}

				// Se a validação ocorreu e existe erros
				}else{
					/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar tudo novamente no formulario*/
					$result = true;
					$data['dataRegister'] = $this->input->post();
					$data['cidades'] = $this->Crud_model->ReadAll('cidade');
					//die(var_dump($data['dataRegister']));
				}

			// Se não existir erros na validação, então insere no banco de dados
			}else{

				$dataRegister = $this->input->post();
				$par = array('id_igreja' => $dataRegister['id_igreja']);
				$dataModel = array(
					'ds_igreja' => $dataRegister['igreja'],
					'id_cidade' => $dataRegister['cidade']);

				$res = $this->Crud_model->Update('igreja',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/igrejas?cod=1'));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario

			//Cabecalho
			$header['title'] = "Lista CCB | Igrejas";
			$this->load->view('adm/commons/header',$header);
			
			//Se houver resultados na pesquisa, mostrar a pagina de edicao
			if($result){
				$this->load->view('adm/cadastro/igreja/editar-igreja',$data);
	
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
				redirect(base_url('adm/igrejas'));
			
			}else{ // Se estiver tudo ok

				// Id recebe o paramentro da url
				$id = (int) $this->input->get('id');
				$dataModel = array('fg_ativo' => 0);
				$par = array('id_igreja' => $id);
				$result = $this->Crud_model->Update('igreja',$dataModel,$par);

				//Se ocorrer a remocao
				if ($result) {
					redirect('adm/igrejas?cod=2');
				}else{
					die('Erro na Remocao');
				}
			}
		}else{
			redirect(base_url('adm/login'));
		}
	}

}
