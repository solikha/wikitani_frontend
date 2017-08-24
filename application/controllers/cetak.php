<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cetak extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        // load the view and saved it into $html variable
        $data = array();
        $html = $this->load->view('cetak', $data, true);
         
        // load mPDF library
        $this->load->library('m_pdf');

        /* Parameter yang dapat digunakan
         * format   : ukuran kertas (contoh: "A4", "A5", dll)
         * mgl      : margin left (int)
         * mgr      : margin right (int)
         * mgt      : margin top (int)
         * mgb      : margin bottom (int)
         * mgh      : margin header (int)
         * mgf      : margin margin footer (int)
         * default_font_size    : ukuran font (int)
         */
        $params = array();
        $pdf = $this->m_pdf->load($params);
         
        // generate the PDF from the given html
        $pdf->WriteHTML($html);
         
        // this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf.pdf";
        // Generate (D: download, I: inline)
        $pdf->Output($pdfFilePath, "I");
    }

    public function getlastimage($terminalid = '', $cctvid = '') {

        try {
            $sql = "SELECT * FROM log WHERE userid = :userid";
            $params = array("userid"=>$terminalid.$cctvid);
            $query = $this->mdb->QueryData('ftp', $sql, $params, 'record');

            $filename = ''; $tgl = '';
            foreach($query as $row) {
                $filename = $row['filename'];
                $tgl = $row['tgl'];
            }
            $localfile = str_replace('hd01/', '', $filename);
            $cloudfile = str_replace('/var/ftp/hd01/', '', $filename);
            $outfile = $terminalid . $cctvid . '.jpg';

            if (file_exists($localfile)) {

                header('Content-Length: ' . filesize($localfile));
                header('Content-Type: image/jpeg');
                header('Content-Disposition: inline; filename="' . $outfile .'";');
                readfile($localfile);
                die();
                exit;

            } else {

                $client = $this->load->library('google');
                $storageService = new Google_Service_Storage($client);

                $object = $storageService->objects->get('cctv', $cloudfile);
                $request = new Google_Http_Request($object->getMediaLink());
                $response = $client->getAuth()->authenticatedRequest($request);

                header('Content-Length: ' . $object->size);
                header('Content-Type: ' . $object->contentType);
                header('Content-Disposition: inline; filename="' . $outfile . '";');
                echo $response->getResponseBody();
                die();
                exit;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
}
?>
