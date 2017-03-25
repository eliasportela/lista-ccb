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

			$id_cidade = $this->input->get('id');
			$sql = "SELECT `id_igreja`, `ds_igreja` FROM `igreja` WHERE id_cidade = $id_cidade ORDER BY ds_igreja";
			$resultado = $this->Crud_model->Query($sql);
			
			?>
			<select class="form-control selectpicker" data-size="2" data-live-search="true" id="igreja_sel" name="igreja" data-style="bg-primary">
			 <?php foreach ($resultado as $igrejas): ?>
				<option value="<?=$igrejas->id_igreja;?>"><?=$igrejas->ds_igreja;?></option>
				<?php endforeach ?>
			</select> <?php
		}
	}

	public function ListarCidade(){
		// retornara de acordo com a cidade do select input
		if ($this->input->get('id') == TRUE ) {

			$id_regiao = $this->input->get('id');
			$par = array('id_regiao' => $id_regiao);
			$resultado = $this->Crud_model->ReadPar('cidade',$par);
			?>
			<select class="form-control selectpicker" data-size="2" data-live-search="true" id="cidade_sel" name="cidade" data-style="bg-primary" data-title="Selecione uma cidade" onchange="buscar_igreja()">
			<?php foreach ($resultado as $cidade): ?>
				<option value="<?=$cidade->id_cidade;?>"><?=$cidade->nome_cidade;?></option>
				<?php endforeach ?>
			</select>
			<?php
		}
	}

	public function CadastroIgreja(){
		$this->form_validation->set_rules('igreja','Igreja','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione uma Cidade'));

	}

	public function CadastroPresbitero(){
		$this->form_validation->set_rules('cidade','Cidade','required|is_natural_no_zero|trim',array('is_natural_no_zero' => 'Selecione uma Cidade'));
		
	}

	public function CadastroCidade(){
		
		$nome_cidade = $_REQUEST['nome_cidade'];
		$id_regiao = $_REQUEST['id_regiao'];

		$dataModal= array('nome_cidade' => $nome_cidade, 'id_regiao' => $id_regiao);
		$result = $this->Crud_model->InsertId('cidade',$dataModal);

		if ($result) {
			$dataModal = array('ds_igreja' => 'Central', 'id_cidade' => $result);
			$res = $this->Crud_model->Insert('igreja',$dataModal);
			echo "1";
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

}