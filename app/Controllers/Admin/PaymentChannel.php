<?php

namespace App\Controllers\Admin\PaymentChannel;

use App\Controllers\BaseController;
use CodeIgniter\Controller;


class PaymentChannel extends BaseController {

    public function index()
    {
        $data['payment_channel'] = $this->m_katpro->findAll();
        $data['title'] = 'PaymentChannel';
        $data['path'] = end($this->data['path']);
        return view('backend/PaymentChannel', $data);

    }

    public function edit_payment_channel($id)
    {
        helper('form');
        $data['edit'] = $this->m_katpro->where('id_kategori_produk', $id)->first();
        $data['title'] = 'edit_kategori';
        return view('backend/Edit_kategori', $data);
    }

    public function proses_payment_channel()
    {
     helper('local');
     $img = $this->request->getFile('gambar');
     $dvalid = [
        'nama_kategori' => ['rules' => 'required','errors' => ['required' => 'Nama Kategori Harus di isi']],
        ];
        if( !empty($img->getName()) )
        {
            $dvalid['gambar'] = ['rules' => 'uploaded[gambar]','is_image[gambar]','mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]','errors' => ['required' => 'Gambar Harus Di Input']];
        }
     if( !$this->validate($dvalid) )
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $dr = $this->request->getVar();

        $data = [
            'nama_kategori' => $dr['nama_kategori'],
        ];
        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $data['gambar'] = $fileName;
            $img->move(WRITEPATH . 'uploads/kategori/', $fileName);
        }


        $this->m_katpro->update($dr['id'], $data);
        session()->setFlashdata('msg', 'Edit Data Kategori Berhasil');

        return redirect()->to(base_url('administrator/kategori'));
    }

    public function tambah_payment_channel()
    {
        $data['title'] = 'tambah_kategori';
        return view('backend/Tambah_kategori', $data);
    }

    public function proses_tambah_payment_channel()
    {
        helper('local');
        if( !$this->validate([
            'nama_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kategori Harus di isi'
                ]
            ]
        ]) )
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->m_katpro->insert([
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'kategori_seo' => seo_title($this->request->getVar('nama_kategori'))
        ]);
        session()->setFlashdata('msg', 'Tambah Data Kategori Berhasil');
        return redirect()->to(base_url('administrator/kategori'));
    }
}