<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET");

class ListaCulto extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	} 
	

	public function Register() {
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

			//validar dados
			
			$this->form_validation->set_rules('data','Data do Serviço de culto','required|trim');
	    	$this->form_validation->set_rules('servico','Servico','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Cidade'));
			$this->form_validation->set_rules('horario','horario','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou o horario'));
			$this->form_validation->set_rules('cidade','Cidade','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Cidade'));
			$this->form_validation->set_rules('igreja','igreja','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a igreja'));
			$this->form_validation->set_rules('anciao','anciao','required|trim',array('is_natural_no_zero' => ' Você não selecionou o anciao'));


			
					// Verificando se a url passada tem o parametro de consulta				
					if($this->input->get('id') == FALSE) {

						//Não havendo o parametro, redireciona a pagina
						redirect(base_url('adm/listas'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$cod = (int) $this->input->get('cod');

						$id = (int) $this->input->get('id');
						$data['id_lc'] = $id;
						// Buscando novmanete a lista pela id url
						$sql = "SELECT l.id_lista, l.data_lista, r.id_regiao, r.nome_regiao, l.id_regiao, m.nome_mes, l.file_lista
							FROM lista l
							INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
							INNER JOIN mes m ON (m.id_mes = l.mes_lista)
							WHERE l.id_lista = $id";
						$lista = $this->Crud_model->Query($sql);

						// Se a url estiver correta
						if($lista){ 
							$data['lista'] = array('id_lista' => $lista[0]->id_lista,'data' => $lista[0]->data_lista, 'regiao' => $lista[0]->nome_regiao, 'id_regiao' => $lista[0]->id_regiao, 'mes' => $lista[0]->nome_mes, 'file' => $lista[0]->file_lista);
						//die(var_dump($lista));
						}else{ // nao estando redireciona para a page
							redirect(base_url('adm/listas'));
						}
						

						//formular consulta para o input
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
						//die(var_dump($data['dataRegister']));
						// Os passos seguintes irao buscar os dados para os selects do formulario
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
			
		// Se a validacao do formulario conter erros, ira retonar os erros para o usuario
			if ($this->form_validation->run() == FALSE) {
				$data['error'] = validation_errors();
				if ($data['error'] == NULL) {
				/* Se a validação do dados ainda nao ocorreu, entao o que retorna 
				no formulario é vazio,*/
					//aqui vira o array do formulario vazio ou algum algoritmo que facilitara a insercao do usuario
					$sql = "SELECT MAX(id_lista_culto) as id_lista_culto FROM lista_cultos WHERE id_lista = $id"; //Faço um select do ultimo culto inserido nessa lista
					$result = $this->Crud_model->Query($sql);
					$par = array ('id_lista_culto' => $result[0]->id_lista_culto); // Jogo para uma variavel para ser parametro
					$result = $this->Crud_model->Read('lista_cultos',$par); //Busca o culto no banco de dados
					if($result){ //se houver resultado, entao pega o ultimo id
							$data['dataForm'] = array ( 
											'servico' => $result->id_servico,
											'horario' => $result->id_horario,
											'data' => $result->data,
											'cidade' => $result->id_cidade
											); //
						}else{ //nao havendo, devolve o padrao
						$sql = "SELECT MIN(c.id_cidade) as id_cidade from lista l INNER JOIN cidade c ON (c.id_regiao = l.id_regiao) WHERE l.id_regiao = 1";
						$result = $this->Crud_model->Query($sql);
						$data['dataForm'] = array ( 
											'servico' => '1',
											'horario' => '3',
											'data' => date('Y-m-d'),
											'cidade' => $result[0]->id_cidade
											); 
					}
					if ($this->input->get('cod') == 1) {
						$data['error'] = "Não foi possivel realizar o cadastro";
					}
				}
				else{
				// Retorna os dados para o usuario nao precisar digitar tudo novamente
				$data['dataForm'] = $this->input->post();
				}
			}else{
				$dataRegister = $this->input->post();
				//die(var_dump($dataRegister));
				if(!isset($dataRegister['encarregado'])){
					$dataRegister['encarregado'] = '1';
				}
				$dataModel = array(
					'data' => $dataRegister['data'], 
					'id_lista' => $id,
					'id_servico' => $dataRegister['servico'], 
					'id_horario' => $dataRegister['horario'], 
					'id_igreja' => $dataRegister['igreja'], 
					'id_cidade' => $dataRegister['cidade'], 
					'id_presbitero' => $dataRegister['anciao'],
					'id_encarregado' => $dataRegister['encarregado']
					);
				
				$res = $this->Crud_model->Insert('lista_cultos',$dataModel);
				if ($res) {
					redirect(base_url('adm/lista-inserir?id='.$id));
				
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario

			//Cabecalho
			$header['title'] = "Lista CCB | Inserir Cultos";
			$this->load->view('adm/commons/header',$header);
			$this->load->view('adm/cadastro/lista-culto/inserir-exibir',$data);
			//$this->load->view('php/lista-culto');
			$this->load->view('adm/commons/footer');

		else: // Se não estiver logado redireciona para tela de login..
			redirect(base_url('login'));
		endif;

		//Fim da função
	}

	public function Editar() {
		
		$nivel_user = 1; //Nivel requirido para visualizar a pagina
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

			//validar dados
			
			$this->form_validation->set_rules('data','Data do Serviço de culto','required|trim');
	    	$this->form_validation->set_rules('servico','Servico','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Cidade'));
			$this->form_validation->set_rules('horario','horario','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou o horario'));
			$this->form_validation->set_rules('cidade','Cidade','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a Cidade'));
			$this->form_validation->set_rules('igreja','igreja','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou a igreja'));
			$this->form_validation->set_rules('anciao','anciao','required|trim',array('is_natural_no_zero' => ' Você não selecionou o anciao'));


			
					// Verificando se a url passada tem o parametro de consulta				
					if($this->input->get('id') == FALSE) {

						//Não havendo o parametro, redireciona a pagina
						redirect(base_url('adm/listas'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						
						$id = (int) $this->input->get('id');
						$data['id_lc'] = $id;
						// Buscando novmanete o culto pela id url
						$par = array ('id_lista_culto' => $id);
						$lista = $this->Crud_model->Read('lista_cultos',$par);
						//die(var_dump($lista));
						// Se a url estiver correta
						if($lista){ 
							$data['dataForm'] = array('data' => $lista->data, 'cidade' => $lista->id_cidade, 'servico' => $lista->id_servico,'horario' => $lista->id_horario,'cidade' => $lista->id_cidade,'anciao' => $lista->id_presbitero,'encarregado' => $lista->id_encarregado);

						//die(var_dump($data['dataForm']));
						}else{ // nao estando redireciona para a page
							redirect(base_url('adm/listas'));
						}
						

						// Os passos seguintes irao buscar os dados para os selects do formulario
						
						//Buscar a regiao desse culto para filtar as cidades do formulario e o modal de insercao de cidade tbm precisa saber qual regiao inserir
						$sql = "SELECT l.id_regiao, l.id_lista from lista l
						INNER JOIN lista_cultos lc ON(l.id_lista = lc.id_lista)
						WHERE lc.id_lista_culto = $id";
						$res = $this->Crud_model->Query($sql);
						$regiao = $res[0]->id_regiao;
						$data['regiao'] = $regiao;

						//buscar a lista do culto para quando o usuario clicar voltar
						$data['lista_current'] = $res[0]->id_lista;
						//die(var_dump($data['lista_current']));
						//Cidades
						$par = array('id_regiao' => $regiao);
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
			
		// Se a validacao do formulario conter erros, ira retonar os erros para o usuario
			if ($this->form_validation->run() == FALSE) {
				$data['error'] = validation_errors();
				if ($data['error'] != NULL) {
				// Retorna os dados para o usuario nao precisar digitar tudo novamente
				$data['dataForm'] = $this->input->post();
				}
			}else{
				$dataRegister = $this->input->post();
				//die(var_dump($dataRegister));
				if(!isset($dataRegister['encarregado'])){
					$dataRegister['encarregado'] = '1';
				}
				$dataModel = array(
					'data' => $dataRegister['data'], 
					'id_lista' => $data['lista_current'],
					'id_servico' => $dataRegister['servico'], 
					'id_horario' => $dataRegister['horario'], 
					'id_igreja' => $dataRegister['igreja'], 
					'id_cidade' => $dataRegister['cidade'], 
					'id_presbitero' => $dataRegister['anciao'],
					'id_encarregado' => $dataRegister['encarregado']
					);
				$par = array('id_lista_culto' => $data['id_lc']);
				$res = $this->Crud_model->Update('lista_cultos',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/lista-inserir?id='.$data['lista_current']));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario

			//Cabecalho
			$header['title'] = "Lista CCB | Editar Cultos";
			$this->load->view('adm/commons/header',$header);
			$this->load->view('adm/cadastro/lista-culto/editar-lc',$data);
			//$this->load->view('php/lista-culto');
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
				redirect(base_url('adm/profile'));
			
			}else{ // Se estiver tudo ok

				// Id recebe o paramentro da url
				$id = (int) $this->input->get('id');
				$dataModel = array('fg_ativo' => 0);
				$par = array('id_lista_culto' => $id);
				$result = $this->Crud_model->Update('lista_cultos',$dataModel,$par);

				//Recuperando lista
				$sql = "SELECT id_lista FROM lista_cultos WHERE id_lista_culto = $id";
				$result = $this->Crud_model->Query($sql);

				//Se ocorrer a remocao
				if ($result) {
					redirect(base_url('adm/lista-inserir?id='.$result[0]->id_lista));
				}else{
					die('Erro na Remocao');
				}
			}
		}else{
			redirect(base_url('adm/login'));
		}
	}

}
