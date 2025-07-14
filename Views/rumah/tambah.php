<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Rumah</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Tambah Rumah</h2>
        <form action="/rumah/simpan" method="post" enctype="multipart/form-data" class="rumah-form">
            <div class="form-group">
                <label for="nama">Nama Rumah:</label>
                <input type="text" name="nama" id="nama" required>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <textarea name="lokasi" id="lokasi" required></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" id="harga" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi"></textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" required>
            </div>

            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>
</body>
</html>
