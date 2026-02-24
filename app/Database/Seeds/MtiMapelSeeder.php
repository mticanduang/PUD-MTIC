<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MtiMapelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_mapel' => 'Fiqih',
                'ustadz_pengampu' => 'Ustadz Ahmad Fauzi, Lc.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_mapel' => 'Bahasa Arab',
                'ustadz_pengampu' => 'Ustadz Muhammad Idris, M.Hum.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_mapel' => 'Al-Quran Hadits',
                'ustadz_pengampu' => 'Ustadz Abdullah, Lc.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_mapel' => 'Tarikh Islam',
                'ustadz_pengampu' => 'Ustadz Hasan Basri, M.A.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_mapel' => 'Akidah Akhlak',
                'ustadz_pengampu' => 'Ustadz Fauzi Anwar, Lc.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('mti_mapel')->insertBatch($data);
    }
}
