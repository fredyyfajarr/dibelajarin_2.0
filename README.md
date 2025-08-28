# DiBelajar.In - Learning Management System (LMS)

Selamat datang di DiBelajar.In, sebuah platform Learning Management System (LMS) modern yang dibangun dari nol menggunakan Laravel 11 dan Filament 3. Proyek ini dirancang untuk menyediakan pengalaman belajar-mengajar yang lengkap, interaktif, dan intuitif bagi admin, instruktur, dan siswa.

### [**🚀 Lihat Demo Langsung**](https://dibelajarin.up.railway.app/)

## Fitur Utama

Aplikasi ini memiliki tiga peran pengguna utama dengan hak akses yang terpisah, memastikan alur kerja yang aman dan terorganisir.

### 👨‍💼 **Fitur Admin**

Panel admin yang kuat untuk mengelola seluruh platform.

* **Manajemen Pengguna**: CRUD (Create, Read, Update, Delete) untuk semua pengguna.
* **Manajemen Peran**: Kemampuan untuk menetapkan peran sebagai `Admin`, `Instructor`, atau `Student`.
* **Manajemen Kategori**: Membuat dan mengelola kategori kursus untuk menjaga konten tetap terstruktur.
* **Pengawasan Global**: Admin dapat melihat semua kursus dari semua instruktur.
* **Dashboard Statistik**: Widget yang menampilkan data penting seperti total kursus, siswa, dan instruktur.

### 🧑‍🏫 **Fitur Instruktur**

Lingkungan kerja mandiri bagi para pengajar untuk membuat dan mengelola konten mereka.

* **Panel Multi-Tenant**: Instruktur hanya dapat melihat dan mengelola data (kursus, pelajaran, siswa) miliknya sendiri.
* **Manajemen Kursus**: CRUD lengkap untuk kursus, termasuk pengaturan judul, deskripsi, thumbnail, dan kategori.
* **Manajemen Pelajaran**: Menambah, mengedit, dan menghapus pelajaran di dalam setiap kursus.
* **Upload Materi**: Mengunggah file lampiran (PDF, ZIP, dll.) untuk setiap pelajaran.
* **Manajemen Kuis**: Membuat kuis dengan pertanyaan pilihan ganda untuk setiap pelajaran.
* **Interaksi Siswa**: Melihat daftar siswa yang terdaftar di kursus dan berinteraksi melalui sistem komentar.

### 🎓 **Fitur Siswa**

Pengalaman belajar yang kaya fitur dan interaktif.

* **Katalog Kursus**: Menjelajahi semua kursus yang tersedia dengan fitur **pencarian** dan **filter** per kategori.
* **Pendaftaran (Enrollment)**: Alur pendaftaran yang mudah untuk mengikuti kursus.
* **Dashboard Fungsional**: Halaman utama yang menampilkan semua kursus yang diikuti, lengkap dengan **progress bar** kemajuan belajar.
* **Halaman Pembelajaran**: Tampilan belajar yang fokus dengan navigasi antar pelajaran.
* **Sistem Komentar & Balasan**: Area diskusi di setiap pelajaran untuk bertanya dan berinteraksi dengan instruktur dan siswa lain.
* **Sistem Kuis**: Mengerjakan kuis dan langsung melihat hasilnya.
* **Sertifikat Kelulusan**: Mengunduh sertifikat dalam format PDF secara otomatis setelah menyelesaikan 100% kursus.
* **Sistem Gamifikasi**: Mendapatkan **Experience Points (XP)** untuk setiap aktivitas (menyelesaikan pelajaran, mengerjakan kuis) dan melihat peringkat di **Papan Peringkat (Leaderboard)**.

## Tumpukan Teknologi (Tech Stack)

* **Backend**: PHP 8, Laravel 11
* **Frontend**: Tailwind CSS, Alpine.js, Vite
* **Panel Admin**: Filament 3
* **Database**: MySQL
* **Deployment**: Railway.app
* **Lainnya**: `barryvdh/laravel-dompdf` untuk pembuatan PDF.

## Instalasi Lokal

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Clone repositori:**
    ```bash
    git clone [https://github.com/username/nama-repo.git](https://github.com/username/nama-repo.git)
    cd nama-repo
    ```

2.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Install dependensi JavaScript:**
    ```bash
    npm install
    ```

4.  **Siapkan file Environment:**
    Salin file `.env.example` menjadi `.env` dan konfigurasikan koneksi database Anda.
    ```bash
    copy .env.example .env
    ```

5.  **Generate kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```

6.  **Jalankan migrasi dan seeder database:**
    Perintah ini akan membuat semua tabel dan mengisi data awal jika ada.
    ```bash
    php artisan migrate --seed
    ```

7.  **Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```

8.  **Jalankan server pengembangan:**
    ```bash
    # Di terminal 1
    php artisan serve

    # Di terminal 2
    npm run dev
    ```

## Kredit

Proyek ini merupakan hasil kolaborasi antara:

* **Backend Developer**: Fredy Fajar Adi Putra
* **Frontend Developer**: Eka Revandi
