<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Rumah</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="detail-container">
    <h2 class="detail-title"><?= esc($rumah['nama']) ?></h2>

    <img class="detail-image" src="/uploads/<?= esc($rumah['gambar']) ?>" alt="<?= esc($rumah['nama']) ?>">

    <div class="detail-info">
        <p><strong>Lokasi:</strong> <?= esc($rumah['lokasi']) ?></p>
        <p><strong>Harga:</strong> Rp <?= number_format($rumah['harga'], 0, ',', '.') ?></p>
        <p><strong>Deskripsi:</strong><br> <?= esc($rumah['deskripsi']) ?></p>
    </div>

    <div class="detail-kontak">
        <p>Hubungi Penjual:</p>
        <ul>
            <li>📞 <a href="tel:08123456789">0812-3456-789</a></li>
            <li>📧 <a href="mailto:rumahku@example.com">rumahku@example.com</a></li>
        </ul>
    </div>

    <a href="/index.php/rumah" class="back-btn">← Kembali ke Daftar Rumah</a>
</div>

</body>
</html>
