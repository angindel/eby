<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MTransaksi;
use App\Models\MProduks;
use App\Models\MIdentitas;
use CodeIgniter\Database\RawSql;

class Tools extends Controller
{

    public function message()
    {
        $rq = \Config\Services::request();
        if($rq->isCLI())
        {
            $i = new MIdentitas();
            $d = $i->findAll();
            $data = array();
            foreach($d as $v)
                $data['row'] = $v;

            var_dump($data);
        }

        if($rq->is('post'))
        {
            $postData = $rq->getPost();
            $data = [];
            foreach($postData as $k => $v)
            {
                if($k != 'id')
                    $data[$k] = $v;
            }
            d($data);
        }

        if($rq->is('get'))
        {

        }

        // $request = \Config\Services::request();
        // $dt = new MTransaksi($request);
        // $lists = $dt->getDatatables();
        // $data = [];
        // $no = 0;
        // $ts = ['id_mtran', 'nama', 'qty','total'];

        // foreach($lists as $list) {
        //     $no++;
        //     $row = [];
        //     $row['no'] = $no;
        //     foreach($list as $k => $v)
        //     {
        //         foreach($ts as $l)
        //         {
        //             if($l == $k)
        //                 $row[$k] = $v;
        //         }
        //     }
        //     $data[] = $row;
        // }

        // $output = [
        //     'draw' => intval(1),
        //     'recordsTotal' => intval($dt->countAll()),
        //     'recordsFiltered' => intval($dt->countFiltered()),
        //     'data' => $data,
        // ];

        // return $this->response->setJSON($output);

        // // foreach($lists as $key => $value)
        // // {
        // //     foreach($value as $k => $v)
        // //     {
        // //         var_dump($v);
        // //     }
        // // }
        // $ts = ['id_mtran', 'nama', 'qty','total'];
        // $no = 0;
        // $data = array();
        // foreach($lists as $list) {
        //     $no++;
        //     $row = [];
        //     $row['no'] = $no;
        //     foreach($list as $k => $v)
        //     {
        //         foreach($ts as $l)
        //         {
        //             if($l == $k)
        //                 $row[$k] = $v;
        //         }
        //     }
        //     $data[] = $row;
        // }
        //     var_dump($data);
    }

}