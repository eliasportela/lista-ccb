<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class User_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function Save($data) // cadastro do usuario
	{
		$data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
		$res = $this->db->insert('usuario',$data);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}

	public function GetUser($id){
		$sql = "SELECT u.nome, u.img_perfil, u.user, c.nome_cidade, t.ds_tipo_usuario
				FROM usuario u
				INNER JOIN cidade c ON (c.id_cidade = u.id_cidade)
				INNER JOIN tipo_usuario t ON (t.id_tipo_usuario = u.id_tipo_usuario)
				WHERE u.fg_ativo = 1 and u.id_usuario = $id";

		$query = $this->db->query($sql);
		$result	= $query->result();
		
		if($result){
			return $result[0];
		}else{
			return false;
			}
		}

	function UpdateSenha($data,$p)
	{
		$data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
		$this->db->where($p);
		$this->db->update('usuario',$data);
	}

	function Login($data){
		$par = array('user' => $data['user'], 'fg_ativo' => 1);
		$this->db->select('*')->from('usuario')->where($par);
		$results = $this->db->get()->result();
		return $results;
	}


	function Validar($data){
		//die(var_dump($data));
		$this->db->select('*')->from('usuario')->where('id_usuario',$data['id_usuario']);
		$results = $this->db->get()->result();
		return $results;
	}

}