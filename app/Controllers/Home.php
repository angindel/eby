<?php

namespace App\Controllers;

use App\Models\MProduks;
use App\Models\MKategoriProduk;
use App\Models\MIdentitas;
use App\Models\MLogo;

class Home extends BaseController
{
    public function __construct()
    {
        $m_iden = new MIdentitas();
        $m_logo = new MLogo();
        $this->web = $m_iden->where('id_identitas', 1)->first();
        $logo = $m_logo->orderBy('id_logo', 'DESC')->limit(1)->first();
        $this->web['logo'] = $logo['gambar'];
    }

    public function index()
    {
        $m_produk = new MProduks();
        $m_katpro = new MKategoriProduk();
        $this->web['kategori'] = $m_katpro->select('nama_kategori')->findAll();
        $this->web['title'] = 'EbyKarya';
        $this->web['produk_new'] = $m_produk->orderBy('created_at', 'DESC')->limit(12)->find();
        $this->web['produk'] = $m_produk->paginate(12, 'produk');
        $this->web['pager'] = $m_produk->pager;
        return view('frontend/Home', $this->web);
    }
    
    public function produkIS($s)
    {
      helper('local');
      $limit = 12;
      $end = $limit * intval($s);
      $start = $end - $limit;
      $mp = new MProduks();
      $c = $mp->countAll();
      if(!($start <= $c))
      {
        return $this->response->setStatusCode(404)->setBody("tidak ada data");
      }
      $produk = $mp->orderBy('created_at', 'DESC')->limit($end, $start)->find();
      $html = "";
      foreach ($produk as $row)
      {
        $base = base_url();
        $rupiah = rupiah($row->harga_konsumen);
        $html .= "<div class='col px-1 mb-1'>
                    <div class='card h-100'>
                        <a href='{$base}produk/detail/{$row->produk_seo} '>
                            <img src='{$base}uploads/produk/{$row->gambar}' class='card-img-top' alt='...'>
                        </a>
                        <div class='card-body p-0 m-1'>
                            <h5 class='card-title'>Rp.{$rupiah}</h5>
                            <a href='{$base}produk/detail/{$row->produk_seo}' style='text-decoration: none;'><h3 class='card-text lh-sm caption-pb '>{$row->nama_produk}</h3></a>
                        </div>
                        <ul class='list-group list-group-flush text-end border border-top-0'>
                            <li class='list-group-item p-0 m-1'><a href='{$base}produk/detail/{$row->produk_seo}' class='btn btn-primary btn-sm'>Lihat Detil</a></li>
                        </ul>
                    </div>
                </div>";
      }
      
      return $this->response->setStatusCode(200)->setBody($html);
      
    }

    public function produk_detail($name_seo = null)
    {
        helper('local');
        $m_produk = new MProduks();
        $this->web['produk'] = $m_produk->where('produk_seo', $name_seo)->first();
        $this->web['produk']->harga_konsumen = rupiah($this->web['produk']->harga_konsumen);
        $this->web['title'] = 'EbyKarya';
        return view('frontend/Produk_detail', $this->web);
    }
}
