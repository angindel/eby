<?php

namespace App\Models;

use CodeIgniter\Model;

class MLogo extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'logo';
    protected $primaryKey       = 'id_logo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['gambar'];

}
