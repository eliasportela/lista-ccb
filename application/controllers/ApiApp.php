<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

class ApiApp extends CI_Controller {
	function __construct(){
		parent::__construct();	
	} 

	// Funcao Ajax para retornar as igrejas de acordo com a cidade
	public function ListarRegioes(){
	// retornara de acordo com a cidade do select input
		$sql = "SELECT r.id_regiao, r.nome_regiao, e.sigla_estado FROM regiao r INNER JOIN estado e ON (e.id_estado = r.id_estado) WHERE r.fg_ativo = 1";
		$resultado = $this->Crud_model->Query($sql);
		$json = json_encode($resultado,JSON_UNESCAPED_UNICODE);
		echo $json;
	}

	// 
	public function ListarEstados(){
	//
		$dia_pesquisa = date('Y-m-d');
		 
		$sql = "SELECT e.id_estado, e.nome_estado,e.sigla_estado FROM lista l INNER JOIN lista_cultos lc ON (lc.id_lista = l.id_lista) INNER JOIN regiao r ON (r.id_regiao = l.id_regiao) INNER JOIN estado e ON (e.id_estado = r.id_estado) WHERE lc.fg_ativo = 1 AND l.fg_ativo = 1 AND lc.data > '$dia_pesquisa' GROUP BY e.id_estado";
		$resultado = $this->Crud_model->Query($sql);
		$json = json_encode($resultado,JSON_UNESCAPED_UNICODE);
		echo $json;
	}

	public function ListarCidades(){
		
		$id_estado = (int)$this->input->get('id');
		
		if($id_estado == NULL) {
			echo "Parametros incorretos";
		}
		else{
			$sql = "SELECT c.id_cidade, c.nome_cidade FROM cidade c INNER JOIN regiao r ON (c.id_regiao = r.id_regiao) 
			INNER JOIN estado e ON (e.id_estado = r.id_estado) WHERE e.id_estado = $id_estado and c.fg_ativo = 1";
			$resultado = $this->Crud_model->Query($sql);
			$json = json_encode($resultado,JSON_UNESCAPED_UNICODE);
			echo $json;
		}
	}

	public function ListarPerId(){
		
		$id_lista = (int)$this->input->get('id');
		
		if($id_lista == NULL) {
			echo "Parametros incorretos";
		}
		else{
			$sql = "SELECT l.id_lista, l.data_lista, m.nome_mes, l.file_lista, r.id_estado, r.nome_regiao FROM lista l 
			left outer JOIN regiao r ON (r.id_regiao = l.id_regiao) 
			INNER JOIN mes m ON (m.id_mes = l.mes_lista) 
			where l.id_lista = $id_lista and l.fg_ativo = 1 order by l.id_lista desc limit 1";

			$resultado = $this->Crud_model->Query($sql);
			$json = json_encode($resultado,JSON_UNESCAPED_UNICODE);
			echo $json;
		}
	}

	public function ListasPerCidade(){

		$id_cidade = (int)$this->input->get('id');
		$dia_pesquisa = date('Y-m-d');

		if ($id_cidade == NULL) {
			$this->output->set_status_header('400');
		}

		else {
			
			$sql = "SELECT DATE_FORMAT(lc.data, '%d-%m') as data, lc.id_servico, ts.nome_servico, c.nome_cidade, i.ds_igreja, h.horario, a.nome AS anciao, e.nome AS encarregado FROM lista_cultos lc INNER JOIN lista l ON (l.id_lista = lc.id_lista) INNER JOIN regiao r ON (r.id_regiao = l.id_regiao) INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade) INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja) INNER JOIN horario h ON (h.id_horario = lc.id_horario) INNER JOIN tipo_servico ts ON (ts.id_servico = lc.id_servico) INNER JOIN presbitero a ON (a.id_presbitero = lc.id_presbitero) INNER JOIN presbitero e ON (e.id_presbitero = lc.id_encarregado) WHERE lc.fg_ativo = 1 AND lc.data > '$dia_pesquisa' and lc.id_cidade = $id_cidade";

				$resultado = $this->Crud_model->Query($sql);

				if($resultado){
					$json = json_encode($resultado,JSON_UNESCAPED_UNICODE);
					echo $json;	
				}else{
					$this->output->set_status_header('400');
				}
				
		}
	}

	
	public function Lista() {

		$id_cidade = (int)$this->input->get('id');
		$id_lista = (int)$this->input->get('lista');
		$dia_pesquisa = date('Y-m-d');
		
		if($id_cidade == 0) {

			if ($id_lista) {

				$sql = "SELECT DATE_FORMAT(lc.data, '%d-%m') as data, lc.id_lista_culto, lc.id_servico, s.nome_servico, c.nome_cidade, i.ds_igreja FROM lista_cultos lc INNER JOIN lista l ON (l.id_lista = lc.id_lista) INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade) INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja) INNER JOIN tipo_servico s ON (s.id_servico = lc.id_servico) WHERE lc.fg_ativo = 1 AND lc.data > '$dia_pesquisa' and l.id_lista = $id_lista";

				$resultado = $this->Crud_model->Query($sql);
				
				if (!$resultado){
					$this->output->set_status_header('400');
				}else {
					$json = $resultado;
					echo json_encode($json,JSON_UNESCAPED_UNICODE);
				}

			}
		}

		elseif($id_cidade > 0) {

			$sql = "SELECT id_regiao from cidade where id_cidade = $id_cidade";

			$id_regiao = $this->Crud_model->Query($sql);
			$id_regiao = $id_regiao[0]->id_regiao;

			$sql = "SELECT l.id_lista, l.data_lista, m.nome_mes, l.file_lista, r.nome_regiao FROM lista l 
			INNER JOIN regiao r ON (r.id_regiao = l.id_regiao) 
			INNER JOIN mes m ON (m.id_mes = l.mes_lista) 
			where r.id_regiao = $id_regiao and l.fg_ativo = 1 order by l.id_lista desc limit 1";
				
				$resultado = $this->Crud_model->Query($sql);
				
			if (!$resultado){
				$this->output->set_status_header('400');
			}else {
				$json = $resultado;
				echo json_encode($json,JSON_UNESCAPED_UNICODE);
			}
			//Mostra as listas com o id do servico.. {"2":[{"data":"2017-03-13"} ...
		}

		else {
			$this->output->set_status_header('400');
		}
	} 

