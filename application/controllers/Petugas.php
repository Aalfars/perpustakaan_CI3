<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		if ($this->session->userdata('role') != 'petugas') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Salah tempat banggg
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Auth');
		}
	}
	public function index()
	{
		$data['title'] = 'Dashboard | Petugas';
		$this->template->load('template_petugas', 'Petugas/home', $data);
	}


	/// for kategori

	public function kategori()
	{
		$data = array(
			'title' => 'List Kategori | Petugas',
			'kategori' => $this->model->get_kategori()
		);
		$this->template->load('template_petugas', 'Petugas/kategori', $data);
	}
	public function insert_kategori()
	{
		if ($this->model->get_nama_kategori() != NULL) {
			$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Kategori Sudah ada
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Petugas/kategori');
		} else {
			$this->model->insert_kategori();
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menambahkan Kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Petugas/kategori');
		}
	}
	public function update_kategori()
	{
		$this->model->update_kategori();
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Petugas/kategori');
	}
	public function delete_kategori($id)
	{
		$this->model->delete_kategori($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menghapus kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Petugas/kategori');
	}

	/// for buku 

	public function buku()
	{
		$data = array(
			'title' => 'List Buku | Petugas',
			'buku' => $this->model->get_buku(),
			'kategori' => $this->model->get_kategori()
		);
		$this->template->load('template_petugas', 'Petugas/buku', $data);
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
						redirect('Petugas/buku');
					} else {
						$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Gagal menambah Foto
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
						redirect('Petugas/buku');
					}
				} else {
					$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Gagal menambah Kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
					redirect('Petugas/buku');
				}
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Gagal menambah Buku
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
				redirect('Petugas/buku');
			}
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible" role="alert">
                        Judul Sudah ada 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Petugas/buku');
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
			redirect('Petugas/buku');
		} else {
			$this->model->delete_relasi($this->input->post('buku_id'));
			$this->model->insert_relasi($this->input->post('kategori'), $this->input->post('buku_id'));
			$this->model->update_buku();
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Update Buku
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Petugas/buku');
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
			redirect('Petugas/buku');

	}
	public function approval()
	{
		$data = array(
			'title' => 'Approval | Petugas',
			'dipesan' => $this->model->get_peminjaman('dipesan'),
			'dipinjam' => $this->model->get_peminjaman('dipinjam'),
			'history' => $this->model->history()

		);
		$this->template->load('template_petugas', 'Petugas/approval', $data);
	}
	public function approve($id)
	{
		$this->model->update_status('approve', $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Approve 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Petugas/approval');
	}
	public function tolak($id)
	{
		$this->model->update_status('ditolak', $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Menolak 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Petugas/approval');
	}
	public function kembali($id)
	{
		$this->model->update_status('dikembalikan', $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Mengembalikan buku 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
		redirect('Petugas/approval');
	}
	public function cetak_laporan(){
		
		$this->load->library('Pdf');
		$this->pdf->load($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
	}
}
