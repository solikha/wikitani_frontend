<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Workflow extends MY_Controller {

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

    function save_import() {
//        $checkbox = $this->input->post('checkbox');
//        $number = $this->input->post('number');
//        $code = $this->input->post('code');
//        $name = $this->input->post('name');
//        if (is_array($name)) {
//            for ($i = 0; $i < count($name); $i++) {
//                if ($checkbox[$i] != NULL)
//                    echo $name[$i] . '     ' . $code[$i] . '    ' . $number[$i] . '     ,.,.,';
//            }
//        } else {
//            echo "1";
//        }
//        $arr = array('one', 'two', 'three', 'four', 'stop', 'five');
//        while (list(, $val) = each($arr)) {
//            if ($val == 'stop') {
//                continue;    /* You could also write 'break 1;' here. */
//            }
//            echo "$val<br />\n";
//        }


        var_dump($_POST);
    }

    function cetaks($quotc = "") {
        $id = $_GET["quots_id"];
        try {
            $this->load->library('fpdf');
            define('FPDF_FONTPATH', $this->config->item('fonts_path'));
            $baris0 = 4.2;
            $this->load->model('m_gas', 'gas_db');
            $dataini = $this->gas_db->quotc($id);
            if ($dataini != null) {
                $datapol = $this->gas_db->data_quotc($id);
                if ($datapol != null) {
                    $this->fpdf->AddPage('P');
                    $this->fpdf->SetFont('Arial', '', 10);
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(20, $baris0);
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(0, $baris0, "Quotation For Customer", 0, 0, 'C');
                    $this->fpdf->SetFont('Arial', '', 9);
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Customer RFQ NO");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['rfq_number']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Quotation Name");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['name']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Ship To");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['ship_to']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Quotation Date");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['quotation_date']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Terms");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['terms']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Reff");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['reff']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Telephone Number");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['phone']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Fax");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['fax']}");
                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(30, $baris0);
                    $this->fpdf->Cell(50, $baris0, "Email");
                    $this->fpdf->Cell(2, $baris0, ": {$datapol[0]['email']}");

                    $this->fpdf->Ln();
                    $this->fpdf->Ln();

                    $this->fpdf->Ln();
                    $this->fpdf->Ln();
                    $this->fpdf->Cell(0, $baris0, "Data Grid Quotation", 0, 0, 'C');

                    $this->fpdf->Ln();
                    $this->fpdf->Ln();

                    $this->fpdf->Ln();
                    $this->fpdf->Ln();


                    $this->fpdf->Cell(5, $baris0, "No", 1);
                    $this->fpdf->Cell(26, $baris0, "Part Number", 1);
                    $this->fpdf->Cell(26, $baris0, "Description", 1);
                    $this->fpdf->Cell(26, $baris0, "Condition", 1);
                    $this->fpdf->Cell(26, $baris0, "Quotation Qty", 1);
                    $this->fpdf->Cell(26, $baris0, "Supplier", 1);
                    $this->fpdf->Cell(26, $baris0, "Price", 1);
                    $this->fpdf->Cell(26, $baris0, "Supplier Price", 1);
                    foreach ($dataini as $row) {
                        $this->fpdf->SetFont('Arial', '', 9);
                        $this->fpdf->Ln();
                        foreach ($row as $key => $column)
                            if ($key == 'id') {
                                if (strlen($column) > 10) {
                                    $this->fpdf->Cell(5, $baris0, substr($column, 0, 10) . '..', 1);
                                } else {
                                    $this->fpdf->Cell(5, $baris0, $column, 1);
                                }
                            } else {
                                if (strlen($column) > 10) {
                                    $this->fpdf->Cell(26, $baris0, substr($column, 0, 10) . '..', 1);
                                } else {
                                    $this->fpdf->Cell(26, $baris0, $column, 1);
                                }
                            }
                    }
                    $this->fpdf->Output('QuotationCustomer.pdf', 'D');
                } else {
                    throw new Exception('<h1>data pejabat tidak ada!</h1>');
                }
            } else {
                throw new Exception('<h1>data tidak ditemukan, mohon maaf!</h1>');
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    public function email_rfqc() {
        $this->load->model('m_gas', 'gas_db');
        $data_rfqc = $this->gas_db->data_quotc($_GET['quots_id']);
        $data['id'] = $_GET['quots_id'];
        $data['to'] = $data_rfqc[0]['email'];
        $data['subject'] = "RFQ For Customer";
        $this->load->view('view_send', $data);
    }

    public function send_email() {
        try {
            $id_data = $this->input->post('id');
            $to = $this->input->post('to');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $this->load->model('m_gas', 'gas_db');
            $data_rfqc = $this->gas_db->data_quotc($id_data);
            $datas = $this->gas_db->quotc($id_data);
            if ($data_rfqc && $datas != NULL) {
                $data['data_rfqc'] = array(
                    'rfq_number' => $data_rfqc[0]['rfq_number'],
                    'name' => $data_rfqc[0]['name'],
                    'addres' => $data_rfqc[0]['addres'],
                    'quotation_date' => $data_rfqc[0]['quotation_date'],
                    'ship_to_name' => $data_rfqc[0]['ship_to_name'],
                    'ship_to_address' => $data_rfqc[0]['ship_to_address'],
                    'quot_no' => $data_rfqc[0]['quot_no'],
                    'requirement' => $data_rfqc[0]['requirement']
                );
                $data['icon'] = BASEPATH . "../themes/aceadmin/images/logo.jpg";
                $data['data'] = $datas;
                $data['total'] = $this->gas_db->total($id_data);
//            $this->load->view('print_rfqc', $data);
                $html = $this->load->view('print_rfqc', $data, true);
//this the the PDF filename that user will get to download
                $pdfFilePath = "RFQ_FOR_Customer.pdf";
//load mPDF library
                $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();
//generate the PDF!
                $page = $pdf->page + 1;
//echo $page; die();
                $pdf->SetHTMLFooter('<div style="background-color:#B2CBF0; height:10px; width:900px;"></div><br>Page [' . $page . '] of {nb}  pages');
//generate the PDF!
                $pdf->WriteHTML($html);
                //offer it to user via browser download! (The PDF won't be saved on your server HDD)
//            $pdf->Output($pdfFilePath, "D");
                $pdf->Output($pdfFilePath, "F");

                $ci = get_instance();
                $ci->load->library('email');
                $config['protocol'] = "smtp";
                $config['smtp_host'] = "ssl://smtp.gmail.com";
                $config['smtp_port'] = "465";
                $config['smtp_user'] = "alimin4444@gmail.com";
                $config['smtp_pass'] = "assalamualaikumalimin2";
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";
                $ci->email->initialize($config);
                $ci->email->from('alimin4444@gmail.com', 'alimin ali');
                $list = array($to);
                $ci->email->to($list);
                $this->email->reply_to('rekysenjaya@gmail.com', 'Explendid Videos');
                $ci->email->subject($subject);
                $ci->email->message($message);
                $path = $_SERVER["DOCUMENT_ROOT"];
                $file = $path . "/RFQ_FOR_Customer.pdf";
                $this->email->attach($file);
                $ci->email->send();
                redirect('menu/quot_c?quotc_id=' . $id_data, 'location');
            } else {
                echo "<h1>data kosong mohon maaf.</h1>";
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    public function cetak() {
        try {
            $this->load->model('m_gas', 'gas_db');
            $data_rfqc = $this->gas_db->data_quotc($_GET["quots_id"]);
            $datas = $this->gas_db->quotc($_GET["quots_id"]);
            if ($data_rfqc && $datas != NULL) {
                $data['data_rfqc'] = array(
                    'quot_no' => $data_rfqc[0]['quot_no'],
                    'rfq_number' => $data_rfqc[0]['rfq_number'],
                    'rfq_date' => $data_rfqc[0]['rfq_date'],
                    'name' => $data_rfqc[0]['name'],
                    'phone' => $data_rfqc[0]['phone'],
                    'fax' => $data_rfqc[0]['fax'],
                    'addres' => $data_rfqc[0]['addres'],
                    'quotation_date' => $data_rfqc[0]['quotation_date'],
                    'ship_to_name' => $data_rfqc[0]['ship_to_name'],
                    'ship_to_address' => $data_rfqc[0]['ship_to_address'],
                    'quot_no' => $data_rfqc[0]['quot_no'],
                    'requirement' => $data_rfqc[0]['requirement'],
                    'terms_id' => $data_rfqc[0]['terms_id'],
                    'freight' => $data_rfqc[0]['freight'],
                    'freight_description' => $data_rfqc[0]['freight_description'],
                    'valid_to' => $data_rfqc[0]['valid_to'],
                    'incoterms_id' => $data_rfqc[0]['incoterms_id'],
                    'incoterms_text' => $data_rfqc[0]['incoterms_text']
                );
                $data['icon'] = BASEPATH . "../themes/aceadmin/images/logo.jpg";
                $data['data'] = $datas;
                $data['total'] = $this->gas_db->total($_GET["quots_id"]);
                //$this->load->view('print_rfqc', $data);
                $html = $this->load->view('print_rfqc', $data, true);
                //this the the PDF filename that user will get to download
                $pdfFilePath = "Quotation_For_Customer.pdf";
                //load mPDF library
                $this->load->library('m_pdf');
                //actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load(array('mgt' => 65, 'mgh' => 10));
                //add header on first page
                $vheader1 = $this->load->view('print_rfqc_header', $data, true);
                $pdf->setHTMLHeader($vheader1);

                //generate the PDF!
                $page = $pdf->page + 1;
                //echo $page; die();
                $pdf->AddPage();
                //add header on page other
                $vheader2 = $this->load->view('print_rfqc_header', $data, true);
                $pdf->setHTMLHeader($vheader2);
                $pdf->SetHTMLFooter('<div style="font-size:10pt; font-family: Dejavu Sans;"><br>Page' . ' {PAGENO} of {nb}  pages </div>');
                $pdf->SetTitle('Quotation For Customer');

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

    public function setemail() {
        $email = "rekysenjaya@gmail.com";
        $subject = "some text";
        $message = "some text";
        $this->sendEmail($email, $subject, $message);
    }

    public function sendEmail($email, $subject, $message) {


        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'abc@gmail.com',
            'smtp_pass' => 'passwrd',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );


        $basefolder = $this->ci->config->item('filefolder');
        $inputFileName = $basefolder . 'data.xlsx';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('abc@gmail.com');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($inputFileName);
        if ($this->email->send()) {
            echo 'Email send.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function to_invoice() {
        try {
            $id = $this->input->post('id');
            $this->load->model('m_gas', 'gas_db');
            $data = $this->gas_db->to_invoice($id);
            $datas = $this->gas_db->to_invoice_po($id);
            if ($data != null) {
                $echo = json_encode($data[0]);
            } elseif ($datas[0]['invoice_names'] && $datas[0]['invoice_addresss']) {
                $echo = json_encode($datas[0]);
            }
            echo $echo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function set_no($code) {
        $year = date("Y");
        $month = date('m');
        $number = $this->generate_number($code, $month, $year);
        echo $number;
    }

    function get_no($code) {
        $year = date("Y");
        $month = date('m');
        $this->load->model('m_workflow', 'db_workflow');
        $data = $this->db_workflow->data_no($code, $month, $year);
        if ($data != NULL) {
            $codes = $data['code'];
            $years = substr($data['year'], 2);
            $months = $this->zeropadded_two($data['month']);
            $nos = $this->no_urut($data['no']);
            $hasil = 'GAS-' . $codes . '-' . $months . '-' . $years . '-' . $nos;
        } else {
            $hasil = 'GAS-' . $code . '-' . $this->zeropadded_two($month) . '-' . substr($year, 2) . '-' . $this->no_urut(0);
        }
        echo $hasil;
    }

    function generate_number($code, $month, $year) {
        $this->load->model('m_workflow', 'db_workflow');
        $data = $this->db_workflow->data_no($code, $month, $year);
        if ($data != NULL) {
            $codes = $data['code'];
            $years = substr($data['year'], 2);
            $months = $this->zeropadded_two($data['month']);
            $nos = $this->no_urut($data['no']);
            $this->db_workflow->update_data_no_max($code, $month, $year, $nos);
            $hasil = 'GAS-' . $codes . '-' . $months . '-' . $years . '-' . $nos;
        } else {
            $this->db_workflow->insert_data_no_max($code, $month, $year, $this->no_urut(0));
            $hasil = 'GAS-' . $code . '-' . $this->zeropadded_two($month) . '-' . substr($year, 2) . '-' . $this->no_urut(0);
        }
        return $hasil;
    }

    function no_urut($padded) {
        if ($padded == NULL) {
            $bilangans = $padded . '1';
        } else {
            $bilangans = $padded + 1;
        }
        return $this->zeropadded_three($bilangans);
    }

    function zeropadded_three($bilangans) {
        $fzeropadded = sprintf("%03d", $bilangans);
        return $fzeropadded;
    }

    function zeropadded_two($bilangans) {
        $fzeropadded = sprintf("%02d", $bilangans);
        return $fzeropadded;
    }

}

?>
