<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model extends CI_Model
{

	/// for user
	public function get_username()
	{
		$this->db->where('username', $this->input->post('username'));
		return $this->db->get('users')->row();
	}
	public function get_user()
	{
		return $this->db->get('users')->result();
	}
	public function insert_user($role)
	{
		$data = array(
			'username' => $this->input->post('username'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'role' => $role
		);
		$this->db->insert('users', $data);
	}
	public function update_user($password)
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'password' => $password,
			'role' => $this->input->post('role')
		);
		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->update('users', $data);
	}
	public function delete_user($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('users');
	}

	/// for kategori 

	public function get_kategori()
	{
		return $this->db->get('kategori')->result();
	}
	public function get_nama_kategori()
	{
		$this->db->where('kategori', $this->input->post('kategori'));
		return $this->db->get('kategori')->row();
	}
	public function insert_kategori()
	{
		$this->db->insert('kategori', array('kategori' => $this->input->post('kategori')));
	}
	public function update_kategori()
	{
		$this->db->where('kategori_id', $this->input->post('kategori_id'));
		$this->db->update('kategori', array('kategori' => $this->input->post('kategori')));
	}
	public function delete_kategori($id)
	{
		$this->db->where('kategori_id', $id);
		$this->db->delete('kategori');
	}

	/// for buku 

	public function get_buku()
	{
		return $this->db->get('buku')->result();
	}
	public function get_buku_tersedia(){
		$this->db->where('stok > 0');
		return $this->db->get('buku')->result();
	}
	public function get_buku_kosong(){
		$this->db->where('stok = 0');
		return $this->db->get('buku')->result();
	}
	
	public function get_judul()
	{
		$this->db->where('judul', $this->input->post('judul'));
		return $this->db->get('buku')->row();
	}
	public function get_buku_id($id)
	{
		$this->db->where('buku_id', $id);
		return $this->db->get('buku')->result();
	}
	public function get_relasi($id)
	{
		$this->db->join('kategori', 'relasi.kategori_id = kategori.kategori_id');
		$this->db->where('buku_id', $id);
		return $this->db->get('relasi')->result();
	}
	public function insert_relasi($kategori, $id)
	{
		$kategori_insert = [];
		foreach ($kategori as $ka) {
			array_push($kategori_insert, [
				'kategori_id' => $ka,
				'buku_id' => $id
			]);
		}
		if (!empty($kategori_insert)) {
			$this->db->insert_batch('relasi', $kategori_insert);
			return true;
		} else {
			return false;
		}
	}
	public function delete_relasi($id)
	{
		$this->db->where('buku_id', $id);
		$this->db->delete('relasi');
	}
	public function insert_buku($namafoto)
	{
		$data = array(
			'judul' => $this->input->post('judul'),
			'penulis' => $this->input->post('penulis'),
			'penerbit' => $this->input->post('penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'stok' => $this->input->post('stok'),
			'sinopsis' => $this->input->post('sinopsis'),
			'foto' => $namafoto
		);
		$this->db->insert('buku', $data);
		return true;
	}
	public function update_buku()
	{
		$data = array(
			'judul' => $this->input->post('judul'),
			'penulis' => $this->input->post('penulis'),
			'penerbit' => $this->input->post('penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'stok' => $this->input->post('stok'),
			'sinopsis' => $this->input->post('sinopsis'),

		);
		$this->db->where('buku_id', $this->input->post('buku_id'));
		$this->db->update('buku', $data);
		return true;
	}
	public function delete_buku($id)
	{
		$this->db->where('buku_id', $id);
		$this->db->delete('buku');
		return true;
	}
	public function do_upload($namafoto)
	{
		$config['upload_path']          = 'assets/upload/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 0;
		$config['file_name']			= $namafoto;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			return array('error' => $this->upload->display_errors());
		} else {
			return array('upload_data' => $this->upload->data());
		}

		
	}
	public function ganti_foto($namafoto){
		
		$config['upload_path']          = 'assets/upload/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 0;
		$config['file_name']			= $namafoto;
		$config['overwrite']			= TRUE;
		
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			return array('error' => $this->upload->display_errors());
		} else {
			return array('upload_data' => $this->upload->data());
		}
	}
	public function delete_foto($namafoto){
			unlink('assets/upload/'.$namafoto);
		
	}

	/// for pinjam
	public function pesan($id){
		$data = array(
			'buku_id' => $id,
			'peminjam_id' => $this->session->userdata('user_id'),
			'status_peminjaman' => 'dipesan'
		);
		$this->db->insert('peminjaman', $data);
	}
	public function batal_pesan($id){
		$this->db->where('buku_id', $id);
		$this->db->where('peminjam_id', $this->session->userdata('user_id'));
		$this->db->where('status_peminjaman', 'dipesan');
		$this->db->delete('peminjaman');
	}
	public function isDipesan($id){
		$this->db->where('buku_id', $id);
		$this->db->where('peminjam_id', $this->session->userdata('user_id'));
		$this->db->where('status_peminjaman', 'dipesan');
		return $this->db->get('peminjaman')->result();
	}
	public function IsDipinjam($id){
		$this->db->where('buku_id', $id);
		$this->db->where('peminjam_id', $this->session->userdata('user_id'));
		$this->db->where('status_peminjaman', 'dipinjam');
		return $this->db->get('peminjaman')->result();
	}
	public function get_peminjaman_saya($status){
		if($status == 'dipesan'){
			$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
			$this->db->where('peminjam_id', $this->session->userdata('user_id'));
			$this->db->where('status_peminjaman', 'dipesan');
			return $this->db->get('peminjaman')->result();
		} elseif($status == 'dipinjam'){
				$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
				$this->db->where('peminjam_id', $this->session->userdata('user_id'));
				$this->db->where('status_peminjaman', 'dipinjam');
				return $this->db->get('peminjaman')->result();

			} elseif($status == 'dikembalikan'){
				$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
				$this->db->where('peminjam_id', $this->session->userdata('user_id'));
				$this->db->where('status_peminjaman', 'dikembalikan');
				return $this->db->get('peminjaman')->result();

			}
		}
	public function search(){
		$this->db->like('judul', $this->input->get('query'));
		return $this->db->get('buku')->result();
	}



	///for koleksi 
	public function get_koleksi(){
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->join('buku', 'koleksi.buku_id = buku.buku_id');
		return $this->db->get('koleksi')->result();
	}
	public function isKoleksi($id){
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('buku_id', $id);
		return $this->db->get('koleksi')->result();
	}
	public function insert_koleksi($id){
		$data = array(
			'buku_id' => $id,
			'user_id' => $this->session->userdata('user_id')
		);
		$this->db->insert('koleksi',$data);
	}
	public function delete_koleksi($id){
		$this->db->where('buku_id', $id);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->delete('koleksi');
	}

	/// for komen 

	public function insert_komen(){
		$data = array(
			'ulasan' => $this->input->post('ulasan'),
			'rating' => $this->input->post('rating'),
			'tanggal' => date('Ymd'),
			'buku_id' => $this->input->post('buku_id'),
			'user_id' => $this->session->userdata('user_id')
		);
		$this->db->insert('ulasan',$data);
	}
	public function get_komen($id){
		$this->db->where('buku_id', $id);
		$this->db->join('users', 'ulasan.user_id = users.user_id');
		return $this->db->get('ulasan')->result();
	}
	public function delete_komen($id){
		$this->db->where('ulasan_id', $id);
		$this->db->delete('ulasan');
	}

	/// for approval 

	public function get_peminjaman($status){
		if($status == 'dipesan'){
			$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
			$this->db->join('users', 'peminjaman.peminjam_id = users.user_id');
			$this->db->where('status_peminjaman', 'dipesan');
			return $this->db->get('peminjaman')->result();
		}
		elseif($status == 'dipinjam'){
			$this->db->select('peminjaman.*, buku.*, peminjam.username as peminjam_username, petugas.username as petugas_username');
			$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
			$this->db->join('users as peminjam', 'peminjaman.peminjam_id = peminjam.user_id', 'left');			
			$this->db->join('users as petugas', 'peminjaman.petugas_id = petugas.user_id','left');
			$this->db->where('status_peminjaman', 'dipinjam');
			return $this->db->get('peminjaman')->result();
		} elseif($status == 'dikembalikan'){
			$this->db->select('peminjaman.*, buku.*, peminjam.username as peminjam_username, petugas.username as petugas_username');
			$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
			$this->db->join('users as peminjam', 'peminjaman.peminjam_id = peminjam.user_id','left');			$this->db->join('users as peminjam', 'peminjaman.peminjam_id = peminjam.user_id');
			$this->db->join('users as petugas', 'peminjaman.petugas_id = petugas.user_id','left');
			$this->db->where('status_peminjaman', 'dipinjam');
			return $this->db->get('peminjaman')->result();
		}
	}
	public function get_peminjaman_id($id){
		$this->db->where('peminjaman_id', $id);
		return $this->db->get('peminjaman')->row();
	}
	public function hitung_denda($pengembalian, $batas){
		$kembali = new DateTime($pengembalian);
		$batas_waktu = new DateTime($batas);

		if($kembali > $batas_waktu){
			$selisih = $kembali->diff($batas_waktu)->days;
			$denda = $selisih*500;
			return $denda;
		} else{
			return 0;
		}
	}
	public function update_status($status, $id){
		if($status == 'approve'){
			$data = array(
				'petugas_id' => $this->session->userdata('user_id'),
				'tanggal_peminjaman' => date('Ymd'),
				'batas_waktu' => date('Ymd') + 7,
				'status_peminjaman' => 'dipinjam'
			);
			$cek = $this->get_peminjaman_id($id);
			$this->db->where('peminjaman_id', $id);
			$this->db->update('peminjaman', $data);

			$this->db->where('buku_id', $cek->buku_id);
			$this->db->set('stok', 'stok -1', FALSE);
			$this->db->update('buku');
		} elseif($status == 'dikembalikan'){
			$cek = $this->get_peminjaman_id($id);
			$denda = $this->hitung_denda(date('Ymd'), $cek->batas_waktu);
			$dataa = array(
				'tanggal_pengembalian' => date('Ymd'),
				'status_peminjaman' => 'dikembalikan',
				'denda' => $denda
			);
			$this->db->where('peminjaman_id', $id);
			$this->db->update('peminjaman', $dataa);

			$this->db->where('buku_id', $cek->buku_id);
			$this->db->set('stok', 'stok + 1', FALSE);
			$this->db->update('buku');
		} elseif($status == 'ditolak'){
			$data = array(
				'petugas_id' => $this->session->userdata('user_id'),
				'status_peminjaman' => 'ditolak'
			);
			$this->db->where('peminjaman_id', $id);
			$this->db->update('peminjaman', $data);
		}
	}
	public function for_laporan($tanggal_awal, $tanggal_akhir){
		$this->db->select('peminjaman.*, buku.*, peminjam.username as peminjam_username, petugas.username as petugas_username');
		$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
		$this->db->join('users as peminjam', 'peminjaman.peminjam_id = peminjam.user_id', 'left');			
		$this->db->join('users as petugas', 'peminjaman.petugas_id = petugas.user_id','left');
		$this->db->where_in('status_peminjaman', $this->input->post('status'));
		$this->db->where('tanggal_peminjaman >=', $tanggal_awal);
		$this->db->where('tanggal_peminjaman <=', $tanggal_akhir);
		return $this->db->get('peminjaman')->result();
	}
	public function history(){
		$this->db->select('peminjaman.*, buku.*, peminjam.username as peminjam_username, petugas.username as petugas_username');
		$this->db->join('buku', 'peminjaman.buku_id = buku.buku_id');
		$this->db->join('users as peminjam', 'peminjaman.peminjam_id = peminjam.user_id', 'left');			
		$this->db->join('users as petugas', 'peminjaman.petugas_id = petugas.user_id','left');
		$this->db->where_not_in('status_peminjaman', array('dipinjam', 'dipesan'));
		return $this->db->get('peminjaman')->result();
	}

	/// hitung

	public function hitung_peminjam(){
		$this->db->where('role', 'peminjam');
		return $this->db->count_all_results('users');
	}
	public function hitung_peminjaman(){
		return $this->db->count_all_results('peminjaman');
	}
	public function average($id){
		$this->db->select_avg('rating');
		$this->db->where('buku_id', $id);
		return $this->db->get('ulasan')->result();
	}
	
	public function total($tanggal_awal, $tanggal_akhir){
		$this->db->select_sum('denda');
		$this->db->where_in('status_peminjaman', $this->input->post('status'));
		$this->db->where('tanggal_peminjaman >=', $tanggal_awal);
		$this->db->where('tanggal_peminjaman <=', $tanggal_akhir);
		return $this->db->get('peminjaman')->result();
	}
}
