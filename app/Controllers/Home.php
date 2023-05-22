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
