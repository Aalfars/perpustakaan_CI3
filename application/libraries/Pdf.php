<?php
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf
{

	function load($tanggal_awal, $tanggal_akhir)
	{
		$dompdf = new Dompdf();
		$ci = &get_instance();
		$peminjaman = $ci->model->for_laporan($tanggal_awal, $tanggal_akhir);

		$html = '<h1>Laporan Peminjaman</h1>';
		$html .= '<h3>Periode : ' . $tanggal_awal . ' Sampai dengan ' . $tanggal_akhir . '</h3>';
		$html .= '<table border="1">';
		$html .=	'<thead>';
		$html .= 		'<tr>
						<th>No</th>
						<th>Judul Buku</th>
						<th>Peminjam</th>
						<th>Petugas</th>
						<th>Tanggal Peminjaman</th>
						<th>Tanggal Dikembalikan</th>
						<th>Status Peminjaman</th>
						<th>Denda</th>
						</tr>';
		$html .=		'</thead>';
		$html .= '<tbody>';
		$no = 0;
		foreach ($peminjaman as $a) {
			$html .= '<tr>';
			$html .= '<td>' . ++$no . '</td>';
			$html .= '<td>' . $a->judul . '</td>';
			$html .= '<td>' . $a->peminjam_username . '</td>';
			$html .= '<td>' . $a->petugas_username . '</td>';
			$html .= '<td>' . $a->tanggal_peminjaman . '</td>';
			$html .= '<td>' . $a->tanggal_pengembalian . '</td>';
			$html .= '<td>' . $a->status_peminjaman . '</td>';
			$html .= '<td>' . $a->denda . '</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		foreach($ci->model->total($tanggal_awal, $tanggal_akhir) as $s){
			$html .= '<h3>Total Denda : Rp. '.number_format($s->denda).' </h3>';
		}
		$dompdf->loadHtml($html);
		$dompdf->setPaper('F4', 'landscape');
		$dompdf->render();
		$dompdf->stream('Laporan_peminjaman.pdf', array("Attachment" => false));
	}
}
