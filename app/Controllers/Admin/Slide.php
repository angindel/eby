<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\MDeliveryService;

class Slide extends BaseController
{
    protected $m_ds;

    public function __construct()
    {
        $this->m_ds = new MDeliveryService();
    }

    public function index()
    {
        $data['payment_channel'] = $this->m_ds->findAll();
        $data['box-title'] = 'PaymentChannel';
        return view('backend/website/m_aio', $data);

    }

    public function edit($id)
    {
        helper('form');
        $data['edit'] = $this->m_ds->where('id', $id)->first();
        $data['title'] = 'edit_kategori';
        return view('backend/website/Edit_PaymentChannel', $data);
    }

    public function proses_edit()
    {
     helper('local');
     $img = $this->request->getFile('gambar');
     $dvalid = [
        'nama' => ['rules' => 'required','errors' => ['required' => 'Nama Payment Channel Harus di isi']],
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


        $this->m_ds->update($dr['id'], $data);
        session()->setFlashdata('msg', 'Edit Data Payment Channel Berhasil');

        return redirect()->to(base_url('administrator/payment_channel'));
    }

    public function tambah()
    {
        helper('form');
        $data['title'] = 'tambah_payment_channel';
        return view('backend/website/Tambah_PaymentChannel', $data);
    }

    public function proses_tambah()
    {
        helper('local');
        if( !$this->validate([
            'nama' => [
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
        $img = $this->request->getFile('gambar');

        $data['nama'] = $this->request->getVar('nama');

        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $data['gambar'] = $fileName;
            $img->move(WRITEPATH . 'uploads/payment_channel/', $fileName);
        }
        else
        {
            $data['gambar'] = NULL;
        }


        $this->m_ds->insert($data);
        session()->setFlashdata('msg', 'Tambah Data Payment Channel Berhasil');
        return redirect()->to(base_url('administrator/payment_channel'));
    }

    public function delete($id)
    {

    }
}