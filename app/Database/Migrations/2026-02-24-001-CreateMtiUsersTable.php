<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMtiUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_lengkap' => ['type' => 'VARCHAR', 'constraint' => 100],
            'kelas' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'santri'], 'default' => 'santri'],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mti_users');
    }

    public function down()
    {
        $this->forge->dropTable('mti_users');
    }
}
