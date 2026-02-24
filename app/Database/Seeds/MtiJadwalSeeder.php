<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MtiJadwalSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'mapel_id' => 1,
                'link_gform' => 'https://docs.google.com/forms/d/e/1FAIpQLSdExample1/viewform',
                'tgl_ujian' => date('Y-m-d', strtotime('+2 days')),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'token' => 'FIQIH2026',
                'status_publish_nilai' => 0,
                'status_ujian' => 'draft',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'mapel_id' => 2,
                'link_gform' => 'https://docs.google.com/forms/d/e/1FAIpQLSdExample2/viewform',
                'tgl_ujian' => date('Y-m-d', strtotime('+3 days')),
                'jam_mulai' => '10:30:00',
                'jam_selesai' => '12:00:00',
                'token' => 'ARAB2026',
                'status_publish_nilai' => 0,
                'status_ujian' => 'draft',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'mapel_id' => 3,
                'link_gform' => 'https://docs.google.com/forms/d/e/1FAIpQLSdExample3/viewform',
                'tgl_ujian' => date('Y-m-d', strtotime('+5 days')),
                'jam_mulai' => '07:30:00',
                'jam_selesai' => '09:30:00',
                'token' => 'QURHAD2026',
                'status_publish_nilai' => 0,
                'status_ujian' => 'draft',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('mti_jadwal')->insertBatch($data);
    }
}
