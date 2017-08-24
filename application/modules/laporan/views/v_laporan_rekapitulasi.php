<?php
if (!defined("BASEPATH"))
    exit("No direct script access allowed");
$function = new laporan();
?>

<html>
    <head>
        <link rel="stylesheet" href="<?php echo getcwd() . "/themes/aceadmin/css/bootstrap.min.css" . "<br>"; ?>" />
        <link rel="stylesheet" href="<?php echo getcwd() . "/themes/aceadmin/css/font-awesome.min.css" . "<br>"; ?>" /> 
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
                <td colspan="1" align="left" width="60%">
                    <span style="font-size:14px; font-weight:900; letter-spacing: 0.8px">KEDUTAAN BESAR</span><br>
                    <span style="font-size:11px; font-weight:900">REPUBLIK INDONESIA</span><br>
                    <span style="font-size:11px; letter-spacing: 0.6px">DI BRUSSELS, BELGIA</span>
                </td>
                <td valign="top" style="font-size: 9px;" colspan="1" align="left" width="12%">
                    <span >Tanggal Cetak</span><br>
                    <span >Jam Cetak</span><br>
                </td>
                <td valign="top" style="font-size: 9px;" colspan="1" align="left" width="1%">:<br/>:</td>
                <td valign="top" style="font-size: 9px;" colspan="1" align="left" width="8%"><?php echo $now; ?><br/><?php echo $now_clock; ?></td>
            </tr>
            <tr>
                <td colspan="3" align="center" >
                    <br/>
                    <br/>
                    <span style="font-size:14px; font-weight:900; letter-spacing: 0.8px">DAFTAR REKAPITULASI PENERIMAAN NEGARA BUKAN PAJAK<BR/>PASPOR - SPLP WNI<br>PADA KBRI DEN GAAG - BELANDA<br>TAHUN ANGGARAN <?php echo $tahun; ?> </span><br>
                </td>
            </tr>
        </table>


        <div style="padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px  " class="row">

            <table class="data" align="center">
                <thead>
                    <tr>
                        <th style="font-size:10px; font-weight:600;padding: 4px;width: 5%;">NO</th>
                        <th style="font-size:10px; font-weight:600;padding: 4px;">BULAN</th>
                        <th style="font-size:10px; font-weight:600;padding: 4px;">JENIS PENERIMAAN SPRI</th>
                        <th style="font-size:10px; font-weight:600;padding: 4px;">JUMLAH<br>PEMOHON</th>
                        <th style="font-size:10px; font-weight:600;padding: 4px;">TARIF<br>€</th>
                        <th style="font-size:10px; font-weight:600;padding: 4px;">RALISASI<br>€</th>
                        <th style="font-size:10px; font-weight:600;padding: 4px;">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data_rekapitulasi as $key => $value) {
                        echo "<tr><td style='font-size:10px; font-weight:600;padding: 4px;'>" . $i++ . "</td>";
                        echo "<td style='font-size:10px; font-weight:600;padding: 4px;'>" . $key . "</td>";
                        echo "<td style='font-size:10px; font-weight:600;padding: 4px;'>";
                        foreach ($value as $val) {
                            echo $val['nama'].'<br>';
                        }
                        echo "</td>";
                        echo "<td style='font-size:10px; font-weight:600;padding: 4px;'>";
                        foreach ($value as $val) {
                            echo $val['count'].'<br>';
                        }
                        echo "</td>";
                        echo "<td style='font-size:10px; font-weight:600;padding: 4px;'>";
                        foreach ($value as $val) {
                            echo $function->getdata_td($val, 'harga').'<br>';
                        }
                        echo "</td>";
                        echo "<td style='font-size:10px; font-weight:600;padding: 4px;'>";
                        foreach ($value as $val) {
                            echo ($val['count']*$function->getdata_td($val, 'harga')).'<br>';
                        }
                        echo "</td>";
                        echo "<td style='font-size:10px; font-weight:600;padding: 4px;'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
            ?>

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
