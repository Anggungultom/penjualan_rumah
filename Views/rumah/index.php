<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Rumah Dijual</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
<div class="container">

    <h2>Daftar Rumah Dijual</h2>

    <!-- Intro Section -->
    <section class="intro-section">
        <div class="intro-icon">
            <!-- SVG cadangan -->
            <svg width="60" height="60" viewBox="0 0 64 64" fill="#1abc9c" xmlns="http://www.w3.org/2000/svg">
                <rect width="64" height="64" rx="16" fill="#1abc9c" />
                <path d="M32 16L16 28H20V44H28V36H36V44H44V28H48L32 16Z" fill="white"/>
            </svg>
        </div>
        <div class="intro-text">
            <p><strong>Rumah Impian</strong> adalah platform modern untuk membantu Anda menemukan rumah idaman secara cepat, mudah, dan terpercaya.
            Kami menyediakan pilihan properti terbaik dengan informasi lengkap, foto berkualitas tinggi, dan harga bersaing di lokasi strategis.
            Temukan rumah ideal Anda dengan tampilan menarik dan proses yang menyenangkan!</p>
        </div>
    </section>

    <a href="<?= base_url('index.php/rumah/tambah') ?>" class="btn">+ Tambah Rumah</a>

    <?php if (empty($rumah)) : ?>
        <p>Belum ada data rumah. Tambahkan sekarang!</p>
    <?php else : ?>
        <?php foreach ($rumah as $r): ?>
            <div class="rumah-item">
                <img src="<?= base_url('uploads/' . esc($r['gambar'])) ?>" alt="<?= esc($r['nama']) ?>">
                <div class="rumah-info">
                    <h3><?= esc($r['nama']) ?></h3>
                    <p><strong>Lokasi:</strong> <?= esc($r['lokasi']) ?></p>
                    <p><strong>Harga:</strong> Rp <?= number_format($r['harga'], 0, ',', '.') ?></p>
                    <p><?= esc($r['deskripsi']) ?></p>

                    <div class="rumah-actions">
                        <a href="<?= base_url('index.php/rumah/detail/' . $r['id']) ?>">Detail</a> |
                        <a href="<?= base_url('index.php/rumah/edit/' . $r['id']) ?>">Edit</a> |
                        <a href="<?= base_url('index.php/rumah/hapus/' . $r['id']) ?>" onclick="return confirm('Yakin hapus rumah ini?')">Hapus</a>
                    </div>

                    <div class="kontak-penjual">
                        <p><strong>Hubungi Penjual:</strong></p>
                        <ul>
                            <li>📞 <a href="tel:08123456789">0812-3456-789</a></li>
                            <li>📧 <a href="mailto:rumahbaru@gmail.com">rumahku@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>
</body>
</html>
