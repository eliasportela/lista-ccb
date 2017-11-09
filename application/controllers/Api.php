<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	} 

	// Funcao Ajax para retornar as igrejas de acordo com a cidade
	public function ListarIgreja(){
		// retornara de acordo com a cidade do select input
		if ($this->input->get('id') == TRUE ) {
			$id_igreja = $this->input->get('ig');
			$id_cidade = $this->input->get('id');
			$sql = "SELECT `id_igreja`, `ds_igreja` FROM `igreja` WHERE id_cidade = $id_cidade ORDER BY ds_igreja";
			$resultado = $this->Crud_model->Query($sql);
			
			?>
			<select class="form-control selectpicker" data-size="2" data-live-search="true" id="igreja_sel" name="igreja" data-style="btn-primary">
			 <?php foreach ($resultado as $igrejas): ?>
				<option value="<?=$igrejas->id_igreja;?>" <?php if ($igrejas->id_igreja == $id_igreja): echo 'selected'; endif;?> ><?=$igrejas->ds_igreja;?></option>
				<?php endforeach ?>
			</select> <?php
		}
	}

	public function ListarCidade(){
		// retornara de acordo com a cidade do select input
		if ($this->input->get('id') == TRUE ) {
			$id_cidade = $this->input->get('ci');
			$id_regiao = $this->input->get('id');
			$par = array('id_regiao' => $id_regiao);
			$resultado = $this->Crud_model->ReadPar('cidade',$par);
			?>
			<select class="form-control selectpicker" data-size="2" data-live-search="true" id="cidade_sel" name="cidade" data-style="btn-primary" data-title="Selecione uma cidade" onchange="buscar_igreja()">
			<?php foreach ($resultado as $cidade): ?>
				<option value="<?=$cidade->id_cidade;?>" <?php if ($cidade->id_cidade == $id_cidade) { echo "selected";}?> ><?=$cidade->nome_cidade;?></option>
				<?php endforeach ?>
			</select>
			<?php
		}
	}

	public function ListarAnciao(){
		// retornara de acordo com a cidade do select input
			$id_funcao = 1;
			if ($this->input->get('id') == TRUE) {
				$presbitero = $this->input->get('id');
			}else {
				$presbitero = 0;
			}
			
			$par = array('id_funcao' => $id_funcao);
			$resultado = $this->Crud_model->ReadPar('presbitero',$par);
			?>
			<select class="form-control selectpicker" data-size="2" data-live-search="true" id="anciao_sel" name="anciao" data-style="btn-primary">
				<?php foreach ($resultado as $anciao): ?>
					<option value="<?=$anciao->id_presbitero?>" <?php if ($anciao->id_presbitero == $presbitero): echo 'selected'; endif;?> > <?=$anciao->nome?></option>
				<?php endforeach ?>
			</select>
			<?php
	}

	public function ListarEncarregado(){
		// retornara de acordo com a cidade do select input
			$id_funcao = 2;

			if ($this->input->get('id') == TRUE) {
				$presbitero = $this->input->get('id');
			}else {
				$presbitero = 0;
			}

			$par = array('id_funcao' => $id_funcao);
			$resultado = $this->Crud_model->ReadPar('presbitero',$par);
			?>
			<select class="form-control selectpicker" data-size="2" data-live-search="true" id="encarregado_sel" name="encarregado" data-style="btn-primary">
				<?php foreach ($resultado as $encarregado): ?>
					<option value="<?=$encarregado->id_presbitero?>" <?php if ($encarregado->id_presbitero == $presbitero): echo 'selected'; endif; ?>><?=$encarregado->nome?></option>
				<?php endforeach ?>
			</select>
			<?php
	}

	public function CadastroIgreja(){
		
		$ds_igreja = $_REQUEST['ds_igreja'];
		$id_cidade = $_REQUEST['id_cidade'];

		$dataModal= array('ds_igreja' => $ds_igreja, 'id_cidade' => $id_cidade);
		$result = $this->Crud_model->InsertId('igreja',$dataModal);

		if ($result) {
			echo $result;
		}else{
			echo "0";
		}
	}

	public function CadastroPresbitero(){
		
		$nome_presbitero = $_REQUEST['nome_presbitero'];
		$id_funcao = $_REQUEST['id_funcao'];

		$dataModal= array('nome' => $nome_presbitero, 'id_funcao' => $id_funcao);
		$result = $this->Crud_model->InsertId('presbitero',$dataModal);

		if ($result) {
			echo $result;
		}else{
			echo "0";
		}
	}

	public function CadastroCidade(){
		
		$nome_cidade = $_REQUEST['nome_cidade'];
		$id_regiao = $_REQUEST['id_regiao'];

		$dataModal= array('nome_cidade' => $nome_cidade, 'id_regiao' => $id_regiao);
		$result = $this->Crud_model->InsertId('cidade',$dataModal);

		if ($result) {
			$dataModal = array('ds_igreja' => 'Central', 'id_cidade' => $result);
			$res = $this->Crud_model->InsertId('igreja',$dataModal);
			echo $result;
		}else{
			echo "0";
		}

		/*
		$this->form_validation->set_rules('cidade','Nome da cidade','required|min_length[4]|trim');
		$this->form_validation->set_rules('regiao','Região','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione uma Região'));
		$res = $this->form_validation->run();

		$res = validation_errors();



		
		if ($res == false) {
			
			$cidade = $this->input->post('cidade');
			$regiao = $this->input->post('regiao');
			$lista = $this->input->post('lista');

			$dataModal = array('nome_cidade' => $cidade, 'id_regiao' => $regiao);
			$res = $this->Crud_model->Insert('cidade',$dataModal);

			if ($res) {
				redirect(base_url('adm/lista-inserir?id='.$lista));
			}else{
				redirect(base_url('adm/lista-inserir?id='.$lista.'&cod=1'));
			}

		}else{
			$lista = $this->input->post('lista');
			redirect(base_url('adm/lista-inserir?id='.$lista.'&cod=1'));
		}
		*/
		
	}

	public function InserirPDF(){

			$dataRegister = $this->input->post('file_id_lista');

			if ($dataRegister == NULL) {
				return 0;
			}

			$this->load->library('upload');
			//define o caminho para salvar as imagens
			$path = './uploads/listas/';
			//Configuração do upload
			//informa o diretorio para salvar as imagens
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

			$imgOld = $this->Crud_model->Read('lista', array('id_lista' => $dataRegister));



			if ($imgOld->file_lista != '') {
				# code...
				$local = './uploads/listas/'.$imgOld->file_lista;
					if(is_file($local)) {
						unlink($local);
					}
			}

			//processa o upload e verifica o status
			if (!$this->upload->do_upload('file')) {
				//Determina o status do header
				$this->output->set_status_header('400');
				//Retorna a mensagem de erro a ser exibida
				echo $this->upload->display_errors(null,null);
			} else {
				//recupera os dados da imagem
				$dadosImagem = $this->upload->data();
				$dataModel = array('file_lista' => $dadosImagem['file_name']);
				$par = array('id_lista' => $dataRegister);
				//paremetro
				$res = $this->Crud_model->Update('lista',$dataModel,$par);
				//Determina o status do header
				$this->output->set_status_header('200');

			}
		}

}