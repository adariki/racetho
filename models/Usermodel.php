<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model {

	public function loginProcess(){
		$query = $this->db->get_where('C013',[
					'UserCode'=>$this->input->post('username'),
					'Password'=>md5($this->input->post('password'))]);
		return $query->row();
	}
}
