<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\MAdmins;
use App\Models\MProduks;
use App\Models\MKategoriProduk;
use App\Models\MTransaksi;
use App\Models\MDatatables;
use App\Models\MIdentitas;

class Administrator extends BaseController
{
    private $ec;
    private $session;
    protected $m_produk;
    protected $m_katpro;
    private $data = [];

    public function __construct()
    {
        $this->m_katpro = new MKategoriProduk();
        $this->m_produk = new MProduks();
        $this->session = session();
        $this->ec = \Config\Services::encrypter();
        $rq = \Config\Services::request();
        $this->data['path'] = explode('/', $rq->getPath());
    }

    public function index()
    {
        helper('form');
        $data['title'] = 'Administrator';
        return view('backend/Admin', $data);
    }

    public function login()
    {
        $m_admin = new MAdmins();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $m_admin->where('username', $username)->first();
        if($data)
        {
            $verif_pass = password_verify($password, $data->password);
            if($verif_pass)
            {
                $s_data = [
                    'id_user' => base64_encode($this->ec->encrypt($data->id_user)),
                    'username' => base64_encode($this->ec->encrypt($data->username)),
                    'nama' => base64_encode($this->ec->encrypt($data->nama)),
                    'logged_in' => TRUE
                ];
                $this->session->set($s_data);
                return redirect()->to('administrator/dashboard');
            }
            else
            {
                $this->session->setFlashdata('msg', 'Username atau Password salah');
                return redirect()->back()->withInput();
            }
        }
        else
        {
            $this->session->setFlashdata('msg', 'Username atau Password salah');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('administrator');
    }

    public function dashboard()
    {
        $path = explode('/', $this->request->getPath());
        helper('form');
        $db = db_connect();
        $data = [
            'title' => "Dashboard",
            'total' => [
                'mtran' => $db->table('mtran')->countAll(),
                'produk' => $db->table('produk')->countAll(),
                'kategori_produk' => $db->table('kategori_produk')->countAll(),
            ],
            'path' => end($this->data['path'])
        ];
        return view('backend/Dashboard', $data);
        
    }

    public function produk()
    {
        $data['produk'] = $this->m_produk->orderBy('id_produk', 'DESC')->findAll();
        $data['title'] = 'Produk';
        $data['path'] = end($this->data['path']);
        return view('backend/Produk', $data);
    }

    public function tambah_produk()
    {
        helper('form');
        $data['kategori_produk'] = $this->m_katpro->orderBy('id_kategori_produk', 'DESC')->findAll();
        $data['title'] = 'tambah_produk';
        return view('backend/Tambah_produk', $data);
    }

    public function proses_produk()
    {
     helper('local');
     $img = $this->request->getFile('gambar');
     $dvalid = [
        'nama_produk' => ['rules' => 'required','errors' => ['required' => 'Nama Produk Harus di isi']],
        'harga_beli' => ['rules' => 'required','errors' => ['required' => 'Harga Beli Harus di isi']],
        'harga_reseller' => ['rules' => 'required','errors' => ['required' => 'Harga Reseller Harus di isi']],
        'harga_konsumen' => ['rules' => 'required','errors' => ['required' => 'Harga Konsumen Harus di isi']],
        'satuan' => ['rules' => 'required','errors' => ['required' => 'Satuan Harus di isi']],
        'berat' => ['rules' => 'required','errors' => ['required' => 'Berat Harus di isi']],
        'keterangan' => ['rules' => 'required','errors' => ['required' => 'Keterangan Harus di isi']],
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
            'id_kategori_produk' => (int)$dr['kategori_produk'],
            'nama_produk' => $dr['nama_produk'],
            'produk_seo' => seo_title($dr['nama_produk']),
            'harga_beli' => $dr['harga_beli'],
            'harga_reseller' => $dr['harga_reseller'],
            'harga_konsumen' => $dr['harga_konsumen'],
            'satuan' => $dr['satuan'],
            'berat' => $dr['berat'],
            'keterangan' => $dr['keterangan'],
        ];
        if( !empty($img->getName()) )
        {
            $fileName = $img->getRandomName();
            $data['gambar'] = $fileName;
            $img->move(WRITEPATH . 'uploads/produk/', $fileName);
        }
        if(!is_null($dr['edit']))
        {
            $this->m_produk->update($dr['id'], $data);
            session()->setFlashdata('msg', 'Edit Data Produk Berhasil');
        }
        elseif (!is_null($dr['tambah'])) {
            $this->m_produk->insert($data);
            session()->setFlashdata('msg', 'Tambah Data Produk Berhasil');
        }
        return redirect()->to(base_url('administrator/produk'));
    }

    public function edit_produk($id)
    {
        helper('form');
        $data['kategori_produk'] = $this->m_katpro->orderBy('id_kategori_produk', 'DESC')->findAll();
        $data['edit'] = $this->m_produk->where('id_produk', $id)->first();
        $data['title'] = 'edit_produk';
        return view('backend/Edit_produk', $data);
    }

    public function delete_produk($id)
    {
        $this->m_produk->delete($id);
        return redirect()->to(base_url('administrator/produk'));
    }


    public function kategori()
    {
        $data['kategori_produk'] = $this->m_katpro->findAll();
        $data['title'] = 'kategori';
        $data['path'] = end($this->data['path']);
        return view('backend/Kategori', $data);

    }

    public function tambah_kategori()
    {
        $data['title'] = 'tambah_kategori';
        return view('backend/Tambah_kategori', $data);
    }

    public function proses_tambah_kategori()
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

    public function transaksi()
    {
        $data['title'] = 'transaksi';
        $data['path'] = end($this->data['path']);
        return view('backend/Transaksi', $data);
    }

    public function stok()
    {
        $data['title'] = 'stok';
        $data['path'] = end($this->data['path']);
        return view('backend/Stok', $data);
    }

    public function identitas()
    {
        helper('form');
        $iden = new MIdentitas();
        $d = $iden->findAll();
        foreach($d as $v)
            $data['row'] = $v;
        $data['title'] = 'identitas';
        $data['path'] = end($this->data['path']);
        return view('backend/Identitas', $data);
    }

    public function edit_identitas()
    {
        $rules = [
            'nama_website' => 'required|min_length[5]|max_length[100]',
            'email' => 'required|min_length[5]|max_length[100]',
            'url' => 'required|min_length[5]|max_length[100]',
            'facebook' => 'required',
            'instagram' => 'required',
            'no_telp' => 'required|min_length[5]|max_length[100]',
            'kota_id' => 'required',
            'alamat' => 'required',
            'meta_deskripsi' => 'required|min_length[10]|max_length[250]',
            'meta_keyword' => 'required|min_length[10]|max_length[250]',
            'favicon' => 'uploaded[favicon]|is_image[favicon]',
            'maps' => 'required'
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $file = $this->request->getFile('favicon');

        $postData = $this->request->getPost();
        $data = array();
        foreach($postData as $k => $v)
        {
            if($k != 'id' || $k != 'favicon')
                $data[$k] = $v;
        }

        if($file->isValid()) {
            $data['favicon'] = "favicon.ico";
            $file->move(WRITEPATH . "uploads/produk/", $data['favicon']);
        }
        $iden = new MIdentitas();
        $iden->update($postData['id'], $data);
        session()->setFlashdata('msg', 'Edit Identitas Berhasil');
        return redirect()->to(base_url('administrator/identitas'));
    }

    public function ajaxDatatables($s1=NULL, $s2=NULL)
    {
        $rq = \Config\Services::request();

        if($s1 == 'mtran')
        {
            $table = $s1;
            $column_order = ['id_mtran', 'nama','total'];
            $column_search = ['nama'];
            $order = ['id_mtran', 'DESC'];
            $primaryKey = 'id_mtran';
            $allowedFields = ['id_produk','nama','qty','total'];
            $dt = new MDatatables($table, $column_order, $column_search, $order, $primaryKey, $allowedFields);
            $ts = ['id_mtran', 'nama', 'qty','total'];
            if(!is_null($s2))
            {
                $response = array();
                if($this->crud_datatables($s2, $rq, $dt))
                {
                    $response['token'] = csrf_hash();
                    return $this->response->setJSON($response);
                }
                else
                {
                    json_encode(['code' => 1, 'msg' => 'ADO YANG SALAH CAKNYO']);
                }
            }
        }
        else if ($s1 == 'stok')
        {
            $table = $s1;
            $column_order = ['id_stok', 'nama','stok_awal', 'stok_akhir'];
            $column_search = ['nama'];
            $order = ['id_stok', 'DESC'];
            $primaryKey = 'id_stok';
            $allowedFields = ['id_produk','nama','stok_awal','stok_akhir'];
            $dt = new MDatatables($table, $column_order, $column_search, $order, $primaryKey, $allowedFields);
            $ts = ['id_stok', 'nama', 'stok_awal','stok_akhir'];
            if(!is_null($s2))
            {
                $response = array();
                if($this->crud_datatables($s2, $rq, $dt))
                {
                    $response['token'] = csrf_hash();
                    return $this->response->setJSON($response);
                }
                else
                {
                    json_encode(['code' => 1, 'msg' => 'ADO YANG SALAH CAKNYO']);
                }
            }
        }
        else
        {
            $rp = ['token' => csrf_hash()];
            return $this->response->setJSON($rp);
        }

        if(is_null($s2))
        {
            if(!$rq->is('post'))
            {
                return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
            }
            else
            {
                $lists = $dt->getDatatables();
                $data = [];
                $no = $rq->getPost('data')['start'];

                foreach($lists as $list) {
                    $no++;
                    $row = [];
                    $row['no'] = $no;
                    foreach($list as $k => $v)
                    {
                        foreach($ts as $l)
                        {
                            if($l == $k)
                                $row[$k] = $v;
                        }
                    }
                    $data[] = $row;
                }

                $output = [
                    'draw' => intval($rq->getPost('data')['draw']),
                    'recordsTotal' => intval($dt->countAll()),
                    'recordsFiltered' => intval($dt->countFiltered()),
                    'data' => $data,
                    'token' => csrf_hash(),
                ];

                return $this->response->setJSON($output);
            }
        }
        
    }

    private function crud_datatables($action, $rq, $dt)
    {
        $postData = $rq->getPost();
        $response = array();

        $response['token'] = csrf_hash();
        if($action == 'hapus')
        {
            $dt->delete($postData['id']);
            return true;
        }
        else if($action == 'tambah')
        {
            $data = [];
            foreach($postData as $k => $v)
            {
                $data[$k] = $v;
            }
            $dt->insert($data);
            return true;
        }
        else if($action == 'edit')
        {
            $data = [];
            foreach($postData as $k => $v)
            {
                if($k != 'id'){
                    $data[$k] = $v;
                }
            }
            $dt->update($postData['id'], $data);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getProdukName()
    {
        $request = \Config\Services::request();
        $postData = $request->getPost();

        $response = array();

        $response['token'] = csrf_hash();
        $data = array();

        if(isset($postData['nama_s'])){
            $name = $postData['nama_s'];

            $plists = $this->m_produk->select('id_produk,nama_produk,harga_konsumen,gambar')
                    ->like('nama_produk', $name)
                    ->orderBy('nama_produk')
                    ->findAll(5);
            foreach($plists as $plist){
                $data[] = array(
                    "value" => $plist->id_produk,
                    "label" => $plist->nama_produk,
                    "harga" => $plist->harga_konsumen,
                    "gambar" => $plist->gambar,
                );
            }
        }
        $response['data'] = $data;

        return $this->response->setJSON($response);

    }

    public function website_payment_channel()
    {
        $data['kategori_produk'] = $this->m_katpro->findAll();
        $data['title'] = 'kategori';
        $data['path'] = end($this->data['path']);
        return view('backend/website/Payment-channel', $data);
    }

    public function direct()
    {
        return redirect()->to('administrator');
    }

}