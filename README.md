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

Kemudian, buka file yang baru dibuat (nama filenya akan seperti `YYYY-MM-DD-HHMMSS_CreateHousesTable.php`) di folder `app/Database/Migrations/` dan salin kode ini ke dalamnya:

```php
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHousesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_rumah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Bisa diisi NULL jika tidak ada gambar
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('houses');
    }

    public function down()
    {
        $this->forge->dropTable('houses');
    }
}
```

Setelah menyalin, jalankan migrasi untuk membuat tabel di database Anda:
`php spark migrate`

#### **3. File Model (`app/Models/HouseModel.php`)**

Buat file baru di `app/Models/HouseModel.php` dan salin kode ini:

```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class HouseModel extends Model
{
    protected $table            = 'houses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['nama_rumah', 'lokasi', 'harga', 'deskripsi', 'gambar'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $validationRules = [
        'nama_rumah' => 'required|min_length[3]|max_length[255]',
        'lokasi'     => 'required|min_length[3]|max_length[255]',
        'harga'      => 'required|numeric|greater_than[0]',
        'deskripsi'  => 'permit_empty',
        'gambar'     => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages = [
        'nama_rumah' => [
            'required'   => 'Nama rumah wajib diisi.',
            'min_length' => 'Nama rumah minimal 3 karakter.',
            'max_length' => 'Nama rumah maksimal 255 karakter.',
        ],
        'lokasi'     => [
            'required'   => 'Lokasi wajib diisi.',
            'min_length' => 'Lokasi minimal 3 karakter.',
            'max_length' => 'Lokasi maksimal 255 karakter.',
        ],
        'harga'      => [
            'required'     => 'Harga wajib diisi.',
            'numeric'      => 'Harga harus berupa angka.',
            'greater_than' => 'Harga harus lebih besar dari 0.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
```

#### **4. File Controller API (`app/Controllers/Api/Houses.php`)**

Buat folder `Api` di dalam `app/Controllers/` jika belum ada.
Kemudian, buat file baru di `app/Controllers/Api/Houses.php` dan salin kode ini:

```php
<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\HouseModel;

class Houses extends ResourceController
{
    use ResponseTrait;
    protected $modelName    = 'App\Models\HouseModel';
    protected $format       = 'json';

    public function __construct()
    {
        $this->houseModel = new HouseModel();
    }

    /**
     * GET /api/v1/houses
     * Mengambil daftar semua rumah.
     * @return mixed
     */
    public function index()
    {
        $houses = $this->houseModel->findAll();
        if ($houses) {
            return $this->respond($houses, 200, 'Data Rumah Berhasil Diambil');
        } else {
            return $this->failNotFound('Tidak ada data rumah ditemukan.');
        }
    }

    /**
     * GET /api/v1/houses/{id}
     * Mengambil detail satu rumah berdasarkan ID.
     * @param int $id
     * @return mixed
     */
    public function show($id = null)
    {
        $house = $this->houseModel->find($id);
        if ($house) {
            return $this->respond($house, 200, 'Detail Rumah Berhasil Diambil');
        } else {
            return $this->failNotFound('Rumah tidak ditemukan dengan ID: ' . $id);
        }
    }

    /**
     * POST /api/v1/houses
     * Menambahkan rumah baru.
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getPost(); // Digunakan untuk form-data
        // Jika Anda mengirim JSON dari front-end, gunakan:
        // $data = $this->request->getJSON(true);

        if (!$this->houseModel->validate($data)) {
            return $this->failValidationErrors($this->houseModel->errors());
        }

        if ($this->houseModel->insert($data)) {
            $response = [
                'status'  => 201,
                'error'   => null,
                'message' => 'Rumah berhasil ditambahkan.',
                'data'    => $this->houseModel->find($this->houseModel->getInsertID())
            ];
            return $this->respondCreated($response);
        } else {
            return $this->fail('Gagal menambahkan rumah.');
        }
    }

    /**
     * PUT /api/v1/houses/{id}
     * Memperbarui detail rumah.
     * @param int $id
     * @return mixed
     */
    public function update($id = null)
    {
        // Untuk menerima data JSON dari body request (PUT/PATCH)
        $data = $this->request->getRawInput();

        $house = $this->houseModel->find($id);
        if (!$house) {
            return $this->failNotFound('Rumah tidak ditemukan dengan ID: ' . $id);
        }

        if (!$this->houseModel->validate($data)) {
            return $this->failValidationErrors($this->houseModel->errors());
        }

        if ($this->houseModel->update($id, $data)) {
            $response = [
                'status'  => 200,
                'error'   => null,
                'message' => 'Rumah berhasil diperbarui.',
                'data'    => $this->houseModel->find($id)
            ];
            return $this->respond($response);
        } else {
            return $this->fail('Gagal memperbarui rumah.');
        }
    }

    /**
     * DELETE /api/v1/houses/{id}
     * Menghapus rumah.
     * @param int $id
     * @return mixed
     */
    public function delete($id = null)
    {
        $house = $this->houseModel->find($id);
        if (!$house) {
            return $this->failNotFound('Rumah tidak ditemukan dengan ID: ' . $id);
        }

        if ($this->houseModel->delete($id)) {
            $response = [
                'status'  => 200,
                'error'   => null,
                'message' => 'Rumah berhasil dihapus.',
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->fail('Gagal menghapus rumah.');
        }
    }
}
```


