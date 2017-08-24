<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Export extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_workflow', 'mwflow');
    }

    // new workflow item from public screen
    public function testing1($param1) {
        echo $param1;
    }

    function hasAccess($wfname) {
        return true;
    }

    function hasAccessGlobal() {
        return true;
    }

    // request new first workflow screen
    public function startprotected($category, $wfname) {
        try {
            $akses = $this->hasAccess($category, $wfname);
            if ($akses === true) {
                $this->mwflow->startscreen($category, $wfname);
            } else {
                throw new MgException('403', $akses);
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    // request new first workflow screen
    public function startpublic($wfname) {
        try {
            $this->mwflow->startpublic($wfname);
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function requestprocess($wfname) {
        try {
            if ($this->hasAccess($wfname)) {
                $this->mwflow->wfscreenfirst($wfname);
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function requestcategory($wfcategory) {
        try {
            if ($this->hasAccessGlobal()) {
                $this->mwflow->wfscreenfirst($wfname);
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function viewworkflow($wfid) {
        try {
            if ($this->hasAccessGlobal()) {
                $this->mwflow->viewworkflow($wfid);
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function editworkflow($wfid) {
        try {
            if ($this->hasAccessGlobal()) {
                $this->mwflow->editworkflow($wfid);
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function savedata() {
        try {
            if ($this->hasAccessGlobal()) {
                if (isset($_POST['processname']) and isset($_POST['processcategory']) and isset($_POST['saving_mode'])) {
                    $this->mwflow->savedata();
                } else {
                    throw new MgException('500', 'Field processname, processcategory dan saving_mode tidak diketemukan.');
                }
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function insertdata($wfname) {
        try {
            if ($this->hasAccess($wfname)) {
                $this->mwflow->wfscreenfirst($wfname);
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    public function updatedata($wfname) {
        try {
            if ($this->hasAccess($wfname)) {
                $this->mwflow->wfscreenfirst($wfname);
            } else {
                throw new MgException('403', 'Tidak ada akses');
            }
        } catch (Exception $E) {
            $this->showException($E);
        }
    }

    function testing($a = 'a', $b = 'b', $c = 'c', $d = 'd') {
        echo "Percobaan";
        echo $a . '-' . $b . '-' . $c . '-' . $d;
    }

    function import_part() {
        $data['data_part'] = array(
            array('nama' => 'Pasar Puyuh', 'alamat' => 'Kecamatan Coblong', 'telepon' => '0223267333'),
            array('nama' => 'Pasar Gang Warta ', 'alamat' => 'Kecamatan Batu Nunggal', 'telepon' => '0223267222'),
            array('nama' => 'PT Daihatsu', 'alamat' => 'Kab Bandung', 'telepon' => '022345345'),
            array('nama' => 'PT Yamaha', 'alamat' => 'Kab Bandung', 'telepon' => '0223264444'),
            array('nama' => 'Pasar Karang Anyar', 'alamat' => 'Kecamatan Astana Anyar', 'telepon' => '0224567498'),
            array('nama' => 'Pasar Kebon Sirih', 'alamat' => 'Kecamatan Sumur Bandung', 'telepon' => '0223256598'),
            array('nama' => 'Pasar Wastukencana', 'alamat' => 'Kecamatan Bandung Wetan', 'telepon' => '0256567498'),
            array('nama' => 'Pasar Gedebage', 'alamat' => 'Kecamatan gedebage Bandung', 'telepon' => '0213267498'),
            array('nama' => 'Pasar UjungBerung', 'alamat' => 'Kecamatan Ujungberung Bandung', 'telepon' => '0243547498'),
            array('nama' => 'Pasar Kebon Sirih', 'alamat' => 'Kecamatan Sumur Bandung', 'telepon' => '0223256598'),
            array('nama' => 'Pasar Wastukencana', 'alamat' => 'Kecamatan Bandung Wetan', 'telepon' => '0256567498'),
            array('nama' => 'Pasar Gedebage', 'alamat' => 'Kecamatan gedebage Bandung', 'telepon' => '0213267498'),
            array('nama' => 'Pasar UjungBerung', 'alamat' => 'Kecamatan Ujungberung Bandung', 'telepon' => '0243547498')
        );
        $this->load->view('part/view_import', $data);
    }

    function import_part_data() {
        echo '{
  "data": [
    {
      "DT_RowId": "row_1",
      "users": {
        "first_name": "Quynn",
        "last_name": "Contreras",
        "phone": "1-971-977-4681",
        "site": "1"
      },
      "sites": {
        "name": "Edinburgh"
      }
    },
    {
      "DT_RowId": "row_2",
      "users": {
        "first_name": "Kaitlin",
        "last_name": "Smith",
        "phone": "1-436-523-6103",
        "site": "2"
      },
      "sites": {
        "name": "London"
      }
    }
    ]}';
    }

    function do_upload() {

        include "application/libraries/PHPExcel/IOFactory.php";

        $basefolder = $this->ci->config->item('filefolder');
        $inputFileName = $basefolder . 'data.xlsx';

//  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        }

//  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            foreach ($rowData[0] as $k => $v)
                print "Row: " . $row . "- Col: " . ($k + 1) . " = " . $v . "<br />";
        }
    }

    public function cetak() {
        try {
            $this->load->model('m_export', 'gas_db');
            $data_export = $this->gas_db->data_export($_GET["po_supp_id"]);
            $datas = $this->gas_db->export($_GET["po_supp_id"]);
            if ($data_export && $datas != NULL) {
                $data['data_export'] = array(
                    'po_number' => $data_export[0]['po_number'],
                    'date_format' => $data_export[0]['date_format'],
                    'reference' => $data_export[0]['reference'],
                    'reference_datex' => $data_export[0]['reference_datex'],
                    'currency' => $data_export[0]['currency'],
                    'requirement' => $data_export[0]['requirement'],
                    'incoterms_idx' => $data_export[0]['incoterms_idx'],
                    'incoterms_text' => $data_export[0]['incoterms_text'],
                    'terms_idx' => $data_export[0]['terms_idx'],
                    'supp_name' => $data_export[0]['supp_name'],
                    'supplier_id' => $data_export[0]['supplier_id'],
                    'bank_address' => $data_export[0]['bank_address'],
                    'supp_addres' => $data_export[0]['supp_addres'],
                    'attn' => $data_export[0]['attn'],
                    'phone' => $data_export[0]['phone'],
                    'fax' => $data_export[0]['fax'],
                    'shipping_arrangement' => $data_export[0]['shipping_arrangement'],
                    'ship_to' => $data_export[0]['ship_to'],
                    'ship_to_address' => $data_export[0]['ship_to_address'],
                    'ship_phone' => $data_export[0]['ship_phone'],
                    'ship_fax' => $data_export[0]['ship_fax'],
                    'ship_name' => $data_export[0]['ship_name'],
                    'invoice_to' => $data_export[0]['invoice_to'],
                    'invoice_to_address' => $data_export[0]['invoice_to_address'],
                    'inv_phone' => $data_export[0]['inv_phone'],
                    'inv_fax' => $data_export[0]['inv_fax'],
                    'inv_name' => $data_export[0]['inv_name'],
                    'total' => $data_export[0]['total'],
                    'tax' => $data_export[0]['tax'],
                    'handling_charge' => $data_export[0]['handling_charge'],
                    'shipping_charge' => $data_export[0]['shipping_charge'],
                );
                $data['icon'] = BASEPATH . "../themes/aceadmin/images/logo.jpg";
                $data['data'] = $datas;
                $data['total'] = $this->gas_db->data_export($_GET["po_supp_id"]);
//            $this->load->view('print_rfqc', $data);
                $html = $this->load->view('export', $data, true);
//this the the PDF filename that user will get to download
                $pdfFilePath = "the_pdf_output.pdf";
//load mPDF library
                $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();
//generate the PDF!
                $page = $pdf->page + 1;
				
				$pdf->AddPage();
				//$pdf->SetHTMLFooter('<br>Page' .' {PAGENO} of {nb}  pages');
//echo $page; die();
                $pdf->SetHTMLFooter('<div style="font-size:10pt; font-family: Dejavu Sans;">Page {PAGENO} of {nb}  pages </div>');
//generate the PDF!
                $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
                $pdf->Output($pdfFilePath, "I");
            } else {
				echo "There is a mistake. <br/>The data item is not found.";
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

}

?>
