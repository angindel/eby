<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserGroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'group_id' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'unsigned' => true
            ]
        ]);

        $this->forge->addPrimaryKey(['user_id', 'group_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id_user', false, 'CASCADE');
        $this->forge->addForeignKey('group_id', 'groups', 'id_group', false, 'CASCADE');
        $this->forge->createTable('users_groups');
    }

    public function down()
    {
        $this->forge->dropTable('users_groups');
    }
}