Anda menginginkan kode PHP untuk setiap fungsi secara terpisah (misalnya, hanya untuk "Tambah", lalu hanya untuk "Edit", dan seterusnya), bukan keseluruhan file Controller sekaligus. Tentu, saya akan pecah kodenya agar lebih fokus pada masing-masing fungsi yang Anda sebutkan: Tambah, Detail, dan Edit.

Ini adalah potongan kode dari `app/Controllers/Api/Houses.php` yang berfokus pada setiap fungsi:

-----

### **1. Kode untuk Fungsi "Detail Rumah"**

Fungsi ini digunakan untuk mengambil data spesifik satu rumah berdasarkan ID-nya. Ini sesuai dengan tampilan "Rumah Minimalis 2 Lantai di Cibubur" yang menunjukkan detail lengkap satu properti.

**File:** `app/Controllers/Api/Houses.php`

```php
<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\HouseModel;

class Houses extends ResourceController
{
    use ResponseTrait;
    protected $modelName    = 'App\Models\HouseModel';
    protected $format       = 'json';

    public function __construct()
    {
        $this->houseModel = new HouseModel();
    }

    /**
     * Mengambil detail satu rumah berdasarkan ID.
     * Endpoint: GET /api/v1/houses/{id}
     * Digunakan untuk menampilkan halaman detail rumah (misalnya, setelah mengklik "Detail" dari daftar).
     *
     * @param int $id ID rumah yang akan diambil.
     * @return mixed Respons JSON berisi detail rumah atau pesan error jika tidak ditemukan.
     */
    public function show($id = null)
    {
        $house = $this->houseModel->find($id); // Mencari data rumah berdasarkan primary key (ID)
        if ($house) {
            // Jika data rumah ditemukan, kirimkan sebagai respons JSON dengan status 200 OK
            return $this->respond($house, 200, 'Detail Rumah Berhasil Diambil');
        } else {
            // Jika rumah tidak ditemukan, kirimkan respons 404 Not Found
            return $this->failNotFound('Rumah tidak ditemukan dengan ID: ' . $id);
        }
    }

    // ... metode lain (index, create, update, delete) akan berada di sini ...
}
```

