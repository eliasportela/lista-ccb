<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
			$this->form_validation->set_rules('encarregado','encarregado','required|is_natural_no_zero|trim',array('is_natural_no_zero' => ' Você não selecionou o encarregado'));



			
					// Verificando se a url passada tem o parametro de consulta				
					if($this->input->get('id') == FALSE) {

						//Não havendo o parametro, redireciona a pagina
						redirect(base_url('adm/listas'));
					
					}else{ //Se existir o parametro, faz a consulta no banco de dados
						$id = (int) $this->input->get('id');
						$data['id_lc'] = $id;
						// Buscando novmanete a lista pela id url
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
																'data' => $result->data
																); //
						}else{ //nao havendo, devolve o padrao
						$data['dataForm'] = array ( 
																'servico' => '1',
																'horario' => '3',
																'data' => date('Y-m-d')
																); 
					}
				}
				else{
				// Retorna os dados para o usuario nao precisar digitar tudo novamente
				$data['dataForm'] = $this->input->post();
				}
				//die(var_dump($data['dataForm']));
			}else{
				$dataRegister = $this->input->post();
				
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
			$this->load->view('adm/commons/footer');

		else: // Se não estiver logado redireciona para tela de login..
			redirect(base_url('login'));
		endif;

		//Fim da função
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
						$sql = "SELECT * FROM lista_cultos WHERE id_lista_culto = $id";
						$result = $this->Crud_model->Query($sql);

						// Se houver resultado, devolve o array com dados da consulta
						$data['dataRegister'] = $result[0];
							//die(var_dump($data['dataForm']));

					}

				// Se a validação ocorreu e existe erros
				}else{
					/* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar tudo novamente no formulario*/
					$registro = $this->input->post();
					die("Erro no Formulario, verifique o dados e tente novamente");
				}

			// Se não existir erros na validação, então insere no banco de dados
			}else{

				$dataRegister = $this->input->post();
				$id_lista_culto = $dataRegister['id_lista_culto'];
				$par = array('id_lista_culto' => $id_lista_culto);
				
				$dataModel = array(
					'data' => $dataRegister['data'], 
					'id_lista' => $dataRegister['lista'],
					'id_servico' => $dataRegister['servico'], 
					'id_horario' => $dataRegister['horario'], 
					'id_igreja' => $dataRegister['igreja'], 
					'id_cidade' => $dataRegister['cidade'], 
					'id_presbitero' => $dataRegister['anciao'],
					'id_encarregado' => $dataRegister['encarregado']
					);

				$res = $this->Crud_model->Update('lista_cultos',$dataModel,$par);
				if ($res) {
					redirect(base_url('adm/lista-inserir?id='.$dataRegister['lista']));
				}else{
					$data['error'] = "Erro ao inserir no Banco de dados";
				}
			}

			// Exibir telas para o usuario
						$lista = $data['dataRegister']->id_lista;
						$par = array('id_lista' => $lista);
						$lista = $this->Crud_model->ReadPar('lista',$par);
						
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
						
					

			//Cabecalho
			$header['title'] = "Lista CCB | Editar Culto";
			$this->load->view('adm/commons/header',$header);
			
			//Se houver resultados na pesquisa, mostrar a pagina de edicao
			if($result){
				//Buscando os tipos de usuarios
				//$data['_user'] = $this->Crud_model->ReadAll('tipo_user');
				$this->load->view('adm/cadastro/lista-culto/editar-lc',$data);
	
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

		
	public function Teste(){
		// retornara de acordo com a cidade do select input
		if ($this->input->get('id') == TRUE ) {

			$id_cidade = $this->input->get('id');
			$sql = "SELECT `id_igreja`, `ds_igreja` FROM `igreja` WHERE id_cidade = $id_cidade ORDER BY ds_igreja";
			$resultado = $this->Crud_model->Query($sql);
			
			?>
			<select class="form-control" name="igreja">
			 <?php foreach ($resultado as $igrejas): ?>
				<option value="<?=$igrejas->id_igreja;?>"><?=$igrejas->ds_igreja;?></option>
				<?php endforeach ?>
			</select> <?php
			}
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
