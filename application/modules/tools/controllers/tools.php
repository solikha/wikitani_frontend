<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class Tools extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
    }
    
    function sql(){
        $sessData = $this->checkSessionData();
        if ($sessData===false){
            //echo "***";
            echo 'not login.';
            //$this->mlogin->openLoginScreen();
        } else {
            //$this->load->model('m_tools', 'mtools');
            //$this->mtools->sql();
            $this->load->view('sql');
        }
    }

    function testing(){
        $x = '88a576c7fc3ed355d4226bbfe1dafab1';
        $xd = base_convert($x, 16, 36); 
        echo $xd;
    }

    function testing2(){
        $num = 1000;
        $xd = base_convert($num, 10, 36);
        echo $xd;
    }

    function test_base(){
        for ($x=0; $x<100; $x++){
            $xd = $this->getNumHash($x);
            echo $xd; echo "<br>\r\n";
        }
        //echo "test-base";
    }

    function getNumHash2($x){
        $num = 879182731+$x;
        $xd = hash('crc32b', $num);
        $xd = base_convert($xd, 16, 36);
        $xd = strtoupper($xd);
        $xd = substr($xd.'EAS1A2', 0, 8);
        $xxd = $xd;
        $a = substr($xxd, 0, 4);
        $b = substr($xxd, 4, 4);
        $xd = $b.'-'.$a;
        return $xd;
    }

    function getNumHash3($x){
        $num = (100+$x).'';
        $xd = enc_rc4('12355', $num);
        $xd = strToHex($xd);
        $xd = base_convert($xd, 16, 36);
        $xd = strtoupper($xd);
        $xxd = $xd;
        $a = substr($xxd, 0, 4);
        $b = substr($xxd, 4, 4);
        $xd = $b.'-'.$a;
        return $xd;
        //$xd = hash('crc32b', $num);
        $xd = strtoupper($xd);
        //$xd = substr($xd.'EAS1A2', 0, 8);
        $xxd = $xd;
        $a = substr($xxd, 0, 4);
        $b = substr($xxd, 4, 4);
        $xd = $b.'-'.$a;
        return $xd;
    }

    function getNumHash($num){
        $result = '';
        $xnum = $num+4200;
        if ($xnum>0){
            while ($xnum>0) {
                $xx = $xnum % 1000;
                $result = $this->data[$xx].$result;
                $xnum = floor($xnum/1000);
            }
        } else {
            $result = $this->data[0];
        } 
        return $result;
    }

    function test_base3(){
        echo $this->getNumHash(100);
    }
    
    function test_base2(){
        $list = array();
        $max = 800000;
        for ($x=0; $x<$max; $x++){
            $xd = $this->getNumHash($x);
            if(isset($list[$xd])){
                echo "collision at $x";
                die;
            }
            $list[$xd] = $x;
        }
        echo count($list);
        echo "success";
    }

    function shuffle_array2($count=0){
        $seed = array(
            '0','1','2','3','4','5','6','7','8','9',
            'A','B','C','D','E','F','G','H','I','J',
            'K','L','M','N','O','P','Q','R','S','T',
            'U','V','W','X','Y','Z');
        $rand = $seed;
        shuffle($rand);
        $result = array();
        for($i=0; $i<count($seed); $i++){
            $result[$seed[$i]] = $rand[$i];
        }
        // print_r($rand);
        // print_r($seed);
        print_r($result);
    }

    function printdata($arrdata){
        $idx = 0;
        foreach($arrdata as $item){
            echo '"'.strtoupper($item).'",';
            if ($idx>=14){
                $idx = 0;
                echo "\r\n";
            } else {
                $idx = $idx+1;
            } 

        }
    }

