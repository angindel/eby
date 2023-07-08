<?php

namespace App\Controllers;

use App\Models\MProduks;
use App\Models\MKategoriProduk;
use App\Models\MIdentitas;
use App\Models\MLogo;
use App\Models\MPaymentChannel;

class Home extends BaseController
{
    public function __construct()
    {
        $m_iden = new MIdentitas();
        $m_logo = new MLogo();
        $this->web = $m_iden->where('id_identitas', 1)->first();
        $logo = $m_logo->orderBy('id_logo', 'DESC')->limit(1)->first();
        $this->web['logo'] = $logo['gambar'];
        $this->web['title'] = 'EbyKarya';
    }

    public function index()
    {
        $m_pc = new MPaymentChannel();
        $m_produk = new MProduks();
        $m_katpro = new MKategoriProduk();
        $this->web['kategori'] = $m_katpro->findAll();
        $this->web['produk_new'] = $m_produk->orderBy('created_at', 'DESC')->limit(9)->find();
        $this->web['pc'] = $m_pc->findAll();
        return view('frontend/Home', $this->web);
    }
    
    public function produkIS($s, $t = null)
    {
      helper('local');
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
      $html = "";
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
        // $html .= "<div class='col px-1 mb-1'>
        //             <div class='card h-100'>
        //                 <a href='{$base}produk/detail/{$row->produk_seo} '>
        //                     <img src='{$base}uploads/produk/{$row->gambar}' class='card-img-top' alt='...'>
        //                 </a>
        //                 <div class='card-body p-0 m-1'>
        //                     <h5 class='card-title'>Rp.{$rupiah}</h5>
        //                     <a href='{$base}produk/detail/{$row->produk_seo}' style='text-decoration: none;'><h3 class='card-text lh-sm caption-pb '>{$row->nama_produk}</h3></a>
        //                 </div>
        //                 <ul class='list-group list-group-flush text-end border border-top-0'>
        //                     <li class='list-group-item p-0 m-1'><a href='{$base}produk/detail/{$row->produk_seo}' class='btn btn-primary btn-sm'>Lihat Detil</a></li>
        //                 </ul>
        //             </div>
        //         </div>";
      }
      
      // return $this->response->setStatusCode(200)->setBody($html);
      return $this->response->setJSON($data);
      
    }

    public function produk_detail($name_seo = null)
    {
        helper('local');
        $m_produk = new MProduks();
        $this->web['produk'] = $m_produk->where('produk_seo', $name_seo)->first();
        $this->web['produk']->harga_konsumen = rupiah($this->web['produk']->harga_konsumen);
        return view('frontend/Produk_detail', $this->web);
    }

    public function produk_kategori($s = null)
    {
        $m_katpro = new MKategoriProduk();
        $this->web['kategori'] = $m_katpro->findAll();
        $this->web['id_kategori'] = $s;
        return view('frontend/Produk_kategori', $this->web);
    }
}
