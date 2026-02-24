1. Prompt untuk Stitch (Admin Dashboard)
Prompt:
"Create a modern Admin Dashboard UI for 'PUD-MTIC' Exam Portal. Use a clean 'Sidebar' navigation layout.

Sidebar Menu: Dashboard, Manajemen Santri, Jadwal Ujian, Monitoring Real-time, Rekap Hasil.
Main Content: > 1. A summary section with 4 stat cards (Total Santri, Ujian Aktif, Santri Online, Pelanggaran).
2. A 'Real-time Monitoring' table showing Santri names, their current status (Active/Finished), and a 'Cheat Alert' badge for those who switch tabs.
3. An 'Action' button to 'Reset Session' or 'Force Submit'.

Style: Professional, Dashboard-like (AdminLTE or Tailwind UI style), using Emerald Green as the primary accent color, clean light gray background, and high-contrast data tables."

2. Wireframe UI/UX Admin (Konsep Struktur)
A. Dashboard Utama (Ringkasan)
Fokus pada pengawasan cepat saat ujian berlangsung.

Plaintext
+-----------------------------------------------------------------------+
| [MTIC LOGO] | PORTAL ADMIN PUD-MTIC               [Admin: Ust. Fauzi] |
+-----------------------------------------------------------------------+
| (Sidebar)    |  [Stat: 450 Santri] [Stat: 2 Mapel Aktif] [Stat: 440 Online]|
|              |-------------------------------------------------------|
| - Dashboard  |  >> MONITORING REAL-TIME                              |
| - Data Siswa |  +---------------------------------------------------+|
| - Jadwal     |  | Nama Santri | Kelas | Status    | Log | Aksi      ||
| - Monitoring |  |-------------|-------|-----------|-----|-----------||
| - Laporan    |  | Abdullah    | 12-A  | Mengerjakan| [V]| [Reset]   ||
| - Pengaturan |  | Zaidan      | 12-B  | SELESAI   | [V]| [Detail]  ||
|              |  | Ahmad       | 12-A  | CURANG!   | [X]| [Blokir]  ||
|              |  +---------------------------------------------------+|
+--------------+-------------------------------------------------------+
B. Halaman Manajemen Jadwal (Input CRUD)
Tempat panitia memasukkan link Google Form.

Plaintext
+-----------------------------------------------------------------------+
| TAMBAH JADWAL UJIAN BARU                                              |
+-----------------------------------------------------------------------+
| Nama Mata Pelajaran: [ Pilih Mapel... ]                               |
| Link Google Form   : [ https://docs.google.com/forms/... ]            |
| Tanggal Ujian      : [ YYYY-MM-DD ]                                   |
| Waktu              : [ 08:00 ] s/d [ 10:00 ]                          |
| Token Akses        : [ MTIC2026 ]  -> (Generate Random)               |
|                                                                       |
| [ SIMPAN JADWAL ]    [ BATAL ]                                        |
+-----------------------------------------------------------------------+
3. Fitur Khusus Admin MTI Canduang
Ada beberapa fitur "Senior Engineer" yang saya sarankan untuk ada di halaman Admin ini:

Kill Switch (Emergency Stop): Satu tombol besar untuk menghentikan akses ke Google Form jika terjadi kebocoran soal atau kendala teknis massal.

Reset Session: Seringkali santri keluar dari Exambro karena HP panas atau baterai habis. Di halaman Admin, harus ada tombol cepat untuk membolehkan santri tersebut login kembali (karena sistem kita mencegah double login).

Log Pelanggaran (The "Snitch" Log): Tabel yang mencatat jam berapa dan berapa kali santri mencoba keluar dari layar ujian. Ini berguna untuk bahan pertimbangan nilai akhlak/kedisiplinan santri.

Export Presensi: Tombol satu klik untuk mendownload file Excel berisi daftar hadir santri yang sudah klik "Mulai" dan "Selesai".

4. Tips UX untuk Admin
Warna Status: Gunakan warna Kuning untuk yang belum mulai, Biru untuk yang sedang mengerjakan, Hijau untuk yang sudah selesai, dan Merah Berkedip untuk yang terdeteksi melakukan pelanggaran.

Auto-Refresh: Halaman Monitoring harus memiliki fitur Auto-Refresh setiap 30 detik (via AJAX) agar data tetap akurat tanpa Admin harus menekan F5 terus-menerus.