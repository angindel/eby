<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class MTransaksi extends Model
{
    protected $table = 'mtran';
    protected $column_order = ['id_mtran', 'nama','total'];
    protected $column_search = ['nama'];
    protected $order = ['id_mtran', 'DESC'];
    protected $allowedFields = ['id_produk','nama','qty','total'];
    protected $request;
    protected $db;
    protected $dt;
    protected $primaryKey = 'id_mtran';
    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    private function getDatatablesQuery()
    {
        $i = 0;
        $search_val = "";
        foreach($this->column_search as $item) {
            //if ($this->request->getPost('data')['search']['value']) {
            if ($search_val) {
                if($i === 0) {
                    $this->dt->groupStart();
                    //$this->dt->like($item, $this->request->getPost('data')['search']['value']);
                    $this->dt->like($item, $search_val);
                }
                else
                {
                    $this->dt->orLike($item, $this->request->getPost('data')['search']['value']);
                    $this->dt->orLike($item, $search_val);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        // if($this->request->getPost('data')['order']) {
        //     $this->dt->orderBy($this->column_order[$this->request->getPost('data')['order']['0']['column']], $this->request->getPost('data')['order']['0']['dir']);
        // } else if (isset($this->order)) {
        //     $order = $this->order;
        //     $this->dt->orderBy(key($order), $order[key($order)]);
        // }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        //if($this->request->getPost('data')['length'] != -1)
        if(10 != -1)
            //$this->dt->limit($this->request->getPost('data')['length'], $this->request->getPost('data')['start']);
            $this->dt->limit(10, 0);
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl = $this->db->table($this->table);
        return $tbl->countAllResults();
    }

    public function insertTrans($data)
    {
        $this->dt->insert($data);
    }
}
