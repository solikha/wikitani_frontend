<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_custom extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function AddInspector($params){
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])
            and isset($params['newpassword']) and isset($params['confirmpassword'])
            and isset($params['namainspektor'])){
            $vcheck = $this->mlogin->checkUser($params['username']);
            
            if ($vcheck===false){
                if ($params['newpassword'] !== $params['confirmpassword'] ) {
                    throw new MgException('430', 'Password baru dan konfirmasi password tidak sama.');
                } else {
                    try {
                        // tipe enkripsi (sementara) adalah 1
                        $newpassword = $params['newpassword'];
                        $vcode = $this->mlogin->SysConfig['enccode'];
                        $encpass = $this->mlogin->strToHex($this->mlogin->rc4($vcode, $newpassword));
                        $params['fullname'] = $params['namainspektor'];
                        $vsql = "insert into app_inspektor(namainspektor, tempatlahir, tanggallahir, alamat, 
                            telepon, email) values (:namainspektor, :tempatlahir, to_date(:tanggallahir, 'DD-MM-YYYY'), :alamat, 
                            :telepon, :email);
                            insert into sys_users(username, password, fullname, inspektorid)
                              values(:username, :password, :fullname,
                                currval('app_inspektor_inspektorid_seq'));
                            insert into sys_userroles(userid, roleid)
                              values(currval('sys_users_userid_seq'), 2);
                            ";
                        $params['password'] = $encpass;
//                        $vparams = array('username'=>$params['username'], 'password'=>$encpass,
//                            'rcust_id'=>$params['rcust_id'], 'fullname'=>$params['fullname']);
                        $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                        $result = array('success'=>1, 'message'=>'Data user sudah ditambahkan.');
                        return $result;
                    } catch (Exception $e) {
                        //echo 'xerror: '.$e->getMessage();
                        throw new MgException('430', 'error: '.$e->getMessage());
                    }
                }
            } else {
                throw new MgException('430', 'Username sudah ada.');
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
        
    }

    public function AddUserInstansi($params){
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username'])
            and isset($params['newpassword']) and isset($params['confirmpassword'])
            and isset($params['namauser'])){
            $vcheck = $this->mlogin->checkUser($params['username']);
            
            if ($vcheck===false){
                if ($params['newpassword'] !== $params['confirmpassword'] ) {
                    throw new MgException('430', 'Password baru dan konfirmasi password tidak sama.');
                } else {
                    try {
                        // tipe enkripsi (sementara) adalah 1
                        $newpassword = $params['newpassword'];
                        $vcode = $this->mlogin->SysConfig['enccode'];
                        $encpass = $this->mlogin->strToHex($this->mlogin->rc4($vcode, $newpassword));
                        //$params['fullname'] = $params['namainspektor'];
                        $vsql = "insert into app_userinstansi(namauser, namainstansi, alamat, telepon, email)
                            values(:namauser, :namainstansi, :alamat, :telepon, :email);
                            insert into sys_users(username, password, fullname, userinstansiid)
                              values(:username, :password, :namauser,
                                currval('app_userinstansi_userinstansiid_seq'));
                            insert into sys_userroles(userid, roleid)
                              values(currval('sys_users_userid_seq'), 3);
                            ";
                        $params['password'] = $encpass;
//                        $vparams = array('username'=>$params['username'], 'password'=>$encpass,
//                            'rcust_id'=>$params['rcust_id'], 'fullname'=>$params['fullname']);
                        $res = $this->mdb->ExecSQL('application', $vsql, $params, 'array');
                        $result = array('success'=>1, 'message'=>'Data user sudah ditambahkan.');
                        return $result;
                    } catch (Exception $e) {
                        //echo 'xerror: '.$e->getMessage();
                        throw new MgException('430', 'error: '.$e->getMessage());
                    }
                }
            } else {
                throw new MgException('430', 'Username sudah ada.');
            }
        } else {
            throw new MgException('430', 'Parameter tidak lengkap.');
        }
        
    }

    function setPassword($params){
        $this->load->model('login/m_login', 'mlogin');
        if (isset($params['username']) and isset($params['newpassword']) 
            and isset($params['confirmpassword'])){
            if ($params['newpassword'] !== $params['confirmpassword'] ) {
                throw new MgException('430', 'Password baru dan konfirmasi password tidak sama.');
            } else {
                // tipe enkripsi (sementara) adalah 1
                $newpassword = $params['newpassword'];
                $vcode = $this->mlogin->SysConfig['enccode'];
                $encpass = $this->mlogin->strToHex($this->mlogin->rc4($vcode, $newpassword));
                $vsql = "update sys_users set enctype = 1, password = :password where username = :username";
                $vparams = array('username'=>$params['username'], 'password'=>$encpass);
                $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
                $result = array('success'=>1, 'message'=>'Password sudah diset.');
                return $result;
            }
        } else {
            throw new MgException('430', 'Parameter change password tidak lengkap.');
        }
        //print_r($params);
        //throw new Exception('Change Password!');
    }
	
	 function setPasswordCustUser($params){
        $this->load->model('cust_user/m_cust_user', 'mcustuser');
        if (isset($params['username']) and isset($params['newpassword']) 
            and isset($params['confirmpassword'])){
            if ($params['newpassword'] !== $params['confirmpassword'] ) {
                throw new MgException('430', 'Password baru dan konfirmasi password tidak sama.');
            } else {
                // tipe enkripsi (sementara) adalah 1
                $newpassword = $params['newpassword'];
                $vcode = $this->mlogin->SysConfig['enccode'];
                $encpass = $this->mlogin->strToHex($this->mlogin->rc4($vcode, $newpassword));
                $vsql = "update app_cust_user set password = :password where username = :username";
                $vparams = array('username'=>$params['username'], 'password'=>$encpass);
                $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
                $result = array('success'=>1, 'message'=>'Password sudah diset.');
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
