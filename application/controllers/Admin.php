<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		if ($this->session->userdata('role') != 'admin') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Salah tempat banggg
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Auth');
		}
	}
	public function index()
	{
		$data['title'] = 'Dashboard | Admin';
		$this->template->load('template_admin', 'Admin/home', $data);
	}
	public function user()
	{
		$data = array(
			'title' => 'List User | Admin',
			'user' => $this->model->get_user()
		);
		$this->template->load('template_admin', 'Admin/user', $data);
	}
	public function insert_user()
	{
		if ($this->model->get_username() != NULL) {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Username sudah dipakai
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/user');
		} else {
			$this->model->insert_user($this->input->post('role'));
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menambahkan user baru
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/user');
		}
	}
	public function delete_user($id)
	{
		$this->model->delete_user($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menghapus user
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Admin/user');
	}
	public function update_user()
	{
		if (!empty($_POST['password'])) {
			$this->model->update_user(password_hash($this->input->post('password'),PASSWORD_BCRYPT));
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update user
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/user');
		} else {
			$this->model->update_user($this->input->post('passwordlama'));
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update user
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/user');
		}
	}

	/// for kategori

	public function kategori()
	{
		$data = array(
			'title' => 'List Kategori | Admin',
			'kategori' => $this->model->get_kategori()
		);
		$this->template->load('template_admin', 'Admin/kategori', $data);
	}
	public function insert_kategori()
	{
		if ($this->model->get_nama_kategori() != NULL) {
			$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Kategori Sudah ada
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/kategori');
		} else {
			$this->model->insert_kategori();
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menambahkan Kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/kategori');
		}
	}
	public function update_kategori()
	{
		$this->model->update_kategori();
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Admin/kategori');
	}
	public function delete_kategori($id)
	{
		$this->model->delete_kategori($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menghapus kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Admin/kategori');
	}

	/// for buku 

	public function buku()
	{
		$data = array(
			'title' => 'List Buku | Admin',
			'buku' => $this->model->get_buku(),
			'kategori' => $this->model->get_kategori()
		);
		$this->template->load('template_admin', 'Admin/buku', $data);
	}
	public function insert_buku()
	{
		if ($this->model->get_judul() == NULL) {
			$namafoto = date('Ymdhis') . '.jpg';
			if ($this->model->insert_buku($namafoto)) {
				$cek = $this->model->get_judul();
				if ($this->model->insert_relasi($this->input->post('kategori'), $cek->buku_id)) {
					if ($this->model->do_upload($namafoto)) {
						$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menambah Buku
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
						redirect('Admin/buku');
					} else {
						$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Gagal menambah Foto
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
						redirect('Admin/buku');
					}
				} else {
					$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Gagal menambah Kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
					redirect('Admin/buku');
				}
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Gagal menambah Buku
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
				redirect('Admin/buku');
			}
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Judul Sudah ada 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/buku');
		}
	}
	public function update_buku()
	{
		if (!empty($_FILES['foto']['name'])) {
			$this->model->ganti_foto($this->input->post('namafoto'));
			$this->model->delete_relasi($this->input->post('buku_id'));
			$this->model->insert_relasi($this->input->post('kategori'), $this->input->post('buku_id'));
			$this->model->update_buku();
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update Buku
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/buku');
		} else {
		
			$this->model->delete_relasi($this->input->post('buku_id'));
			$this->model->insert_relasi($this->input->post('kategori'), $this->input->post('buku_id'));
			$this->model->update_buku();
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update Buku
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Admin/buku');
		}
	
	}
		public function delete_buku($id){
			$this->db->where('buku_id', $id);
			$cek = $this->db->get('buku')->row_array();
			$foto = $cek['foto'];
			$this->model->delete_foto($foto);
			$this->model->delete_relasi($id);
			$this->model->delete_buku($id);
			$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
							Berhasil Hapus Buku
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						  </div>');
				redirect('Admin/buku');
	
		}
	public function cetak_laporan(){
		$this->load->library('Pdf');
		$this->pdf->load($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
	}
	public function delete_komen($id){
		$this->db->where('ulasan_id',$id);
		$this->db->delete('ulasan');
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
}
