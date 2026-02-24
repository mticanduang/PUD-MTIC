<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMtiLogUjianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jadwal_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jam_masuk' => ['type' => 'DATETIME', 'null' => true],
            'jam_selesai' => ['type' => 'DATETIME', 'null' => true],
            'nilai_akhir' => ['type' => 'FLOAT', 'null' => true],
            'jumlah_pelanggaran' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_submit' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status' => ['type' => 'ENUM', 'constraint' => ['waiting', 'mengerjakan', 'selesai'], 'default' => 'waiting'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'mti_users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jadwal_id', 'mti_jadwal', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mti_log_ujian');
    }

    public function down()
    {
        $this->forge->dropTable('mti_log_ujian');
    }
}
