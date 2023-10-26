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
use App\Models\MStok;
use CodeIgniter\Database\RawSql;

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
                'transaksi' => [
                    'hariini' => $db->table('mtran')->selectSum('total')->where(new RawSql("DATE_FORMAT(created_at ,'%Y-%m-%d') = curdate()"))->limit(1, 0)->get()->getFirstRow(),
                    'mingguini' => $db->table('mtran')->selectSum('total')->where(new RawSql("WEEK(created_at)=WEEK(CURDATE())"))->limit(1, 0)->get()->getFirstRow(),
                    'bulanini' => $db->table('mtran')->selectSum('total')->where( new RawSql("created_at between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()") )->limit(1, 0)->get()->getFirstRow(),
                    'bulanlalu' => $db->table('mtran')->selectSum('total')->where( new RawSql("month(created_at) = month(date_sub(curdate(), interval 1 month)) and year(created_at) = year(date_sub(curdate(), interval 1 month))") )->limit(1, 0)->get()->getFirstRow(),
                    'tahunini' => $db->table('mtran')->selectSum('total')->where( new RawSql("YEAR(created_at)=YEAR(CURDATE())") )->limit(1, 0)->get()->getFirstRow(),
                ]
            ],
            'data' => [
                'transaksi' => $db->table('mtran')->limit(5)->orderBy('id_mtran', 'DESC')->get()->getResult(),
            ],
            'path' => end($this->data['path'])
        ];
        return view('backend/Dashboard', $data);
        
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
        $validation = \Config\Services::validation();
        $rules = $validation->getRuleGroup('identitas');

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
            $model = 'Mtran';
            $column_order = ['id_mtran', 'nama','total'];
            $column_search = ['nama'];
            $order = ['id_mtran', 'DESC'];
            $dt = new MDatatables($model, $column_order, $column_search, $order);
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
            $model = 'MStok';
            $column_order = ['id_stok', 'nama','stok_awal', 'stok_akhir', 'created_at', 'updated_at'];
            $column_search = ['nama'];
            $order = ['id_stok', 'DESC'];
            $dt = new MDatatables($model, $column_order, $column_search, $order);
            $ts = ['id_stok', 'nama', 'stok_awal','stok_akhir','created_at','updated_at'];
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
        else if ($s1 == 'produk')
        {
            $model = 'ProdukBModel';
            $column_order = ['id_produk', 'nama_produk'];
            $column_search = ['nama_produk'];
            $order = ['id_produk', 'DESC'];
            $dt = new MDatatables($model, $column_order, $column_search, $order);
            $ts = ['id_produk', 'nama_produk', 'harga_beli','harga_reseller','harga_konsumen','satuan','berat'];
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
        else if ($s1 == 'kategori')
        {
            $model = 'MKategoriProduk';
            $column_order = ['id_kategori_produk', 'nama_kategori'];
            $column_search = ['nama_kategori'];
            $order = ['id_kategori_produk', 'DESC'];
            $dt = new MDatatables($model, $column_order, $column_search, $order);
            $ts = ['id_kategori_produk', 'nama_kategori', 'gambar'];
            if(!is_null($s2))
            {
                $response = array();
                $response['token'] = csrf_hash();
                $response['msg'] = 'Amazing Spiderman';
                return $this->response->setJSON($response);
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
        if (! $rq->is('post')) {
            return $rq->setStatusCode(405)->setBody('Method Not Allowed');
        }
        $postData = $rq->getPost();
        $response = array();

        $response['token'] = csrf_hash();
        if($action == 'hapus')
        {
            $dt->hapus($postData['id']);
            return true;
        }
        else if($action == 'tambah')
        {
            $data = [];
            foreach($postData as $k => $v)
            {
                $data[$k] = $v;
            }
            $dt->tambah($data);
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
            $dt->edit($postData['id'], $data);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getProdukName()
    {
        if (! $this->request->is('post')) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }
        // AMBIL SEMUA DATA POST
        $postData = $this->request->getPost();

        // BUAT ARRAY VARIABLE UNTUK MENGIRIMKAN RESPONSE
        $response = array();
        $response['token'] = csrf_hash(); // TOKEN CSRF
        $data = array();
        $nama_s = trim($postData['nama_s']);

        if(isset($nama_s)){
            $names = preg_match('/\s|\+/', $nama_s ) ? explode(" ", $nama_s) : $nama_s;
            // $name = $postData['nama_s'];
            $row_count = 6;
            $offset = $postData['offset'];
            $offset = $row_count * $offset;

            // AMBIL DATA PRODUK DI DATABASE
            $db = \Config\Database::connect();
            // $querySql = "SELECT `p`.`id_produk`, `p`.`nama_produk`, `p`.`harga_konsumen`, `p`.`gambar`, `s`.`stok_akhir` FROM `produk` `p` INNER JOIN `stok` `s` ON `p`.`id_produk`=`s`.`id_produk`";
            // al%' ESCAPE '!'\nORDER BY CASE\n                    WHEN nama_produk LIKE 'al%' then 1\n                    WHEN nama_produk LIKE '%al%' then 2\n                    ELSE 3\n                    END ASC\n LIMIT 6;"
            $builder = $db->table('produk');
            $builder->select('id_produk,nama_produk,harga_konsumen');

            if(is_array($names))
            {
                $i = 1;
                foreach($names as $name)
                {
                    ($i == 1) ? $builder->like('nama_produk', $name) : $builder->orLike('nama_produk', $name);
                    // if ($i == 1)
                    // {
                    //     $querySql .= " WHERE `p`.`nama_produk` LIKE '%".  $db->escapeLikeString($name) . "%' ESCAPE '!'";
                    // }
                    // else
                    // {
                    //     $querySql = " OR LIKE '%".  $db->escapeLikeString($name) . "%' ESCAPE '!'";
                    // }
                    ++$i;
                }
                $i_nama_s = implode("%", $names);
                $s_case = " CASE WHEN nama_produk LIKE '{$nama_s}%' then 1 WHEN nama_produk LIKE '%{$nama_s}%' then 2 WHEN nama_produk LIKE '%{$i_nama_s}%' then 3";
                $s = 3;
                foreach($names as $name)
                {
                    $s_case .= " WHEN nama_produk LIKE '{$name}%' then ".++$s;
                    $s_case .= " WHEN nama_produk LIKE '%{$name}%' then ".++$s;
                }
                $s_case .= " ELSE ".++$s." END ASC";
                // $querySql .= $s_case;
                $builder->orderBy($s_case);
            }
            else
            {
                if( !empty($names) )
                {
                    // $querySql .= " WHERE `p`.`nama_produk` LIKE '%".  $db->escapeLikeString($names) . "%' ESCAPE '!' ";
                    $builder->like('nama_produk', $names);
                    // $querySql .= " ORDER BY CASE WHEN p.nama_produk LIKE '{$names}%' then 1 WHEN p.nama_produk LIKE '%{$names}%' then 2 ELSE 3 END ASC ";
                    $builder->orderBy("CASE WHEN nama_produk LIKE '{$names}%' then 1 WHEN nama_produk LIKE '%{$names}%' then 2 ELSE 3 END ASC");
                }
                else
                {
                    // $querySql .= " ORDER BY p.nama_produk ASC";
                    $builder->orderBy("nama_produk", "ASC");
                }
            }
            // $querySql .= " LIMIT {$offset}, {$row_count}";
            $builder->limit($row_count, $offset);
            $sql = $builder->getCompiledSelect(false);
            $query = $builder->get();
            $res = $query->getResult();
            // $query = $db->query($querySql);
            $response['sql'] = $sql;

            if(!empty($res))
            {
                foreach($res as $plist){
                    $label = $plist->nama_produk;
                    if(is_array($names))
                    {
                        foreach($names as $name)
                        {
                            $lo_name = strtolower($name);
                            $up_name = strtoupper($name);
                            $ucf_name = ucfirst($name);
                            $label = str_replace($lo_name, "<b>{$lo_name}</b>", $label);
                            $label = str_replace($up_name, "<b>{$up_name}</b>", $label);
                            $label = str_replace($ucf_name, "<b>{$ucf_name}</b>", $label);
                        }
                    }
                    else
                    {
                        if(!empty($names))
                        {
                            $lo_names = strtolower($names);
                            $up_names = strtoupper($names);
                            $ucf_names = ucfirst($names);
                            $label = str_replace($lo_names, "<b>{$lo_names}</b>", $label);
                            $label = str_replace($up_names, "<b>{$up_names}</b>", $label);
                            $label = str_replace($ucf_names, "<b>{$ucf_names}</b>", $label);
                        }
                    }
                    $data[] = array(
                        "value" => $plist->id_produk,
                        "label" => $plist->nama_produk,
                        "lbl" => $label,
                        "harga" => $plist->harga_konsumen,
                        // "stok_akhir" => $plist->stok_akhir,
                    );
                }
                $response["end"] = (count($data) <= 6) ? true : false;
                $response['data'] = $data;
            } else {
                $response["end"] = true;
                // return $this->response->setStatusCode(404, json_encode($response));
            }
        }

        return $this->response->setJSON($response);

    }

    public function asa($id=null)
    {
        $m_stok = new MStok();
        $sa = $m_stok->allowCallbacks(false)->select("stok_akhir")->where("id_produk", $id)->first();
        return $this->response->setJSON($sa);
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

    public function admin_tes($d)
    {
        d($d);
    }

}