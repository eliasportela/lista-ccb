<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigo extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		$this->load->view('php/conexao');
		$this->load->view('index');
	}

	public function Profile()
	{
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_usuario'))) : 

		$data['user'] = $this->User_model->GetUser($this->session->userdata('id_usuario'));
		$header['title'] = "Lista CCB"; 

		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/user/profile', $data);
		$this->load->view('commons/footer');
		
		else:
			redirect(base_url('adm/login'));
		endif;
	}
}
