<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListaCulto extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	} 
	

	public function Register(){
		
		
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
					if($this->input->get('id') == FALSE) {

						//Não havendo o parametro, redireciona a pagina
						redirect(base_url('adm/listas'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$id = (int) $this->input->get('id');
						
						// Buscando a lista pela id
						$sql = "SELECT l.data_lista, r.nome_regiao, l.id_regiao
							FROM lista l
							INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
							WHERE l.id_lista = $id";
						$lista = $this->Crud_model->Query($sql);

						// Se a url estiver correta
						if($lista){ 
							$data['lista'] = array('data' => $lista[0]->data_lista, 'regiao' => $lista[0]->nome_regiao);
						//die(var_dump($data['lista']));
						}else{ // nao estando redireciona para a page
							redirect(base_url('adm/listas'));
						}
						//formular consulta
						$sql = "SELECT l.id_lista_culto, i.ds_igreja, l.data, c.nome_cidade, h.horario, s.nome_servico, p.nome as anciao, ec.nome as encarregado
							FROM lista_cultos l 
							INNER JOIN lista lt ON (lt.id_lista = l.id_lista)
							INNER JOIN tipo_servico s ON (s.id_servico = l.id_servico)
							INNER JOIN horario h ON  (h.id_horario = l.id_horario)
							INNER JOIN igreja i ON (i.id_igreja = l.id_igreja)
							INNER JOIN cidade c ON (c.id_cidade = l.id_cidade)
							INNER JOIN presbitero p ON(p.id_presbitero = l.id_presbitero)
							INNER JOIN presbitero ec ON (ec.id_presbitero = l.id_encarregado)
							WHERE l.id_lista = $id AND l.fg_ativo = 1 ORDER BY l.id_servico";

						$result = $this->Crud_model->Query($sql);
						
						if ($result){ // Havendo resultado, é inserido os dados na variavel
							$data['dataRegister'] = $result;
						}else{ // Nao havendo, devolve null
							$data['dataRegister'] = FALSE; 
						}
						
						//Cidades
						$par = array('id_regiao' => $lista[0]->id_regiao);
						$data['cidades'] = $this->Crud_model->ReadPar('cidade',$par);
						
						//Igreja
						$data['igrejas'] = $this->Crud_model->ReadAll('igreja');
						
						//Anciao
						$par1 = array('id_funcao' => 1);
						$data['ancioes'] = $this->Crud_model->ReadPar('presbitero',$par1);
						
						//Encarregado
						$par2 = array('id_funcao' => 2);
						$data['encarregados'] = $this->Crud_model->ReadPar('presbitero',$par2);
						
						//Horario
						$data['horarios'] = $this->Crud_model->ReadAll('horario');
						
						//Tipo Servico
						$data['servicos'] = $this->Crud_model->ReadAll('tipo_servico');
						
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
				$par = array('id_igreja' => $dataRegister['id_lista_culto']);
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
			$this->load->view('adm/cadastro/lista-culto/inserir-exibir',$data);
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
