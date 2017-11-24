<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('Usermodel');
	}
	public function login(){
		if($this->session->userdata('username')) redirect('Home');
		$this->load->view('login');
	}

	public function proses(){
		$query = $this->Usermodel->loginProcess();
		if($query){
			$this->session->set_userdata(['username'=>$query->UserCode,'sts'=>1]);
			redirect('Home');
		}else{
			$this->session->set_flashdata('error_message','Username/Password Salah');
			redirect('User/login');
		}

	}

	public function logout(){
		$this->session->sess_destroy();
			redirect('User/login');

	}
}
