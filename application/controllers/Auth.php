<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
	}

	public function index()
	{
		redirect('Auth/login');
	}
	public function login()
	{
		$this->load->view('Auth/login');
	}
	public function register()
	{
		$this->load->view('Auth/register');
	}
	public function process_login()
	{
		if ($this->model->get_username() != NULL) {
			$cek = $this->model->get_username();
			if (password_verify($this->input->post('password'), $cek->password) == true) {
				$userdata = array(
					'username' => $cek->username,
					'user_id' => $cek->user_id,
					'email' => $cek->email,
					'role' => $cek->role,
					'alamat' => $cek->alamat
				);
				$this->session->set_userdata($userdata);
				switch ($cek->role) {
					case 'admin':
						redirect('Admin');
						break;
					case 'peminjam':
						redirect('Peminjam');
						break;
					case 'petugas':
						redirect('Petugas');
						break;
				}
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Password salah 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
				redirect('Auth/login');
			}
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Username tidak ditemukan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Auth/login');
		}
	}
	public function process_register()
	{
		if ($this->model->get_username() != NULL) {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Username Sudah ada, Silahkan gunakan username lain
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    	</div>');
			redirect('Auth/register');
		} else {
			$this->model->insert_user('peminjam');
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Mendaftar silahkan login 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Auth/login');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Berhasil Log Out
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Auth/login');
	}
}
