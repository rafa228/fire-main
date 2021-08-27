<?php error_reporting(0); ?>
<?php
include_once ("conn_report.php");

 $pdf = new FPDF('L', 'mm','A4');
 $pdf->SetMargins(20,20,20);
 $pdf->SetTopMargin(20);
 $pdf->SetLeftMargin(28);
 $pdf->SetRightMargin(28);

$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,7,'DATA PERMOHONAN LAYANAN PERBAIKAN & PERAWATAN',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,7,'DINAS PEMADAM KEBAKARAN DAN PENANGGULANGAN BENCANA KOTA PALEMBANG (DPK-PB) 
',0,1,'C');
$pdf->Ln();

$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Times','B',10);

$pdf->Cell(8,10,'No',1,0,'C');
$pdf->Cell(40,10,'Tgl. Permohonan',1,0,'C');
$pdf->Cell(40,10,'Kantor Cabang',1,0,'C');
$pdf->Cell(80,10,'Nama Alat',1,0,'C');
$pdf->Cell(40,10,'Status Permohonan',1,0,'C');
$pdf->Cell(30,10,'Estimasi Waktu',1,0,'C');
$pdf->SetFont('Times','',10);
$pdf->Ln();

$no=1;
$jk='';
//Query untuk mengambil data mahasiswa pada tabel mahasiswa
$hasil = mysqli_query($kon, "SELECT * from db_permohonan order by id_permohonan ASC");
while ($data = mysqli_fetch_array($hasil)){
    $pdf->Cell(8,6,$no,1,0);
    $pdf->Cell(40,6,$data['tgl_pelaporan'],1,0, 'C');
    $pdf->Cell(40,6,$data['kantor_cabang'],1,0);
    $pdf->Cell(80,6,$data['nama_alat'],1,0);
    $pdf->Cell(40,6,$data['status_pelaporan'],1,0,'C');
    $pdf->Cell(30,6,$data['estimasi_waktu'],1,0,'C');
    $pdf->Ln();
    $no++;
}

$pdf->Output();
?>