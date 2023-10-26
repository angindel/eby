<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\MKategoriProduk;

class Kategori extends BaseController
{
    protected $m_katpro;
    private $data = [];
    private $segments;

    public function __construct()
    {
        $uri = current_url(true);
        $this->segments = $uri->getSegments();
        $this->data['l'] = $this->segments;
        $this->m_katpro = new MKategoriProduk();
    }

    public function index()
    {
        $this->data['kategori_produk'] = $this->m_katpro->findAll();
        $this->data['title'] = 'Kategori';

        return view('backend/kategori/Home', $this->data);

    }

    public function sunting($id)
    {
        helper('form');
        $this->data['edit'] = $this->m_katpro->where('id_kategori_produk', $id)->first();
        $this->data['title'] = 'edit_kategori';
        return view('backend/kategori/Edit_kategori', $this->data);
    }

    public function proses_sunting()
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

        $this->data = [
            'nama_kategori' => $dr['nama_kategori'],
        ];
        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $this->data['gambar'] = $fileName;
            $img->move(WRITEPATH . 'uploads/kategori/', $fileName);
        }


        $this->m_katpro->update($dr['id'], $this->data);
        session()->setFlashdata('msg', 'Edit Data Kategori Berhasil');

        return redirect()->to(base_url('administrator/kategori'));
    }

    public function tambah()
    {
        helper('form');
        $this->data['title'] = 'tambah_kategori';
        return view('backend/kategori/Tambah_kategori', $this->data);
    }

    public function proses_tambah()
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
        $img = $this->request->getFile('gambar');

        $this->data = [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'kategori_seo' => seo_title($this->request->getVar('nama_kategori'))
        ];

        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $this->data['gambar'] = $fileName;
            $img->move(WRITEPATH . 'uploads/kategori/', $fileName);
        }
        else
        {
            $this->data['gambar'] = NULL;
        }


        $this->m_katpro->insert($this->data);
        session()->setFlashdata('msg', 'Tambah Data Kategori Berhasil');
        return redirect()->to(base_url('administrator/kategori'));
    }

    public function hapus()
    {
        if( !$this->request->is('post') )
        {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }
        $id = $this->request->getVar('id_kategori_produk');
        if($this->m_katpro->delete($id))
        {
            return $this->response->setJSON(['token' => csrf_hash()]);
        }
    }

}