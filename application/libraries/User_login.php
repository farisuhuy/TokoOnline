<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_login
{
 protected $CI;
 
 public function __construct()
 {
    $this->ci = &get_instance();
    $this->ci->load->model('m_auth');
 }

 public function login($username,$passowrd)
 {
    $cek = $this->ci->m_auth->login_user($username,$passowrd);
    if ($cek) {
        $nama_user = $cek->nama_user;
        $username = $cek->username;
        $level_user = $cek->level_user;
        
        $this->ci->session->set_userdata('username', $username);
        $this->ci->session->set_userdata('nama_user', $nama_user);
        $this->ci->session->set_userdata('level_user', $level_user);
        redirect('admin');
    }else{
        $this->ci->session->set_flashdata('error', 'Username Atau Password Salah!');
        redirect('Auth/login_user');
    }
    
 }
 
 public function proteksi_halaman()
 {
    if ($this->ci->session->userdata('username') == '') {
        $this->ci->session->set_flashdata('error', 'Anda Belum Login !!!');
        redirect('Auth/login_user');
    }
 }

 public function logout()
 {
    $this->ci->session->unset_userdata('username');
    $this->ci->session->unset_userdata('nama_user');
    $this->ci->session->unset_userdata('level_user');
    $this->ci->session->set_flashdata('pesan', 'Anda Bethasil Logout !!!');
    redirect('Auth/login_user');
 }
}