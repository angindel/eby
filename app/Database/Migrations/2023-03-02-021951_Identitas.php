<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Identitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_identitas' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_website' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'facebook' => [
                'type' => 'TEXT',
            ],
            'instagram' => [
                'type' => 'TEXT',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kota_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'meta_deskripsi' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'meta_keyword' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'favicon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'maps' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id_identitas', true);
        $this->forge->createTable('identitas');
    }

    public function down()
    {
        $this->forge->dropTable('identitas');
    }
}