function convBase($numberInput, $fromBaseInput, $toBaseInput)
{
    if ($fromBaseInput==$toBaseInput) return $numberInput;
    $fromBase = str_split($fromBaseInput,1);
    $toBase = str_split($toBaseInput,1);
    $number = str_split($numberInput,1);
    $fromLen=strlen($fromBaseInput);
    $toLen=strlen($toBaseInput);
    $numberLen=strlen($numberInput);
    $retval='';
    if ($toBaseInput == '0123456789')
    {
        $retval=0;
        for ($i = 1;$i <= $numberLen; $i++)
            $retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
        return $retval;
    }
    if ($fromBaseInput != '0123456789')
        $base10=convBase($numberInput, $fromBaseInput, '0123456789');
    else
        $base10 = $numberInput;
    if ($base10<strlen($toBaseInput))
        return $toBase[$base10];
    while($base10 != '0')
    {
        $retval = $toBase[bcmod($base10,$toLen)].$retval;
        $base10 = bcdiv($base10,$toLen,0);
    }
    return $retval;
}
    function shuffle_array(){
        $xbase = '0123456789ABCDEFGHJKLMNPQRTUVWXYZ';
        $arrdata = array();
        $start = 85;
        for($i=$start; $i<$start+1000; $i++){
            $xdata = base_convert($i, 10, 36);

            $xdata = $this->convBase($i, '0123456789', $xbase);
            array_push($arrdata, $xdata);
        }
        shuffle($arrdata);
        $this->printdata($arrdata);
        print_r($arrdata);
    }

    var $data = array(
        "U9","UM","HT","Y1","CM","Q1","EL","33","XU","61","NT","QG","4R","N3","98",
        "CB","T0","DA","Y9","YZ","K7","BN","HH","NH","ED","MD","D5","YP","XB","XJ",
        "4X","TY","LX","67","80","Z3","2P","VB","A7","59","F8","DL","MT","H7","4C",
        "PT","NF","JX","E5","FV","ZU","WK","WE","WA","D7","7T","4D","32","M0","G0",
        "9M","YG","PB","7U","Q8","AT","LF","VT","QH","AZ","MW","H8","KG","WF","GQ",
        "DK","QM","J1","T2","FM","YC","Q2","MZ","AH","A0","BW","T9","PK","XH","36",
        "30","XT","TV","DR","7Y","VQ","EZ","LP","DY","KN","2U","DF","71","D0","HW",
        "AU","T4","NC","TF","GD","5R","X3","G4","K6","2N","5D","TR","4Y","QX","MB",
        "9W","4K","HR","XL","M9","81","BL","37","UY","5G","JA","T1","V4","A1","87",
        "ND","LM","2Y","XW","9X","CC","LN","BE","F4","CR","BB","7N","N9","9E","UB",
        "5N","3G","R8","T7","LA","AV","E6","TH","5V","U6","9B","MM","RE","EW","RF",
        "A5","D1","6P","L7","9K","W7","KB","8Y","BD","UA","QT","KP","JL","EU","U0",
        "JD","V8","CF","X2","84","C3","B5","LK","NY","4N","8F","AG","GM","9C","DX",
        "2M","L5","A6","6N","LH","5K","JP","AX","Q4","6E","KH","XM","4U","7D","9V",
        "4E","ET","NB","VW","A9","7A","T3","9Y","BU","XY","BZ","LQ","MA","5F","CW",
        "Y8","VP","6R","A8","X5","7C","7K","75","FL","DP","AF","AK","RL","DQ","8N",
        "EB","P2","3H","7G","U7","TZ","EF","PM","VM","6U","EK","B4","3U","66","8R",
        "76","5Q","3M","JT","72","WB","F3","LV","PE","TD","HF","RV","BQ","GE","V2",
        "LY","89","5T","PF","R6","D3","52","2R","HC","GN","96","MH","D8","HY","BJ",
        "JJ","DE","GR","LC","UK","TW","WT","BC","YY","VR","LU","FD","EA","FC","JZ",
        "8P","J6","XR","B3","UR","6T","T6","VY","DV","QL","6F","AC","E1","J5","49",
        "7E","BM","39","51","JM","YH","V1","FK","Z2","KJ","DT","C4","Y5","XF","FU",
        "YF","C7","X7","RP","YU","VL","VC","5P","BP","AA","ZD","4H","H2","L4","65",
        "5B","3Q","TU","45","GA","Q3","HE","3L","MY","3B","ZP","T5","KR","Z8","RZ",
        "J7","KX","Z9","NX","3F","B0","WR","PY","PD","QF","N6","8J","KY","UQ","HN",
        "K1","7J","97","WC","6X","57","UW","XD","H5","ZB","KU","YW","Y6","BH","ZM",
        "CQ","8U","99","A3","ZH","50","9Q","KQ","RG","G2","4B","44","7X","UP","EP",
        "D2","BV","69","JV","5Z","L6","TQ","HU","68","WP","M6","P9","6K","JC","2W",
        "LT","VF","42","UN","F2","Q6","FH","7L","FE","PA","WG","AE","U5","WU","J2",
        "5C","KW","GL","F6","L1","PH","HZ","PQ","Q0","WM","TJ","QW","JF","BK","NW",
        "TP","5W","G1","KD","60","BY","NM","YT","MF","FT","YN","H1","VE","CH","MP",
        "8X","9F","UV","3R","X4","2V","EC","HJ","DU","N5","HQ","PV","BX","CT","6L",
        "BA","R1","8Q","ER","HP","QU","XA","PZ","8M","8E","LZ","FQ","WJ","WD","X8",
        "VH","CA","U2","MK","8H","PX","CP","H9","4V","V5","W4","G7","C1","74","G8",
        "C6","RU","R0","W0","L0","UJ","DJ","CE","ZN","U8","Q9","NQ","U3","5L","KT",
        "K5","F1","JN","GZ","6Y","34","3A","NR","QR","FB","UG","MX","FG","3P","CK",
        "EV","NJ","9A","JW","48","62","Y4","YK","H4","GH","QJ","EJ","8D","FN","CV",
        "WN","ZR","JK","P3","PR","PL","F9","D6","LD","7H","T8","YA","JG","94","X0",
        "YQ","MG","3Y","Z5","QC","LG","E7","HV","91","P6","JU","TL","TA","B1","4W",
        "C2","R5","RW","V3","YB","QK","X6","31","D9","43","B7","XE","J0","V6","9D",
        "W8","83","P7","NP","7R","J8","DW","ZT","4G","KC","ZJ","ZG","W5","TK","3C",
        "E2","HA","F0","W2","RR","FZ","FA","DN","JY","KM","J3","Y0","7F","QY","ML",
        "C5","6D","FW","EG","K4","K0","VN","YV","Y3","KF","AN","8T","RJ","PP","XK",
        "GG","WX","53","8V","5X","6V","RC","VV","EH","M8","6Z","FJ","AW","QA","AR",
        "9Z","CY","K3","YJ","TC","8W","DH","Q7","8Z","GX","93","R2","VG","4Q","6G",
        "7Q","92","ZQ","ZF","TM","HK","3K","XP","X9","FF","MC","63","NE","RK","AQ",
        "HM","N8","CN","B8","2Z","P5","DB","AL","V0","79","5M","6Q","ZA","9P","GW",
        "VZ","77","CL","UF","DC","L8","8K","2T","95","9N","NL","MV","F7","8G","QZ",
        "KL","JQ","HG","TE","RT","HL","4J","UX","XC","X1","E8","ZK","ME","3X","E9",
        "W9","G5","LJ","55","3W","90","XN","M7","P8","6B","PN","JB","Y7","UH","WV",
        "88","EX","64","D4","EE","5A","A2","A4","Z6","8C","MJ","HB","MU","TN","CG",
        "9H","CU","9G","XG","K8","PC","35","V9","M5","XQ","QE","78","QP","YE","6J",
        "3N","U4","4Z","C0","C8","WL","82","M1","41","AY","P4","RD","9L","WY","2X",
        "WZ","PW","QN","85","NZ","UZ","2L","FP","VJ","M2","Z7","E3","AB","56","AD",
        "3Z","PJ","RN","PU","P1","J4","FR","3E","YR","NG","XZ","M4","GC","38","JH",
        "CJ","4A","WQ","7W","R9","R4","MQ","KK","KA","46","4M","P0","HD","58","4L",
        "R7","4F","3V","RX","LL","3J","DM","8L","G9","RB","9R","7V","6M","FX","5U",
        "EY","QV","YL","2K","W1","DD","9J","DZ","40","5H","LW","Z4","73","MR","GV",
        "JR","8A","H0","YM","TX","BT","BR","ZV","TT","8B","DG","5E","XV","VX","GF",
        "WH","ZL","AP","V7","LB","QB","BG","FY","2Q","RM","N7","E4","5J","NN","KZ",
        "GY","TG","WW","NK","4P","N0","LR","6W","TB","GU","9T","JE","70","N4","RH",
        "6C","PG","7M","UE","GK","ZE","CD","G6","RQ","F5","5Y","6H","Q5","KV","UU",
        "UL","G3","86","K2","Y2","L3","GB","K9","AJ","C9","9U","RY","GJ","B9","YX",
        "N1","VU","MN","UD","YD","54","4T","QQ","EN","3T","NU","AM","L9","BF","7Z",
        "NA","47","W6","NV","QD","N2","E0","VD","R3","UC","RA","W3","HX","H6","L2",
        "EQ","B2","ZC","VK","KE","UT","CX","7B","3D","H3","VA","GP","XX","Z0","GT",
        "CZ","Z1","M3","LE","U1","B6","7P","6A","EM","J9"       
    );
}

?>
