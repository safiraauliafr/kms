<?php

/**
 * 
 */
class Notulen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    function index()
    {
        $this->cetak();
    }

    function cetak()
    {
        $id = $this->uri->segment(4);
        $this->db->select("*");
        $this->db->from('tb_notulensi');
        $this->db->where('id_notulensi', $id);
        $query = $this->db->get();

        $this->data['notulensi'] = $query->result();

        //tanggal
        $date = explode("-", $this->data['notulensi'][0]->tgl_notulensi);
        $implode = array($hari  = $date[2], $bulan = $date[1], $tahun = $date[0]);
        $tanggal = implode("-", $implode);

        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'PT. SYARFI TEKNOLOGI FINANSIAL', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'NOTULENSI RAPAT ', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(42, 6, "ID Notulensi", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->id_notulensi, 1, 1);
        $pdf->Cell(42, 6, "NIP", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->nip, 1, 1);
        $pdf->Cell(42, 6, "Nama", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->nama_user, 1, 1);
        $pdf->Cell(42, 6, "Isi Notulensi", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->isi_notulensi, 1, 1);
        $pdf->Cell(42, 6, "Tanggal Notulensi", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->tgl_notulensi, 1, 1);
        $pdf->Cell(42, 6, "Waktu", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->waktu, 1, 1);
        $pdf->Cell(42, 6, "Tempat", 1, 0);
        $pdf->Cell(146, 6, $this->data['notulensi'][0]->tempat, 1, 1);

        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(330, 7, "Bekasi, " . $tanggal, 0, 'R', 'C');
        $pdf->Cell(10, 22, '', 0, 1, 'C');
        $pdf->Cell(330, 7, "SYARFI MANAGEMENT", 0, 'R', 'C');
        $pdf->Output();
    }
}