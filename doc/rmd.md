Ini adalah dokumen **Master Plan Strategis Terpadu (Final)** untuk pembangunan **Portal Ujian Digital MTI Canduang (PUD-MTIC)**. Dokumen ini telah menggabungkan seluruh aspek teknologi, alur kerja, keamanan, hingga fitur **Monitoring Nilai** secara *real-time*.

---

# 📜 DOKUMEN FINAL: MASTER PLAN PUD-MTIC

**Sistem Informasi Ujian Terintegrasi Pondok Pesantren MTI Canduang**

## 1. Spesifikasi Arsitektur Teknologi

* **Core Framework:** CodeIgniter 4 (PHP 8.2+) – Stabilitas tinggi untuk trafik simultan.
* **Frontend UI:** Tailwind CSS – Desain modern, ringan, dan sangat responsif di perangkat santri.
* **Real-time Engine:** jQuery AJAX – Sinkronisasi waktu server, deteksi kecurangan, dan *live update* nilai.
* **Security Wrapper:** **Exambro** (Android/Windows) – Mengunci perangkat santri secara total selama ujian.
* **Engine Soal:** Google Forms (Quiz Mode) – Efisiensi manajemen soal dan koreksi otomatis.

---

## 2. Struktur Database (Final Schema)

Sistem menggunakan database relasional untuk menghubungkan identitas santri dengan hasil ujian:

1. **`mti_users`**: `id, username(NIS), password, nama_lengkap, kelas, role(admin/santri)`.
2. **`mti_mapel`**: `id, nama_mapel, ustadz_pengampu`.
3. **`mti_jadwal`**: `id, mapel_id, link_gform, tgl_ujian, jam_mulai, jam_selesai, token, status_publish_nilai(0/1)`.
4. **`mti_log_ujian`**: `id, user_id, jadwal_id, jam_masuk, jam_selesai, **nilai_akhir**, jumlah_pelanggaran, is_submit(0/1)`.

---

## 3. Alur Kerja Aplikasi (The End-to-End Flow)

### A. Tahap Persiapan (Admin & Panitia)

1. **Input Data:** Admin mengunggah data santri dan membuat jadwal ujian di Portal.
2. **Setup Webhook:** Admin memasang **Google Apps Script** di Google Sheets respon untuk mengirim nilai balik ke Portal secara otomatis begitu santri klik "Kirim".

### B. Tahap Aktivasi (Santri & Device)

1. **Akses Exambro:** Santri membuka aplikasi Exambro yang sudah dikunci ke URL Portal.
2. **Login & Waiting Room:** Santri login. Tombol "Mulai" hanya aktif jika waktu server sudah sesuai jadwal.

### C. Tahap Pelaksanaan (Ujian)

1. **Input Token:** Santri memasukkan token dari pengawas.
2. **Focus Mode:** Portal memaksa layar Fullscreen dan memuat Google Form di dalam Iframe.
3. **Active Monitoring:** Server mencatat log jika santri mencoba meminimalkan browser atau pindah aplikasi (Cheat Detection).

### D. Tahap Sinkronisasi Nilai (Real-time)

1. **Submit GForm:** Santri menekan tombol "Kirim" di Google Form.
2. **Webhook Trigger:** Google Sheets secara otomatis mengirim data (NIS, ID Ujian, Skor) ke API Portal CI4.
3. **Final Update:** Status di dashboard Admin berubah menjadi "Selesai" dan **Nilai muncul secara otomatis** di layar monitoring Admin.

---

## 4. Fitur & Menu Per Halaman User

### Halaman Siswa (Santri)

* **Dashboard Jadwal:** Daftar ujian aktif dan selesai.
* **Exam Room:** Tampilan fullscreen dengan *sticky timer* (hitung mundur waktu sisa).
* **Result View:** Menampilkan nilai (hanya jika Admin sudah mengaktifkan status *Publish Nilai*).

### Halaman Admin (Panitia/Ustadz)

* **Monitoring Real-time & Nilai:**
* **Live Score Feed:** Tabel yang menampilkan siapa yang sedang mengerjakan, siapa yang sudah selesai, dan **berapa nilai yang didapat secara langsung.**
* **Cheat Log:** Daftar santri yang melanggar aturan (pindah tab/aplikasi).


* **Control Center:** Fitur **"Reset Login"** (untuk santri yang kendala perangkat) dan **"Publish Nilai"** (untuk membuka akses nilai ke santri).
* **Export Center:** Download rekap kehadiran dan nilai dalam format Excel (XLSX) yang sudah menyatu antara data identitas portal dan skor GForm.

---

## 5. Strategi Keamanan (Anti-Cheat Plan)

| Layer | Fitur | Fungsi |
| --- | --- | --- |
| **Physical** | Exambro Wrapper | Mematikan navigasi Android (Home, Back, Recent Apps). |
| **Logic** | Blur Detection | AJAX mengirim log ke Admin jika santri kehilangan fokus browser. |
| **Access** | Token Validation | Soal hanya bisa dibuka dengan kode rahasia dari pengawas. |
| **Session** | Device Locking | Satu akun NIS hanya bisa aktif di satu perangkat. |

---

## 6. Integrasi Monitoring Nilai (Google Apps Script)

Berikut adalah logika kode yang harus dipasang tim IT pada **Google Sheets Respon** agar nilai bisa mengalir otomatis ke Portal CI4:

```javascript
function onFormSubmit(e) {
  var formData = {
    nis: e.values[1],      // Kolom NIS di GForm
    skor: e.values[2],     // Kolom Skor (misal: "80 / 100")
    id_ujian: "ID_UJIAN"   // ID unik dari Portal
  };
  
  var options = {
    'method' : 'post',
    'contentType': 'application/json',
    'payload' : JSON.stringify(formData)
  };
  
  // Kirim data ke API Portal CI4
  UrlFetchApp.fetch('https://exam.mticanduang.sch.id/api/update_nilai', options);
}

```

---

## 7. Rencana Implementasi (Timeline 5 Hari)

* **Hari 1:** Setup Server, Database, dan Sistem Login (Auth).
* **Hari 2:** Pembuatan CRUD Jadwal, Mapel, dan Manajemen Santri.
* **Hari 3:** Pembangunan Dashboard Santri, Timer, dan Iframe Exam Room.
* **Hari 4:** Integrasi API Webhook Nilai dan Monitoring Real-time untuk Admin.
* **Hari 5:** Uji Coba Beban (Stress Test), Distribusi APK Exambro, dan Peluncuran.

---

**Saran Final:**
Dengan plan ini, **Pondok Pesantren MTI Canduang** memiliki ekosistem ujian yang tertutup dan akurat. Panitia tidak perlu lagi melakukan rekap nilai secara manual karena portal akan menyajikannya secara otomatis di layar monitor.
