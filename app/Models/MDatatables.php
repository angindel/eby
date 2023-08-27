<?php

namespace App\Models;

use CodeIgniter\Model;

class MDatatables extends Model
{
    // protected $table;
    protected $column_order = [];
    protected $column_search = [];
    protected $order = [];
    // protected $primaryKey;

    protected $allowedFields = [];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct($model, $column_order, $column_search, $order)
    {
        parent::__construct();
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        // $this->allowedFields = $allowedFields;
        $this->model = model($model);
    }

    private function getDatatablesQuery()
    {
        $i = 0;
        foreach($this->column_search as $item) {
            if ($_POST['data']['search']['value']) {
                if($i === 0) {
                    $this->model->groupStart();
                    $this->model->like($item, $_POST['data']['search']['value']);
                }
                else
                {
                    $this->model->orLike($item, $_POST['data']['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->model->groupEnd();
            }
            $i++;
        }

        if($_POST['data']['order']) {
            $this->model->orderBy($this->column_order[$_POST['data']['order']['0']['column']], $_POST['data']['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->model->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if($_POST['data']['length'] != -1)
            return $this->model->findAll($_POST['data']['length'], $_POST['data']['start']);
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->model->countAllResults();
    }

    public function countAll()
    {
        return $this->model->countAll();
    }

    public function edit(int $id, array $data)
    {
        $this->model->update((int)$id, $data);
    }

    public function tambah($data)
    {
        return $this->model->insert($data);
    }

    public function hapus($id)
    {
        $this->model->delete($id);
    }
}
