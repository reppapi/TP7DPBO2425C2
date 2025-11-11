# TP7DPBO2425C2

# Janji
Saya Repa Pitriani  dengan NIM 2402499 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---

# Mood Tracker – A Simple Web App to Record Your Daily Moods
**Mood Tracker Website** adalah proyek berbasis **PHP Native** yang berfungsi untuk mencatat, memantau, dan menampilkan suasana hati pengguna setiap hari.  
Website ini dibuat dengan konsep **Object-Oriented Programming (OOP)** dan menerapkan pola arsitektur **Model-View-Controller (MVC)** agar struktur kodenya lebih rapi dan mudah dikembangkan.

Dengan website ini, pengguna dapat mendaftar, login, menambahkan jenis mood, serta membuat catatan harian lengkap dengan tanggal dan keterangan.  
Semua data tersimpan secara terstruktur di database **MySQL**.

## Struktur Folder

```

Mood Tracker/
├── class/
│   ├── MoodController.php
│   ├── MoodEntryController.php
│   ├── UserController.php
│   ├── MoodEntryModel.php
│   ├── MoodTypeModel.php
│   └── UserModel.php
│
├── config/
│   └── Database.php
│
├── database/
│   └── database.sql
│
├── view/
│   ├── edit_entry.php
│   ├── edit_mood.php
│   ├── entry_page.php
│   ├── footer.php
│   ├── header.php
│   ├── home.php
│   ├── login.php
│   ├── mood_page.php
│   └── register.php
│
├── index.php
└── style.css

```

## Penjelasan Umum
- **config/** — Menyimpan konfigurasi koneksi ke database.  
- **class/** — Menampung semua file class PHP yang menangani logika bisnis, baik itu **Controller** (pengatur alur) maupun **Model** (urusan ke database).
- **database/** — Berisi file `.sql` yang memuat struktur tabel dan data dummy.  
- **views/** — Menampilkan antarmuka pengguna (halaman HTML/PHP). 
- **index.php** — File router utama yang menerima semua permintaan dan mengarahkannya ke Controller yang tepat.
- **style.css** — File styling untuk antarmuka.

## Fitur Utama
- **Struktur MVC**  
  Logika aplikasi dipisahkan menjadi Model, View, dan Controller agar lebih terorganisir dan mudah dikembangkan.
- **Autentikasi Pengguna**  
  Sistem login dan registrasi fungsional dengan validasi session untuk membatasi hak akses halaman.
- **Manajemen Data Lengkap (CRUD)**  
  - **Mood Type:** Tambah, ubah, hapus, dan lihat daftar jenis mood.  
  - **Mood Entry:** Tambah, ubah, hapus, dan lihat catatan mood harian.  
- **Keamanan Dasar Web**  
  Menggunakan *prepared statements* untuk mencegah SQL Injection dan menjaga integritas data saat memproses query database.

## Akun Demo (Untuk Mencoba)
  Setelah mengimpor file `database.sql`, kamu bisa langsung login menggunakan akun demo yang sudah disiapkan untuk melihat fungsionalitas website dan data dummy yang ada.
- Username: `coba`
- Password: `123456`

## Dokumentasi

