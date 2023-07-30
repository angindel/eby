<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\{MProduks, MKategoriProduk};
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

class Produk extends BaseController
{
    protected $m_produk;
    protected $m_katpro;
    private $data = [];

    public function __construct()
    {
        $this->m_produk = new MProduks();
        $this->m_katpro = new MKategoriProduk();
        $rq = \Config\Services::request();
        $this->data['path'] = explode('/', $rq->getPath());
    }

    public function index()
    {
        $data['produk'] = $this->m_produk->orderBy('id_produk', 'DESC')->findAll();
        $data['kategori_produk'] = $this->m_katpro->orderBy('id_kategori_produk', 'DESC')->findAll();
        $data['title'] = 'Produk';
        $data['path'] = end($this->data['path']);
        return view('backend/produk/Home', $data);
    }

    public function tambah_produk()
    {
        helper('form');
        $data['kategori_produk'] = $this->m_katpro->orderBy('id_kategori_produk', 'DESC')->findAll();
        $data['title'] = 'tambah_produk';
        return view('backend/produk/Tambah_produk', $data);
    }

    use ResponseTrait;
    public function proses_produk()
    {
        helper('local');
        $rules = [
            'kategori_produk' => ['rules' => 'required','errors' => ['required' => 'Harus di isi']],
            'nama_produk' => ['rules' => 'required','errors' => ['required' => 'Harus di isi']],
            'harga_beli' => ['rules' => 'required|decimal','errors' => ['required' => 'Harus di isi', 'decimal' => 'Harus berupa angka']],
            'harga_reseller' => ['rules' => 'required','errors' => ['required' => 'Harus di isi', 'decimal' => 'Harga Reseller harus berupa angka']],
            'harga_konsumen' => ['rules' => 'required','errors' => ['required' => 'Harus di isi', 'decimal' => 'harus berupa angka']],
            'satuan' => ['rules' => 'required','errors' => ['required' => 'Harus di isi', 'decimal' => 'harus berupa angka']],
            'stok' => ['rules' => 'required','errors' => ['required' => 'Harus di isi', 'decimal' => 'harus berupa angka']],
            'berat' => ['rules' => 'required','errors' => ['required' => 'Harus di isi']],
            'warna' => ['rules' => 'required','errors' => ['required' => 'Harus di isi']],
            'size' => ['rules' => 'required','errors' => ['required' => 'Harus di isi']],
            'keterangan' => ['rules' => 'required','errors' => ['required' => 'Harus di isi']],
        ];
        $dr = $this->request->getVar();

        if( isset( $dr['tambah'] ) )
        {
            $rules['gambar'] = [
                'rules' =>  [
                    'uploaded[gambar]',
                    'is_image[gambar]',
                    'mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]'
                ],
                'errors' => [
                    'uploaded' => 'Harus di isi',
                    'mime_in' => 'Bukan Format Yang Di dukung',
                    'is_image' => 'Sepertinya Ini Bukan File Gambar'

                ]
            ];
        }
        
        if( !$this->validate($rules) )
        {
            //session()->setFlashdata('error', $this->validator->getErrors());
            // return redirect()->back()->withInput();
            $data['error'] = $this->validator->listErrors('produk_list');
            $data['token'] = csrf_hash();
            return $this->failValidationErrors($data);
        }

        $data = [
            'id_kategori_produk' => (int)$dr['kategori_produk'],
            'nama_produk' => $dr['nama_produk'],
            'produk_seo' => seo_title($dr['nama_produk']),
            'harga_beli' => (int)$dr['harga_beli'],
            'harga_reseller' => (int)$dr['harga_reseller'],
            'harga_konsumen' => (int)$dr['harga_konsumen'],
            'berat' => $dr['berat'],
            'warna' => $dr['warna'],
            'size' => $dr['size'],
            'satuan' => $dr['satuan'],
            'keterangan' => $dr['keterangan'],
        ];

        $res = [];

        $img = $this->request->getFile('gambar');
        if(!is_null($img))
        {
            if( !is_null($img->isValid()) && !$img->hasMoved() )
            {
                $fileName = $img->getRandomName();
                $data['gambar'] = $fileName;
                $img->move(WRITEPATH . 'uploads/produk/', $fileName);
            }
            else
            {
                $res["gambar"] = 'Harap Upload ulang Gambar, Terjadi Masalah Pada Saat Mengupload, Jika info ini masih ada, Harap Hubungi Pembuat nya';
            }

        }

        if(isset($dr['edit']))
        {
            if( $this->m_produk->update($dr['id'], $data) )
            {
                $now = new Time('now');
                $db = db_connect();
                $stok = $db->table('stok');
                $dstok = [
                    "nama" => $dr['nama_produk'],
                    "stok_awal" => $dr['stok'],
                    "updated_at" => $now
                ];
                $res['info'] = $stok->where('id_produk', $dr['id'])->update($dstok) ? 'Edit Data Berhasil' : 'Edit Data Terjadi Kesalahan';

            }
            else
            {
                $res['info'] =  "Edit Data Gagal";
            }
        }
        elseif (isset($dr['tambah'])) {
            if($this->m_produk->insert($data, false))
            {
                $now = new Time('now');
                $db = db_connect();
                $stok = $db->table('stok');
                $dstok = [
                    "id_produk" => $this->m_produk->getInsertID(),
                    "nama" => $dr['nama_produk'],
                    "stok_awal" => $dr['stok'],
                    "stok_akhir" => $dr['stok'],
                    "created_at" => $now
                ];
                $res['info'] = $stok->insert($dstok) ? 'Tambah Data Berhasil' : 'Tambah Data Terjadi Kesalahan';
            }
            else
            {
                $res["info"] = 'Tambah Data Terjadi Kesalahan';
            }
        }

        $res["token"] = csrf_hash();
        $res["uri"] = base_url('administrator/produk');
        return $this->respond($res, 200);
    }

    public function edit_produk($id)
    {
        helper('form');
        $data['kategori_produk'] = $this->m_katpro->orderBy('id_kategori_produk', 'DESC')->findAll();
        $data['edit'] = $this->m_produk->where('id_produk', $id)->first();
        $data['edit']->warna = str_contains($data['edit']->warna, ',') ? explode(',', $data['edit']->warna) : $data['edit']->warna;
        $data['edit']->size = str_contains($data['edit']->size, ',') ? explode(',', $data['edit']->size) : $data['edit']->size;
        $db = db_connect();
        $stok = $db->table('stok')->where('id_produk', $id)->get()->getRow();
        $data['edit']->stok = (int)$stok->stok_awal;
        $data['title'] = 'edit_produk';
        return view('backend/produk/Edit_produk', $data);
    }

    public function delete_produk($id)
    {
        $this->m_produk->delete($id);
        return redirect()->to(base_url('administrator/produk'));
    }   

}