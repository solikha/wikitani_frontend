<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<html>
    <head>
        <link rel="stylesheet" href="<?php echo getcwd() . '/themes/aceadmin/css/bootstrap.min.css' . '<br>'; ?>" />
        <link rel="stylesheet" href="<?php echo getcwd() . '/themes/aceadmin/css/font-awesome.min.css' . '<br>'; ?>" /> 
    </head>
    <body>
        <style>
            td {
                font-family: Dejavu Sans;
            }
            .data {
                table-layout: fixed;
                width: 100%;
                white-space: nowrap;
                font:10pt verdana sans-serif;
                border-collapse: collapse;
            }
            .data th {
                font-family: Dejavu Sans;
                font-size:8px;
                border:solid;
                border-width: 0.5px;
                font-weight:400;
            }
            .data th.tbl_judul{
                font-size: 10pt;
                height: 30px;
            }
            .data td {
                font-family: Dejavu Sans;
                font-size:8px;
                border:solid;
                border-width: 0.5px;
                font-weight:400;
            }
            .data table {

            }

        </style>

        <table style="width:100%;">
            <tr>
                <td align="center" width="5%">
                    <img src="<?php echo $garuda; ?>" width="45" border="0" alt="" style="margin-left: 10px"/>
                </td>
                <td align="left" width="15%">
                    <span style="font-size:12px; font-weight:900; letter-spacing: 0.8px">KEDUTAAN BESAR</span><br>
                    <span style="font-size:11px; font-weight:900">REPUBLIK INDONESIA</span><br>
                    <span style="font-size:11px; letter-spacing: 0.6px">DI BRUSSELS, BELGIA</span>
                </td>
                <td align="center" >
                    <span style="font-size:14px; font-weight:900; letter-spacing: 0.8px">LAPORAN STATISTIK BULANAN</span><br>
                    <span style="font-size:12px; font-weight:700; letter-spacing: 2.4px">WARGA NEGARA INDONESIA</span><br>
                </td>
                <td align="center" width="20%">
                    <span style="font-size:12px; font-weight:600; letter-spacing: 0.8px">FORMULIR S-VIPA 1</span><br>
                    <span style="font-size:11px; font-weight:900">&nbsp;</span><br>
                    <span style="font-size:11px; letter-spacing: 0.6px">Bulan <?php echo $bulan . ' ' . $tahun ?></span>
                </td>
            </tr>
        </table>


        <div style="padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px  " class="row">

            <table class="data">
                <thead>
                    <tr>
                        <th colspan=7 class="tbl_judul">I. WN  RI TINGGAL TETAP/SEMENTARA</th>
                        <th colspan=8 class="tbl_judul">II. REKAPITULASI SURAT PERJALANAN RI</th>
                        <th colspan=5 class="tbl_judul">III. PELAYANAN SPRI</th>
                    </tr>
                    <tr>
                        <th rowspan=2>Komposisi</th>
                        <th rowspan=2>Jumlah Akhir Bulan Lalu</th>
                        <th colspan=4>Perubahan</th>
                        <th rowspan=2>Jumlah Bulan Ini</th>
                        <th rowspan=2>Jenis SPRI</th>
                        <th colspan=2>Persediaan Akhir Bulan Lalu</th>
                        <th colspan=2>Diterima Tambahan SPRI Bulan Ini</th>
                        <th rowspan=2>Pengeluaran SPRI Bulan Ini</th>
                        <th colspan=2>Sisa Persediaan SPRI Akhir Bulan Ini</th>
                        <th rowspan=2>Jenis SPRI</th>
                        <th rowspan=2>Baru</th>
                        <th rowspan=2>Penggantian (habis berlaku)</th>
                        <th rowspan=2>Penggantian (hilang/rusak)</th>
                        <th rowspan=2>Perpanjangan</th>
                    </tr>
                    <tr>
                        <th>Datang<br>(+)</th>
                        <th>Lahir<br>(+)</th>
                        <th>Pulang/Pindah ke Negara Lain RI (-)</th>
                        <th>Hilang Kewarganegaraan RI (-)</th>
                        <th>No Perforasi</th>
                        <th>Jumlah</th>
                        <th>No Perforasi</th>
                        <th>Jumlah</th>
                        <th>No Perforasi</th>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <th>(1)</th>
                        <th>(2)</th>
                        <th>(3)</th>
                        <th>(4)</th>
                        <th>(5)</th>
                        <th>(6)</th>
                        <th>(7)</th>
                        <th>(8)</th>
                        <th>(9)</th>
                        <th>(10)</th>
                        <th>(11)</th>
                        <th>(12)</th>
                        <th>(13)</th>
                        <th>(14)</th>
                        <th>(15)</th>
                        <th>(16)</th>
                        <th>(17)</th>
                        <th>(18)</th>
                        <th>(19)</th>
                        <th>(20)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrdata as $row) { ?>
                        <tr>
                            <?php foreach ($row as $item) { ?>
                                <td>
                                    <?php echo $item; ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <table style="width:100%;">
                <tr><td>&nbsp;<br></td><td></td><td></td></tr>
                <tr>
                    <td align="left" width="35%">
                        <span style="font-size:10px; font-weight:600">Disampaikan Kepada</span><br>
                        <span style="font-size:10px; font-weight:600">1. Direktur Jendral Protokol dan Konsuler</span><br>
                        <span style="font-size:10px; font-weight:600">&nbsp;&nbsp;Up. Direktur Konsuler.</span><br>
                        <span style="font-size:10px; font-weight:600">2. Direktur Jendral Imigrasi</span><br>
                        <span style="font-size:10px; font-weight:600">&nbsp;&nbsp;Up. Direktur Informasi Keimigrasian.</span>
                    </td>
                    <td align="center" >
                    </td>
                    <td align="center" width="25%">
                        <span style="font-size:10px; font-weight:600">Brussels <?php echo date("d M Y"); ?></span><br>
                        <span style="font-size:10px; font-weight:600">A.n KEPALA PERWAKILAN</span><br>
                        <span style="font-size:10px; font-weight:600"></span><br>
                        <span style="font-size:10px; font-weight:600"></span><br>
                        <span style="font-size:10px; font-weight:600">Ifan Mahdiyat Sofiana</span><br>
                        <span style="font-size:10px; font-weight:600">Sekretaris Pertama</span>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
