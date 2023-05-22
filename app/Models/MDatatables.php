<?php

namespace App\Models;

use CodeIgniter\Model;

class MDatatables extends Model
{
    protected $table;
    protected $column_order = [];
    protected $column_search = [];
    protected $order = [];
    protected $db;
    protected $dt;
    protected $primaryKey;

    protected $allowedFields = [];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct($table, $column_order, $column_search, $order, $primaryKey, $allowedFields)
    {
        parent::__construct();
        $this->table = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }

    private function getDatatablesQuery()
    {
        $i = 0;
        foreach($this->column_search as $item) {
            if ($_POST['data']['search']['value']) {
                if($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $_POST['data']['search']['value']);
                }
                else
                {
                    $this->dt->orLike($item, $_POST['data']['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if($_POST['data']['order']) {
            $this->dt->orderBy($this->column_order[$_POST['data']['order']['0']['column']], $_POST['data']['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if($_POST['data']['length'] != -1)
            $this->dt->limit($_POST['data']['length'], $_POST['data']['start']);
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
}
