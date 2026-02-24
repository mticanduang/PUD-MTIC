<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMtiJadwalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'mapel_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'link_gform' => ['type' => 'VARCHAR', 'constraint' => 500],
            'tgl_ujian' => ['type' => 'DATE'],
            'jam_mulai' => ['type' => 'TIME'],
            'jam_selesai' => ['type' => 'TIME'],
            'token' => ['type' => 'VARCHAR', 'constraint' => 20],
            'status_publish_nilai' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status_ujian' => ['type' => 'ENUM', 'constraint' => ['draft', 'aktif', 'selesai'], 'default' => 'draft'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('mapel_id', 'mti_mapel', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mti_jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('mti_jadwal');
    }
}
