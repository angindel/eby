<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['google_id', 'name', 'email', 'picture'];


    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['addGroup'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    protected function addGroup(array $data)
    {
        log_message('info',"Users : ".json_encode($data));
        if($data)
        {
            $users_groups = new UsersGroups();
            $users_groups->insert([
                'user_id' => $data['id'],
                'group_id' => 1
            ]);
        }

        return $data;
    }
}
