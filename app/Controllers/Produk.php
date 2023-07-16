<?php

namespace App\Controllers;

use App\Models\{ProdukPage, MIdentitas, MLogo};


class Produk extends BaseController
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

    public function index($page = 1)
    {
        $page = intval($page);
        $m_produk = new ProdukPage();
        $pager = service('pager');
        $perPage = 8;
        $total = $m_produk->countAllResults(false);
        $offset = $perPage * ($page - 1);
        $segment = $total / $perPage;

        $pager->setPath('produk/page', 'produk-group');

        $pager_links = $pager->makeLinks($page, $perPage, $total, 'bs_pagination', 3, 'produk-group');
        $this->web['produk'] = $m_produk->findAll($perPage, $offset);        
        $this->web['pager'] = $pager_links;
        return view('frontend/Produk', $this->web);
    }
}
