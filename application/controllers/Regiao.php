<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regiao extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	} 
	
	public function Register() {

		$nivel_user = 2; //Nivel requirido para visualizar a pagina

		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

		$data['success'] = null;

		 
		$this->form_validation->set_rules('regiao','Nome da Região','required|min_length[4]|trim');
    	$this->form_validation->set_rules('estado','Estado','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione o Estado da Região'));

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
			if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é vazio,*/
				$data['dataRegister'] = array('estado' => '', 'regiao' => '');	
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
				'nome_regiao' => $dataRegister['regiao'], 
				'id_estado' => $dataRegister['estado']);
				
				$res = $this->Crud_model->Insert('regiao',$dataModel);
			
			if($res){
				$data['error'] = null;
				// os dados voltam vazios novamente depois da confirmação
				$data['dataRegister'] = array('estado' => '', 'regiao' => '');
				$data['success'] = "A Região foi inserida com sucesso";
			}else{
				$data['error'] = "Não foi possivel inserir a Região";
			}
		}
		//cidades
		$data['estados'] = $this->Crud_model->ReadAll('estado');
		$header['title'] = "Lista CCB | Regiões";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/regiao/cadastro-regiao',$data);
	    $this->load->view('adm/commons/footer');
		else:
			redirect(base_url('login'));
		endif;

	}

	public function Listar(){
		
		
	$nivel_user = 1; //Nivel requirido para visualizar a pagina

	if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
		
		#usuarios
		$sql = "SELECT r.id_regiao, r.nome_regiao, e.nome_estado 
				FROM regiao r
				INNER JOIN estado e ON (r.id_estado = e.id_estado)
				WHERE r.fg_ativo = 1 ORDER BY e.nome_estado";
		//consultando
		$data['regioes'] = $this->Crud_model->Query($sql);

		//die(var_dump($data['users']));
		$header['title'] = "Lista CCB | Regiões";
		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/cadastro/regiao/regioes',$data);
		$this->load->view('adm/commons/footer');
		
			}else{
			redirect(base_url('login'));
		}
	}

	public function Editar(){
		
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

			//validar dados
			$this->form_validation->set_rules('regiao','Nome da Região','required|min_length[4]|trim');
	    	$this->form_validation->set_rules('estado','Estado','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione o Estado da Região'));

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
						redirect(base_url('adm/regioes'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$id = (int) $this->input->get('id');
						//formular consulta
						$dataModel = array('id_regiao' => $id);
						
						$result = $this->Crud_model->Read('regiao',$dataModel);

						
						// Se houver resultado, devolve o array com dados da consulta
						if ($result) {
							$data['dataRegister'] = 
								array(
									'id_regiao' => $result->id_regiao,
									'estado' => $result->id_estado,
									'regiao' => $result->nome_regiao);
							$data['estados'] = $this->Crud_model->ReadAll('estado'); 
						}
						//die(var_dump($data['dataRegister']));
					}

				// Se a validação ocorreu e existe erros
				}else{
					/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar tudo novamente no formulario*/
					$result = true;
					$data['dataRegister'] = $this->input->post();
					$data['estados'] = $this->Crud_model->ReadAll('estado');
					//die(var_dump($data['dataRegister']));
				}

			// Se não existir erros na validação, então insere no banco de dados
			}else{

				$dataRegister = $this->input->post();
				$par = array('id_regiao' => $dataRegister['id_regiao']);
				$dataModel = array(
					'nome_regiao' => $dataRegister['regiao'],
					'id_estado' => $dataRegister['estado']);

				$res = $this->Crud_model->Update('regiao',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/regioes?cod=1'));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario

			//Cabecalho
			$header['title'] = "Lista CCB | Regiões";
			$this->load->view('adm/commons/header',$header);
			
			//Se houver resultados na pesquisa, mostrar a pagina de edicao
			if($result){
				//Buscando os tipos de usuarios
				//$data['_user'] = $this->Crud_model->ReadAll('tipo_user');
				$this->load->view('adm/cadastro/regiao/editar-regiao',$data);
	
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
				$par = array('id_regiao' => $id);
				$result = $this->Crud_model->Update('regiao',$dataModel,$par);

				//Se ocorrer a remocao
				if ($result) {
					redirect('adm/regioes?cod=2');
				}else{
					die('Erro na Remocao');
				}
			}
		}else{
			redirect(base_url('adm/login'));
		}
	}

}
