<?php

namespace App\Models;

use CodeIgniter\Model;

class MAdmins extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admins';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['username','password','nama','level','blokir'];
}
