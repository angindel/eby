<?php

namespace App\Models;

use CodeIgniter\Model;

class Groups extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'groups';
    protected $primaryKey       = 'id_group';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

    // Callbacks
    protected $allowCallbacks = false;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
