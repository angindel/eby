<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\MAdmins;

class Pengaturan extends BaseController {

    private $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function ubah_password()
    {
        helper('form');
        $data['title'] = 'Pengaturan - Ubah Password';
        return view('backend/pengaturan/ubah_password', $data);
    }

    public function proses_ubah_password()
    {
        if(!$this->request->is('post'))
        {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }
        $m_admin = new MAdmins();
        $old_pass = $this->request->getVar('old_pass');
        $new_pass = $this->request->getVar('new_pass');
        $val_pass = $this->request->getVar('val_pass');
        $data = $m_admin->where('username', 'admin')->first();
        
        $verif_pass = password_verify($old_pass, $data->password);
        if($verif_pass)
        {
            if($new_pass == $val_pass)
            {
                $password = password_hash($new_pass, PASSWORD_DEFAULT);
                $m_admin->where('username', 'admin')->set(['password' => $password])->update();
                $this->session->markAsFlashdata('success');
                $this->session->setFlashdata('berhasil', 'Password Berhasil Di Ubah');
                return redirect()->back()->withInput();   
            }
            else
            {
                $this->session->setFlashdata('gagal', 'Gagal Mengubah Password, Ada Yang Salah.!!!');
                return redirect()->back()->withInput();
            }
        }
        else
        {
            $this->session->setFlashdata('gagal', 'Gagal Mengubah Password, Ada Yang Salah.!!!');
                return redirect()->back()->withInput();
        }

    }
}