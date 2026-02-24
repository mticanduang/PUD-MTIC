> **Prompt:**
> "Create a high-fidelity UI/UX design for a Digital Examination Portal named 'PUD-MTIC' for Pondok Pesantren MTI Canduang. The design should be modern, clean, and professional using a color palette of Deep Green (Islamic/Pesantren vibe) and White. The layout must be responsive for mobile (Exambro view) and desktop.
> **Dashboard Siswa:** Show a profile card, a grid of exam cards with subjects, exam time, and a 'Start' button. Active exams should have a glowing green indicator.
> **Exam Interface:** A sidebar for student identity, a main area for an embedded Google Form (iframe placeholder), and a sticky top bar with a countdown timer and a 'Finish' button.
> **Style:** Minimalist, using Tailwind CSS aesthetics, rounded corners, soft shadows, and clear typography (Sans Serif)."

---

## 2. Contoh Wireframe UI/UX (Konsep Struktur)

Berikut adalah gambaran kasar struktur halaman yang harus ada di portal:

### A. Halaman Dashboard Siswa (Mobile First)

Halaman ini adalah yang pertama dilihat santri saat membuka Exambro.

```text
+-------------------------------------------------------+
| [Logo MTIC]          Portal Ujian           [Profile] |
+-------------------------------------------------------+
| Halo, Ahmad Fauzi (Kelas 12 MA)                       |
+-------------------------------------------------------+
| >> UJIAN HARI INI                                     |
|                                                       |
| +---------------------------------------------------+ |
| | Fiqih (Kitab Fathul Mu'in)                        | |
| | Jam: 08:00 - 10:00                                | |
| | Status: [ SEDANG BERLANGSUNG ]                    | |
| |                                                   | |
| | [ TOMBOL MULAI ] -> Warna Hijau                   | |
| +---------------------------------------------------+ |
|                                                       |
| +---------------------------------------------------+ |
| | Bahasa Arab                                       | |
| | Jam: 10:30 - 12:00                                | |
| | Status: [ BELUM DIMULAI ]                         | |
| |                                                   | |
| | [ TOMBOL MULAI ] -> Warna Abu-abu (Disabled)      | |
| +---------------------------------------------------+ |
+-------------------------------------------------------+

```

### B. Halaman Ruang Ujian (Exam Room)

Saat tombol "Mulai" diklik, layar akan berubah menjadi mode fokus.

```text
+-------------------------------------------------------+
| [Mapel: Fiqih]        [ Sisa Waktu: 01:24:05 ]        |
+-------------------------------------------------------+
|                                                       |
|  +-------------------------------------------------+  |
|  |                                                 |  |
|  |             EMBED GOOGLE FORM AREA              |  |
|  |      (Siswa scroll soal di dalam sini)          |  |
|  |                                                 |  |
|  |                                                 |  |
|  |                                                 |  |
|  +-------------------------------------------------+  |
|                                                       |
+-------------------------------------------------------+
| [!] Pastikan sudah klik SUBMIT di Google Form         |
| [ TOMBOL KONFIRMASI SELESAI DI PORTAL ]               |
+-------------------------------------------------------+

```

---

## 3. Fitur Utama yang Harus Muncul di UI/UX

Saat Anda mereview hasil dari Stitch, pastikan elemen-elemen ini ada:

1. **Indicator Online/Offline:** Karena di pesantren koneksi internet bisa naik-turun, UI harus punya indikator status koneksi santri.
2. **Alert Modal:** Desain pop-up peringatan jika santri mencoba mematikan mode *Fullscreen* atau keluar dari aplikasi.
3. **Sticky Header:** Informasi sisa waktu tidak boleh hilang meskipun santri men-*scroll* Google Form sampai ke bawah.
4. **Empty State:** Tampilan yang rapi jika tidak ada jadwal ujian pada hari tersebut (misal: "Tidak ada ujian hari ini, silakan mengaji").

---

## 4. Rekomendasi Warna (Tailwind CSS Palette)

Berikan catatan ini kepada pengembang Anda untuk diimplementasikan di Tailwind:

* **Primary:** `bg-emerald-800` (Hijau khas MTI Canduang)
* **Secondary:** `bg-slate-100` (Background halaman agar mata tidak lelah)
* **Accent:** `bg-amber-500` (Untuk tombol perhatian/timer)
* **Danger:** `bg-red-600` (Untuk peringatan kecurangan)