![WhatsApp Image 2025-07-12 at 20 18 25_804b6924](https://github.com/user-attachments/assets/94ffb8f6-5266-4874-87a8-14b042b3bfb1)


-----

### **2. Kode untuk Fungsi "Tambah Rumah"**

Fungsi ini bertanggung jawab untuk menerima data dari formulir "Tambah Rumah" dan menyimpannya sebagai entri baru di database.

**File:** `app/Controllers/Api/Houses.php`

```php
<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\HouseModel;

class Houses extends ResourceController
{
    use ResponseTrait;
    protected $modelName    = 'App\Models\HouseModel';
    protected $format       = 'json';

    public function __construct()
    {
        $this->houseModel = new HouseModel();
    }

    // ... metode lain (index, show) akan berada di sini ...

    /**
     * Menambahkan data rumah baru.
     * Endpoint: POST /api/v1/houses
     * Digunakan saat menekan tombol "Simpan" pada halaman "Tambah Rumah".
     * Data dikirim dari form front-end.
     *
     * @return mixed Respons JSON berisi data rumah yang baru dibuat atau pesan error validasi.
     */
    public function create()
    {
        // Mengambil data dari request POST.
        // Asumsi dari gambar "Tambah Rumah" (WhatsApp Image 2025-07-12 at 19.45.19_433be62a.jpg) yang memiliki input file,
        // kemungkinan besar data akan dikirim sebagai 'multipart/form-data', sehingga getPost() sesuai.
        $data = $this->request->getPost();

        // Validasi data input menggunakan aturan yang telah didefinisikan di HouseModel.
        // Model akan memeriksa 'nama_rumah', 'lokasi', 'harga', dll.
        if (!$this->houseModel->validate($data)) {
            // Jika validasi gagal, kembalikan respons error 400 (Bad Request)
            // dengan detail kesalahan validasi yang diambil dari Model.
            return $this->failValidationErrors($this->houseModel->errors());
        }

        // --- Contoh Penanganan Upload Gambar (Jika Anda ingin mengunggah file gambar) ---
        // Anda perlu mengaktifkan ini jika 'gambar' adalah upload file, bukan hanya URL.
        // Pastikan direktori 'writable/uploads' ada dan dapat ditulis oleh server.
        // $image = $this->request->getFile('gambar'); // 'gambar' adalah nama input type="file" di form
        // if ($image && $image->isValid() && !$image->hasMoved()) {
        //     $newName = $image->getRandomName(); // Buat nama file unik
        //     $image->move(WRITEPATH . 'uploads', $newName); // Pindahkan file ke folder writable/uploads
        //     $data['gambar'] = 'uploads/' . $newName; // Simpan path relatif di database
        // } else {
        //     $data['gambar'] = null; // Atau jika tidak ada file, set null
        // }
        // --- Akhir Contoh Penanganan Upload Gambar ---

        // Memasukkan data baru ke database melalui Model.
        // Kolom 'created_at' dan 'updated_at' akan otomatis terisi karena useTimestamps=true di Model.
        if ($this->houseModel->insert($data)) {
            // Jika operasi insert berhasil, kirim respons 201 Created.
            $response = [
                'status'  => 201,
                'error'   => null,
                'message' => 'Rumah berhasil ditambahkan.',
                // Mengambil kembali data rumah yang baru ditambahkan (termasuk ID) untuk respons.
                'data'    => $this->houseModel->find($this->houseModel->getInsertID())
            ];
            return $this->respondCreated($response);
        } else {
            // Jika ada kegagalan internal saat menyimpan ke database, kirim respons 500 Internal Server Error.
            return $this->fail('Gagal menambahkan rumah.');
        }
    }

    // ... metode lain (index, update, delete) akan berada di sini ...
}
```

![WhatsApp Image 2025-07-12 at 20 19 47_f5146823](https://github.com/user-attachments/assets/b04c0217-8efd-408b-8933-e18944f7b1cf)


-----

### **3. Kode untuk Fungsi "Edit Rumah" **

Fungsi ini digunakan untuk memperbarui data rumah yang sudah ada. Ini sesuai dengan tampilan formulir "Edit Rumah".

**File:** `app/Controllers/Api/Houses.php`

```php
<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\HouseModel;

class Houses extends ResourceController
{
    use ResponseTrait;
    protected $modelName    = 'App\Models\HouseModel';
    protected $format       = 'json';

    public function __construct()
    {
        $this->houseModel = new HouseModel();
    }

    // ... metode lain (index, show, create) akan berada di sini ...

    /**
     * Memperbarui data rumah yang sudah ada.
     * Endpoint: PUT /api/v1/houses/{id}
     * Digunakan saat menekan tombol "Simpan Perubahan" pada halaman "Edit Rumah".
     *
     * @param int $id ID rumah yang akan diperbarui.
     * @return mixed Respons JSON berisi data rumah yang diperbarui atau pesan error.
     */
    public function update($id = null)
    {
        // Mengambil data dari request body. Untuk method PUT/PATCH, data biasanya dikirim dalam format JSON mentah.
        // getRawInput() akan mengurai JSON (atau data mentah lainnya) menjadi array PHP.
        // Namun, jika Anda menggunakan form HTML biasa dengan method POST dan _method override (misalnya input hidden _method="PUT"),
        // Anda mungkin perlu menggunakan $this->request->getPost() jika form-data dikirim.
        $data = $this->request->getRawInput(); // Umumnya digunakan untuk JSON body pada PUT/PATCH

        // Memeriksa apakah rumah dengan ID yang diberikan ada di database sebelum mencoba memperbarui.
        $house = $this->houseModel->find($id);
        if (!$house) {
            // Jika rumah tidak ditemukan, kirim respons 404 Not Found.
            return $this->failNotFound('Rumah tidak ditemukan dengan ID: ' . $id);
        }

        // Melakukan validasi data yang diterima.
        // Di sini, kita menggunakan validasi dari Model, yang akan memeriksa bidang-bidang yang ada di $data.
        if (!$this->houseModel->validate($data)) {
            // Jika validasi gagal, kirim respons error 400 Bad Request.
            return $this->failValidationErrors($this->houseModel->errors());
        }

        // --- Contoh Penanganan Update Gambar (Jika Anda ingin mengelola upload/ganti file gambar) ---
        // Ini lebih kompleks karena melibatkan penghapusan file lama dan penyimpanan file baru.
        // Perlu diingat, untuk PUT/PATCH dengan upload file, front-end harus mengirim sebagai multipart/form-data
        // dan menggunakan override method untuk PUT/PATCH.
        // $image = $this->request->getFile('gambar');
        // if ($image && $image->isValid() && !$image->hasMoved()) {
        //     // Hapus gambar lama jika ada dan file-nya eksis
        //     if (!empty($house['gambar']) && file_exists(WRITEPATH . $house['gambar'])) {
        //         unlink(WRITEPATH . $house['gambar']);
        //     }
        //     $newName = $image->getRandomName();
        //     $image->move(WRITEPATH . 'uploads', $newName);
        //     $data['gambar'] = 'uploads/' . $newName;
        // } else if (isset($data['gambar']) && $data['gambar'] === '') {
        //     // Jika input gambar dikosongkan, berarti user ingin menghapus gambar
        //     if (!empty($house['gambar']) && file_exists(WRITEPATH . $house['gambar'])) {
        //         unlink(WRITEPATH . $house['gambar']);
        //     }
        //     $data['gambar'] = null;
        // }
        // --- Akhir Contoh Penanganan Update Gambar ---

        // Memperbarui data di database melalui Model.
        // Kolom 'updated_at' akan otomatis terisi karena useTimestamps=true di Model.
        if ($this->houseModel->update($id, $data)) {
            // Jika berhasil, kirim respons 200 OK dengan data rumah yang sudah diperbarui.
            $response = [
                'status'  => 200,
                'error'   => null,
                'message' => 'Rumah berhasil diperbarui.',
                // Mengambil data lengkap rumah setelah diperbarui untuk respons.
                'data'    => $this->houseModel->find($id)
            ];
            return $this->respond($response);
        } else {
            // Jika ada kegagalan internal, kirim respons 500 Internal Server Error.
            return $this->fail('Gagal memperbarui rumah.');
        }
    }

    // ... metode lain (index, delete) akan berada di sini ...
}
```
![WhatsApp Image 2025-07-12 at 20 23 11_e1f86305](https://github.com/user-attachments/assets/ba698799-cc8f-4354-bdd7-9b8ff8a4593a)


#### **5. File Routes (`app/Config/Routes.php`)**

**Lokasi File:** `app/Config/Routes.php`


```php
<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route dasar untuk halaman utama.
// Ini adalah route default yang biasanya mengarah ke halaman selamat datang atau dashboard.
$routes->get('/', 'Home::index');
$routes->group('api/v1', function($routes){
    // Menggunakan resource routing untuk otomatis membuat route CRUD untuk 'houses'.
    // Ini sangat mempermudah pengembangan API karena secara otomatis memetakan:
    //
    // GET /api/v1/houses        -> Memanggil metode index() di Api\Houses Controller (untuk mengambil semua rumah)
    // GET /api/v1/houses/{id}   -> Memanggil metode show($id) di Api\Houses Controller (untuk mengambil detail satu rumah)
    // POST /api/v1/houses       -> Memanggil metode create() di Api\Houses Controller (untuk menambahkan rumah baru)
    // PUT /api/v1/houses/{id}   -> Memanggil metode update($id) di Api\Houses Controller (untuk memperbarui rumah yang ada)
    // DELETE /api/v1/houses/{id} -> Memanggil metode delete($id) di Api\Houses Controller (untuk menghapus rumah)
    $routes->resource('houses', ['controller' => 'Api\Houses']);
});

// Anda bisa menambahkan route lain di sini jika diperlukan, misalnya untuk halaman admin, autentikasi, dll.

```


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

