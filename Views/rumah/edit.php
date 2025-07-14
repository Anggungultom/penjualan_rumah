<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rumah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #f8f9fa);
            font-family: 'Poppins', sans-serif;
        }
        .edit-container {
            max-width: 800px;
            margin: 70px auto;
            background: #ffffff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            transition: all 0.3s ease-in-out;
        }
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 16px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.2);
        }
        .preview-img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-primary {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 12px;
            background: linear-gradient(45deg, #0d6efd, #66b2ff);
            border: none;
        }
        .btn-secondary {
            margin-left: 12px;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 12px;
            background-color: #dee2e6;
            border: none;
            color: #333;
            text-decoration: none;
        }
        h2 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 35px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="edit-container">
    <h2>Edit Rumah</h2>

    <form action="/index.php/rumah/update/<?= $rumah['id'] ?>" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Rumah:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($rumah['nama']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi:</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= esc($rumah['lokasi']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= esc($rumah['harga']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= esc($rumah['deskripsi']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini:</label><br>
            <img src="/uploads/<?= esc($rumah['gambar']) ?>" alt="Gambar Rumah" class="preview-img">
        </div>

        <div class="mb-4">
            <label for="gambar" class="form-label">Ganti Gambar (Opsional):</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="/index.php/rumah" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
