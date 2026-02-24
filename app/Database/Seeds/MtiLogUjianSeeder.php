<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MtiLogUjianSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2,
                'jadwal_id' => 1,
                'jam_masuk' => date('Y-m-d 08:05:00', strtotime('+2 days')),
                'jam_selesai' => NULL,
                'nilai_akhir' => NULL,
                'jumlah_pelanggaran' => 0,
                'is_submit' => 0,
                'status' => 'mengerjakan',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'jadwal_id' => 1,
                'jam_masuk' => date('Y-m-d 08:02:00', strtotime('+2 days')),
                'jam_selesai' => date('Y-m-d 09:55:00', strtotime('+2 days')),
                'nilai_akhir' => 85.5,
                'jumlah_pelanggaran' => 0,
                'is_submit' => 1,
                'status' => 'selesai',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4,
                'jadwal_id' => 1,
                'jam_masuk' => date('Y-m-d 07:58:00', strtotime('+2 days')),
                'jam_selesai' => date('Y-m-d 09:45:00', strtotime('+2 days')),
                'nilai_akhir' => 92.0,
                'jumlah_pelanggaran' => 1,
                'is_submit' => 1,
                'status' => 'selesai',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 5,
                'jadwal_id' => 1,
                'jam_masuk' => date('Y-m-d 08:10:00', strtotime('+2 days')),
                'jam_selesai' => NULL,
                'nilai_akhir' => NULL,
                'jumlah_pelanggaran' => 0,
                'is_submit' => 0,
                'status' => 'mengerjakan',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 6,
                'jadwal_id' => 1,
                'jam_masuk' => date('Y-m-d 08:00:00', strtotime('+2 days')),
                'jam_selesai' => date('Y-m-d 09:30:00', strtotime('+2 days')),
                'nilai_akhir' => 78.0,
                'jumlah_pelanggaran' => 2,
                'is_submit' => 1,
                'status' => 'selesai',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'jadwal_id' => 2,
                'jam_masuk' => NULL,
                'jam_selesai' => NULL,
                'nilai_akhir' => NULL,
                'jumlah_pelanggaran' => 0,
                'is_submit' => 0,
                'status' => 'waiting',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'jadwal_id' => 2,
                'jam_masuk' => NULL,
                'jam_selesai' => NULL,
                'nilai_akhir' => NULL,
                'jumlah_pelanggaran' => 0,
                'is_submit' => 0,
                'status' => 'waiting',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('mti_log_ujian')->insertBatch($data);

        $pelanggaran = [
            [
                'log_ujian_id' => 4,
                'jenis_pelanggaran' => 'Tab Switch',
                'timestamp' => date('Y-m-d H:i:s', strtotime('+2 days 09:15:00')),
            ],
            [
                'log_ujian_id' => 6,
                'jenis_pelanggaran' => 'Window Blur',
                'timestamp' => date('Y-m-d H:i:s', strtotime('+2 days 08:30:00')),
            ],
            [
                'log_ujian_id' => 6,
                'jenis_pelanggaran' => 'Tab Switch',
                'timestamp' => date('Y-m-d H:i:s', strtotime('+2 days 09:00:00')),
            ],
        ];

        $this->db->table('mti_log_pelanggaran')->insertBatch($pelanggaran);
    }
}
