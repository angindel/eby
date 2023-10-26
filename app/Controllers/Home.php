<?php

namespace App\Controllers;

use App\Models\{ MProduks, MSlide, MDatatables, Users };
use CodeIgniter\Test\Fabricator;

//use CodeIgniter\I18n\Time;

class Home extends FrontendController
{
    public function __construct()
    {
        $this->web['title'] = 'EbyKarya';
        helper("local");
    }

    public function index()
    {
        session()->close();
        $m_produk = new MProduks();
        $m_sl = new MSlide();
        //$this->web['produk_new'] = $m_produk->orderBy('created_at', 'DESC')->limit(9)->find();
        $db = db_connect();
        $produk_new = $db->table('mtran as m');
        $produk_new->select('m.id_mtran, m.id_produk, p.nama_produk, p.produk_seo, p.gambar, p.harga_konsumen, sum(m.qty) as qty')
            ->join('produk as p', 'm.id_produk = p.id_produk', 'inner')
            ->groupBy('p.nama_produk')
            ->orderBy('qty', 'DESC')
            ->limit(9);

        $q = $produk_new->get();
        $this->web['produk_new'] = $q->getResult();
        $db->close();
        $this->web['sl'] = $m_sl->findAll();
        return view('frontend/Home', $this->web);
    }
    
    public function produkIS(?int $t, $s)
    {
      $db = db_connect();
      $dt = $db->table('produk');
      $limit = 8;
      $offset = $limit * intval($s - 1);

      if(!is_null($t))
      {
        $dt->where('id_kategori_produk', $t);
      }
      $c = $dt->countAllResults(false);
      if(!($offset < $c))
      {
        return $this->response->setStatusCode(404)->setBody("tidak ada data");
      }
      $dt->orderBy('created_at', 'DESC')->limit($limit, $offset);
      $query = $dt->get();
      $produk = $query->getResult();
      $data = array();
      foreach ($produk as $row)
      {
        $base = base_url();
        $rupiah = rupiah($row->harga_konsumen);
        $data[] = (object)[
            "base" => $base,
            "nama_produk" => $row->nama_produk,
            "produk_seo" => $row->produk_seo,
            "gambar" => $row->gambar,
            "harga_konsumen" => $rupiah,        
        ];
      }
      
      return $this->response->setJSON($data);
      
    }

    public function produk_detail($name_seo = null)
    {
        $m_produk = new MProduks();
        $this->web['produk'] = $m_produk->where('produk_seo', $name_seo)->first();
        $this->web['produk']->harga_konsumen = rupiah($this->web['produk']->harga_konsumen);
        $this->web['produk_terkait'] = $m_produk->where('id_kategori_produk', $this->web['produk']->id_kategori_produk)->findAll(6);
        return view('frontend/Produk_detail', $this->web);
    }

    public function produk_kategori($s = null)
    {
        $this->web['id_kategori'] = $s;
        return view('frontend/Produk_kategori', $this->web);
    }
}
 