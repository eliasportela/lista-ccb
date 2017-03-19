<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Crud_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function Insert($table,$data)
	{
		$res = $this->db->insert($table,$data);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}

	function InsertId($table,$data)
	{
		$res = $this->db->insert($table,$data);
		$id = $this->db->insert_id();
		if ($res) {
			return $id;
		}else{
			return false;
		}
	}

	public function Read($table,$p){
		$this->db->select('*')->from($table)->where($p);
		$result	= $this->db->get()->result();
		if($result){
			return $result[0];
		}else{
			return false;
			}
	}

	public function ReadPar($table,$p){
		$this->db->select('*')->from($table)->where($p);
		$result	= $this->db->get()->result();
		if($result){
			return $result;
		}else{
			return false;
			}
	}

	public function ReadAll($table){
		$this->db->select('*')->from($table)->where('fg_ativo',1);
		$result	= $this->db->get()->result();
		if($result){
			return $result;
		}else{
			return false;
			}
	}

	function Update($table,$data,$p)
	{
		$this->db->where($p);
		$result = $this->db->update($table,$data);
		if($result){
			return true;
		}else{
			return false;
			}
	}

	public function Query($sql){
		$query = $this->db->query($sql);
		$result = $query->result();
		if($result){
			return $result;
		}else{
			return false;
			}
	}

}