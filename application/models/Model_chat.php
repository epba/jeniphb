<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_chat extends CI_Model {

	function getAll($where="")
	{
		if($where) $this->db->where($where);
		$this->db->order_by("time","ASC");
		return $this->db->get("chat");
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert("chat");
	}
	
	function getLastId($where){
		return $this->db->where($where)->order_by("chat_id","DESC")->limit(1)->get("chat")->row_array();
	}
}
