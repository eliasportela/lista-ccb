<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exibicao extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		$data['regioes'] = $this->Crud_model->ReadAll('regiao');
		$data['servicos'] = $this->Crud_model->ReadAll('tipo_servico');
		$header['title'] = "Lista CCB";
		$this->load->view('index',$data);
	}

	public function Pesquisa()
	{

		//Formulando o algoritmo de pesquisa com as informaçoes do usuario
		$id_servico = $this->input->post('servico');
		$id_regiao = $this->input->post('regiao');
		$dia_pesquisa = date('Y-m-d');

		//Buscando dados para formular tela de busca
		
		$par = array('id_regiao' => $id_regiao);
		$data['regiao'] = $this->Crud_model->Read('regiao',$par);

		// Se for informado um servico em particular 
		if ($id_servico > 0):

		// busca o servico pesquisado
		$par = array('id_servico' => $id_servico);
		$servico = $this->Crud_model->Read('tipo_servico',$par);
		// Codigo sql de consulta ao bd
			$sql = "SELECT lc.data, c.nome_cidade, i.ds_igreja, h.horario, a.nome AS anciao, e.nome AS encarregado
				FROM lista_cultos lc
				INNER JOIN lista l ON (l.id_lista = lc.id_lista)
				INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
				INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade)
				INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja)
				INNER JOIN horario h ON (h.id_horario = lc.id_horario)
				INNER JOIN presbitero a ON (a.id_presbitero = lc.id_presbitero)
				INNER JOIN presbitero e ON (e.id_presbitero = lc.id_encarregado)
				WHERE lc.fg_ativo = 1 AND lc.data >= '$dia_pesquisa' AND r.id_regiao = $id_regiao AND lc.id_servico = $id_servico";

		$result = $this->Crud_model->Query($sql);
		if($result){
			$servicos[0] = array('nome_servico' => $servico->nome_servico, 'id_servico' => $id_servico, 0 => $result);
			$data['cultos'] = $servicos;
		}else{
			$servicos[0] = array('nome_servico' => $servico->nome_servico, 'id_servico' => $id_servico, 0 => null);
			$data['cultos'] = $servicos;
		}
		//die(var_dump($data['cultos']));

		// se nao for informado o servico mostra todos os servcos
		else:
			// o id_servico comeca no 1 e sao 6 servicos
			$cont = 1;
			$cont2 = 0;
			while($cont <= 6){ //
				//codigo de consulta
				$sql = "SELECT lc.data, lc.id_servico, c.nome_cidade, i.ds_igreja, h.horario, a.nome AS anciao, e.nome AS encarregado
				FROM lista_cultos lc
				INNER JOIN lista l ON (l.id_lista = lc.id_lista)
				INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
				INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade)
				INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja)
				INNER JOIN horario h ON (h.id_horario = lc.id_horario)
				INNER JOIN presbitero a ON (a.id_presbitero = lc.id_presbitero)
				INNER JOIN presbitero e ON (e.id_presbitero = lc.id_encarregado)
				WHERE lc.fg_ativo = 1 AND lc.data >= '$dia_pesquisa' AND r.id_regiao = $id_regiao AND lc.id_servico = $cont"; //contador que ira fazer a pesquisa

				$result = $this->Crud_model->Query($sql);

				if ($result) { //se tiver resultado, entao faz a pesquisa do servico de culto, monta o array, sendo q a montagem somente sera realizada com os servicos que tiverem cadastros
					$par = array('id_servico' => $cont);
					$servico = $this->Crud_model->Read('tipo_servico',$par);
					$servicos[$cont2] = array('nome_servico' =>$servico->nome_servico, 'id_servico' => $id_servico, $cont2 => $result);
					$cont2++;
				}

				$cont++;
			}

			//die(var_dump($servicos));
			$data['cultos'] = $servicos;
			endif;

		$this->load->view('commons/header'); 
		$this->load->view('page-principal/pesquisa',$data); 
	}

	public function Profile()
	{
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_usuario'))): 

		$data['user'] = $this->User_model->GetUser($this->session->userdata('id_usuario'));
		$header['title'] = "Lista CCB"; 

		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/user/profile', $data);
		$this->load->view('commons/footer');
		
		else:
			redirect(base_url('login'));
		endif;
	}

	public function Contato()
	{
		
		$header['title'] = "Lista CCB | Contato"; 

		$this->load->view('commons/header',$header);
		$this->load->view('page-principal/contato');
		$this->load->view('commons/footer',$header);
		
	}


}
