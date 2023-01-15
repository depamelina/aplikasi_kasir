<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        $this->load->model('Models','m');
    }
	public function index()
	{
		$this->load->view('auth/index');
	}
	
	public function cek_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$select = $this->db->select("*");
		$select = $this->db->where("username",$username);
		$select = $this->db->where("password",$password);
		$cek_login = $this->m->Get_All("user",$select);

		if(count($cek_login)>0){
		foreach ($cek_login as $d){}
			$data = array(
				"username" => $username,
				"nama" => $d->nama,
				"akses" => $d->akses
			);
		
			$this->session->set_userdata($data);
			redirect(base_url().ucfirst($d->akses));
		}else{
			redirect(base_url()."Auth?msg=gagal");
		}

	}

	public function logout()
    {
        session_destroy();
        redirect(base_url()."Auth");
    }
	
}
?>