<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\{MPaymentChannel, MDeliveryService, MSlide};


class Aio extends BaseController {

    protected $m;
    protected $data = [];
    private $segments;
    private $seg;

    public function __construct()
    {
        $this->seg = array("payment_channel", "delivery_service","slide");
        $uri = current_url(true);
        $this->segments = $uri->getSegments();
        if ( !in_array($this->segments[2], $this->seg) )
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else
        {
            if($this->segments[2] == "payment_channel"){
                $this->data = [
                    "box_title" => "Payment Channel",
                    "url_web" => "payment_channel",
                    "title" => "Administrator - Payment Channel",
                ];
                $this->m = new MPaymentChannel();
            } else if ($this->segments[2] == "delivery_service"){
                $this->data = [
                    "box_title" => "Delivery Service",
                    "url_web" => "delivery_service",
                    "title" => "Administrator - Delivery Service"
                ];
                $this->m = new MDeliveryService();
            } else if ($this->segments[2] == "slide"){
                $this->data = [
                    "box_title" => "Slide",
                    "url_web" => "slide",
                    "title" => "Administrator - Slide"
                ];
                $this->m = new MSlide();
            }
            $this->data['l'] = $this->segments;
        }

    }

    public function index($s = false)
    {
        $this->data['data'] = $this->m->findAll();
        return view('backend/website/m_aio', $this->data);
    }

    public function edit($s = false, $id)
    {
        helper('form');
        $this->data['data'] = $this->m->where('id', $id)->first();
        $this->data['title'] = "Administrator - Edit {$this->data['box_title']}";
        return view('backend/website/e_aio', $this->data);
    }

    public function proses_edit($s = false)
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

        // Membuat aturan request data gambar
        if( !empty($img->getName()) )
        {
            $data_validasi['gambar'] = [
                'rules' => 'uploaded[gambar]','is_image[gambar]','mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'required' => 'Gambar Harus Di Input'
                ]
            ];
        }

        // Memvalidasi $data_validasi
        if( !$this->validate($data_validasi) )
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Mengambil seluruh request data
        $dr = $this->request->getVar();

        // Inisialisasi data nama ke var $data['nama']
        $data['nama'] = $dr['nama'];

        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $data['gambar'] = $fileName;
            $img->move(WRITEPATH . "uploads/{$this->data['url_web']}/", $fileName);
        }

        // Mengupdate data terbaru ke database
        $this->m->update($dr['id'], $data);
        // Buat pesan edit data berhasil
        session()->setFlashdata('msg', "Edit Data {$this->data['box_title']} Berhasil");

        return redirect()->to(base_url("administrator/{$this->data['url_web']}"));
    }

    public function tambah($s = false)
    {
        helper('form');
        $this->data['title'] = "Administrator - Tambah {$this->data['box_title']}";
        return view('backend/website/t_aio', $this->data);
    }

    public function proses_tambah($s = false)
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
        return redirect()->to(base_url("administrator/aio/{$this->data['url_web']}"));
    }

    public function delete($s = false, $id)
    {


    }
}