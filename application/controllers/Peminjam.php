<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjam extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		if ($this->session->userdata('role') != 'peminjam') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
                        Salah tempat banggg
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
			redirect('Auth');
		}
	}
	public function index(){
		$data = array(
			'title' => 'Dashboard | Peminjam',
			'buku' => $this->model->get_buku_tersedia(),
			'bukukosong' => $this->model->get_buku_kosong()
		);
		$this->template->load('template_peminjam', 'Peminjam/home', $data);
	}
	public function buku_detail($id){
		$data = array(
			'title' => 'Detail Buku | Peminjam',
			'buku' => $this->model->get_buku_id($id)
		);
		$this->template->load('template_peminjam','Peminjam/detail', $data);
	}
	public function pinjam($id){
		$this->model->pesan($id);
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
	public function batal_pinjam($id){
		$this->model->batal_pesan($id);
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
	public function pinjaman(){
		$data = array(
			'title' => 'Pinjaman Saya',
			'pinjam' => $this->model->get_peminjaman_saya('dipinjam'),
			'pesan' => $this->model->get_peminjaman_saya('dipesan')
		);
		$this->template->load('template_peminjam', 'Peminjam/pinjaman',$data);
	}
	
	public function history(){
		$data = array(
			'title' => 'Pinjaman Saya',
			'buku' => $this->model->get_peminjaman_saya('dikembalikan')
		);
		$this->template->load('template_peminjam', 'Peminjam/history',$data);
	}
	public function favorit(){
		$data = array(
			'title' => 'Favorit | Peminjam',
			'favorit' => $this->model->get_koleksi()
		);
		$this->template->load('template_peminjam', 'Peminjam/favorit',$data);
	}
	public function insert_favorit($id){
		$this->model->insert_koleksi($id);
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
	public function delete_favorite($id){
		$this->model->delete_koleksi($id);
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
	public function insert_komen(){
		$this->model->insert_komen();
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
	public function search(){
		$data = array(
			'title' => 'Hasil Pencarian | Peminjam', 
			'buku' => $this->model->search()
		);
		$this->template->load('template_peminjam', 'Peminjam/hasil', $data);
	}
	public function delete_komen($id){
		$this->db->where('ulasan_id',$id);
		$this->db->delete('ulasan');
		$previous = $this->input->server('HTTP_REFERER');
		redirect($previous);
	}
}
