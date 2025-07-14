# Jual Beli Rumah 

  Rumah Impian adalah platform web modern yang dirancang untuk mempermudah proses jual beli properti. Repositori ini berisi kode *back-end* yang berfungsi sebagai API untuk mengelola data properti. Aplikasi ini menyediakan antarmuka yang intuitif bagi pengguna untuk menjelajahi daftar rumah dijual, melihat detail lengkap, serta bagi penjual untuk dengan mudah menambah, mengedit, dan menghapus properti mereka. Dibangun dengan CodeIgniter 4 untuk API *back-end* yang robust.

<img width="1219" height="431" alt="image" src="https://github.com/user-attachments/assets/fc443302-4692-4095-bfa3-7eb826e30fd4" />

-----

### **Langkah Utama:**

1.  **Buat Proyek CodeIgniter 4 Baru:** Jika Anda belum memilikinya, buat proyek CI4 baru. Anda bisa mengunduhnya dari situs resmi CodeIgniter atau menggunakan Composer:
    ```bash
    composer create-project codeigniter4/appstarter nama-proyek-rumah
    cd nama-proyek-rumah
    ```
2.  **Edit File `.env`:** Duplikasi `.env.example` menjadi `.env` dan konfigurasikan detail database Anda.
3.  **Jalankan `composer install`:** Pastikan semua dependensi terinstal.

-----


#### **1. File `.env` (di root proyek Anda)**

Edit file ini. Jika Anda belum punya, duplikasi `env.example` menjadi `.env` terlebih dahulu.

```env
#--------------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------------
CI_ENVIRONMENT = development

#--------------------------------------------------------------------------
# APP
#--------------------------------------------------------------------------
app.baseURL = 'http://localhost:8080/' # Sesuaikan ini jika Anda menggunakan port lain atau domain lain
app.indexPage = '' # Ini agar URL Anda bersih (tanpa index.php)

#--------------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = nama_database_anda # <--- GANTI INI DENGAN NAMA DATABASE ANDA
database.default.username = root             # <--- GANTI INI DENGAN USERNAME DATABASE ANDA
database.default.password = ''               # <--- GANTI INI DENGAN PASSWORD DATABASE ANDA (kosongkan jika tidak ada)
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.pConnect = false
database.default.DBDebug = true
database.default.charset = utf8
database.default.DBCollat = utf8_general_ci
database.default.swapPre =
database.default.encrypt = false
database.default.compress = false
database.default.strictOn = false
database.default.failover = []
database.default.port = 3306

#--------------------------------------------------------------------------
# HACKING PREVENTION
#--------------------------------------------------------------------------
# csrf.tokenName = csrf_test_name
# csrf.headerName = X-CSRF-TOKEN
# csrf.cookieName = csrf_cookie_name
# csrf.expires = 7200
# csrf.regenerate = true
# csrf.excludeURIs = []
# csrf.methods = ['POST','PUT','DELETE']

# Content Security Policy
# csp.enabled = false
```

#### **2. File Migrasi Database (`app/Database/Migrations/`)**

Jalankan perintah ini di terminal dari root proyek CI4 Anda untuk membuat file migrasi kosong:
`php spark make:migration CreateHousesTable`

Kemudian, buka file yang baru dibuat (nama filenya akan seperti `YYYY-MM-DD-HHMMSS_CreateHousesTable.php`) di folder `app/Database/Migrations/` 

#### **3. File Controller API (`app/Controllers/Api/Houses.php`)**

Buat folder `Api` di dalam `app/Controllers/` jika belum ada.
Kemudian, buat file baru di `app/Controllers/Api/Houses.php` 

### **4. Kode untuk Fungsi "Detail Rumah"**

Fungsi ini digunakan untuk mengambil data spesifik satu rumah berdasarkan ID-nya. Ini sesuai dengan tampilan "Rumah Minimalis 2 Lantai di Cibubur" yang menunjukkan detail lengkap satu properti.

![WhatsApp Image 2025-07-12 at 20 18 25_804b6924](https://github.com/user-attachments/assets/94ffb8f6-5266-4874-87a8-14b042b3bfb1)


-----

### **5. Kode untuk Fungsi "Tambah Rumah"**

Fungsi ini bertanggung jawab untuk menerima data dari formulir "Tambah Rumah" dan menyimpannya sebagai entri baru di database.

![WhatsApp Image 2025-07-12 at 20 19 47_f5146823](https://github.com/user-attachments/assets/b04c0217-8efd-408b-8933-e18944f7b1cf)


-----

### **6. Kode untuk Fungsi "Edit Rumah" **

Fungsi ini digunakan untuk memperbarui data rumah yang sudah ada. Ini sesuai dengan tampilan formulir "Edit Rumah".

![WhatsApp Image 2025-07-12 at 20 23 11_e1f86305](https://github.com/user-attachments/assets/ba698799-cc8f-4354-bdd7-9b8ff8a4593a)


#### **7. File Routes (`app/Config/Routes.php`)**

**Lokasi File:** `app/Config/Routes.php`


## Fitur Utama API:
* **CRUD Properti:** Endpoint untuk Menambah (Create), Membaca (Read), Memperbarui (Update), dan Menghapus (Delete) data rumah.
* **Listing Dinamis:** Menyediakan data daftar rumah untuk ditampilkan di *front-end*.
* **Detail Properti:** Mengembalikan detail lengkap satu properti berdasarkan ID.
* Respons API dalam format JSON.

## Teknologi yang Digunakan:
* **Back End Framework:** CodeIgniter 4 (PHP)
* **Database:** MySQL / PostgreSQL
* **Server:** PHP Development Server (untuk pengembangan), Nginx/Apache (untuk produksi)

## Instalasi dan Menjalankan Proyek (Back-end):

1.  **Instal dependensi Composer:**
    ```bash
    composer install
    ```

2.  **Konfigurasi Environment:**
    * Duplikasi `.env.example` menjadi `.env`: `cp .env.example .env`
    * Buka file `.env` dan konfigurasikan detail database Anda (DB driver, hostname, database name, username, password).

3.  **Jalankan Migrasi Database:**
    Ini akan membuat tabel `houses` di database Anda.
    ```bash
    php spark migrate
    ```

4.  **Jalankan Server Pengembangan CodeIgniter:**
    ```bash
    php spark serve
    ```
    API akan berjalan di `http://localhost:8080` (atau port lain yang ditampilkan).