	//Mostra os cultos q terao no estado
	public function ListasPerCulto() {
		
		$id_estado = (int)$this->input->get('es');

		$dia_pesquisa = date('Y-m-d');

		
		if($id_estado == NULL)  {
			$this->output->set_status_header('400');
		}

		else {
			$sql = "SELECT l.id_lista, l.data_lista, m.nome_mes, r.nome_regiao FROM lista l INNER JOIN lista_cultos lc ON (lc.id_lista = l.id_lista) INNER JOIN regiao r ON (r.id_regiao = l.id_regiao) INNER JOIN mes m ON (m.id_mes = l.mes_lista) WHERE lc.fg_ativo = 1 AND l.fg_ativo = 1 AND lc.data > '$dia_pesquisa' and r.id_estado = $id_estado GROUP BY l.id_lista";
				
				$resultado = $this->Crud_model->Query($sql);
				
			if (!$resultado){
				$this->output->set_status_header('400');
			}else {
				$json = $resultado;
				echo json_encode($json,JSON_UNESCAPED_UNICODE);
			}
			//Mostra as listas com o id do servico.. {"2":[{"data":"2017-03-13"} ...
		}
			
	}

	public function CultoDetalhe() {
		
		$id_culto = (int)$this->input->get('id');
		
		if($id_culto == NULL)  {
			$this->output->set_status_header('400');
		}

		else {
			$sql = "SELECT DATE_FORMAT(lc.data, '%d-%m-%y') as data, ts.nome_servico, lc.id_servico, c.nome_cidade, i.ds_igreja, h.horario, a.nome AS anciao, e.nome AS encarregado
				FROM lista_cultos lc
				INNER JOIN tipo_servico ts ON (ts.id_servico = lc.id_servico)
				INNER JOIN lista l ON (l.id_lista = lc.id_lista)
				INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
				INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade)
				INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja)
				INNER JOIN horario h ON (h.id_horario = lc.id_horario)
				INNER JOIN presbitero a ON (a.id_presbitero = lc.id_presbitero)
				INNER JOIN presbitero e ON (e.id_presbitero = lc.id_encarregado)
				WHERE lc.fg_ativo = 1 AND lc.id_lista_culto = $id_culto";
	
				$resultado = $this->Crud_model->Query($sql);
				
			if (!$resultado){
				$this->output->set_status_header('400');
			}else {
				$json = $resultado;
				echo json_encode($json,JSON_UNESCAPED_UNICODE);
			}
			//Mostra as listas com o id do servico.. {"2":[{"data":"2017-03-13"} ...
		}
			
	}


	public function EnviarEmail()
	{
		
		$dataRegister = $this->input->post();

		$nome = $dataRegister['nome'];
		$email = $dataRegister['email'];

		$assunto = "Voluntários Lista CCB";
		


		if($dataRegister == NULL)  {
			
			$this->output->set_status_header('500');
			

		}else {

			//die(var_dump($dataModel));

			$this->load->library('myemail');
      		$dados = array('nome' => $nome, 'email' => $email, 'assunto' => $assunto);
			if($this->myemail->EnviarEmail($dados)){
				$this->output->set_status_header('200');
			}else{
				$this->output->set_status_header('400');
			}
		}
	}

	public function AssinarEmail()
	{
		
		$dataRegister = $this->input->post();
		
		$dataModel = array ('nome_contato' => $dataRegister['nome'],'email_contato' => $dataRegister['email'],'id_regiao' => $dataRegister['regiao']);

		$nome = $dataRegister['nome'];
		$email = $dataRegister['email'];
		$regiao = $dataRegister['regiao'];
		
		$sql = "SELECT COUNT(1) as i, id_contato, fg_ativo FROM contato WHERE email_contato like '$email'";

		$exist = $this->Crud_model->Query($sql);

		//die(var_dump($exist));
		if($exist[0]->i > 0) {
			
			if($exist[0]->fg_ativo == 0){
				
				$par = array('id_contato' => $exist[0]->id_contato);
				$dataModel = array('fg_ativo' => 1);
				$res = $this->Crud_model->Update('contato',$dataModel,$par);
				
				if ($res) {
					echo "E-mail ativado com sucesso!";
					$this->output->set_status_header('200');
				}else{
					echo "Erro ao enviar requisição. Tente novamente mais tarde!";
					$this->output->set_status_header('400');
				}
			}else{
				echo "O email '".$email."' já se encontra cadastrado.";
				$this->output->set_status_header('400');
				return '';
 			}

 		}else{
					
				$this->load->library('myemail');
				$dados = array("nome" => $nome, "email" => $email);
				if($this->myemail->Cadastrar($dados)){
						$result = $this->Crud_model->Insert('contato',$dataModel);
						echo "Enviamos uma confirmação em seu e-mail!";
						$this->output->set_status_header('200');
				 }else {
						echo "Erro ao enviar requisição. Tente novamente mais tarde!";
						$this->output->set_status_header('400');
				}

		}

	}

}