<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\MPaymentChannel;


class PaymentChannel extends BaseController {

    protected $m;
    protected $data = [];

    public function __construct()
    {
        $this->m = new MPaymentChannel();
        $this->data['title'] = 'Administrator - Payment Channel';
        $this->data['box_title'] = 'Payment Channel';
        $this->data['url_web'] = 'payment_channel';
    }

    public function index()
    {
        $this->data['data'] = $this->m->findAll();
        return view('backend/website/m_aio', $this->data);
    }

    public function edit($id)
    {
        helper('form');
        $data['edit'] = $this->m->where('id', $id)->first();
        $data['title'] = 'edit_kategori';
        return view('backend/website/Edit_PaymentChannel', $data);
    }

    public function proses_edit()
    {
        helper('local');
        $img = $this->request->getFile('gambar');
        
        // Membuat aturan request data nama
        $data_validasi = [
            "nama" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama {$this->data['box_title']} Harus di isi"
                ]
            ],
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
            'nama' => $dr['nama'],
        ];
        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $data['gambar'] = $fileName;
            $img->move(WRITEPATH . 'uploads/payment_channel/', $fileName);
        }


        $this->m->update($dr['id'], $data);
        session()->setFlashdata('msg', 'Edit Data Payment Channel Berhasil');

        return redirect()->to(base_url('administrator/payment_channel'));
    }

    public function tambah()
    {
        helper('form');
        $this->data['title'] = 'Administrator - Tambah Payment Channel';
        return view('backend/website/t_aio', $this->data);
    }

    public function proses_tambah()
    {
        helper('local'); // Panggil helper local

        // Membuat aturan request data nama
        $data_validasi = [
            "nama" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama {$this->data['box_title']} Harus di isi"
                ]
            ],
        ];

        // Memvalidasi $data_validasi
        if( !$this->validate($data_validasi) )
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Inisialiasi data gambar ke $img
        $img = $this->request->getFile('gambar');

        // Inisialisasi data nama ke $data['nama']
        $data['nama'] = $this->request->getVar('nama');

        // Memvalidasi jika tidak ada gambar
        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $data['gambar'] = $fileName;
            $img->move(WRITEPATH . "uploads/{$this->data['url_web']}/", $fileName);
        }
        else
        {
            $data['gambar'] = NULL;
        }

        // Masuksan data ke dalam database
        $this->m->insert($data);

        // Buat Pesan tambah data berhasil
        session()->setFlashdata("msg", "Tambah Data {$this->data['box_title']} Berhasil");

        // Redirect ke menu semua data
        return redirect()->to(base_url("administrator/{$this->data['url_web']}"));
    }

    public function delete($id)
    {

    }
}