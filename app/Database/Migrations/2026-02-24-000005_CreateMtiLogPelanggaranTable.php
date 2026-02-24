<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMtiLogPelanggaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'log_ujian_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jenis_pelanggaran' => ['type' => 'VARCHAR', 'constraint' => 100],
            'timestamp' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('log_ujian_id', 'mti_log_ujian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mti_log_pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('mti_log_pelanggaran');
    }
}
