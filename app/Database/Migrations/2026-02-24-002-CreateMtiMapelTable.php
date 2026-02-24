<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMtiMapelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_mapel' => ['type' => 'VARCHAR', 'constraint' => 100],
            'ustadz_pengampu' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mti_mapel');
    }

    public function down()
    {
        $this->forge->dropTable('mti_mapel');
    }
}
