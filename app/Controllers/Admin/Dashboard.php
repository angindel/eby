<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class Administrator extends BaseController
{

    public function index()
    {
        helper('form');
        $db = db_connect();
        $ct['mtran'] = $db->table('mtran')->countAll();
        $ct['produk'] = $db->table('produk')->countAll();
        $data = [
            'title' => "Dashboard",
            'total' => [
                'mtran' => $ct['mtran'],
                'produk' => $ct['produk']
            ],
        ];
        return view('backend/Admin', $data);
    }

    

}