<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_user extends MY_Model {

    var $keys;
    var $SysConfig;

    public function __construct() {
        parent::__construct();
		$this->prepareKey();
        $this->SysConfig = $this->ci->config->item('sysconfig');
    }
	
	function prepareKey(){
        $vx=array();
        $vx[0] = '17283'; $vx[1] = '33480'; $vx[2] = '42503'; $vx[3] = '17676'; $vx[4] = '88947'; 
        $vx[5] = '87961'; $vx[6] = '91578'; $vx[7] = '85077'; $vx[8] = '61295'; $vx[9] = '26954'; 
        $vx[10] = '62432'; $vx[11] = '86209'; $vx[12] = '10263'; $vx[13] = '27646'; $vx[14] = '98500'; 
        $vx[15] = '85758'; $vx[16] = '56790'; $vx[17] = '42225'; $vx[18] = '28220'; $vx[19] = '13414'; 
        $vx[20] = '96813'; $vx[21] = '67878'; $vx[22] = '85031'; $vx[23] = '23861'; $vx[24] = '71270'; 
        $vx[25] = '56793'; $vx[26] = '97368'; $vx[27] = '46790'; $vx[28] = '56098'; $vx[29] = '96157'; 
        $vx[30] = '28671'; $vx[31] = '56886'; $vx[32] = '82235'; $vx[33] = '48158'; $vx[34] = '67376'; 
        $vx[35] = '73838'; $vx[36] = '45617'; $vx[37] = '89983'; $vx[38] = '86920'; $vx[39] = '72333'; 
        $vx[40] = '67183'; $vx[41] = '83819'; $vx[42] = '95742'; $vx[43] = '72059'; $vx[44] = '42871'; 
        $vx[45] = '26855'; $vx[46] = '57279'; $vx[47] = '47702'; $vx[48] = '93616'; $vx[49] = '51278'; 
        $vx[50] = '69968'; $vx[51] = '18951'; $vx[52] = '25358'; $vx[53] = '64275'; $vx[54] = '97247'; 
        $vx[55] = '50492'; $vx[56] = '49034'; $vx[57] = '18033'; $vx[58] = '57554'; $vx[59] = '72015'; 
        $vx[60] = '60581'; $vx[61] = '89741'; $vx[62] = '94325'; $vx[63] = '58205'; $vx[64] = '90936'; 
        $vx[65] = '51585'; $vx[66] = '35999'; $vx[67] = '28750'; $vx[68] = '36037'; $vx[69] = '80754'; 
        $vx[70] = '26012'; $vx[71] = '48339'; $vx[72] = '16822'; $vx[73] = '39435'; $vx[74] = '72803'; 
        $vx[75] = '46658'; $vx[76] = '19228'; $vx[77] = '14814'; $vx[78] = '49808'; $vx[79] = '88395'; 
        $vx[80] = '74193'; $vx[81] = '49081'; $vx[82] = '55466'; $vx[83] = '13238'; $vx[84] = '77653'; 
        $vx[85] = '49421'; $vx[86] = '53214'; $vx[87] = '65873'; $vx[88] = '60548'; $vx[89] = '58023'; 
        $vx[90] = '51489'; $vx[91] = '85989'; $vx[92] = '98813'; $vx[93] = '72075'; $vx[94] = '13729'; 
        $vx[95] = '48273'; $vx[96] = '43387'; $vx[97] = '43763'; $vx[98] = '38372'; $vx[99] = '62413'; 
        $this->keys = $vx;
    }
	
	function rc4($key, $str) {
            $s = array();
            for ($i = 0; $i < 256; $i++) {
                    $s[$i] = $i;
            }
            $j = 0;
            for ($i = 0; $i < 256; $i++) {
                    $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
                    $x = $s[$i];
                    $s[$i] = $s[$j];
                    $s[$j] = $x;
            }
            $i = 0;
            $j = 0;
            $res = '';
            for ($y = 0; $y < strlen($str); $y++) {
                    $i = ($i + 1) % 256;
                    $j = ($j + $s[$i]) % 256;
                    $x = $s[$i];
                    $s[$i] = $s[$j];
                    $s[$j] = $x;
                    $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
            }
            return $res;
    }    
    
	
	function hexToStr($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
    
    function strToHex($string){
        $hex='';
        for ($i=0; $i < strlen($string); $i++){
            $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT);
        }
        return $hex;
    }    

    public function AddUser($params) {
        $this->load->model('login/m_login', 'mlogin');
         try {
			$password = $params['password'];
			$vcode = $this->SysConfig['enccode'];
			$encpass = $this->strToHex($this->rc4($vcode, $password));
			$vsql = "insert into sys_users(username, fullname, password) 
			values (:username, :fullname, :password);";
			$vparams = array('username'=>$params['username'],'fullname'=>$params['fullname'], 'password'=>$encpass);
            $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
			
			$result = array('success' => 1, 'message' => 'Data User sudah ditambahkan.');
			return $result;
		} catch (Exception $e) {
			throw new MgException('430', 'error: ' . $e->getMessage());
		}
    }

    public function AddOrangTua($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])) {
            if ($params['username'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_orangtua(nama, tempat_lahir, tgl_lahir, pendidikan, telepon, email, alamat, last_update) 
                    values (:nama, :tempat_lahir, to_date(:tgl_lahir, 'DD-MM-YYYY'), :pendidikan, :telepon, :email, :alamat, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Orang Tua sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddSiswa($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['nama_lengkap'])) {
            if ($params['nama_lengkap'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_siswa(nis, nama_lengkap, tempat_lahir, tgl_lahir, ortuid, anak_ke, goldarah, agama, jenis_kelamin, asal_sekolah, telepon, tahun_masuk, kelas_masuk, alamat, kodepos, last_update) 
                    values (:nis, :nama_lengkap, :tempat_lahir, to_date(:tgl,'DD-MM-YYYY'), :ortuid, :anak_ke, :goldarah, :agama, :jenis_kelamin, :asal_sekolah, :telepon, :tahun_masuk, :kelas_masuk, :alamat, :kodepos, now());
                    insert into app_siswa_kelas(kelasid, siswaid, last_update) values (1, currval('app_siswa_id_seq'), now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Siswa sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddMataPelajaran($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])) {
            if ($params['username'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_pelajaran(nama, kode, last_update, tahunajaranid, tingkat) values (:nama, :kode, now(), :tahunajaranid, :tingkat);";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Pelajaran sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddSpp($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['nominal'])) {
            if ($params['nominal'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_siswa_spp(siswaid, tahun, bulan, nominal, last_update) values (:siswaid, :tahun, :bulan, :nominal, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Spp sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddNilai($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['kelasid'])) {
            if ($params['kelasid'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_siswa_nilai(kelasid, pelajaranid, jenisid, siswaid, nilai_angka, nilai_huruf, keterangan, last_update) values (:kelasid, :pelajaranid, :jenisid, :siswaid, :nilai_angka, :nilai_huruf, :keterangan, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Nilai sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddJenisEvaluasi($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])) {
            if ($params['username'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_jenis_evaluasi(nama, deskripsi, last_update) values (:nama, :deskripsi, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Jenis sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddDisiplin($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['siswaid'])) {
            if ($params['siswaid'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_siswa_disiplin(siswaid, disiplinid, tanggal, deskripsi, nilai, pengawasid, last_update) values (:siswaid, :disiplinid, to_date(:tanggal,'DD-MM-YYYY'), :deskripsi, :nilai, :pengawasid, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Nilai sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddJenisDisiplin($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])) {
            if ($params['username'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_disiplin_jenis(nama, deskripsi, last_update) values (:nama, :deskripsi, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data disiplin sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddTingkat($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])) {
            if ($params['username'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_kelas(nama, ruangan, tingkat, last_update, tahunajaranid, walikelasid) values (:nama, :ruangan, :tingkat, now(), :tahunajaranid, :walikelasid);";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Kelas sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    public function AddTahunAjaran($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])) {
            if ($params['username'] == null) {
                throw new MgException('430', 'Data belum terisi.');
            } else {
                try {
                    $vsql = "insert into app_tahun_ajaran(nama, tgl_mulai, tgl_akhir, semester, deskripsi, last_update) values (:nama, to_date(:tgl_mulai,'DD-MM-YYYY'), to_date(:tgl_akhir,'DD-MM-YYYY'), :semester, :deskripsi, now());";
                    $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                    $result = array('success' => 1, 'message' => 'Data Kelas sudah ditambahkan.');
                    return $result;
                } catch (Exception $e) {
                    throw new MgException('430', 'error: ' . $e->getMessage());
                }
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
    }

    function setPassword($params) {
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username']) and isset($params['newpassword']) and isset($params['confirmpassword'])) {
            if ($params['newpassword'] !== $params['confirmpassword']) {
                throw new MgException('430', 'Password baru dan konfirmasi password tidak sama.');
            } else {
                // tipe enkripsi (sementara) adalah 1
                $newpassword = $params['newpassword'];
                $vcode = $this->mlogin->SysConfig['enccode'];
                $encpass = $this->mlogin->strToHex($this->mlogin->rc4($vcode, $newpassword));
                $vsql = "update sys_users set enctype = 1, password = :password where username = :username";
                $vparams = array('username' => $params['username'], 'password' => $encpass);
                $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
                $result = array('success' => 1, 'message' => 'Password sudah diset.');
                return $result;
            }
        } else {
            throw new MgException('430', 'Parameter change password tidak lengkap.');
        }
        //print_r($params);
        //throw new Exception('Change Password!');
    }
}
?>