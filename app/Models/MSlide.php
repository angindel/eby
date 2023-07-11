<?php

namespace App\Models;

use CodeIgniter\Model;

class MSlide extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'slide';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama','gambar'];
}
